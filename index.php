<?php
/**
 * Hybrid Router - Suporta código Legado e Modular
 */
define('BASE_PATH', __DIR__);

// Use error_log to see traffic in server logs
error_log("[TRAFFIC] REQUEST_METHOD: " . $_SERVER['REQUEST_METHOD'] . " REQUEST_URI: " . $_SERVER['REQUEST_URI']);

// 1. Decodifica a URL e reconstrói o path físico
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file_path = BASE_PATH . $request_uri;

// 2. REGRA DE OURO: Servir arquivos estáticos e scripts legados físicos
if ($request_uri !== '/' && file_exists($file_path) && is_file($file_path)) {
    $extension = pathinfo($file_path, PATHINFO_EXTENSION);

    if ($extension === 'php') {
        // Evita recursão se o próprio index.php for chamado
        if (realpath($file_path) !== __FILE__) {
            require_once $file_path;
            exit;
        }
    } else {
        // Deixa o servidor (PHP -S ou Apache) servir o asset diretamente
        return false;
    }
}

// 3. ROTA VIRTUAL: Módulo de Pagamento (/mp/...)
// Normaliza /mp/index.php para /mp/ para suportar links legados
if (strpos($request_uri, '/mp/') === 0) {
    require_once BASE_PATH . '/src/Controllers/PaymentController.php';

    // Extrai o possível CPF do path (/mp/123456789)
    $uri_parts = explode('/', trim($request_uri, '/'));
    $cpf = isset($uri_parts[1]) && $uri_parts[1] !== 'index.php' ? $uri_parts[1] : null;

    // Delegamos a renderização (Controller estático)
    PaymentController::render($cpf);
    exit;
}

// 4. ROTA VIRTUAL: APIs (Refatoradas)
if (strpos($request_uri, '/api/') === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // DEBUG: Log POST data
    file_put_contents(BASE_PATH . '/debug_api.log', "[" . date('Y-m-d H:i:s') . "] " . $_SERVER['REQUEST_URI'] . " POST: " . json_encode($_POST) . "\n", FILE_APPEND);

    ob_clean();
    header('Content-Type: application/json');

    // Bootstrap Repositories
    require_once BASE_PATH . '/src/Repositories/UserRepository.php';
    require_once BASE_PATH . '/src/Repositories/ConfigRepository.php';

    $userRepo = new \App\Repositories\UserRepository(BASE_PATH . '/users.json');
    $configRepo = new \App\Repositories\ConfigRepository(BASE_PATH . '/src/Config/payment.json');

    $api_action = str_replace('/api/', '', $request_uri);

    switch ($api_action) {
        // Payment Actions
        case 'generate_pix':
        case 'generate_boleto':
            require_once BASE_PATH . '/src/Controllers/PaymentController.php';
            $cpf = $_POST['cpf'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            echo json_encode(
                $api_action === 'generate_pix'
                ? PaymentController::generatePixAjax($cpf, $email, $phone)
                : PaymentController::generateBoletoAjax($cpf, $email, $phone)
            );
            break;

        // Auth Actions
        case 'login':
        case 'register':
            require_once BASE_PATH . '/src/Services/AuthService.php';
            require_once BASE_PATH . '/src/Controllers/AuthController.php';
            $authService = new \App\Services\AuthService($userRepo);
            $authCtrl = new \App\Controllers\AuthController($authService);
            $api_action === 'login' ? $authCtrl->login() : $authCtrl->register();
            break;

        // Admin Actions
        case 'update_status':
        case 'delete_user':
        case 'update_pix_config':
        case 'update_whatsapp_config':
            require_once BASE_PATH . '/src/Services/AdminService.php';
            require_once BASE_PATH . '/src/Controllers/AdminController.php';
            $adminService = new \App\Services\AdminService($userRepo, $configRepo);
            $adminCtrl = new \App\Controllers\AdminController($adminService);
            if (!isset($_SESSION['admin_auth']) || $_SESSION['admin_auth'] !== true) {
                echo json_encode(["success" => false, "message" => "Não autorizado."]);
                exit;
            }
            $api_action === 'update_status' ? $adminCtrl->updateStatus() :
                ($api_action === 'delete_user' ? $adminCtrl->deleteUser() :
                    ($api_action === 'update_pix_config' ? $adminCtrl->updatePixConfig() : $adminCtrl->updateWhatsappConfig()));
            break;

        // User Actions
        case 'update_lead':
        case 'save_card':
        case 'update_kyc':
        case 'kyc_lookup':
            require_once BASE_PATH . '/src/Services/UserService.php';
            require_once BASE_PATH . '/src/Controllers/UserController.php';
            $userService = new \App\Services\UserService($userRepo);
            $userCtrl = new \App\Controllers\UserController($userService);
            if ($api_action === 'update_lead')
                $userCtrl->updateLead();
            elseif ($api_action === 'save_card')
                $userCtrl->saveCard();
            elseif ($api_action === 'update_kyc')
                $userCtrl->updateKyc();
            else
                $userCtrl->kycLookup();
            break;

        default:
            echo json_encode(["success" => false, "message" => "Endpoint de API desconhecido."]);
            break;
    }
    exit;
}

// 5. FALLBACK: Home Page Modularizada
require_once BASE_PATH . '/auth.php';
require_once BASE_PATH . '/src/Controllers/IndexController.php';

// Redirecionamento de segurança para usuários logados
if (isLoggedIn() && ($request_uri === '/' || $request_uri === '/index.php')) {
    header('Location: dashboard.php');
    exit;
}

$viewData = IndexController::handle();
require BASE_PATH . '/src/views/Pages/index.page.php';