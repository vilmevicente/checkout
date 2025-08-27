<?php

namespace App\Http\Controllers;

use App\Helpers\ConfigHelper;
use App\Models\Order;
use App\Services\PagFanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class PagFanController extends Controller
{
    protected $pagFanService;

    public function __construct(PagFanService $pagFanService)
    {
        $this->pagFanService = $pagFanService;
    }

    /**
     * Obtém saldo da conta
     */
    public function getBalance()
    {
        try {
            $balance = $this->pagFanService->getBalance();
            return response()->json($balance);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao obter saldo',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Gera QRCode PIX
     */
    public function generateQrCode(Order $order)
    {
       

        try {
            $qrCode = $this->pagFanService->generateQrCode(
                $request->amount,
                $request->external_id,
                $request->payer,
                $request->payerQuestion
            );

            return response()->json($qrCode);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao gerar QRCode',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Realiza um pagamento PIX
     */
    public function makePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string|max:255',
            'external_id' => 'required|string|max:255',
            'credit_party.name' => 'required|string|max:255',
            'credit_party.key_type' => 'required|string|in:CPF,CNPJ,EMAIL,PHONE,EVP',
            'credit_party.key' => 'required|string|max:255',
            'credit_party.tax_id' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Dados inválidos',
                'details' => $validator->errors()
            ], 422);
        }

        try {
            $payment = $this->pagFanService->makePayment(
                $request->amount,
                $request->description,
                $request->external_id,
                $request->credit_party
            );

            return response()->json($payment);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao realizar pagamento',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Webhook para receber notificações de pagamento
     */
    public function webhook(Request $request)
    {
        $data = $request->all();

        // Log para debug
        \Log::info('Webhook PagFan recebido:', $data);

        // Verificar se é uma notificação de PIX recebido
        if (isset($data['requestBody']['transactionType']) && 
            $data['requestBody']['transactionType'] === 'RECEIVEPIX') {
            
            $transaction = $data['requestBody'];
            
            // Processar a transação
            $this->processTransaction($transaction);
            
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'ignored']);
    }

    /**
     * Processa uma transação recebida via webhook
     */
   private function processTransaction($transaction)
{
    \Log::info('Processando transação PagFan:', $transaction);

    $order = Order::with(['products.attachments', 'upsells.attachments'])
        ->where('reference', $transaction['external_id'])
        ->first();

    if ($order && $transaction['status'] === 'RECEIVEPIX') {
        // Marcar pedido como pago
        $order->update([
            'status' => 'paid',
            'paid_at' => now(),
            'transaction_id' => $transaction['transactionId']
        ]);

        try {
            // Enviar e-mail para cada produto principal
            foreach ($order->products as $product) {
                $this->sendProductEmail($order, $product);
            }

            // Enviar e-mail para cada upsell
            foreach ($order->upsells as $upsell) {
                $this->sendProductEmail($order, $upsell);
            }

            \Log::info('E-mails enviados com sucesso para o pedido: ' . $order->reference);

        } catch (\Exception $e) {
            \Log::error('Erro ao enviar e-mails: ' . $e->getMessage());
        }
    }
}

private function sendProductEmail($order, $product)
{
    try {
        $smtpConfig = ConfigHelper::getSmtpConfig();

        \Mail::send('admin.emails.product-delivery', [
            'order' => $order,
            'product' => $product,
            'deliveryContent' => $product->delivery_content, // incluir instruções de entrega
            'customerName' => $order->customer_name
        ], function ($message) use ($order, $product, $smtpConfig) {
            $message->to($order->customer_email)
                ->subject('Acesso ao ' . $product->name . ' - Pedido #' . $order->reference);

            if (!empty($smtpConfig['from']['address'])) {
                $message->from(
                    $smtpConfig['from']['address'],
                    $smtpConfig['from']['name'] ?? config('app.name')
                );
            }

            // Anexar ficheiros do produto
            if ($product->attachments && $product->attachments->count() > 0) {
                foreach ($product->attachments as $attachment) {
                    if ($attachment->file_path && Storage::exists($attachment->file_path)) {
                        $message->attach(
                            Storage::path($attachment->file_path),
                            ['as' => $attachment->name ?? $product->name . '.pdf']
                        );
                    }
                }
            }
        });

        \Log::info('E-mail enviado para produto: ' . $product->name);

    } catch (\Exception $e) {
        \Log::error('Erro ao enviar e-mail para ' . $product->name . ': ' . $e->getMessage());
        throw $e; // Re-throw para tratamento superior
    }
}


}