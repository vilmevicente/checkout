<?php

namespace App\Http\Controllers;

use App\Helpers\ConfigHelper;
use App\Models\checkout;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\PagFanService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     *
     */

protected $pagFanService;

    public function __construct(PagFanService $pagFanService)
    {
        $this->pagFanService = $pagFanService;
    }


    public function index($slug)
{
  try {
    $product = Product::with([
        'features', 
        'testimonials', 
        'upsells',
        'deliveryMethods'
    ])->where('slug', $slug)->firstOrFail();
} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    // Redirecionar para página 404 ou mostrar erro
    abort(404, 'Produto não encontrado');
}

        return view('checkout', [
            'mainProduct' => $product,
            'upsells' => $product->upsells,
            'depoimentos' => $product->testimonials
        ]);
}

      public function process(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string',
        'product_id' => 'required|exists:products,id',
        'g-recaptcha-response' => ConfigHelper::isRecaptchaEnabled() ? 'required|captcha' : 'nullable'
    ]);

    if ($validator->fails()) {

          $errors = $validator->errors();
    if ($errors->has('g-recaptcha-response')) {
        // Manter a mensagem de erro mas indicar para resetar o captcha
        $errors->add('reset_captcha', true);
    }
        return response()->json([
            'error' => 'Dados inválidos',
            'details' => $errors,
            'reset_captcha' => $errors->has('g-recaptcha-response')
        ], 422);
    }

    try {
        return \DB::transaction(function () use ($request) {
            // Buscar produto principal
            $mainProduct = Product::findOrFail($request->product_id);
            
            // Criar pedido
            $order = Order::create([
                'reference' => Order::generateReference(),
                'customer_name' => $request->name,
                'customer_email' => $request->email,
                'customer_phone' => $request->phone,
                'subtotal' => $mainProduct->price,
                'discount' => $mainProduct->original_price ? 
                             ($mainProduct->original_price - $mainProduct->price) : 0,
                'total' => $mainProduct->price,
                'payment_method' => 'pix',
                'status' => 'pending',
                'pix_expires_at' => now()->addMinutes(30)
            ]);

            // Adicionar produto principal
            $this->addProductToOrder($order, $mainProduct, 'main');

            // Adicionar upsells selecionados
            if ($request->has('upsells')) {
                foreach ($request->upsells as $upsellId) {
                    $upsell = Product::find($upsellId);
                    if ($upsell && $upsell->is_active) {
                        $this->addProductToOrder($order, $upsell, 'upsell');
                    }
                }
            }

            // Recalcular totais
            $this->calculateOrderTotals($order);

            // Gerar PIX - COM VALIDAÇÃO CRÍTICA
            $response = $this->pagFanService->generateQrCode(
                $order->total,
                $order->reference,
                [
                    'name' => $order->customer_name,
                    'document' => "000000000", // CPF genérico
                    'email' => $order->customer_email,
                ],
                $order->reference
            );

            // VALIDAÇÃO OBRIGATÓRIA DO PIX CODE
            if (empty($response['code'])) {
                \DB::rollBack();
                \Log::error('Falha ao gerar PIX: QRCode vazio', [
                    'order_id' => $order->id,
                    'response' => $response,
                    'request' => [
                        $order->total,
                $order->reference,
                [
                    'name' => $order->customer_name,
                    'document' => "00000000", // CPF genérico
                    'email' => $order->customer_email,
                ],
                $order->reference
                    ]
                ]);

                return response()->json([
                    'error' => 'Falha ao gerar código PIX',
                    'message' => 'Não foi possível gerar o código de pagamento. Por favor, tente novamente em alguns instantes.'
                ], 500);
            }

            $pixCode = $response['code'];
            
            // SALVAR PIX CODE NO PEDIDO
            $order->update([
                'pix_code' => $pixCode,
            ]);

            // Verificar novamente se o PIX foi salvo corretamente
            $order->refresh();
            if (empty($order->pix_code)) {
                \DB::rollBack();
                \Log::critical('Falha crítica: PIX não foi salvo no pedido', [
                    'order_id' => $order->id,
                    'pix_code' => $pixCode
                ]);

                return response()->json([
                    'error' => 'Erro no processamento do pagamento',
                    'message' => 'Ocorreu um erro interno. Por favor, entre em contato com o suporte.'
                ], 500);
            }

            // Enviar e-mail de confirmação
            try {
                $this->sendConfirmationEmail($order);
            } catch (\Exception $emailError) {
                \Log::warning('Falha ao enviar e-mail, mas pedido foi criado', [
                    'order_id' => $order->id,
                    'error' => $emailError->getMessage()
                ]);
                // Não faz rollback se falhar o e-mail, apenas \Loga o erro
            }

            // \Log de sucesso
            \Log::info('Pedido criado com sucesso', [
                'order_id' => $order->id,
                'reference' => $order->reference,
                'total' => $order->total
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pedido criado com sucesso!',
                'order' => [
                    'reference' => $order->reference,
                    'total' => $order->total,
                    'pix_code' => $pixCode,
                ],
            ]);

        });

    } catch (\Exception $e) {
        \Log::error('Erro crítico no checkout: ' . $e->getMessage(), [
            'exception' => $e,
            'request_data' => $request->all()
        ]);
        
        return response()->json([
            'error' => 'Erro no processamento',
            'message' => 'Ocorreu um erro inesperado. Por favor, tente novamente em alguns instantes.'
        ], 500);
    }
}


