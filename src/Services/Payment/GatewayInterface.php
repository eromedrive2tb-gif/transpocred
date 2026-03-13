<?php

namespace App\Services\Payment;

interface GatewayInterface
{
    /**
     * Generates the payment payload (PIX QR Code, etc.)
     * 
     * @param string $pixKey The receiver's PIX key
     * @param float $amount The structured amount
     * @return array Contains 'payload' (string) and 'qrUrl' (string)
     */
    public function generatePayload(string $pixKey, float $amount): array;
}
