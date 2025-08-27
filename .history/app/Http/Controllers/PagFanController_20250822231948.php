<?php

namespace App\Http\Controllers;

use App\Services\PagFanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function generateQrCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0.01',
            'external_id' => 'required|string|max:255',
            'payer.name' => 'required|string|max:255',
            'payer.document' => 'nullable|string|max:20',
            'payer.email' => 'nullable|email',
            'postback_url' => 'nullable|url',
            'payer_question' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Dados inválidos',
                'details' => $validator->errors()
            ], 422);
        }

        try {
            $qrCode = $this->pagFanService->generateQrCode(
                $request->amount,
                $request->external_id,
                $request->payer,
                $request->postback_url,
                $request->payer_question
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
        // Implemente a lógica para processar a transação
        // Ex: atualizar status do pedido, liberar acesso, etc.
        
        \Log::info('Processando transação PagFan:', $transaction);
        
        // Exemplo de implementação:
        /*
        $order = Order::where('external_id', $transaction['external_id'])->first();
        
        if ($order && $transaction['status'] === 'PAID') {
            $order->update([
                'status' => 'paid',
                'paid_at' => $transaction['dateApproval'],
                'transaction_id' => $transaction['transactionId']
            ]);
            
            // Liberar acesso ao produto/serviço
            event(new OrderPaid($order));
        }
        */
    }
}