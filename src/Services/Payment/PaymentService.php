<?php

namespace App\Services\Payment;

class PaymentService
{
    private $gateway;

    public function __construct($gatewayName = 'safe-bank')
    {
        $this->gateway = $this->factory($gatewayName);
    }

    /**
     * Factory to instantiate the active gateway
     */
    private function factory($name): GatewayInterface
    {
        require_once __DIR__ . '/GatewayInterface.php';
        switch ($name) {
            case 'safe-bank':
                require_once __DIR__ . '/Gateways/SafeBankGateway.php';
                return new Gateways\SafeBankGateway();
            default:
                // Fallback safe
                require_once __DIR__ . '/Gateways/SafeBankGateway.php';
                return new Gateways\SafeBankGateway();
        }
    }

    /**
     * Clean R$ formatted string to decimal string
     */
    public function cleanAmount($formattedAmount)
    {
        $valorLimpo = preg_replace('/[R$\s.]/u', '', $formattedAmount);
        return (float) str_replace(',', '.', $valorLimpo);
    }

    /**
     * Delegates payload generation to the active gateway
     */
    public function preparePixPayload($pixKey, $amount)
    {
        return $this->gateway->generatePayload($pixKey, $amount);
    }
}
