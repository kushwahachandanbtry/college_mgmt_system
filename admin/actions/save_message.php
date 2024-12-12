<?php
include dirname(__DIR__, 2). '/config.php';
ob_clean();
header('Content-Type: application/json');


// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];
    $email = $_POST['email'];
    $time = $_POST['time'];
    $userEmail = $_POST['userEmail'];

    // Sanitize inputs
    $message = mysqli_real_escape_string($conn, $message);
    $email = mysqli_real_escape_string($conn, $email);
    $time = mysqli_real_escape_string($conn, $time);
    $userEmail = mysqli_real_escape_string($conn, $userEmail);

    // Insert message into the database
    $sql = "INSERT INTO message (email, message, time, user_email) VALUES ('$email', '$message', '$time', '$userEmail')";

    
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }
}

mysqli_close($conn);
?>
