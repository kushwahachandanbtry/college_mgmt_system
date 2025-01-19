<?php
include_once '../constant.php';
session_start();

// Regenerate session ID to prevent session fixation attacks
session_regenerate_id(true);

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Clear session cookie
if (ini_get("session.useCookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}

// Redirect to the login page or home page securely
header("Location: " . APP_PATH . "admin/index.php");
exit();
?>
