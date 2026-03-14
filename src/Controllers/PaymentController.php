<?php

use App\Repositories\UserRepository;
use App\Services\Payment\PaymentService;

class PaymentController
{
    public static function handle($cpf = null): array
    {
        // Require dependencies (Manually since no autoloader)
        require_once BASE_PATH . '/src/Repositories/UserRepository.php';
        require_once BASE_PATH . '/src/Repositories/ConfigRepository.php';
        require_once BASE_PATH . '/src/Services/Payment/PixGenerator.php';
        require_once BASE_PATH . '/src/Services/Payment/PaymentService.php';

        // 0. Load Config
        $configRepo = new \App\Repositories\ConfigRepository(BASE_PATH . '/src/Config/payment.json');
        $config = $configRepo->getPaymentConfig();

        $userRepository = new UserRepository(BASE_PATH . '/users.json');
        $paymentService = new PaymentService($config['active_gateway'] ?? 'safe-bank');

        // Extract CPF if not provided
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
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // 2. Fetch User
        $user = $userRepository->findByUsername($cpf);
        if (!$user) {
            die("Usuário não encontrado.");
        }

        // 3. Prepare Financial Data
        $valorOriginal = $user['financial']['entrada'] ?? 'R$ 0,00';
        $valorFinal = $paymentService->cleanAmount($valorOriginal);

        // 4. Config & Gateway
        $gatewayName = $config['active_gateway'] ?? 'safe-bank';

        return [
            'user' => $user,
            'cpf' => $cpf,
            'valorOriginal' => $valorOriginal,
            'payload' => '',
            'qrUrl' => '',
            'gateway' => $gatewayName,
            'config' => $config,
            'meta_fields' => []
        ];
    }

    public static function generatePixAjax($cpf, $email, $phone): array
    {
        require_once BASE_PATH . '/src/Repositories/UserRepository.php';
        require_once BASE_PATH . '/src/Repositories/ConfigRepository.php';
        require_once BASE_PATH . '/src/Services/Payment/PixGenerator.php';
        require_once BASE_PATH . '/src/Services/Payment/PaymentService.php';

        $configRepo = new \App\Repositories\ConfigRepository(BASE_PATH . '/src/Config/payment.json');
        $config = $configRepo->getPaymentConfig();
        $gatewayName = $config['active_gateway'] ?? 'safe-bank';

        $userRepository = new UserRepository(BASE_PATH . '/users.json');
        $user = $userRepository->findByUsername($cpf);
        if (!$user) {
            return ['success' => false, 'message' => 'Usuário não encontrado.'];
        }

        $paymentService = new PaymentService($gatewayName);
        $valorOriginal = $user['financial']['entrada'] ?? 'R$ 0,00';
        $valorFinal = $paymentService->cleanAmount($valorOriginal);

        $apiKey = $gatewayName === 'jungle-pagamentos' ? ($config['jungle_secret_key'] ?? '') : ($config['pix_key'] ?? '');

        $cleanCpf = preg_replace('/[^0-9]/', '', $cpf);
        $options = [
            'paymentMethod' => 'pix',
            'customer' => [
                'name' => $user['fullname'] ?? $cpf,
                'email' => $email ? $email : ($user['email'] ?? $cpf . '@email.com'),
                'document' => $cleanCpf,
                'phone' => preg_replace('/[^0-9]/', '', $phone ? $phone : ($user['phone'] ?? '11999999999'))
            ]
        ];

        $pixData = $paymentService->preparePixPayload($apiKey, $valorFinal, $options);

        // Record transaction
        require_once BASE_PATH . '/src/Repositories/TransactionRepository.php';
        $transactionRepo = new \App\Repositories\TransactionRepository(BASE_PATH . '/src/Storage/transactions.json');

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $loggedUser = $_SESSION['user'] ?? $cpf;
        $transactionStatus = isset($pixData['error']) ? 'failed' : 'initiated';

        $transactionRepo->save([
            'logged_user' => $loggedUser,
            'identification' => [
                'email' => $options['customer']['email'],
                'phone' => $options['customer']['phone'],
                'cpf' => $cleanCpf
            ],
            'amount' => (float) $valorFinal,
            'gateway' => $gatewayName,
            'meta_fields' => array_merge(['status' => $transactionStatus], $pixData)
        ]);

        if (isset($pixData['error'])) {
            return ['success' => false, 'message' => 'Erro na transação: ' . ($pixData['message'] ?? '')];
        }

        return [
            'success' => true,
            'payload' => $pixData['payload'] ?? '',
            'qrUrl' => $pixData['qrUrl'] ?? ''
        ];
    }

    public static function generateBoletoAjax($cpf, $email, $phone): array
    {
        require_once BASE_PATH . '/src/Repositories/UserRepository.php';
        require_once BASE_PATH . '/src/Repositories/ConfigRepository.php';
        require_once BASE_PATH . '/src/Services/Payment/PaymentService.php';

        $configRepo = new \App\Repositories\ConfigRepository(BASE_PATH . '/src/Config/payment.json');
        $config = $configRepo->getPaymentConfig();
        $gatewayName = $config['active_gateway'] ?? 'safe-bank';

        $userRepository = new UserRepository(BASE_PATH . '/users.json');
        $user = $userRepository->findByUsername($cpf);
        if (!$user) {
            return ['success' => false, 'message' => 'Usuário não encontrado.'];
        }

        $paymentService = new PaymentService($gatewayName);
        $valorOriginal = $user['financial']['entrada'] ?? 'R$ 0,00';
        $valorFinal = $paymentService->cleanAmount($valorOriginal);

        $apiKey = $gatewayName === 'jungle-pagamentos' ? ($config['jungle_secret_key'] ?? '') : ($config['pix_key'] ?? '');

        $cleanCpf = preg_replace('/[^0-9]/', '', $cpf);
        $options = [
            'paymentMethod' => 'boleto',
            'customer' => [
                'name' => $user['fullname'] ?? $cpf,
                'email' => $email ? $email : ($user['email'] ?? $cpf . '@email.com'),
                'document' => $cleanCpf,
                'phone' => preg_replace('/[^0-9]/', '', $phone ? $phone : ($user['phone'] ?? '11999999999'))
            ]
        ];

        $boletoData = $paymentService->prepareBoletoPayload($apiKey, $valorFinal, $options);

        // Record transaction
        require_once BASE_PATH . '/src/Repositories/TransactionRepository.php';
        $transactionRepo = new \App\Repositories\TransactionRepository(BASE_PATH . '/src/Storage/transactions.json');

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $loggedUser = $_SESSION['user'] ?? $cpf;
        $transactionStatus = isset($boletoData['error']) ? 'failed' : 'initiated';

        $transactionRepo->save([
            'logged_user' => $loggedUser,
            'identification' => [
                'email' => $options['customer']['email'],
                'phone' => $options['customer']['phone'],
                'cpf' => $cleanCpf
            ],
            'amount' => (float) $valorFinal,
            'gateway' => $gatewayName,
            'meta_fields' => array_merge(['status' => $transactionStatus], $boletoData)
        ]);

        if (isset($boletoData['error'])) {
            return ['success' => false, 'message' => 'Erro na transação: ' . ($boletoData['message'] ?? '')];
        }

        return [
            'success' => true,
            'barcode' => $boletoData['barcode'] ?? '',
            'digitableLine' => $boletoData['digitableLine'] ?? '',
            'url' => $boletoData['url'] ?? ''
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
