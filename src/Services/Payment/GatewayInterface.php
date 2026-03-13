<?php

namespace App\Services\Payment;

interface GatewayInterface
{
    /**
     * Generates the payment payload (PIX QR Code, etc.)
     * 
     * @param string $pixKey The receiver's PIX key (or API key depending on context)
     * @param float $amount The structured amount
     * @param array $options Additional data like customer info, payment method
     * @return array Contains 'payload' (string), 'qrUrl' (string), or 'error' (bool)
     */
    public function generatePayload(string $pixKey, float $amount, array $options = []): array;
}
