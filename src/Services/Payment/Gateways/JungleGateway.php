<?php

namespace App\Services\Payment\Gateways;

use App\Services\Payment\GatewayInterface;

class JungleGateway implements GatewayInterface
{
    private $apiUrl = 'https://api.junglepagamentos.com/v1/transactions';

    public function generatePayload(string $pixKey, float $amount, array $options = []): array
    {
        // $pixKey in this context is the Secret Key for Jungle API
        $secretKey = $pixKey;

        // Amount is in cents
        $amountInCents = (int) round($amount * 100);

        // Default to pix if not provided
        $paymentMethod = $options['paymentMethod'] ?? 'pix';

        // Extract customer data
        $customer = $options['customer'] ?? [];
        $name = $customer['name'] ?? 'Cliente Padrão';
        $email = $customer['email'] ?? 'undefined@email.com';
        $documentNumber = $customer['document'] ?? '00000000000';
        $phone = $customer['phone'] ?? '11999999999';

        $payload = [
            'amount' => $amountInCents,
            'paymentMethod' => $paymentMethod,
            'customer' => [
                'name' => $name,
                'email' => $email,
                'document' => [
                    'number' => preg_replace('/[^0-9]/', '', $documentNumber),
                    'type' => strlen(preg_replace('/[^0-9]/', '', $documentNumber)) > 11 ? 'cnpj' : 'cpf'
                ],
                'phone' => preg_replace('/[^0-9]/', '', $phone)
            ],
            'items' => [
                [
                    'title' => 'Entrada Simulação de Crédito',
                    'unitPrice' => $amountInCents,
                    'quantity' => 1,
                    'tangible' => false
                ]
            ]
        ];

        if ($paymentMethod === 'boleto') {
            $payload['boleto'] = ['expiresInDays' => 3];
        } else if ($paymentMethod === 'pix') {
            $payload['pix'] = ['expiresInDays' => 3];
        }

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => [
                    "Content-Type: application/json",
                    "Authorization: Basic " . base64_encode($secretKey . ':x')
                ],
                'content' => json_encode($payload),
                'ignore_errors' => true // Important to fetch content even on 4xx/5xx responses
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false
            ]
        ];

        $context = stream_context_create($options);
        $response = @file_get_contents($this->apiUrl, false, $context);

        if ($response === false) {
            return ['error' => true, 'message' => 'Falha de comunicação com a API Jungle (Servidor offline ou timeout).'];
        }

        $httpCode = 200;
        if (isset($http_response_header) && count($http_response_header) > 0) {
            preg_match('#HTTP/[\d\.]+\s+(\d+)#i', $http_response_header[0], $matches);
            if (isset($matches[1])) {
                $httpCode = (int) $matches[1];
            }
        }

        $responseData = json_decode($response, true);

        if ($httpCode >= 400 || !isset($responseData['id'])) {
            return [
                'error' => true,
                'message' => 'Erro na adquirente: ' . ($responseData['message'] ?? 'Desconhecido'),
                'raw_response' => $responseData
            ];
        }

        // Handle success response based on method
        if ($paymentMethod === 'pix' && isset($responseData['pix'])) {
            $qrUrl = !empty($responseData['pix']['url']) ? $responseData['pix']['url'] : 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($responseData['pix']['qrcode']);

            return [
                'payload' => $responseData['pix']['qrcode'],
                'qrUrl' => $qrUrl,
                'transaction_id' => $responseData['id'],
                'raw' => $responseData
            ];
        } elseif ($paymentMethod === 'boleto' && isset($responseData['boleto'])) {
            return [
                'barcode' => $responseData['boleto']['barcode'],
                'digitableLine' => $responseData['boleto']['digitableLine'],
                'url' => $responseData['boleto']['url'],
                'transaction_id' => $responseData['id'],
                'raw' => $responseData
            ];
        }

        return ['error' => true, 'message' => 'Resposta inesperada da API Jungle.'];
    }
}
