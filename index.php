<?php
/**
 * Hybrid Router - Suporta código Legado e Modular
 */
define('BASE_PATH', __DIR__);

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

// 4. FALLBACK: Home Page Modularizada
require_once BASE_PATH . '/auth.php';
require_once BASE_PATH . '/src/Controllers/IndexController.php';

// Redirecionamento de segurança para usuários logados
if (isLoggedIn() && ($request_uri === '/' || $request_uri === '/index.php')) {
    header('Location: dashboard.php');
    exit;
}

$viewData = IndexController::handle();
require BASE_PATH . '/src/views/Pages/index.page.php';