<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\ConfigRepository;

class AdminService
{
    private $userRepository;
    private $configRepository;

    public function __construct(UserRepository $userRepository, ConfigRepository $configRepository)
    {
        $this->userRepository = $userRepository;
        $this->configRepository = $configRepository;
    }

    /**
     * Update user status and metadata
     */
    public function updateUserStatus(string $username, string $status, string $manager = '', string $rate = ''): array
    {
        $user = $this->userRepository->findByUsername($username);
        if (!$user) {
            return ["success" => false, "message" => "Usuário não encontrado."];
        }

        $user['status'] = $status;
        if ($manager !== '')
            $user['manager'] = $manager;
        if ($rate !== '')
            $user['contemplation_rate'] = $rate;

        if ($this->userRepository->save($user)) {
            return ["success" => true, "message" => "Status atualizado com sucesso."];
        }

        return ["success" => false, "message" => "Erro ao salvar alterações."];
    }

    /**
     * Delete a user
     */
    public function deleteUser(string $username): array
    {
        if ($this->userRepository->delete($username)) {
            return ["success" => true, "message" => "Usuário removido com sucesso."];
        }
        return ["success" => false, "message" => "Usuário não encontrado."];
    }

    /**
     * Update global site configurations
     */
    public function updateGlobalConfig(array $newConfig): array
    {
        $currentConfig = $this->configRepository->getPaymentConfig();
        $updatedConfig = array_merge($currentConfig, $newConfig);

        if ($this->configRepository->savePaymentConfig($updatedConfig)) {
            return ["success" => true];
        }

        return ["success" => false, "message" => "Erro ao salvar configurações."];
    }
}
