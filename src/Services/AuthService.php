<?php

namespace App\Services;

use App\Repositories\UserRepository;

class AuthService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Authenticate a user and start session
     */
    public function login(string $username, string $password): array
    {
        $user = $this->userRepository->findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            $this->startSession($username);
            return ["success" => true, "message" => "Login realizado com sucesso!"];
        }
        return ["success" => false, "message" => "Usuário ou senha inválidos."];
    }

    /**
     * Register a new user
     */
    public function register(array $data): array
    {
        if ($this->userRepository->findByUsername($data['username'])) {
            return ["success" => false, "message" => "Usuário já existe."];
        }

        $userData = [
            "username" => $data['username'],
            "password" => password_hash($data['password'], PASSWORD_BCRYPT),
            "fullname" => $data['fullname'] ?? '',
            "email" => $data['email'] ?? '',
            "phone" => $data['phone'] ?? '',
            "kyc" => $data['kyc'] ?? ["selfie" => "", "front" => "", "back" => ""],
            "financial" => $data['financial'] ?? [
                "renda" => "",
                "veiculo_tipo" => "",
                "veiculo_valor" => "",
                "entrada" => ""
            ],
            "status" => "Pendente",
            "created_at" => date('Y-m-d H:i:s')
        ];

        if ($this->userRepository->save($userData)) {
            $this->startSession($data['username']);
            return ["success" => true, "message" => "Registro realizado com sucesso!"];
        }

        return ["success" => false, "message" => "Erro ao salvar usuário."];
    }

    /**
     * Logout and destroy session
     */
    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
    }

    /**
     * Check if user is logged in
     */
    public function isLoggedIn(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    /**
     * Internal helper to set session variables
     */
    private function startSession(string $username): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user'] = $username;
        $_SESSION['logged_in'] = true;
    }
}
