<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class PagFanService
{
    private $clientId;
    private $clientSecret;
    private $baseUrl;
    private $accessToken;

    public function __construct($clientId, $clientSecret, $baseUrl, $)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Obtém token de acesso
     */
    public function getAccessToken()
    {
        try {
            

            $credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");

            $response = Http::withHeaders([
                'Authorization' => "Basic {$credentials}",
                'Content-Type' => 'application/json',
            ])->post("{$this->baseUrl}/oauth/token");


            if ($response->successful()) {
                $data = $response->json();
                $this->accessToken = $data['access_token'];
                return $this->accessToken;
            }
            
            throw new Exception('Falha ao obter token: ' . $response->body());
        } catch (Exception $e) {
            Log::error('Erro ao obter token PagFan: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Obtém saldo da conta
     */
    public function getBalance()
    {
        try {
            $token = $this->getAccessToken();

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'Content-Type' => 'application/json',
            ])->get("{$this->baseUrl}/balance");

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('Falha ao obter saldo: ' . $response->body());
        } catch (Exception $e) {
            Log::error('Erro ao obter saldo PagFan: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Gera QRCode PIX
     */
    public function generateQrCode($amount, $externalId, $payer, $postbackUrl, $payerQuestion)
    {
        try {
            $token = $this->getAccessToken();

            $payload = [
                'amount' => (string) $amount,
                'external_id' => $externalId,
                'payerQuestion' => $payerQuestion,
                'payer' => $payer,
                'postbackUrl' => $postbackUrl,
            ];

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'Content-Type' => 'application/json',
            ])->post("{$this->baseUrl}/pix/qrcode", $payload);

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('Falha ao gerar QRCode: ' . $response->body());
        } catch (Exception $e) {
            Log::error('Erro ao gerar QRCode PagFan: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Realiza um pagamento PIX
     */
    public function makePayment($amount, $description, $externalId, $creditParty)
    {
        try {
            $token = $this->getAccessToken();

            $payload = [
                'creditParty' => $creditParty,
                'amount' => $amount,
                'description' => $description,
                'external_id' => $externalId,
            ];

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'Content-Type' => 'application/json',
            ])->post("{$this->baseUrl}/pix/payment", $payload);

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('Falha ao realizar pagamento: ' . $response->body());
        } catch (Exception $e) {
            Log::error('Erro ao realizar pagamento PagFan: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Verifica status de uma transação
     */
    public function checkTransactionStatus($transactionId)
    {
        try {
            $token = $this->getAccessToken();

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'Content-Type' => 'application/json',
            ])->get("{$this->baseUrl}/transaction/{$transactionId}");

            if ($response->successful()) {
                return $response->json();
            }

            throw new Exception('Falha ao verificar transação: ' . $response->body());
        } catch (Exception $e) {
            Log::error('Erro ao verificar transação PagFan: ' . $e->getMessage());
            throw $e;
        }
    }
}