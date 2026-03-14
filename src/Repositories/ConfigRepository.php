<?php

namespace App\Repositories;

class ConfigRepository
{
    private $paymentConfigPath;

    public function __construct(string $paymentConfigPath)
    {
        $this->paymentConfigPath = $paymentConfigPath;
    }

    /**
     * Get global configuration from payment.json
     */
    public function getPaymentConfig(): array
    {
        if (!file_exists($this->paymentConfigPath)) {
            return [
                'pix_key' => '',
                'active_gateway' => 'safe-bank',
                'whatsapp_number' => ''
            ];
        }
        $content = file_get_contents($this->paymentConfigPath);
        return json_decode($content, true) ?: [];
    }

    /**
     * Save payment configuration
     */
    public function savePaymentConfig(array $config): bool
    {
        $dir = dirname($this->paymentConfigPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        return file_put_contents($this->paymentConfigPath, json_encode($config, JSON_PRETTY_PRINT)) !== false;
    }
}
