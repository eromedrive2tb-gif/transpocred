<?php

namespace App\Services;

class TurnstileService
{
    private $secretKey;

    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * Validate the Turnstile token with Cloudflare
     * 
     * @param string $token The token from the client-side widget
     * @param string|null $remoteip The visitor's IP address
     * @return array Response from Cloudflare API
     */
    public function validate(string $token, ?string $remoteip = null): array
    {
        if (empty($token)) {
            return ['success' => false, 'error-codes' => ['missing-input-response']];
        }

        $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

        $data = [
            'secret' => $this->secretKey,
            'response' => $token
        ];

        if ($remoteip) {
            $data['remoteip'] = $remoteip;
        }

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
                'timeout' => 10 // Reasonable timeout
            ]
        ];

        $context = stream_context_create($options);
        $response = @file_get_contents($url, false, $context);

        // Debug logging
        $logFile = __DIR__ . '/../../debug_api.log';
        $logEntry = "[" . date('Y-m-d H:i:s') . "] TURNSTILE_VALIDATION: " . 
                    "IP: " . ($remoteip ?? 'N/A') . " " .
                    "Response: " . ($response ?: 'FAIL') . "\n";
        file_put_contents($logFile, $logEntry, FILE_APPEND);

        if ($response === FALSE) {
            return ['success' => false, 'error-codes' => ['internal-error']];
        }

        return json_decode($response, true) ?: ['success' => false, 'error-codes' => ['invalid-response']];
    }
}
