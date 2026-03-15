<?php
$turnstileConfig = json_decode(file_get_contents(__DIR__ . '/src/Config/turnstile.json'), true);
$siteKey = $turnstileConfig['site_key'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Transprocred</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit" async defer></script>
    <style>
        :root {
            --primary: #007d89;
            --primary-light: #00d084;
            --bg-light: #f8fafc;
            --text-dark: #1e293b;
            --border-light: #e2e8f0;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }

        .step-indicator::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--border-light);
            z-index: 1;
            transform: translateY(-50%);
        }

        .step {
            width: 30px;
            height: 30px;
            background: #fff;
            border: 2px solid var(--border-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 2;
            transition: all 0.3s;
            color: #94a3b8;
        }

        .step.active {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
            box-shadow: 0 0 0 4px rgba(0, 125, 137, 0.1);
        }

        .step.done {
            background: var(--primary-light);
            border-color: var(--primary-light);
            color: #fff;
        }

        h2 {
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--primary);
        }

        p {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 1px solid var(--border-light);
            border-radius: 12px;
            font-size: 1rem;
            transition: border 0.3s;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .btn {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn:disabled {
            background: #94a3b8;
            cursor: not-allowed;
        }

        .option-card {
            border: 1px solid var(--border-light);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }

        .option-card:hover {
            border-color: var(--primary);
            background: #f0f9ff;
        }

        .option-card.selected {
            border-color: var(--primary);
            background: #f0f9ff;
            box-shadow: 0 0 0 2px var(--primary);
        }

        #register-steps>div {
            display: none;
        }

        #register-steps>div.active {
            display: block;
            animation: slideIn 0.4s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .contemplation-gauge {
            width: 100%;
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            margin: 15px 0 10px;
            overflow: hidden;
            position: relative;
        }

        .contemplation-fill {
            height: 100%;
            width: 20%;
            background: #ef4444;
            transition: all 0.5s ease;
        }

        .chance-badge {
            font-size: 0.75rem;
            padding: 2px 8px;
            border-radius: 10px;
            color: #fff;
            font-weight: 700;
        }

        .progress-container {
            width: 100%;
            height: 12px;
            background: #e2e8f0;
            border-radius: 6px;
            overflow: hidden;
            margin: 20px 0;
            display: none;
        }

        .progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(to right, #ef4444, #eab308, #22c55e);
            transition: width 0.1s linear;
        }

        .analysis-status {
            text-align: center;
            font-weight: 600;
            color: var(--primary);
            margin: 10px 0;
            font-size: 1.1rem;
            display: none;
        }

        .analysis-spinner {
            width: 60px;
            height: 60px;
            border: 6px solid #e2e8f0;
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
            display: none;
        }

        .success-checkmark {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: #22c55e;
            color: #fff;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes popIn {
            0% {
                scale: 0;
            }

            100% {
                scale: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="step-indicator">
            <div class="step active" id="idx-1">1</div>
            <div class="step" id="idx-2">2</div>
            <div class="step" id="idx-3">3</div>
            <div class="step" id="idx-4">4</div>
            <div class="step" id="idx-5">5</div>
            <div class="step" id="idx-6">6</div>
            <div class="step" id="idx-7">7</div>
        </div>

        <div id="register-steps">
            <!-- Step 1: Basic Info -->
            <div id="step-1" class="active">
                <h2>Identificação</h2>
                <p>Inicie seu cadastro seguro com CPF e Nome completo.</p>
                <div class="form-group">
                    <label>CPF</label>
                    <input type="text" id="reg-cpf" placeholder="000.000.000-00" maxlength="14">
                </div>
                <div class="form-group">
                    <label>Nome Completo</label>
                    <input type="text" id="reg-nome" placeholder="Como no seu documento">
                </div>

                <!-- Cloudflare Turnstile CAPTCHA -->
                <div style="margin: 20px 0; display: flex; justify-content: center;">
                    <div id="turnstile-container"></div>
                </div>

                <button class="btn" id="btn-next-1" disabled>Continuar</button>
            </div>

            <!-- Step 2: KYC API Verification -->
            <div id="step-2">
                <h2>Verificação de Autenticidade</h2>
                <p>Para sua segurança, confirme sua data de nascimento encontrada na base da Receita Federal.</p>
                <div id="kyc-options">
                    <!-- Options injected via JS -->
                </div>
                <button class="btn" id="btn-next-dob" disabled>Confirmar Identidade</button>
            </div>

            <!-- Step 2: Renda (now step 3) -->
            <div id="step-3">
                <h2>Renda</h2>
                <p>Informe sua renda mensal média.</p>
                <div class="form-group">
                    <label>Renda Mensal</label>
                    <input type="text" id="reg-renda" placeholder="R$ 0,00">
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn" style="background: #f1f5f9; color: var(--text-dark);"
                        onclick="showStep(1)">Voltar</button>
                    <button class="btn" id="btn-next-2">Próximo</button>
                </div>
            </div>

            <!-- Step 3: Veículo (now step 4) -->
            <div id="step-4">
                <h2>Veículo Desejado</h2>
                <p>Qual tipo de veículo você busca?</p>
                <div class="form-group">
                    <label>Tipo de Veículo</label>
                    <select id="reg-veiculo-tipo"
                        style="width: 100%; padding: 14px; border: 1px solid var(--border-light); border-radius: 12px; font-size: 1rem;">
                        <option value="Caminhão">Caminhão</option>
                        <option value="Van">Van</option>
                        <option value="Ônibus">Ônibus</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Valor Desejado</label>
                    <input type="text" id="reg-veiculo-valor" placeholder="R$ 0,00">
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn" style="background: #f1f5f9; color: var(--text-dark);"
                        onclick="showStep(2)">Voltar</button>
                    <button class="btn" id="btn-next-3">Próximo</button>
                </div>
            </div>

            <!-- Step 4: Entrada e Prazo (now step 5) -->
            <div id="step-5">
                <h2>Entrada e Prazo</h2>
                <p>Defina sua proposta de entrada e o prazo.</p>
                <div class="form-group">
                    <div
                        style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 8px;">
                        <label style="margin-bottom: 0;">Valor de Entrada</label>
                        <span id="perc-display"
                            style="font-size: 0.75rem; font-weight: 700; color: var(--primary);">10%</span>
                    </div>
                    <input type="text" id="reg-entrada" placeholder="R$ 0,00">

                    <div class="contemplation-gauge">
                        <div id="gauge-fill" class="contemplation-fill"></div>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.75rem; color: #64748b;">Chance de Contemplação:</span>
                        <span id="chance-val" class="chance-badge" style="background: #ef4444;">BAIXA (24%)</span>
                    </div>
                    <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 10px; line-height: 1.3;">
                        *Quanto maior sua entrada, maior sua posição na fila de contemplação para este grupo.
                    </p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn" style="background: #f1f5f9; color: var(--text-dark);"
                        onclick="showStep(3)">Voltar</button>
                    <button class="btn" id="btn-next-4">Próximo</button>
                </div>
            </div>

            <!-- Step 5: Password (now step 6) -->
            <div id="step-6">
                <h2>Segurança</h2>
                <p>Crie uma senha forte para sua conta.</p>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" id="reg-pass" placeholder="••••••••">
                </div>
                <div class="form-group">
                    <label>Confirmar Senha</label>
                    <input type="password" id="reg-pass-confirm" placeholder="••••••••">
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn" style="background: #f1f5f9; color: var(--text-dark);"
                        onclick="showStep(4)">Voltar</button>
                    <button class="btn" id="btn-next-5">Próximo</button>
                </div>
            </div>

            <!-- Step 6: Revisão (now step 7) -->
            <div id="step-7">
                <h2>Revisão</h2>
                <p>Verifique se os dados estão corretos.</p>
                <div
                    style="background: #f8fafc; padding: 20px; border-radius: 12px; margin-bottom: 25px; border: 1px solid var(--border-light);">
                    <div style="margin-bottom: 10px; font-size: 0.9rem;"><strong>Nome:</strong> <span
                            id="rev-nome"></span></div>
                    <div style="margin-bottom: 10px; font-size: 0.9rem;"><strong>CPF:</strong> <span
                            id="rev-cpf"></span></div>
                    <div style="margin-bottom: 10px; font-size: 0.9rem;"><strong>Valor Desejado:</strong> <span
                            id="rev-valor"></span></div>
                    <div style="margin-bottom: 10px; font-size: 0.9rem;"><strong>Entrada:</strong> <span
                            id="rev-entrada"></span></div>
                    <div style="margin-bottom: 10px; font-size: 0.9rem;"><strong>Chance de Contemplação:</strong> <span
                            id="rev-chance" style="color: var(--primary); font-weight: 700;">24%</span></div>
                    <div style="font-size: 0.9rem;"><strong>Tempo Estimado:</strong> <span id="rev-tempo">8 dias</span>
                    </div>
                </div>
                <div id="review-area">
                    <button class="btn" id="btn-finish">Enviar para Análise</button>
                    <button class="btn" style="background: #f1f5f9; color: var(--text-dark); margin-top: 10px;"
                        onclick="showStep(5)">Voltar</button>
                </div>

                <div id="simulation-area" style="text-align: center; padding: 20px 0; display: none;">
                    <div class="analysis-spinner" id="main-spinner"></div>
                    <div class="analysis-status" id="status-text">Consultando situação financeira e analisando os
                        dados...</div>
                    <div class="progress-container" id="prog-cont">
                        <div class="progress-bar" id="prog-bar"></div>
                    </div>
                </div>
            </div>

            <!-- Step 8: Pre-Approval Result -->
            <div id="step-8">
                <div class="success-checkmark" id="check-icon" style="display: flex;"><i class="fas fa-check"></i></div>
                <h2 style="color: #22c55e; text-align: center;">Crédito Pré-Aprovado!</h2>
                <p style="text-align: center; margin-bottom: 25px;">Sua proposta foi analisada com sucesso e você possui
                    um limite disponível imediato.</p>

                <div
                    style="background: #f0f9ff; padding: 25px; border-radius: 16px; margin-bottom: 25px; border: 1px solid #bae6fd; text-align: center;">
                    <div
                        style="color: #0369a1; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; margin-bottom: 5px;">
                        Saldo Pré-Aprovado</div>
                    <div style="font-size: 2.2rem; font-weight: 800; color: #0369a1;" id="final-balance"></div>
                    <div style="margin-top: 15px; font-size: 0.9rem; color: #0c4a6e;">
                        <i class="fas fa-info-circle"></i> Para concluir, você deve verificar sua identidade no conta
                        digital após o login.
                    </div>
                </div>

                <button class="btn" id="btn-go-finish">Concluir e Acessar Conta Digital</button>
            </div>
        </div>

        <p style="text-align:center; margin-top:20px; margin-bottom:0;">
            Já tem conta? <a href="login.php"
                style="color: var(--primary); font-weight:600; text-decoration:none;">Login</a>
        </p>
    </div>

    <script>
        let userData = {
            cpf: '',
            nome: '',
            renda: '',
            veiculo_tipo: '',
            veiculo_valor: '',
            entrada: '',
            password: '',
            data_nascimento: '',
            selected_dob: ''
        };

        const steps = ['step-1', 'step-2', 'step-3', 'step-4', 'step-5', 'step-6', 'step-7', 'step-8'];
        let currentStep = 0;

        let turnstileWidgetId = null;

        window.addEventListener('load', function() {
            console.log('Window loaded, checking turnstile...');
            if (typeof turnstile !== 'undefined') {
                console.log('Turnstile found, rendering...');
                turnstileWidgetId = turnstile.render('#turnstile-container', {
                    sitekey: '<?php echo $siteKey; ?>',
                    callback: function(token) {
                        console.log('Turnstile success! Token received.');
                        const nextBtn = document.getElementById('btn-next-1');
                        if (nextBtn) {
                            nextBtn.disabled = false;
                            console.log('Button btn-next-1 enabled.');
                        } else {
                            console.error('Button btn-next-1 NOT FOUND');
                        }
                    },
                    'error-callback': function(code) {
                        console.error('Turnstile error code:', code);
                        alert("Erro de segurança (Turnstile): " + code + ". Verifique seu domínio ou chave.");
                    }
                });
            } else {
                console.error('Turnstile NOT defined');
            }
        });

        function showStep(idx) {
            document.querySelectorAll('#register-steps > div').forEach(d => d.classList.remove('active'));
            document.getElementById(steps[idx]).classList.add('active');

            document.querySelectorAll('.step').forEach((s, i) => {
                s.classList.remove('active', 'done');
                if (i === idx) s.classList.add('active');
                if (i < idx) s.classList.add('done');
            });
            currentStep = idx;
        }

        // Step 1 -> Step 2 (Restore API Lookup)
        document.getElementById('btn-next-1').addEventListener('click', async () => {
            const cpf = document.getElementById('reg-cpf').value.replace(/\D/g, '');
            const nome = document.getElementById('reg-nome').value;

            if (cpf.length !== 11 || nome.length < 5) {
                alert("Por favor, preencha os dados corretamente.");
                return;
            }

            // Turnstile token is automatically included in the form data if we use hidden field or we can get it via turnstile.getResponse()
            const turnstileToken = turnstile.getResponse(turnstileWidgetId);

            if (!turnstileToken) {
                alert("Por favor, complete o desafio de segurança antes de continuar.");
                return;
            }

            const btn = document.getElementById('btn-next-1');
            btn.disabled = true;
            btn.innerHTML = '<span class="loading-spinner"></span> Consultando...';

            try {
                const response = await fetch('/api/kyc_lookup', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `cpf=${cpf}&cf-turnstile-response=${turnstileToken}`
                });
                const result = await response.json();

                if (result.success) {
                    userData.cpf = cpf;
                    userData.nome = nome;
                    userData.data_nascimento = result.data.data_nascimento;

                    generateKycOptions(result.data.data_nascimento);
                    showStep(1); // Go to step 2 (DOB verification)
                } else {
                    alert(result.message || "Erro ao validar CPF ou base fora do ar. Tente novamente.");
                }
            } catch (e) {
                console.error(e);
                alert("Erro de conexão com o servidor.");
            } finally {
                btn.disabled = false;
                btn.innerHTML = 'Continuar';
            }
        });

        function generateKycOptions(realDob) {
            const container = document.getElementById('kyc-options');
            container.innerHTML = '';

            const [d, m, y] = realDob.split('/');
            const fakes = [
                `${String(Math.min(28, parseInt(d) + 2)).padStart(2, '0')}/${m}/${parseInt(y) - 1}`,
                `${d}/${String(Math.min(12, parseInt(m) + 1)).padStart(2, '0')}/${y}`
            ];

            const options = [...fakes, realDob].sort(() => Math.random() - 0.5);

            options.forEach(opt => {
                const card = document.createElement('div');
                card.className = 'option-card';
                card.innerHTML = `<span style="font-weight:600">${opt}</span>`;
                card.onclick = () => {
                    document.querySelectorAll('.option-card').forEach(c => c.classList.remove('selected'));
                    card.classList.add('selected');
                    userData.selected_dob = opt;
                    document.getElementById('btn-next-dob').disabled = false;
                };
                container.appendChild(card);
            });
        }

        // DOB verification to Renda
        document.getElementById('btn-next-dob').addEventListener('click', () => {
            if (userData.selected_dob !== userData.data_nascimento) {
                alert("Verificação falhou. A data de nascimento não condiz com o CPF informado.");
                window.location.reload();
                return;
            }
            showStep(2); // Go to step 3 (Renda)
        });

        // Mask function for CPF
        function maskCPF(v) {
            v = v.replace(/\D/g, "");
            if (v.length > 11) v = v.substring(0, 11);
            v = v.replace(/(\d{3})(\d)/, "$1.$2");
            v = v.replace(/(\d{3})(\d)/, "$1.$2");
            v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            return v;
        }

        document.getElementById('reg-cpf').addEventListener('input', (e) => {
            e.target.value = maskCPF(e.target.value);
        });

        // Mask function for currency
        function maskCurrency(v) {
            v = v.replace(/\D/g, "");
            v = (v / 100).toFixed(2) + "";
            v = v.replace(".", ",");
            v = v.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            return "R$ " + v;
        }

        ['reg-renda', 'reg-veiculo-valor', 'reg-entrada'].forEach(id => {
            document.getElementById(id).addEventListener('input', (e) => {
                e.target.value = maskCurrency(e.target.value);
            });
        });

        // Step 3 -> Step 4
        document.getElementById('btn-next-2').addEventListener('click', () => {
            const renda = document.getElementById('reg-renda').value;
            if (!renda || renda === 'R$ 0,00') {
                alert("Por favor, informe sua renda.");
                return;
            }
            userData.renda = renda;
            showStep(3);
        });

        // Step 4 -> Step 5
        document.getElementById('btn-next-3').addEventListener('click', () => {
            const valor = document.getElementById('reg-veiculo-valor').value;
            if (!valor || valor === 'R$ 0,00') {
                alert("Por favor, informe o valor desejado.");
                return;
            }
            userData.veiculo_tipo = document.getElementById('reg-veiculo-tipo').value;
            userData.veiculo_valor = valor;
            showStep(4);
        });

        // Step 5 Logic (Contemplation Chance)
        document.getElementById('reg-entrada').addEventListener('input', (e) => {
            const valStr = e.target.value.replace(/\D/g, '');
            const val = parseFloat(valStr) / 100;
            const veiculoValorStr = userData.veiculo_valor.replace(/\D/g, '');
            const veiculoValor = parseFloat(veiculoValorStr) / 100;

            if (veiculoValor > 0) {
                const perc = (val / veiculoValor) * 100;
                document.getElementById('perc-display').textContent = Math.floor(perc) + '%';

                let chance = 24;
                let color = '#ef4444';
                let label = 'BAIXA';
                let gaugeWidth = 20;

                if (perc >= 10 && perc < 20) {
                    chance = 24 + (perc - 10) * 1.5;
                    color = '#ef4444';
                    label = 'BAIXA';
                    gaugeWidth = 20 + (perc - 10) * 2;
                } else if (perc >= 20 && perc < 30) {
                    chance = 40 + (perc - 20) * 2;
                    color = '#eab308';
                    label = 'MÉDIA';
                    gaugeWidth = 40 + (perc - 20) * 2.5;
                } else if (perc >= 30 && perc < 45) {
                    chance = 65 + (perc - 30) * 1.5;
                    color = '#22c55e';
                    label = 'ALTA';
                    gaugeWidth = 65 + (perc - 30) * 1.5;
                } else if (perc >= 45) {
                    chance = Math.min(98, 85 + (perc - 45) * 0.5);
                    color = '#15803d';
                    label = 'MUITO ALTA';
                    gaugeWidth = Math.min(100, 85 + (perc - 45) * 1);
                }

                const fill = document.getElementById('gauge-fill');
                const chanceDisplay = document.getElementById('chance-val');

                fill.style.width = gaugeWidth + '%';
                fill.style.background = color;
                chanceDisplay.style.background = color;
                chanceDisplay.textContent = `${label} (${Math.floor(chance)}%)`;

                userData.contemplation_chance = Math.floor(chance);
            }
        });

        // Step 5 -> Step 6
        document.getElementById('btn-next-4').addEventListener('click', () => {
            const entradaStr = document.getElementById('reg-entrada').value.replace(/\D/g, '');
            const entrada = parseFloat(entradaStr) / 100;
            const veiculoValorStr = userData.veiculo_valor.replace(/\D/g, '');
            const veiculoValor = parseFloat(veiculoValorStr) / 100;

            if (!entrada || entrada === 0) {
                alert("Por favor, informe o valor de entrada.");
                return;
            }

            if (entrada < veiculoValor * 0.1) {
                alert("O valor de entrada mínimo é de 10% do valor do veículo (" + maskCurrency((veiculoValor * 10).toString().replace('.', '')) + ").");
                return;
            }

            userData.entrada = document.getElementById('reg-entrada').value;
            showStep(5);
        });

        // Step 6 -> Step 7 (Review)
        document.getElementById('btn-next-5').addEventListener('click', () => {
            const pass = document.getElementById('reg-pass').value;
            const confirm = document.getElementById('reg-pass-confirm').value;

            if (pass.length < 6 || pass !== confirm) {
                alert("As senhas não coincidem ou são muito curtas.");
                return;
            }
            userData.password = pass;

            // Populate Review
            document.getElementById('rev-nome').textContent = userData.nome;
            document.getElementById('rev-cpf').textContent = userData.cpf;
            document.getElementById('rev-valor').textContent = userData.veiculo_valor;
            document.getElementById('rev-entrada').textContent = userData.entrada;
            document.getElementById('rev-chance').textContent = (userData.contemplation_chance || 24) + '%';
            document.getElementById('final-balance').textContent = userData.veiculo_valor;

            showStep(6);
        });

        // Finish Click -> Simulation -> Step 8
        document.getElementById('btn-finish').addEventListener('click', () => {
            document.getElementById('review-area').style.display = 'none';
            document.getElementById('simulation-area').style.display = 'block';
            document.getElementById('main-spinner').style.display = 'block';
            document.getElementById('status-text').style.display = 'block';
            document.getElementById('prog-cont').style.display = 'block';

            let progress = 0;
            const bar = document.getElementById('prog-bar');
            const interval = setInterval(() => {
                progress += 1; // 10s (100 / 100 increments of 100ms)
                bar.style.width = Math.min(progress, 100) + '%';

                if (progress >= 100) {
                    clearInterval(interval);
                    showStep(7); // Final step
                }
            }, 100);
        });

        // Step 8 -> Database Finish
        document.getElementById('btn-go-finish').addEventListener('click', async () => {
            const btn = document.getElementById('btn-go-finish');
            btn.disabled = true;
            btn.innerHTML = '<span class="loading-spinner"></span> Finalizando...';

            const formData = new FormData();
            formData.append('username', userData.cpf.replace(/\D/g, ''));
            formData.append('password', userData.password);
            formData.append('fullname', userData.nome);
            formData.append('renda', userData.renda);
            formData.append('veiculo_tipo', userData.veiculo_tipo);
            formData.append('veiculo_valor', userData.veiculo_valor);
            formData.append('entrada', userData.entrada);
            formData.append('kyc_selfie', '');
            formData.append('kyc_front', '');
            formData.append('kyc_back', '');
            formData.append('cf-turnstile-response', turnstile.getResponse(turnstileWidgetId));

            const response = await fetch('/api/register', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (result.success) {
                alert("Cadastro e proposta enviados com sucesso! Proposta pré-aprovada.");
                window.location.href = 'dashboard.php';
            } else {
                alert(result.message);
                btn.disabled = false;
                btn.textContent = 'Enviar para Análise';
            }
        });
    </script>
</body>

</html>