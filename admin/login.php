<?php
session_start();

$admin_user = "admin";
$admin_pass = "F#1admin";

if (isset($_POST['login'])) {
    if ($_POST['user'] === $admin_user && $_POST['pass'] === $admin_pass) {
        $_SESSION['admin_auth'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Acesso Negado. Credenciais Inválidas.";
    }
}

if (isset($_GET['logout'])) {
    unset($_SESSION['admin_auth']);
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo | Transprocred</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --red-primary: #ff0000;
            --red-glow: rgba(255, 0, 0, 0.5);
            --bg-dark: #050505;
            --glass: rgba(15, 15, 15, 0.7);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            color: #fff;
        }

        /* Mesh Gradient Background */
        .mesh-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-color: #000;
            background-image: 
                radial-gradient(at 0% 0%, hsla(0, 100%, 20%, 1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(0, 100%, 10%, 1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(0, 100%, 25%, 1) 0, transparent 50%), 
                radial-gradient(at 0% 100%, hsla(0, 100%, 15%, 1) 0, transparent 50%), 
                radial-gradient(at 100% 100%, hsla(0, 100%, 18%, 1) 0, transparent 50%);
            animation: mesh-float 20s infinite alternate linear;
        }

        @keyframes mesh-float {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: var(--glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 50px;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px rgba(0,0,0,0.5), inset 0 0 20px rgba(255,0,0,0.05);
            position: relative;
            z-index: 10;
            animation: card-entry 1s ease-out;
        }

        @keyframes card-entry {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, var(--red-primary), transparent, var(--red-primary));
            z-index: -1;
            border-radius: 32px;
            opacity: 0.3;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header i {
            font-size: 3rem;
            color: var(--red-primary);
            margin-bottom: 20px;
            filter: drop-shadow(0 0 10px var(--red-glow));
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -1px;
            background: linear-gradient(to right, #fff, #ff9999);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header p {
            color: #888;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            transition: 0.3s;
        }

        input {
            width: 100%;
            padding: 16px 20px 16px 55px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            color: #fff;
            transition: all 0.3s;
            font-size: 1rem;
        }

        input:focus {
            outline: none;
            background: rgba(255, 0, 0, 0.03);
            border-color: var(--red-primary);
            box-shadow: 0 0 20px var(--red-glow);
        }

        input:focus + i {
            color: var(--red-primary);
        }

        button {
            width: 100%;
            padding: 18px;
            background: var(--red-primary);
            border: none;
            color: #fff;
            font-weight: 800;
            font-size: 1rem;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.4s;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 10px 20px rgba(255, 0, 0, 0.3);
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        button::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -150%;
            width: 100%;
            height: 200%;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.4), transparent);
            transform: rotate(45deg);
            transition: 0.6s;
        }

        button:hover::after {
            left: 150%;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255, 0, 0, 0.4);
            background: #ff2222;
        }

        .error-msg {
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid rgba(255, 0, 0, 0.2);
            color: #ff6666;
            padding: 15px;
            border-radius: 12px;
            font-size: 0.85rem;
            margin-bottom: 25px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .footer-info {
            text-align: center;
            margin-top: 30px;
            font-size: 0.8rem;
            color: #444;
        }
    </style>
</head>
<body>
    <div class="mesh-bg"></div>

    <div class="login-card">
        <div class="header">
            <i class="fas fa-microchip"></i>
            <h1>MASTER ACCESS</h1>
            <p>Painel Administrativo Transprocred</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="error-msg">
                <i class="fas fa-exclamation-triangle"></i>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <input type="text" name="user" placeholder="Nome de usuário" required autocomplete="off">
                <i class="fas fa-user-shield"></i>
            </div>
            
            <div class="form-group">
                <input type="password" name="pass" placeholder="Palavra-passe mestra" required>
                <i class="fas fa-key"></i>
            </div>

            <button type="submit" name="login">
                AUTENTICAR NO SISTEMA <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <div class="footer-info">
            &copy; 2026 TRANSPROCRED TECH | SECURE ENVIRONMENT
        </div>
    </div>

    <?php if(isset($error)): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Credenciais Inválidas',
            text: '<?php echo $error; ?>',
            background: '#111',
            color: '#fff',
            confirmButtonColor: '#ff0000'
        });
    </script>
    <?php endif; ?>
</body>
</html>
