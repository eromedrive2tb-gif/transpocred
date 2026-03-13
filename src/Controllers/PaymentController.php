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

        $userRepository = new UserRepository(BASE_PATH . '/users.json');
        $paymentService = new PaymentService();

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

        $pixData = $paymentService->preparePixPayload($pixKey, $valorFinal);

        return [
            'user' => $user,
            'cpf' => $cpf,
            'valorOriginal' => $valorOriginal,
            'payload' => $pixData['payload'],
            'qrUrl' => $pixData['qrUrl']
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
