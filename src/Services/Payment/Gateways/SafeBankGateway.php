<?php

namespace App\Services\Payment\Gateways;

use App\Services\Payment\GatewayInterface;
use App\Services\Payment\PixGenerator;

class SafeBankGateway implements GatewayInterface
{
    public function __construct()
    {
        // Require legacy components if necessary
        if (!class_exists('App\Services\Payment\PixGenerator')) {
            require_once __DIR__ . '/../PixGenerator.php';
        }
    }

    public function generatePayload(string $pixKey, float $amount, array $options = []): array
    {
        $pixGenerator = new PixGenerator($pixKey, $amount);
        $payload = $pixGenerator->getPayload();
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . urlencode($payload);

        return [
            'payload' => $payload,
            'qrUrl' => $qrUrl
        ];
    }
}
