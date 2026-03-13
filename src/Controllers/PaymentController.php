<?php

use App\Repositories\UserRepository;
use App\Services\Payment\PaymentService;

class PaymentController
{
    public static function handle($cpf = null): array
    {
        // Require dependencies (Manually since no autoloader)
        require_once BASE_PATH . '/src/Repositories/UserRepository.php';
        require_once BASE_PATH . '/src/Services/Payment/PixGenerator.php';
        require_once BASE_PATH . '/src/Services/Payment/PaymentService.php';

        // 0. Load Config
        $configPath = BASE_PATH . '/src/Config/payment.json';
        $config = file_exists($configPath) ? json_decode(file_get_contents($configPath), true) : ['pix_key' => 'seu-pix@email.com', 'active_gateway' => 'safe-bank'];

        $userRepository = new UserRepository(BASE_PATH . '/users.json');
        $paymentService = new PaymentService($config['active_gateway'] ?? 'safe-bank');

        // 1. Extract CPF if not provided
        if (!$cpf) {
            $cpf = $_GET['cpf'] ?? null;
            if (!$cpf) {
                $request_uri = $_SERVER['REQUEST_URI'];
                $base_path = '/mp/';
                $uri_parts = explode('/', trim(str_replace($base_path, '', $request_uri), '/'));
                if (isset($uri_parts[0]) && $uri_parts[0] !== 'index.php') {
                    $cpf = $uri_parts[0];
                }
            }
        }

        if (!$cpf) {
            die("Acesso inválido. CPF não informado.");
        }

        // 2. Fetch User
        $user = $userRepository->findByUsername($cpf);
        if (!$user) {
            die("Usuário não encontrado.");
        }

        // 3. Prepare Financial Data
        $valorOriginal = $user['financial']['entrada'] ?? 'R$ 0,00';
        $valorFinal = $paymentService->cleanAmount($valorOriginal);

        // 4. Config & PIX (Checking legacy mp/config.json first, then fallback)
        $configPath = BASE_PATH . '/mp/config.json';
        if (!file_exists($configPath)) {
            $configPath = BASE_PATH . '/src/Config/payment.json'; // Future proof location
        }
        $config = file_exists($configPath) ? json_decode(file_get_contents($configPath), true) : ['pix_key' => 'seu-pix@email.com'];
        $pixKey = $config['pix_key'];

        // 5. Transaction Logging
        $gatewayName = $config['active_gateway'] ?? 'safe-bank';
        $pixData = $paymentService->preparePixPayload($pixKey, $valorFinal);

        // Record transaction
        require_once BASE_PATH . '/src/Repositories/TransactionRepository.php';
        $transactionRepo = new \App\Repositories\TransactionRepository(BASE_PATH . '/src/Storage/transactions.json');

        $loggedUser = $_SESSION['user'] ?? $cpf;
        // Clean CPF just in case
        $cleanCpf = preg_replace('/[^0-9]/', '', $cpf);

        $transactionRepo->save([
            'logged_user' => $loggedUser,
            'identification' => [
                'email' => $user['email'] ?? null,
                'phone' => $user['phone'] ?? null,
                'cpf' => $cleanCpf
            ],
            'amount' => (float) $valorFinal,
            'gateway' => $gatewayName,
            'meta_fields' => [
                'payload' => $pixData['payload'],
                'status' => 'initiated'
            ]
        ]);

        return [
            'user' => $user,
            'cpf' => $cpf,
            'valorOriginal' => $valorOriginal,
            'payload' => $pixData['payload'],
            'qrUrl' => $pixData['qrUrl'],
            'gateway' => $gatewayName
        ];
    }

    /**
     * Renders the payment checkout page
     */
    public static function render($cpf = null)
    {
        $viewData = self::handle($cpf);
        require BASE_PATH . '/src/views/Payments/Pages/checkout.page.php';
    }
}
