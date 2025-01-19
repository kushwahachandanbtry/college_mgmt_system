<?php

// Database credentials
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "college_mgmt";

// Secure the connection with mysqli with error handling
$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

// Check for connection errors
if ($conn->connect_error) {
    // Use proper error message without exposing sensitive details
    die("Connection failed: Unable to connect to database.");
}

// Set the connection charset to prevent SQL injection through character encoding
$conn->set_charset('utf8mb4'); // utf8mb4 is a more secure charset for handling emojis and multibyte characters

