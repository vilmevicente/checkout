<?php

namespace App\Http\Controllers;

use App\Helpers\ConfigHelper;
use App\Models\checkout;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($produto)
{
    // Buscar o produto principal (você pode ajustar a lógica para buscar o produto desejado)
     $mainProduct = Product::with(['features', 'testimonials', 'attachments', 'upsells', 'deliveryMethods'])
                          ->where('is_active', true)
                          ->where(function($query) use ($produto) {
                              $query->where('id', $produto);
                        })
                          ->firstOrFail();

    // Formatar os dados do produto principal
    $formattedMainProduct = [
        'id' => $mainProduct->id,
        'name' => $mainProduct->name,
        'price' => (float) $mainProduct->price,
        'originalPrice' => (float) $mainProduct->original_price,
        'mainbanner' => $mainProduct->main_banner,
        'description' => $mainProduct->description,
        'secondarybanner' => $mainProduct->secondary_banner,
        'delivery_content' => $mainProduct->delivery_content,
        'features' => $mainProduct->features->map(function($feature) {
            return [
                'name' => $feature->name,
                'description' => $feature->description,
                'icon' => $feature->icon // assumindo que há um campo 'icon' no modelo Feature
            ];
        })->toArray(),
    ];

    // Buscar upsells ativos
    $upsells = $mainProduct->upsells->map(function($upsell) {
        return [
            'id' => $upsell->id,
            'name' => $upsell->name,
            'price' => (float) $upsell->pivot->discount_price,
            'originalPrice' => (float) $upsell->price,
            'discount' => round((($upsell->price - $upsell->pivot->discount_price) / $upsell->price) * 100) . '% OFF',
            'image' => $upsell->main_banner // ou secondary_banner_url, dependendo da sua necessidade
        ];
    })->toArray();

    // Buscar depoimentos
    $depoimentos = $mainProduct->testimonials->map(function($testimonial) {
        return [
            'name' => $testimonial->name,
            'text' => $testimonial->text, // assumindo que há um campo 'content'
            'image' => $testimonial->image, // assumindo que há um accessor para image_url
            'username' => $testimonial->username // assumindo que há um campo 'username'
        ];
    })->toArray();

    return view('checkout', [
        'mainProduct' => $formattedMainProduct,
        'upsells' => $upsells,
        'depoimentos' => $depoimentos,
    ]);
}

     public function process(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'g-recaptcha-response' => ConfigHelper::isRecaptchaReady() ? 'required|captcha' : 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Iniciar transação
            return \DB::transaction(function () use ($request) {
                // Criar o pedido
                $order = Order::create([
                    'reference' => Order::generateReference(),
                    'customer_name' => $request->name,
                    'customer_email' => $request->email,
                    'customer_phone' => $request->phone,
                    'subtotal' => 0,
                    'discount' => 0,
                    'total' => 0,
                    'payment_method' => 'pix',
                    'status' => 'pending',
                    'pix_expires_at' => now()->addMinutes(30)
                ]);

                // Adicionar produto principal
                $mainProduct = Product::find($request->main_product_id);
                if ($mainProduct) {
                    $this->addProductToOrder($order, $mainProduct, 'main');
                }

                // Adicionar upsells selecionados
                if ($request->has('upsells')) {
                    foreach ($request->upsells as $upsellId) {
                        $upsell = Product::find($upsellId);
                        if ($upsell) {
                            $this->addProductToOrder($order, $upsell, 'upsell');
                        }
                    }
                }

                // Calcular totais
                $this->calculateOrderTotals($order);

                // Gerar código PIX (simulação - na prática integrar com API de pagamento)
                $pixCode = $this->generatePixCode($order);

                $order->update([
                    'pix_code' => $pixCode
                ]);

                // Enviar e-mail de confirmação
                $this->sendConfirmationEmail($order);

                // Redirecionar para página de sucesso
                return redirect()->route('checkout.success', $order->reference)
                    ->with('success', 'Pedido criado com sucesso!');
            });

        } catch (\Exception $e) {
            \Log::error('Erro no checkout: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Erro ao processar pedido. Tente novamente.')
                ->withInput();
        }
    }

    /**
     * Adicionar produto ao pedido
     */
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
                'features' => $product->features,
                'delivery_method' => $product->delivery_method
            ]
        ]);
    }

    /**
     * Calcular totais do pedido
     */
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
    private function generatePixCode(Order $order): string
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
            
            \Mail::send('emails.order-confirmation', ['order' => $order], function ($message) use ($order, $smtpConfig) {
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
        
        return view('checkout.success', compact('order'));
    }

}
