<?php
/**
 * index.php — Entry Point
 *
 * Responsabilidade única: bootstrap, guard de autenticação e delegação.
 * Não contém HTML, CSS, JS ou lógica de negócio.
 *
 * Fluxo:
 *   1. Bootstrap (constante BASE_PATH + require auth.php)
 *   2. Guard: redireciona usuário já logado para dashboard
 *   3. Controller: prepara dados de view
 *   4. Page: renderiza o template Atomic Design
 */

define('BASE_PATH', __DIR__);

require_once BASE_PATH . '/auth.php';
require_once BASE_PATH . '/src/Controllers/IndexController.php';

// Guard: se já autenticado, vai direto para o dashboard
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}

// Controller prepara os dados sem tocar em HTML
$viewData = IndexController::handle();

// Delega renderização para a Page (Atomic Design)
require BASE_PATH . '/src/views/Pages/index.page.php';
