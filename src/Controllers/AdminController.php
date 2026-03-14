<?php

namespace App\Controllers;

use App\Services\AdminService;

class AdminController
{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Update user status
     */
    public function updateStatus(): void
    {
        $username = $_POST['username'] ?? '';
        $status = $_POST['status'] ?? 'Pendente';
        $manager = $_POST['manager'] ?? '';
        $rate = $_POST['rate'] ?? '';

        $result = $this->adminService->updateUserStatus($username, $status, $manager, $rate);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Delete user
     */
    public function deleteUser(): void
    {
        $username = $_POST['username'] ?? '';
        $result = $this->adminService->deleteUser($username);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Update payment gateway config
     */
    public function updatePixConfig(): void
    {
        $config = [
            'pix_key' => $_POST['pix_key'] ?? '',
            'active_gateway' => $_POST['active_gateway'] ?? 'safe-bank',
            'jungle_secret_key' => $_POST['jungle_secret_key'] ?? '',
            'jungle_public_key' => $_POST['jungle_public_key'] ?? ''
        ];

        $result = $this->adminService->updateGlobalConfig($config);
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Update WhatsApp config
     */
    public function updateWhatsappConfig(): void
    {
        $config = [
            'whatsapp_number' => $_POST['whatsapp_number'] ?? ''
        ];

        $result = $this->adminService->updateGlobalConfig($config);
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
