<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Session Helper (Legacy Support)
 */
function isLoggedIn()
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function logout()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_destroy();
    header("Location: index.php");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
}

// All POST actions moved to /api/ via index.php