// Método auxiliar para adicionar validação de PIX
private function validatePixResponse($response)
{
    if (!is_array($response)) {
        return false;
    }

    if (empty($response['code'])) {
        return false;
    }

    // Validar se o QR code tem formato básico de PIX
    if (!preg_match('/^000201/', $response['code'])) {
        return false;
    }

    return true;
}
    

    private function addProductToOrder(Order $order, Product $product, string $type): void
    {
        OrderItem::create([
            'order_id' => $order->id,
            'product_type' => $type,
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'original_price' => $product->original_price,
            'quantity' => 1,
            'metadata' => [
                'description' => $product->description,
                'delivery_content' => $product->delivery_content,
                'features' => $product->features->toArray(),
                'delivery_methods' => $product->deliveryMethods->toArray()
            ]
        ]);
    }

    private function calculateOrderTotals(Order $order): void
    {
        $subtotal = 0;
        $discount = 0;

        foreach ($order->items as $item) {
            $subtotal += $item->price;
            if ($item->original_price) {
                $discount += ($item->original_price - $item->price);
            }
        }

        $order->update([
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $subtotal
        ]);
    }

    /**
     * Gerar código PIX (simulação)
     */
    private function generatePixCode(Order $order, ): string
    {
        // Em produção, integrar com API de pagamento como:
        // - Mercado Pago
        // - PagSeguro
        // - Gerencianet
        // - Asaas
        
        return "00020126580014br.gov.bcb.pix0136" . uniqid() . 
               "5204000053039865406" . number_format($order->total, 2) . 
               "5802BR5913Minha Loja6008Sao Paulo62070503***6304" . 
               substr(md5($order->reference), 0, 4);
    }

        private function sendConfirmationEmail(Order $order): void
    {
        try {
            // Usar configurações SMTP do banco
            $smtpConfig = ConfigHelper::getSmtpConfig();
            
            \Mail::send('admin.emails.order-confirmation', ['order' => $order], function ($message) use ($order, $smtpConfig) {
                $message->to($order->customer_email)
                        ->subject('Confirmação do Pedido #' . $order->reference);
                
                if (!empty($smtpConfig['from']['address'])) {
                    $message->from(
                        $smtpConfig['from']['address'], 
                        $smtpConfig['from']['name'] ?? config('app.name')
                    );
                }
            });

        } catch (\Exception $e) {
            \Log::error('Erro ao enviar e-mail: ' . $e->getMessage());
        }
    }

    /**
     * Página de sucesso
     */
public function success($reference)
{
    $order = Order::where('reference', $reference)->firstOrFail();

    if ($order->status === 'success') {
        return response()->json([
            'success' => true,
            'message' => 'Pagamento confirmado com sucesso.',
            'success_redirect_link' => $order->success_redirect_link, 
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'O pagamento ainda está pendente, por favor realize o pagamento',
    ]);
}

}
