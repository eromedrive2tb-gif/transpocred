<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

define('USERS_FILE', __DIR__ . '/users.json');

function getUsers() {
    if (!file_exists(USERS_FILE)) return [];
    return json_decode(file_get_contents(USERS_FILE), true) ?: [];
}

$username = $_SESSION['user'];
$users = getUsers();
$user = null;

foreach ($users as $u) {
    if ($u['username'] === $username) {
        $user = $u;
        break;
    }
}

if (!$user) {
    header("Location: auth.php?action=logout");
    exit;
}
$userStatus = $user['status'] ?? 'Pendente';
$userStatusColor = '#94a3b8';
if ($userStatus === 'Aprovado') $userStatusColor = '#00d084';
if ($userStatus === 'Pré-aprovado' || $userStatus === 'Pendente' || $userStatus === 'Em Análise') $userStatusColor = '#f59e0b';
if ($userStatus === 'Bloqueado') $userStatusColor = '#ef4444';
if ($userStatus === 'Recusado') $userStatusColor = '#1e293b';

// Helper to calculate financial values
$fin = $user['financial'] ?? [];
$renda = $fin['renda'] ?? 'R$ 0,00';
$valorVeiculoStr = $fin['veiculo_valor'] ?? 'R$ 0,00';
$entradaStr = $fin['entrada'] ?? 'R$ 0,00';
$prazo = $fin['prazo'] ?? '0';
$veiculoTipo = $fin['veiculo_tipo'] ?? '---';

// Numeric clean function
function parseCurrency($str) {
    return (float) str_replace(['R$', '.', ','], ['', '', '.'], $str);
}

$valorVeiculo = parseCurrency($valorVeiculoStr);
$entrada = parseCurrency($entradaStr);
$restante = $valorVeiculo - $entrada;
$percentualEntrada = ($valorVeiculo > 0) ? round(($entrada / $valorVeiculo) * 100) : 0;


