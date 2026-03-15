<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Services\AuthService;

class AuthController
{
    private $authService;
    private $turnstileService;

    public function __construct(AuthService $authService, \App\Services\TurnstileService $turnstileService)
    {
        $this->authService = $authService;
        $this->turnstileService = $turnstileService;
    }

    /**
     * Handle login request
     */
    public function login(): void
    {
        $username = preg_replace('/[^0-9]/', '', $_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $turnstileToken = $_POST['cf-turnstile-response'] ?? '';

        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
        $validation = $this->turnstileService->validate($turnstileToken, $ip);

        if (!$validation['success']) {
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Verificação de segurança falhou. Tente novamente."]);
            return;
        }

        $result = $this->authService->login($username, $password);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Handle registration request
     */
    public function register(): void
    {
        $turnstileToken = $_POST['cf-turnstile-response'] ?? '';
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
        $validation = $this->turnstileService->validate($turnstileToken, $ip);

        if (!$validation['success']) {
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Verificação de segurança falhou. Tente novamente."]);
            return;
        }

        $data = [
            'username' => preg_replace('/[^0-9]/', '', $_POST['username'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'fullname' => $_POST['fullname'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'financial' => [
                'renda' => $_POST['renda'] ?? '',
                'veiculo_tipo' => $_POST['veiculo_tipo'] ?? '',
                'veiculo_valor' => $_POST['veiculo_valor'] ?? '',
                'entrada' => $_POST['entrada'] ?? ''
            ]
        ];

        $result = $this->authService->register($data);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Handle logout
     */
    public function logout(): void
    {
        $this->authService->logout();
        header("Location: index.php");
        exit;
    }
}
