<?php

namespace App\Services\Payment;

class PaymentService
{
    /**
     * Clean R$ formatted string to decimal string
     */
    public function cleanAmount($formattedAmount)
    {
        $valorLimpo = preg_replace('/[R$\s.]/u', '', $formattedAmount);
        return str_replace(',', '.', $valorLimpo);
    }

    /**
     * Prepare PIX Payload and QR Code URL
     */
    public function preparePixPayload($pixKey, $amount)
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