function formatCurrency($val) {
    return 'R$ ' . number_format($val, 2, ',', '.');
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Transprocred - Conta Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #007d89;
            --primary-dark: #006069;
            --primary-light: #00d084;
            --secondary: #00b4d8;
            --bg: #f0f4f8;
            --sidebar-bg: #ffffff;
            --sidebar-text: #64748b;
            --sidebar-active: #007d89;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --success: #22c55e;
            --warning: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 30px 0;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }

        .logo {
            padding: 0 25px;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo svg {
            width: 35px;
            height: 35px;
            fill: var(--primary);
        }

        .logo h1 {
            font-size: 1.5rem;
            color: var(--primary);
            font-weight: 700;
            letter-spacing: -1px;
        }

        .nav-menu {
            flex: 1;
            padding: 0 15px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .nav-item:hover {
            background: #f8fafc;
            color: var(--primary);
        }

        .nav-item.active {
            background: rgba(0, 125, 137, 0.1);
            color: var(--primary);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .logout-btn {
            margin-top: auto;
            border-top: 1px solid var(--border);
            padding: 20px 25px 0;
        }

        .logout-btn a {
            color: #ef4444;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            font-weight: 600;
        }

        /* Main Content */
        .main {
            margin-left: 280px;
            flex: 1;
            padding: 40px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .user-welcome h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
        }

        .user-welcome p {
            color: var(--text-muted);
            margin-top: 4px;
        }

        .status-badge {
            background: #fef3c7;
            color: var(--warning);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #fde68a;
        }

        .status-badge.approved {
            background: #dcfce7;
            color: var(--success);
            border-color: #bbf7d0;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .section-card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 25px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .section-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            opacity: 0.6;
        }

        .section-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }

        .btn {
            background: var(--primary);
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                120deg,
                transparent,
                rgba(255, 255, 255, 0.3),
                transparent
            );
            transition: 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 125, 137, 0.3);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--text-muted);
            font-weight: 500;
        }

        .info-value {
            font-weight: 700;
            color: var(--text-main);
        }

        /* Credit Card Mockup */
        .card-container {
            perspective: 1000px;
            margin-bottom: 30px;
        }

        .credit-card {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, #007d89 0%, #004d55 100%);
            border-radius: 20px;
            position: relative;
            box-shadow: 0 20px 40px rgba(0, 77, 85, 0.4);
            padding: 25px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            transition: transform 0.5s ease;
        }

        .credit-card:hover {
            transform: rotateY(10deg) rotateX(5deg);
        }

        /* Card Patterns */
        .credit-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -20%;
            width: 150%;
            height: 200%;
            background: radial-gradient(circle at 50% 50%, rgba(255,255,255,0.08) 0%, transparent 60%);
            pointer-events: none;
        }

        .card-chip {
            width: 45px;
            height: 35px;
            background: linear-gradient(135deg, #ffd700 0%, #daa520 100%);
            border-radius: 6px;
            position: relative;
        }

        .card-logo {
            position: absolute;
            top: 25px;
            right: 25px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-logo span {
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: -1px;
        }

        .card-number {
            font-family: 'Courier New', Courier, monospace;
            font-size: 1.4rem;
            letter-spacing: 3px;
            margin: 20px 0;
            word-spacing: 12px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .card-holder {
            text-transform: uppercase;
        }

        .card-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
            margin-bottom: 4px;
        }

        .card-val {
            font-weight: 600;
            font-size: 1rem;
        }

        /* Balance & Stats */
        .balance-summary {
            background: #f8fafc;
            border-radius: 16px;
            padding: 20px;
            margin-top: 20px;
            border: 1px solid var(--border);
        }

        .balance-item {
            margin-top: 5px;
        }

        .balance-amount {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--primary);
        }

        .status-tracker {
            margin-top: 30px;
        }

        .track-item {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            position: relative;
        }

        .track-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 24px;
            left: 12px;
            width: 2px;
            height: 25px;
            background: var(--border);
        }

        .track-circle {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }

        .track-item.done .track-circle {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .track-item.pending .track-circle {
            border-color: var(--warning);
            color: var(--warning);
        }

        .track-info h4 {
            font-size: 0.95rem;
            font-weight: 700;
        }

        .track-info p {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .action-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            margin-left: 5px;
        }

        .view-content {
            display: none;
        }

        .view-content.active {
            display: block;
        }

        .tab-btn {
            cursor: pointer;
        }

        @media (max-width: 1024px) {
            .dashboard-grid { grid-template-columns: 1fr; }
            .sidebar { width: 80px; padding: 20px 0; }
            .sidebar .logo h1, .sidebar span, .sidebar .logout-btn span { display: none; }
            .main { margin-left: 80px; padding: 20px; }
            .logo { justify-content: center; padding: 0; }
        }

        .dashboard-grid.three-cols {
            grid-template-columns: repeat(3, 1fr);
        }

        /* Notification Dots */
        .nav-item {
            position: relative;
        }

        .notification-dot {
            position: absolute;
            top: 10px;
            right: 15px;
            width: 10px;
            height: 10px;
            background-color: var(--warning);
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.2);
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); }
            70% { transform: scale(1.1); box-shadow: 0 0 0 6px rgba(245, 158, 11, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
        }

        .nav-item:hover .notification-dot {
            border-color: #f8fafc;
        }

        .nav-item.active .notification-dot {
            border-color: #f0f7f8;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -280px;
                height: 100%;
                z-index: 2000;
                transition: left 0.3s ease;
                width: 280px !important;
                display: flex !important;
                padding: 20px !important;
                overflow-y: auto;
            }
            .sidebar.active {
                left: 0;
            }
            .sidebar .logo h1, .sidebar span, .sidebar .logout-btn span {
                display: block !important;
            }
            .main {
                margin-left: 0 !important;
                padding: 15px !important;
            }
            .mobile-header {
                display: flex !important;
            }
            .mobile-close-btn {
                display: flex !important;
            }
            .sidebar-overlay {
                display: block !important;
            }
            .sidebar-overlay.active {
                opacity: 1 !important;
                pointer-events: all !important;
            }
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .mobile-header {
            display: none;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 15px 20px;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0,0,0,0.03);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .menu-toggle {
            font-size: 1.5rem;
            color: var(--primary);
            cursor: pointer;
        }

        .mobile-bank-quick-actions {
            display: none;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            padding: 20px;
            background: #ffffff;
            margin-bottom: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }

        .mq-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            text-decoration: none;
        }

        .mq-icon-box {
            width: 50px;
            height: 50px;
            background: rgba(0, 125, 137, 0.05);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 125, 137, 0.1);
        }

        .mq-icon-box::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: rotate(45deg);
            transition: 0.5s;
        }

        .mq-item:hover .mq-icon-box::after {
            left: 100%;
        }

        .mq-item:hover .mq-icon-box {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 125, 137, 0.2);
        }

        .mq-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .mb-balance-card {
            display: none;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 25px;
            border-radius: 24px;
            color: white;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 125, 137, 0.2);
        }

        /* Shiny Sheen Effect */
        .mb-balance-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                120deg,
                transparent,
                rgba(255, 255, 255, 0.3),
                transparent
            );
            transition: all 0.6s;
            animation: shine 4s infinite;
        }

        @keyframes shine {
            0% { left: -150%; }
            20% { left: 150%; }
            100% { left: 150%; }
        }

        .mb-balance-card::after {
            content: '';
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 120px;
            height: 120px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        /* Dancing Notification Icon */
        .dancing-exclamation {
            display: inline-block;
            color: var(--warning);
            font-size: 1.2rem;
            animation: dance 1s infinite alternate;
        }

        @keyframes dance {
            0% { transform: translateY(0) rotate(0); }
            50% { transform: translateY(-3px) rotate(10deg); }
            100% { transform: translateY(0) rotate(-10deg); }
        }

        @keyframes pulse-alert {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(239, 68, 68, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        .notification-btn {
            position: relative;
            font-size: 1.3rem;
            color: var(--primary);
            cursor: pointer;
            margin-right: 15px;
        }

        .notification-btn .dot {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border: 2px solid white;
            border-radius: 50%;
        }
        /* Camera Guides */
        #camera-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .face-guide {
            background: radial-gradient(ellipse 180px 240px at 50% 50%, transparent 99%, rgba(0, 0, 0, 0.8) 100%);
            box-shadow: none !important;
        }

        .face-guide::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 180px;
            height: 240px;
            border-radius: 50%;
            border: 4px solid #00d2ff;
            -webkit-mask-image: repeating-linear-gradient(-45deg, black, black 10px, transparent 10px, transparent 20px);
            mask-image: repeating-linear-gradient(-45deg, black, black 10px, transparent 10px, transparent 20px);
            animation: face-line-walk 0.8s linear infinite;
        }

        .face-guide::before {
            content: none;
        }

        @keyframes face-line-walk {
            from { -webkit-mask-position: 0 0; mask-position: 0 0; }
            to { -webkit-mask-position: 28px 0; mask-position: 28px 0; }
        }

        .doc-guide {
            box-shadow: 0 0 0 1000px rgba(0, 0, 0, 0.6);
            border: 2px dashed rgba(255, 255, 255, 0.4);
            margin: 30px;
            border-radius: 12px;
        }

        @media (max-width: 768px) {
            .mobile-bank-quick-actions, .mb-balance-card {
                display: grid;
            }
            #view-conta .credit-card {
                display: none; /* Hide large credit card on mobile redundant with balance card */
            }
            .main header {
                display: none; /* Hide desktop header on mobile */
            }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <!-- Sidebar content remains same for desktop -->
        <div class="logo">
            <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
            <h1>Transprocred</h1>
        </div>
        
        <!-- Mobile Close Button -->
        <div class="mobile-close-btn" onclick="toggleSidebar()" style="display: none; position: absolute; top: 20px; right: 20px; width: 35px; height: 35px; background: rgba(0, 125, 137, 0.1); border-radius: 50%; cursor: pointer; align-items: center; justify-content: center; color: var(--primary); font-size: 1.2rem; z-index: 1000;">
            <i class="fas fa-times"></i>
        </div>

        <nav class="nav-menu">
            <a href="javascript:void(0)" class="nav-item tab-btn" onclick="showView('resumo', this)">
                <i class="fas fa-home"></i>
                <span>Minha Proposta</span>
            </a>
            <a href="javascript:void(0)" class="nav-item tab-btn" onclick="showView('fila', this)">
                <i class="fas fa-users"></i>
                <span>Fila de Contemplação</span>
            </a>
            <a href="javascript:void(0)" class="nav-item tab-btn" onclick="showView('documentos', this)">
                <i class="fas fa-id-card"></i>
                <span>Verificação de Documentos</span>
                <?php if (empty($user['kyc']['selfie'])): ?>
                    <span class="notification-dot"></span>
                <?php endif; ?>
            </a>
            <a href="javascript:void(0)" class="nav-item tab-btn" onclick="showView('pagamentos', this)">
                <i class="fas fa-wallet"></i>
                <span>Pagamento de Entrada</span>
                <?php if ($userStatus === 'Pendente'): ?>
                    <span class="notification-dot"></span>
                <?php endif; ?>
            </a>
            <a href="javascript:void(0)" class="nav-item tab-btn active" onclick="showView('conta', this)">
                <i class="fas fa-university"></i>
                <span>Conta Digital</span>
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-headset"></i>
                <span>Suporte Transprocred</span>
            </a>
            <?php if ($userStatus === 'Aprovado' && !empty($user['manager'])): ?>
                <div style="margin-top: 20px; padding: 15px; background: rgba(0, 125, 137, 0.05); border-radius: 12px; border: 1px dashed var(--primary);">
                    <div style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Consultor Financeiro</div>
                    <div style="font-size: 0.95rem; color: var(--primary); font-weight: 700; margin-top: 5px; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-user-tie" style="color: #d4af37;"></i> <?php echo htmlspecialchars($user['manager']); ?>
                    </div>
                </div>
            <?php endif; ?>
        </nav>

        <div class="logout-btn">
            <a href="auth.php?action=logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sair</span>
            </a>
        </div>
    </aside>



    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <main class="main">
        <div class="mobile-header">
            <div style="display: flex; align-items: center; gap: 12px; cursor: pointer;" onclick="toggleSidebar()">
                <div style="width: 45px; height: 45px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; box-shadow: 0 4px 15px rgba(0, 125, 137, 0.3); position: relative;">
                    <i class="fas fa-user" style="font-size: 1.4rem;"></i>
                    <div style="position: absolute; top: -2px; right: -2px; width: 14px; height: 14px; background: #ef4444; border-radius: 50%; border: 2px solid white; animation: pulse-alert 1.5s infinite;"></div>
                </div>
                <div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">Olá, <?php echo explode(' ', ucwords($user['fullname']))[0]; ?></div>
                    <div style="font-size: 0.9rem; font-weight: 700;">Transprocred</div>
                </div>
            </div>
            <div style="display: flex; align-items: center;">
                <?php if (empty($user['kyc']['selfie']) || $userStatus === 'Pendente' || $userStatus === 'Bloqueado'): ?>
                    <div class="notification-btn" onclick="showPendingAlert()">
                        <i class="fas fa-bell"></i>
                        <span class="dot" <?php echo $userStatus === 'Bloqueado' ? 'style="background:#ef4444; animation: dance 0.5s infinite;"' : ''; ?>></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="mb-balance-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                <span style="font-size: 0.9rem; opacity: 0.9;">Saldo em conta</span>
                <i class="fas fa-eye-slash" id="mobile-eye" onclick="toggleMobileBalance()" style="cursor: pointer;"></i>
            </div>
            <div id="mobile-balance" style="font-size: 1.8rem; font-weight: 800; letter-spacing: -0.5px;">
                <?php echo formatCurrency($valorVeiculo); ?>
            </div>
            <div style="margin-top: 15px; font-size: 0.75rem; opacity: 0.8; background: rgba(255,255,255,0.15); display: inline-block; padding: 4px 12px; border-radius: 20px;">
                <i class="fas fa-gift"></i> Saldo pré-aprovado
            </div>
        </div>

        <div class="mobile-bank-quick-actions">
            <div class="mq-item" onclick="handleRetirarFundos()">
                <div class="mq-icon-box">
                    <i class="fas fa-qrcode"></i>
                    <?php if ($userStatus !== 'Aprovado'): ?>
                        <i class="fas fa-lock" style="position: absolute; top: 5px; right: 5px; font-size: 0.55rem; opacity: 0.5;"></i>
                    <?php endif; ?>
                </div>
                <span class="mq-label">Pix</span>
            </div>
            <div class="mq-item" onclick="handleRetirarFundos()">
                <div class="mq-icon-box">
                    <i class="fas fa-barcode"></i>
                    <?php if ($userStatus !== 'Aprovado'): ?>
                        <i class="fas fa-lock" style="position: absolute; top: 5px; right: 5px; font-size: 0.55rem; opacity: 0.5;"></i>
                    <?php endif; ?>
                </div>
                <span class="mq-label">Pagar</span>
            </div>
            <div class="mq-item" onclick="handleRetirarFundos()">
                <div class="mq-icon-box">
                    <i class="fas fa-paper-plane"></i>
                    <?php if ($userStatus !== 'Aprovado'): ?>
                        <i class="fas fa-lock" style="position: absolute; top: 5px; right: 5px; font-size: 0.55rem; opacity: 0.5;"></i>
                    <?php endif; ?>
                </div>
                <span class="mq-label">Transferir</span>
            </div>
            <div class="mq-item" onclick="showView('conta')">
                <div class="mq-icon-box"><i class="fas fa-list-ul"></i></div>
                <span class="mq-label">Extrato</span>
            </div>
        </div>

        <header>
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; box-shadow: 0 4px 15px rgba(0, 125, 137, 0.2); position: relative;">
                    <i class="fas fa-user" style="font-size: 1.5rem;"></i>
                    <div style="position: absolute; top: -2px; right: -2px; width: 15px; height: 15px; background: #ef4444; border-radius: 50%; border: 3px solid white; animation: pulse-alert 1.5s infinite;"></div>
                </div>
                <div class="user-welcome">
                    <h2>Olá, <?php echo ucwords($user['fullname']); ?>!</h2>
                    <p>Conta Digital Transprocred | |transpocred</p>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 5px;">
                <div class="status-badge" style="border-color: <?php echo $userStatusColor; ?>; color: <?php echo $userStatusColor; ?>;">
                    <i class="fas fa-circle" style="font-size: 0.6rem;"></i> Status: <?php echo strtoupper($userStatus); ?>
                </div>
                <small style="color: var(--text-muted); font-size: 0.75rem;">
                    <?php 
                        if ($userStatus === 'Pendente') echo "Aguardando pagamento da entrada.";
                        elseif ($userStatus === 'Em Análise') echo "Documentos em análise técnica.";
                        elseif ($userStatus === 'Aprovado') echo "Crédito liberado em sua conta digital.";
                        elseif ($userStatus === 'Bloqueado') echo "Acesso restrito. Entre em contato com o suporte.";
                        else echo "Acompanhe o status da sua proposta.";
                    ?>
                </small>
            </div>
        </header>

        <div id="view-resumo" class="view-content">
            <div class="dashboard-grid">
                
                <!-- Resumo da Proposta -->
                <div class="section-card">
                    <div class="section-header">
                        <h3><i class="fas fa-clipboard-list" style="color: var(--primary);"></i> Resumo da Proposta</h3>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Valor Total Solicitado</span>
                        <span class="info-value"><?php echo formatCurrency($valorVeiculo); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Valor de Entrada (<?php echo $percentualEntrada; ?>%)</span>
                        <span class="info-value"><?php echo formatCurrency($entrada); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Valor Restante a Financiar</span>
                        <span class="info-value"><?php echo formatCurrency($restante); ?></span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Renda Mensal Informada</span>
                        <span class="info-value"><?php echo $renda; ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tipo de Veículo</span>
                        <span class="info-value"><?php echo $veiculoTipo; ?></span>
                    </div>

                    <div class="balance-summary" style="margin-top: 25px; border-left: 4px solid var(--primary);">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div>
                                <div class="card-label">TITULAR</div>
                                <div class="info-value" style="font-size: 0.9rem;"><?php echo strtoupper($user['fullname']); ?></div>
                            </div>
                            <div style="text-align: right;">
                                <div class="card-label">SALDO PRÉ-APROVADO</div>
                                <div class="balance-amount" style="font-size: 1.4rem;"><?php echo formatCurrency($valorVeiculo); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status de Liberação -->
                <div class="section-card">
                    <div class="section-header">
                        <h3><i class="fas fa-chart-line" style="color: var(--primary);"></i> Status de Liberação</h3>
                    </div>

                    <div class="status-tracker">
                        <div class="track-item <?php echo ($userStatus === 'Aprovado') ? 'done' : 'pending'; ?>">
                            <div class="track-circle"><i class="fas <?php echo ($userStatus === 'Aprovado') ? 'fa-check' : 'fa-dollar-sign'; ?>"></i></div>
                            <div class="track-info">
                                <h4>Pagamento da Entrada</h4>
                                <p><?php echo ($userStatus === 'Aprovado') ? 'Pagamento confirmado.' : 'Aguardando pagamento de <strong>'.formatCurrency($entrada).'</strong>'; ?></p>

                                <?php if ($userStatus !== 'Aprovado'): ?>
                                    <a href="javascript:void(0)" onclick="showView('pagamentos')" class="action-link" style="display: inline-block; margin-top: 5px; padding: 4px 12px; background: var(--primary); color: white; border-radius: 6px; text-decoration: none;">Pagar Agora</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="track-item <?php echo ($userStatus === 'Aprovado' || !empty($user['kyc']['selfie'])) ? 'done' : 'pending'; ?>">
                            <div class="track-circle"><i class="fas <?php echo ($userStatus === 'Aprovado' || !empty($user['kyc']['selfie'])) ? 'fa-check' : 'fa-id-card'; ?>"></i></div>
                            <div class="track-info">
                                <h4>Verificação de Documentos</h4>
                                <p style="<?php echo ($userStatus === 'Aprovado' || !empty($user['kyc']['selfie'])) ? 'color: var(--success); font-weight: 600;' : ''; ?>">
                                    <?php 
                                        if ($userStatus === 'Aprovado') echo 'Documentos Validados.';
                                        elseif (!empty($user['kyc']['selfie'])) echo 'Recebido - Em Análise';
                                        else echo 'Aguardando envio.';
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="track-item <?php echo ($userStatus === 'Aprovado') ? 'done' : ''; ?>">
                            <div class="track-circle"><i class="fas <?php echo ($userStatus === 'Aprovado') ? 'fa-unlock' : 'fa-lock'; ?>"></i></div>
                            <div class="track-info">
                                <h4>Saldo Liberado</h4>
                                <p><?php echo ($userStatus === 'Aprovado') ? 'Seu saldo está disponível para retirada.' : 'Disponível após compensação bancária.'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="view-fila" class="view-content">
            <div class="section-card">
                <div class="section-header">
                    <h3><i class="fas fa-hourglass-half" style="color: var(--warning);"></i> Fila de Contemplação</h3>
                </div>

                <?php if ($userStatus === 'Aprovado'): ?>
                    <div style="background: #f0fdf4; padding: 25px; border-radius: 20px; border: 1px solid var(--success); margin-bottom: 30px;">
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                            <div style="width: 50px; height: 50px; background: var(--success); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <div>
                                <h4 style="color: var(--success); margin: 0; font-size: 1.2rem;">Mapa de Contemplação</h4>
                                <p style="margin: 0; font-size: 0.9rem; color: #166534;">Sua jornada para o crédito liberado</p>
                            </div>
                        </div>

                        <!-- Timeline Visual -->
                        <div style="position: relative; padding-left: 30px; border-left: 2px dashed rgba(22, 101, 52, 0.2); margin-left: 10px;">
                            <div style="position: relative; margin-bottom: 25px;">
                                <div style="position: absolute; left: -39px; top: 0; width: 16px; height: 16px; background: var(--success); border-radius: 50%; box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.2);"></div>
                                <h5 style="margin: 0; color: #1e293b; font-size: 0.95rem;">Análise de Proposta</h5>
                                <p style="margin: 5px 0 0; font-size: 0.8rem; color: #64748b;">Concluída com sucesso.</p>
                            </div>
                            <div style="position: relative; margin-bottom: 25px;">
                                <div style="position: absolute; left: -39px; top: 0; width: 16px; height: 16px; background: var(--success); border-radius: 50%; box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.2);"></div>
                                <h5 style="margin: 0; color: #1e293b; font-size: 0.95rem;">Assembleia Geral</h5>
                                <p style="margin: 5px 0 0; font-size: 0.8rem; color: #64748b;">Cota sorteada e contemplada.</p>
                            </div>
                            <div style="position: relative; margin-bottom: 25px;">
                                <div style="position: absolute; left: -39px; top: 0; width: 16px; height: 16px; background: var(--warning); border-radius: 50%; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.2); animation: pulse-warning 2s infinite;"></div>
                                <h5 style="margin: 0; color: #1e293b; font-size: 0.95rem;">Liberação de Saldo</h5>
                                <p style="margin: 5px 0 0; font-size: 0.85rem; color: #92400e; font-weight: 600;">Processando transferência final...</p>
                                <div style="margin-top: 10px; background: #fffbeb; padding: 10px; border-radius: 8px; border: 1px solid #fef3c7;">
                                    <i class="fas fa-info-circle" style="color: #d97706;"></i> 
                                    <span style="font-size: 0.75rem; color: #92400e;">Prazo estimado: de 2 a 8 dias úteis após contemplação.</span>
                                </div>
                            </div>
                            <div style="position: relative;">
                                <div style="position: absolute; left: -39px; top: 0; width: 16px; height: 16px; background: #e2e8f0; border-radius: 50%;"></div>
                                <h5 style="margin: 0; color: #94a3b8; font-size: 0.95rem;">Crédito Disponível</h5>
                                <p style="margin: 5px 0 0; font-size: 0.8rem; color: #94a3b8;">Aguardando compensação.</p>
                            </div>
                        </div>
                    </div>

                    <style>
                        @keyframes pulse-warning {
                            0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); }
                            70% { box-shadow: 0 0 0 10px rgba(245, 158, 11, 0); }
                            100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
                        }
                    </style>
                <?php else: ?>
                    <div style="margin-bottom: 25px; border-bottom: 1px solid var(--border); padding-bottom: 15px;">
                        <h4 style="color: var(--warning); margin-bottom: 5px;">Status: Pré-aprovado</h4>
                        <p style="font-size: 0.9rem; color: var(--text-muted);">Aguardando pagamento da entrada para confirmar contemplação.</p>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                        <div style="background: rgba(0, 208, 132, 0.1); padding: 20px; border-radius: 16px; text-align: center; border: 1px solid rgba(0, 208, 132, 0.2);">
                            <div class="card-label" style="color: var(--primary); font-weight: 700;">Chance de Contemplação</div>
                            <div style="font-size: 2rem; font-weight: 800; color: var(--primary);"><?php echo $user['contemplation_rate'] ?? '24%'; ?></div>
                        </div>
                        <div style="background: rgba(0, 125, 137, 0.05); padding: 20px; border-radius: 16px; text-align: center; border: 1px solid rgba(0, 125, 137, 0.1);">
                            <div class="card-label" style="color: var(--text-muted);">Tempo Médio de Espera</div>
                            <div style="font-size: 2rem; font-weight: 800; color: var(--text-main);">8 dias</div>
                        </div>
                    </div>

                    <div class="status-tracker">
                        <h3 style="font-size: 1rem; color: var(--text-muted); margin-bottom: 20px;">Posição Atual</h3>
                        <div class="track-item pending">
                            <div class="track-circle"><i class="fas fa-users"></i></div>
                            <div class="track-info">
                                <h4>Monitoramento de Grupo</h4>
                                <p>Sua proposta está sendo processada no grupo atual de contemplação.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div id="view-documentos" class="view-content">
            <div class="section-card">
                <h3><i class="fas fa-file-invoice" style="color: var(--primary);"></i> Verificação de Documentos</h3>
                <br>
                <?php if ($userStatus === 'Aprovado'): ?>
                    <div style="background: #f0fdf4; padding: 30px; border-radius: 16px; text-align: center; border: 1px solid var(--success);">
                        <i class="fas fa-user-check" style="font-size: 3rem; color: var(--success); margin-bottom: 15px;"></i>
                        <h4 style="color: var(--success);">Documentação Validada</h4>
                        <p>Seus documentos foram verificados e aprovados com sucesso pelo nosso setor de compliance.</p>
                        <br>
                        <span class="status-badge" style="display: inline-flex; background: var(--success); color: white; border: none;">VALIDADO</span>
                    </div>
                <?php elseif (empty($user['kyc']['selfie'])): ?>
                    <div style="background: #f8fafc; padding: 30px; border-radius: 16px; text-align: center;">
                        <i class="fas fa-id-card" style="font-size: 3rem; color: var(--warning); margin-bottom: 15px;"></i>
                        <h4>Verificação Pendente</h4>
                        <p>Você ainda não enviou seus documentos de identificação.</p>
                        <p style="font-size: 0.9rem; color: var(--text-muted); margin-top: 10px;">A verificação é obrigatória para a retirada de fundos da sua conta digital.</p>
                        <br>
                        <button class="btn" onclick="openKycModal()" style="display: inline-block; background: var(--primary); color: white; padding: 12px 25px; border: none; border-radius: 10px; font-weight: 700; cursor: pointer;">VERIFICAR AGORA</button>
                    </div>
                <?php else: ?>
                    <div style="background: #f8fafc; padding: 30px; border-radius: 16px; text-align: center;">
                        <i class="fas fa-file-signature" style="font-size: 3rem; color: var(--primary); margin-bottom: 15px;"></i>
                        <h4>Documentos Recebidos</h4>
                        <p>Sua selfie e fotos do documento já foram enviadas e estão em análise pelo nosso setor de segurança.</p>
                        <br>
                        <span class="status-badge" style="display: inline-flex; border-color: #f59e0b; color: #f59e0b;">AGUARDANDO ANÁLISE</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div id="view-pagamentos" class="view-content">
            <div class="section-card">
                <h3><i class="fas fa-credit-card" style="color: var(--primary);"></i> Pagamento de Entrada</h3>
                <br>
                <p>Para confirmar sua contemplação e liberar o saldo, realize o pagamento da entrada solicitada:</p>
                <br>
                <div style="background: var(--bg); padding: 25px; border-radius: 16px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <div class="card-label">VALOR DA ENTRADA</div>
                        <div style="font-size: 1.5rem; font-weight: 800;"><?php echo formatCurrency($entrada); ?></div>
                    </div>

                    <button class="btn" onclick="solicitarPagamento()" style="background: var(--primary); color: white; padding: 12px 25px; border: none; border-radius: 10px; font-weight: 700; cursor: pointer;">SOLICITAR PAGAMENTO</button>
                </div>
            </div>
        </div>

        <div id="view-conta" class="view-content active">
            <div class="section-card">
                <div class="section-header">
                    <h3>🏦 Conta Digital</h3>
                    <span class="status-badge approved">ATIVA</span>
                </div>

                <div class="card-container" style="max-width: 400px; margin: 0 auto;">
                    <div class="credit-card">
                        <div class="card-logo">
                            <svg viewBox="0 0 24 24" fill="#fff" width="24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                            <span>TRANSPROCRED</span>
                        </div>
                        <div class="card-chip"></div>
                        <div style="margin-top: 15px;">
                            <div class="card-label" style="font-size: 0.8rem; letter-spacing: 2px; opacity: 1;">SALDO PRÉ-APROVADO</div>
                            <div class="card-number" style="font-size: 2.2rem; margin: 5px 0; letter-spacing: 0; word-spacing: 0;">
                                <?php echo formatCurrency($valorVeiculo); ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="card-holder"><div class="card-label">Titular do Cartão</div><div class="card-val"><?php echo strtoupper($user['fullname']); ?></div></div>
                            <div class="card-expiry"><div class="card-label">Válido até</div><div class="card-val">12/2026</div></div>
                        </div>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 20px;">
                    <?php if ($userStatus !== 'Aprovado'): ?>
                        <div style="background: #fffbeb; padding: 15px; border-radius: 12px; border: 1px solid #fef3c7; display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                            <i class="fas fa-info-circle" style="color: #d97706;"></i>
                            <p style="margin: 0; font-size: 0.8rem; color: #92400e; text-align: left; line-height: 1.3;">
                                <strong>Acesso Restrito:</strong> Aguardando contemplação. As opções Transferir PIX e Saque estão disponíveis apenas após aprovação. <strong>Verifique seus documentos</strong> (clique no perfil e opção documentos) e aguarde o prazo de sua contemplação.
                            </p>
                        </div>
                        <button class="btn" onclick="handleRetirarFundos()" style="background: #cbd5e1; color: white; padding: 15px 40px; border: none; border-radius: 12px; font-weight: 700; cursor: not-allowed; width: 100%; max-width: 400px; font-size: 1.1rem;">
                            <i class="fas fa-lock"></i> RETIRAR FUNDOS
                        </button>
                    <?php else: ?>
                        <button class="btn" onclick="handleRetirarFundos()" style="background: var(--primary); color: white; padding: 15px 40px; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; width: 100%; max-width: 400px; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(0, 125, 137, 0.3);">
                            <i class="fas fa-money-bill-transfer"></i> RESGATAR CRÉDITO NO BANCO
                        </button>
                    <?php endif; ?>
                    <p style="margin-top: 10px; font-size: 0.85rem; color: var(--text-muted);">Acompanhe o mapa de contemplação para acompanhar a liberação.</p>
                </div>

                <?php if ($userStatus === 'Aprovado' && !empty($user['manager'])): ?>
                <div style="margin-top: 25px; padding: 25px; border-radius: 20px; border: 1px solid rgba(212, 175, 55, 0.3); background: linear-gradient(135deg, #ffffff 0%, #fff9e6 100%); text-align: center; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: -10px; right: -10px; font-size: 4rem; color: rgba(212, 175, 55, 0.05); transform: rotate(15deg);">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 15px; box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3); border: 3px solid #fff;">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div style="font-size: 0.75rem; color: #b8860b; text-transform: uppercase; font-weight: 800; letter-spacing: 2px; margin-bottom: 5px;">Consultor Exclusive</div>
                    <div style="font-size: 1.5rem; color: #1e293b; font-weight: 900; margin: 5px 0;"><?php echo htmlspecialchars($user['manager']); ?></div>
                    <div style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Especialista Transprocred</div>
                </div>
                <?php endif; ?>

                <?php if ($userStatus === 'Aprovado'): ?>
                    <div class="info-row" style="margin-top: 30px;">
                        <span class="info-label">Número da Conta</span>
                        <span class="info-value">000<?php echo substr($user['username'], -5); ?>-<?php echo mt_rand(0, 9); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Agência</span>
                        <span class="info-value">0001</span>
                    </div>
                <?php else: ?>
                    <div style="margin-top: 30px; padding: 15px; background: #f8fafc; border-radius: 12px; text-align: center; border: 1px dashed #cbd5e1;">
                        <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">
                            <i class="fas fa-lock" style="margin-right: 5px;"></i> Dados bancários liberados após aprovação
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- KYC Modal Overlay -->
        <div id="kyc-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
            <div style="background: white; width: 100%; max-width: 450px; border-radius: 20px; padding: 30px; position: relative; overflow-y: auto; max-height: 90vh;">
                <button onclick="closeKycModal()" style="position: absolute; top: 15px; right: 15px; border: none; background: none; font-size: 1.5rem; cursor: pointer; color: var(--text-muted);">&times;</button>
                
                <div id="kyc-step-content text-center">
                    <h2 id="kyc-title" style="color: var(--primary); margin-bottom: 10px; text-align: center;">Verificação de Identidade</h2>
                    <p id="kyc-desc" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 25px; text-align: center;">Para sua segurança, precisamos validar seus documentos antes de liberar a retirada de fundos.</p>
                    
                    <div id="camera-section">
                        <div id="camera-container" style="position: relative; width: 100%; border-radius: 12px; overflow: hidden; background: #000; aspect-ratio: 4/3; margin-bottom: 20px;">
                            <video id="video" autoplay playsinline style="width: 100%; height: 100%; object-fit: cover;"></video>
                            <canvas id="canvas" style="display: none;"></canvas>
                            <img id="photo-preview" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                            <div id="camera-overlay" class="face-guide"></div>
                        </div>

                        <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                            <button class="btn" id="btn-capture" onclick="capturePhoto()" style="flex: 2; background: var(--primary); color: white; padding: 12px; border: none; border-radius: 10px; font-weight: 600; cursor: pointer;"><i class="fas fa-camera"></i> Tirar Foto</button>
                            <button class="btn" id="btn-retake" onclick="retakePhoto()" style="flex: 1; background: #f1f5f9; color: var(--text-dark); padding: 12px; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; display: none;">Refazer</button>
                        </div>

                        <div id="kyc-progress" style="font-size: 0.8rem; color: #64748b; margin-bottom: 15px; text-align: center;">Etapa: 1 de 3</div>
                        <button class="btn" id="btn-kyc-next" onclick="nextKycStep()" disabled style="width: 100%; background: var(--primary); color: white; padding: 14px; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; opacity: 0.5;">Próxima Foto</button>
                    </div>

                    <div id="kyc-loading" style="display: none; text-align: center; padding: 40px 0;">
                        <div style="display: inline-block; width: 50px; height: 50px; border: 5px solid rgba(0,125,137,0.1); border-radius: 50%; border-top-color: var(--primary); animation: k-spin 1s linear infinite; margin-bottom: 20px;"></div>
                        <h4 style="color: var(--primary); margin-bottom: 10px;">Analisando seus documentos</h4>
                        <p style="font-weight: 600; color: #64748b; font-size: 0.9rem;">Processando e validando seus documentos...</p>
                        <div style="width: 100%; height: 10px; background: #e2e8f0; border-radius: 10px; margin-top: 20px; overflow: hidden;">
                            <div id="kyc-progress-bar" style="width: 0%; height: 100%; background: var(--primary); transition: width 1s linear;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes k-spin { to { transform: rotate(360deg); } }
        </style>

        <div id="recent-activity" class="section-card" style="margin-top: 30px;">

            <div class="section-header"><h3><i class="fas fa-history" style="color: var(--primary);"></i> Transações Recentes</h3></div>
            <div class="info-row">
                <div style="display:flex; gap:15px; align-items:center;">
                    <div style="background:#eef2ff; color:#6366f1; width:40px; height:40px; border-radius:80%; display:flex; align-items:center; justify-content:center;"><i class="fas fa-file-invoice"></i></div>
                    <div><div class="info-value">Simulação criada</div><div style="font-size:0.8rem; color:var(--text-muted);">31/10/2025</div></div>
                </div>
                <div class="info-value" style="color: var(--text-muted);">-</div>
            </div>
            <div class="info-row">
                <div style="display:flex; gap:15px; align-items:center;">
                    <div style="background:#f0fdf4; color:#22c55e; width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="fas fa-user-check"></i></div>
                    <div><div class="info-value">Pré-aprovação concedida</div><div style="font-size:0.8rem; color:var(--text-muted);">31/10/2025</div></div>
                </div>
                <div class="info-value" style="color:var(--success);"><?php echo formatCurrency($valorVeiculo); ?></div>
            </div>
        </div>
    </main>

    <script>
        function showView(viewId, btn = null) {
            if ("<?php echo $userStatus; ?>" === "Bloqueado") {
                showPendingAlert();
                return;
            }
            document.querySelectorAll('.view-content').forEach(v => {
                v.classList.remove('active');
            });
            const view = document.getElementById('view-' + viewId);
            if (view) view.classList.add('active');
            
            if (btn) {
                document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
                btn.classList.add('active');
            } else {
                const sidebarItem = document.querySelector(`.nav-item[onclick*="'${viewId}'"]`);
                if (sidebarItem) {
                    document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
                    sidebarItem.classList.add('active');
                }
            }

            const recentActivity = document.getElementById('recent-activity');
            if (recentActivity) {
                recentActivity.style.display = (viewId === 'resumo') ? 'block' : 'none';
            }
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function handleRetirarFundos() {
            const status = "<?php echo $userStatus; ?>";
            if (status === 'Bloqueado') {
                showPendingAlert();
                return;
            }
            if (status !== 'Aprovado') {
                Swal.fire({
                    title: 'Conclua as Pendências',
                    html: `
                        <div style="text-align: center; padding: 10px;">
                            <div style="font-size: 3rem; color: #f59e0b; margin-bottom: 15px;">
                                <i class="fas fa-lock"></i>
                            </div>
                            <p style="font-size: 0.9rem; color: #64748b; line-height: 1.6;">As opções de <b>Transferência PIX</b> e <b>Saque</b> estarão disponíveis após a aprovação.</p>
                            <div style="background: #fffbeb; padding: 15px; border-radius: 10px; margin: 15px 0; border: 1px solid #fef3c7;">
                                <p style="font-size: 0.85rem; color: #92400e; margin: 0; line-height: 1.5;">
                                    <b>Para liberar o acesso:</b><br>
                                    1️⃣ <b>Verifique seus documentos</b> (clique no perfil → opção "Documentos")<br>
                                    2️⃣ <b>Efetue o pagamento da entrada</b><br>
                                    3️⃣ Aguarde o prazo de contemplação (2 a 8 dias úteis)
                                </p>
                            </div>
                        </div>
                    `,
                    confirmButtonText: 'Verificar',
                    confirmButtonColor: '#007d89'
                }).then((result) => {
                    if (result.isConfirmed) {
                        showView('documentos');
                    }
                });
            } else {
                Swal.fire({
                    title: 'Como deseja receber?',
                    text: 'Selecione abaixo o método de recebimento do seu crédito contemplado:',
                    icon: 'question',
                    input: 'select',
                    inputOptions: {
                        'pix': 'Transferência Instantânea via PIX',
                        'ted': 'Transferência TED para outros bancos',
                        'card': 'Carregar Cartão de Débito Transprocred',
                        'invoice': 'Pagamento de Boletos diversos'
                    },
                    inputPlaceholder: 'Selecione uma opção',
                    showCancelButton: true,
                    confirmButtonText: 'Continuar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#007d89'
                }).then((result) => {
                    if (result.isConfirmed && result.value) {
                        const selectedMethod = result.value;
                        
                        if (selectedMethod === 'pix' || selectedMethod === 'ted') {
                            Swal.fire({
                                title: 'Dados de Destino',
                                text: 'Selecione o seu banco para transferência:',
                                input: 'select',
                                inputOptions: {
                                    'nubank': 'Nubank (260)',
                                    'itau': 'Itaú Unibanco (341)',
                                    'bradesco': 'Bradesco (237)',
                                    'santander': 'Santander (033)',
                                    'caixa': 'Caixa Econômica (104)',
                                    'inter': 'Banco Inter (077)',
                                    'outro': 'Outros Bancos'
                                },
                                inputPlaceholder: 'Selecione o Banco',
                                showCancelButton: true,
                                confirmButtonText: 'Finalizar',
                                confirmButtonColor: '#007d89'
                            }).then((bankResult) => {
                                if (bankResult.isConfirmed) {
                                    Swal.fire({
                                        title: 'Solicitação em Processamento',
                                        html: `
                                            <div style="padding: 10px;">
                                                <i class="fas fa-hourglass-half fa-spin" style="font-size: 2.5rem; color: #007d89; margin-bottom: 15px;"></i>
                                                <p>Sua solicitação de resgate foi registrada com sucesso.</p>
                                                <p style="font-size: 0.85rem; color: #64748b; margin-top: 10px;">Devido aos protocolos de segurança, a liberação ocorre em até <b>8 dias úteis</b> após a contemplação.</p>
                                                <p style="font-size: 0.8rem; font-weight: 600; color: #007d89;">Acompanhe o mapa de contemplação para mais detalhes.</p>
                                            </div>
                                        `,
                                        icon: 'success',
                                        confirmButtonColor: '#007d89'
                                    });
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Solicitação Registrada',
                                text: 'Seu pedido de resgate está em análise. O processamento final ocorre em até 8 dias úteis.',
                                icon: 'success',
                                confirmButtonColor: '#007d89'
                            });
                        }
                    }
                });
            }
        }

        function solicitarPagamento() {
            Swal.fire({
                title: 'Solicitação Enviada!',
                text: 'Para prosseguir com o pagamento, entre em contato com nosso suporte via WhatsApp.',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: '<i class="fab fa-whatsapp"></i> Falar no WhatsApp',
                confirmButtonColor: '#25D366',
                cancelButtonText: 'Fechar',
                background: '#ffffff',
                color: '#1e293b'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open('https://wa.me/18257304568?text=Olá, gostaria de solicitar o pagamento da minha entrada no Transprocred.', '_blank');
                }
            });
        }

        // KYC Camera Logic
        let stream;
        let kycStep = 0;
        const kycPhotos = { selfie: null, front: null, back: null };
        const kycTitles = ["Selfie do Rosto", "Frente do Documento", "Verso do Documento"];
        const kycDescs = [
            "Posicione seu rosto dentro do quadro e tire uma foto nítida.",
            "Posicione a FRENTE do seu documento no quadro abaixo.",
            "Posicione o VERSO do seu documento no quadro abaixo."
        ];

        function openKycModal() {
            const modal = document.getElementById('kyc-modal');
            if (modal) {
                modal.style.display = 'flex';
                kycStep = 0;
                updateKycUI();
                startCamera();
            }
        }

        function closeKycModal() {
            const modal = document.getElementById('kyc-modal');
            if (modal) {
                modal.style.display = 'none';
                stopCamera();
                document.getElementById('camera-section').style.display = 'block';
                document.getElementById('kyc-loading').style.display = 'none';
                retakePhoto();
            }
        }

        async function startCamera() {
            try {
                const facingMode = kycStep === 0 ? 'user' : 'environment';
                stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        facingMode: facingMode,
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    } 
                });
                const video = document.getElementById('video');
                if (video) video.srcObject = stream;
            } catch (err) {
                console.error("Camera access denied", err);
                Swal.fire('Erro', 'Não foi possível acessar a câmera. Verifique as permissões.', 'error');
            }
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
        }

        function capturePhoto() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const preview = document.getElementById('photo-preview');
            
            if (video && canvas && preview) {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                
                const dataUrl = canvas.toDataURL('image/jpeg', 0.8);
                const keys = ['selfie', 'front', 'back'];
                kycPhotos[keys[kycStep]] = dataUrl;
                
                preview.src = dataUrl;
                preview.style.display = 'block';
                video.style.display = 'none';
                document.getElementById('camera-overlay').style.display = 'none';
                
                document.getElementById('btn-capture').style.display = 'none';
                document.getElementById('btn-retake').style.display = 'block';
                document.getElementById('btn-kyc-next').disabled = false;
                document.getElementById('btn-kyc-next').style.opacity = '1';
            }
        }

        function retakePhoto() {
            const preview = document.getElementById('photo-preview');
            const video = document.getElementById('video');
            if (preview && video) {
                preview.style.display = 'none';
                video.style.display = 'block';
                document.getElementById('camera-overlay').style.display = 'block';
                document.getElementById('btn-capture').style.display = 'block';
                document.getElementById('btn-retake').style.display = 'none';
                document.getElementById('btn-kyc-next').disabled = true;
                document.getElementById('btn-kyc-next').style.opacity = '0.5';
            }
        }

        function updateKycUI() {
            const title = document.getElementById('kyc-title');
            const desc = document.getElementById('kyc-desc');
            const progress = document.getElementById('kyc-progress');
            const nextBtn = document.getElementById('btn-kyc-next');
            const overlay = document.getElementById('camera-overlay');
            
            if (title) title.textContent = kycTitles[kycStep];
            if (desc) desc.textContent = kycDescs[kycStep];
            if (progress) progress.textContent = `Etapa: ${kycStep + 1} de 3`;
            if (nextBtn) nextBtn.textContent = kycStep === 2 ? "Finalizar Verificação" : "Próxima Foto";

            if (overlay) {
                overlay.className = (kycStep === 0) ? 'face-guide' : 'doc-guide';
            }
        }

        async function nextKycStep() {
            if (kycStep < 2) {
                kycStep++;
                updateKycUI();
                retakePhoto();
                stopCamera();
                await startCamera();
            } else {
                document.getElementById('camera-section').style.display = 'none';
                document.getElementById('kyc-loading').style.display = 'block';
                
                try {
                    // Start countdown
                    let timeLeft = 16;
                    const countdown = setInterval(() => {
                        timeLeft--;
                        const percent = ((16 - timeLeft) / 16) * 100;
                        if (document.getElementById('kyc-progress-bar')) {
                            document.getElementById('kyc-progress-bar').style.width = `${percent}%`;
                        }
                        if (timeLeft <= 0) {
                            clearInterval(countdown);
                        }
                    }, 1000);

                    const formData = new FormData();
                    formData.append('action', 'update_kyc');
                    formData.append('kyc_selfie', kycPhotos.selfie);
                    formData.append('kyc_front', kycPhotos.front);
                    formData.append('kyc_back', kycPhotos.back);

                    const [response] = await Promise.all([
                        fetch('auth.php', { method: 'POST', body: formData }),
                        new Promise(resolve => setTimeout(resolve, 16000)) // Guarantee 16s wait
                    ]);

                    const result = await response.json();
                    if (result.success) {
                        // Automatically close and reload without user clicking "OK"
                        closeKycModal();
                        window.location.reload();
                    } else {
                        throw new Error(result.message || 'Erro ao processar documentos.');
                    }
                } catch (e) {
                    Swal.fire('Falha na Análise', 'Não foi possível completar a verificação agora. Tente novamente.', 'error');
                    document.getElementById('camera-section').style.display = 'block';
                    document.getElementById('kyc-loading').style.display = 'none';
                }
            }
        }
 
        let mobileBalanceVisible = true;
        const realMobileBalance = '<?php echo formatCurrency($valorVeiculo); ?>';

        function toggleMobileBalance() {
            mobileBalanceVisible = !mobileBalanceVisible;
            const balanceEl = document.getElementById('mobile-balance');
            const eyeIcon = document.getElementById('mobile-eye');
            
            if (mobileBalanceVisible) {
                if (balanceEl) balanceEl.textContent = realMobileBalance;
                if (eyeIcon) {
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                }
            } else {
                if (balanceEl) balanceEl.textContent = 'R$ ••••••';
                if (eyeIcon) {
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            }
        }

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            if (sidebar && overlay) {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }
        }

        // Auto-close sidebar on view change (mobile)
        const originalShowView = showView;
        showView = function(viewId, btn = null) {
            originalShowView(viewId, btn);
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            if (sidebar && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        }

        function showProfileInfo() {
            Swal.fire({
                title: 'Informações da Conta',
                html: `
                    <div style="text-align: left; padding: 10px;">
                        <div style="margin-bottom: 15px;">
                            <label style="font-size: 0.8rem; color: #64748b; display: block;">NOME COMPLETO</label>
                            <span style="font-weight: 700; color: #1e293b;"><?php echo ucwords($user['fullname']); ?></span>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <label style="font-size: 0.8rem; color: #64748b; display: block;">DATA DE CRIAÇÃO</label>
                            <span style="font-weight: 700; color: #1e293b;"><?php echo $user['created_at'] ?? '---'; ?></span>
                        </div>

                        <div style="margin-bottom: 5px;">
                            <label style="font-size: 0.8rem; color: #64748b; display: block;">CONTRATO</label>
                            <span style="font-weight: 700; color: #1e293b;">#DGT-<?php echo substr($user['username'], -4); ?></span>
                        </div>
                    </div>
                `,
                confirmButtonText: 'Fechar',
                confirmButtonColor: '#007d89',
                background: '#ffffff',
                customClass: {
                    title: 'swal-profile-title',
                    popup: 'swal-profile-popup'
                }
            });
        }

        function showPendingAlert() {
            const status = "<?php echo $userStatus; ?>";
            
            if (status === 'Bloqueado') {
                Swal.fire({
                    title: 'ACESSO BLOQUEADO',
                    html: `
                        <div class="dancing-exclamation" style="margin-bottom: 20px; color: #ef4444; font-size: 3rem;">
                            <i class="fas fa-shield-virus"></i>
                        </div>
                        <p style="font-weight: 700; color: #1e293b; margin-bottom: 10px;">Identificamos uma inconsistência na sua conta.</p>
                        <p style="font-size: 0.9rem; color: #64748b;">Para sua segurança, as operações em sua conta digital foram suspensas temporariamente. Por favor, fale com nossa central de segurança.</p>
                    `,
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonText: '<i class="fab fa-whatsapp"></i> Falar com Suporte',
                    confirmButtonColor: '#25D366',
                    cancelButtonText: '&times; Fechar',
                    cancelButtonColor: '#94a3b8',
                    reverseButtons: true,
                    background: '#ffffff',
                    customClass: {
                        popup: 'swal-critical-popup'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open('https://wa.me/18257304568?text=Olá, minha conta Transprocred aparece como bloqueada. Preciso de suporte.', '_blank');
                    }
                });
                return;
            }

            let pendingItems = '';
            <?php if ($userStatus === 'Pendente'): ?>
                pendingItems += '<li><i class="fas fa-dollar-sign"></i> Pagamento da entrada pendente</li>';
            <?php endif; ?>
            <?php if (empty($user['kyc']['selfie'])): ?>
                pendingItems += '<li><i class="fas fa-id-card"></i> Verificação de identidade pendente</li>';
            <?php endif; ?>

            if (pendingItems === '') return;

            Swal.fire({
                title: 'Notificações',
                html: `
                    <div class="dancing-exclamation" style="margin-bottom: 15px;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <ul style="text-align: left; list-style: none; padding: 0; display: flex; flex-direction: column; gap: 12px; font-weight: 600; color: #1e293b;">
                        ${pendingItems}
                    </ul>
                `,
                confirmButtonText: 'Ir para Pendências',
                confirmButtonColor: '#f59e0b',
                showCancelButton: true,
                cancelButtonText: 'Depois',
            }).then((result) => {
                if (result.isConfirmed) {
                    if ("<?php echo $userStatus; ?>" === "Pendente") {
                        showView('pagamentos');
                    } else {
                        showView('documentos');
                    }
                }
            });
        }

        // Auto-show alert if blocked on page load
        window.addEventListener('load', () => {
            if ("<?php echo $userStatus; ?>" === "Bloqueado") {
                showPendingAlert();
                
                // Block all clicks on interactive elements
                document.body.addEventListener('click', (e) => {
                    // Don't re-trigger if Swal is already open
                    if (Swal.isVisible()) return;

                    const target = e.target.closest('a, button, [onclick]');
                    if (target) {
                        e.preventDefault();
                        e.stopPropagation();
                        showPendingAlert();
                    }
                }, true);
            }
        });
    </script>
</body>
</html>
