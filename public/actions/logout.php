<?php 
// Include the constants file securely
include dirname(__DIR__, 2) . '/constant.php';

// Start the session securely
session_start();

// Regenerate the session ID to prevent session fixation
session_regenerate_id(true);

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Ensure APP_PATH is sanitized and escape it before redirecting
$redirectUrl = filter_var(APP_PATH, FILTER_SANITIZE_URL);

// Redirect user to the home page (index.php) securely
header('Location: ' . $redirectUrl . 'index.php');

// Exit to stop further script execution
exit;
