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

    // Buscar apenas o pedido (sem with, pois mainProduct() e upsells() cuidam disso)
    $order = Order::where('reference', $transaction['external_id'])->first();

    if (!$order) {
        \Log::error('Pedido não encontrado: ' . $transaction['external_id']);
        return;
    }

    if ($transaction['status'] === 'PAID') {
        // Marcar pedido como pago
        $order->markAsPaid($transaction['status'], $transaction['dateApproval'], $transaction);

        try {
            // Produto principal
            $mainProductItem = $order->mainProduct();
            if ($mainProductItem && $mainProductItem->product) {
                $this->sendProductEmail($order, $mainProductItem->product);
            }

            // Upsells
            $upsellItems = $order->upsells();
            foreach ($upsellItems as $upsellItem) {
                if ($upsellItem->product) {
                    $this->sendProductEmail($order, $upsellItem->product);
                }
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

        $relativePath = ltrim($attachment->file_path, '/'); // ex.: product-attachments/arquivo.ext

        // 1) Caminho padrão via symlink: public/storage/<relativePath>
        $absolutePath = public_path('storage/' . $relativePath);

        // 2) Fallback: caso esteja direto em public/<relativePath>
        if (!file_exists($absolutePath)) {
            $absolutePath = public_path($relativePath);
        }

        // 3) Último fallback: disco 'public'
        if (!file_exists($absolutePath) && \Storage::disk('public')->exists($relativePath)) {
            $absolutePath = \Storage::disk('public')->path($relativePath);
        }

        \Log::info('Caminho para anexar: ' . $absolutePath);

        if (file_exists($absolutePath)) {
            try {
                $downloadName = $attachment->name ?: ($product->name . '_anexo');
                $ext = pathinfo($absolutePath, PATHINFO_EXTENSION);

                if ($ext && !str_contains($downloadName, '.')) {
                    $downloadName .= '.' . $ext;
                }

                $message->attach($absolutePath, ['as' => $downloadName]);
                \Log::info('Anexo adicionado: ' . $downloadName);

            } catch (\Exception $e) {
                \Log::warning('Erro ao anexar arquivo ' . $absolutePath . ': ' . $e->getMessage());
                continue;
            }
        } else {
            \Log::warning('Arquivo não encontrado para anexar: ' . $absolutePath);
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

private function getExtensionFromMime($mime)
{
    $mimeMap = [
        'application/pdf' => 'pdf',
        'application/zip' => 'zip',
        'application/vnd.rar' => 'rar',
        'application/x-rar-compressed' => 'rar',
        'application/x-zip-compressed' => 'zip',
        'application/msword' => 'doc',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
        'application/vnd.ms-excel' => 'xls',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
        'application/vnd.ms-powerpoint' => 'ppt',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/svg+xml' => 'svg',
        'text/plain' => 'txt',
        'text/csv' => 'csv',
        'audio/mpeg' => 'mp3',
        'audio/wav' => 'wav',
        'video/mp4' => 'mp4',
        'video/quicktime' => 'mov',
        'application/octet-stream' => 'bin',
    ];
    
    return $mimeMap[$mime] ?? null;
}


}