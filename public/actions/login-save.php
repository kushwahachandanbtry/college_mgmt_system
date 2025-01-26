<?php
include dirname(__DIR__, 2) . '/constant.php';
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // TODO: Validate the user's credentials

    // If the credentials are valid, start a session and store the user's ID
    $_SESSION['user_id'] = true; // Replace with the actual user ID
    header('Location: ' . APP_PATH . 'index.php');
    exit;
}
?>

