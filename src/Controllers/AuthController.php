<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Services\AuthService;

class AuthController
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle login request
     */
    public function login(): void
    {
        $username = preg_replace('/[^0-9]/', '', $_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $result = $this->authService->login($username, $password);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Handle registration request
     */
    public function register(): void
    {
        $data = [
            'username' => preg_replace('/[^0-9]/', '', $_POST['username'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'fullname' => $_POST['fullname'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'captcha' => $_POST['captcha'] ?? '',
            'financial' => [
                'renda' => $_POST['renda'] ?? '',
                'veiculo_tipo' => $_POST['veiculo_tipo'] ?? '',
                'veiculo_valor' => $_POST['veiculo_valor'] ?? '',
                'entrada' => $_POST['entrada'] ?? ''
            ]
        ];

        if ($data['captcha'] !== 'verified') {
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Por favor, verifique que você não é um robô."]);
            return;
        }

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
