<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Transprocred</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
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
            height: 100%;
            width: 100%;
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #bg-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .login-card {
            background: #fff;
            border: 1px solid var(--border-light);
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.8s ease-out;
            z-index: 10;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin: 0;
            color: var(--primary);
            letter-spacing: -1px;
        }

        .brand p {
            color: #64748b;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        input {
            width: 100%;
            padding: 14px 16px;
            background: #fff;
            border: 1px solid var(--border-light);
            border-radius: 12px;
            color: var(--text-dark);
            font-size: 1rem;
            transition: all 0.3s;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 125, 137, 0.1);
        }

        .captcha-box {
            background: rgba(0, 125, 137, 0.05);
            border: 1px dashed var(--primary);
            padding: 10px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .captcha-box:hover {
            background: rgba(0, 125, 137, 0.1);
        }

        .captcha-text {
            font-size: 0.8rem;
            color: var(--primary);
            font-weight: 600;
        }

        .btn {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s, background 0.2s;
        }

        .btn:hover {
            background: #006a74;
            transform: scale(1.02);
        }

        .btn:active {
            transform: scale(0.98);
        }

        .toggle-auth {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #64748b;
        }

        .toggle-auth span {
            color: var(--primary);
            cursor: pointer;
            font-weight: 600;
        }

        .message {
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            display: none;
        }

        .message.error {
            background: rgba(255, 71, 87, 0.1);
            color: #ff4757;
            border: 1px solid rgba(255, 71, 87, 0.2);
        }

        .message.success {
            background: rgba(0, 208, 132, 0.1);
            color: var(--primary);
            border: 1px solid rgba(0, 208, 132, 0.2);
        }
    </style>
</head>

<body>
    <canvas id="bg-canvas"></canvas>

    <div class="login-card">
        <div class="brand">
            <img src="public/assets/vendor/images/transpoicon.png" alt="Transprocred"
                style="max-width: 200px; height: auto; margin: 0 auto 10px;">
            <p>Acesse sua plataforma segura</p>
        </div>

        <div id="auth-message" class="message"></div>

        <form id="auth-form">
            <div class="form-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" placeholder="Seu CPF (usuário)" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="captcha-box" id="fake-captcha">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary)">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
                <span class="captcha-text">(site seguro, verificação)</span>
            </div>

            <button type="submit" class="btn" id="submit-btn">Entrar</button>
        </form>

        <div class="toggle-auth">
            <p id="toggle-text">Não tem uma conta? <span id="switch-mode">Cadastre-se</span></p>
        </div>
    </div>



    <script>
        // Particle Grid Animation
        const canvas = document.getElementById('bg-canvas');
        const ctx = canvas.getContext('2d');
        let dots = [];
        const spacing = 40;

        function init() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            dots = [];
            for (let x = 0; x < canvas.width; x += spacing) {
                for (let y = 0; y < canvas.height; y += spacing) {
                    dots.push({
                        x: x,
                        y: y,
                        size: 1.2,
                        opacity: Math.random(),
                        speed: 0.02 + Math.random() * 0.03
                    });
                }
            }
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (let i = 0; i < dots.length; i++) {
                let dot = dots[i];
                dot.opacity += dot.speed;
                if (dot.opacity > 1 || dot.opacity < 0.1) dot.speed *= -1;

                ctx.fillStyle = `rgba(0, 208, 132, ${dot.opacity * 0.3})`;
                ctx.beginPath();
                ctx.arc(dot.x, dot.y, dot.size, 0, Math.PI * 2);
                ctx.fill();
            }
            requestAnimationFrame(animate);
        }

        window.addEventListener('resize', init);
        init();
        animate();

        // Auth Logic
        const form = document.getElementById('auth-form');
        const switchMode = document.getElementById('switch-mode');
        const submitBtn = document.getElementById('submit-btn');
        const toggleText = document.getElementById('toggle-text');
        const messageBox = document.getElementById('auth-message');
        let isLogin = true;

        switchMode.addEventListener('click', () => {
            window.location.href = 'register.php';
        });

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            formData.append('action', isLogin ? 'login' : 'register');

            try {
                const response = await fetch('auth.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                messageBox.textContent = result.message;
                messageBox.style.display = 'block';
                messageBox.className = 'message ' + (result.success ? 'success' : 'error');

                if (result.success) {
                    if (isLogin) {
                        setTimeout(() => window.location.href = 'dashboard.php', 1000);
                    } else {
                        isLogin = true;
                        switchMode.click();
                        form.reset();
                    }
                }
            } catch (err) {
                console.error(err);
                messageBox.textContent = "Erro ao processar solicitação.";
                messageBox.style.display = 'block';
                messageBox.className = 'message error';
            }
        });

        // Fake Captcha feedback
        document.getElementById('fake-captcha').addEventListener('click', function () {
            this.style.background = 'rgba(0, 208, 132, 0.3)';
            const text = this.querySelector('.captcha-text');
            text.textContent = "Verificado com sucesso! ✓";
            setTimeout(() => {
                this.style.background = 'rgba(0, 208, 132, 0.1)';
                text.textContent = "(site seguro, verificação)";
            }, 2000);
        });
    </script>
</body>

</html>