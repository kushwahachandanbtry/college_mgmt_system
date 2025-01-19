<?php
// Initialize response object
$info = (object) [];
$errors = ''; // Ensure that the errors variable is defined

// Sanitize and validate email
$data['email'] = isset($DATA_OBJ->email) ? filter_var($DATA_OBJ->email, FILTER_SANITIZE_EMAIL) : '';
if (empty($data['email'])) {
    $errors = "Please enter an email.";
} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors .= "Invalid email format.";
}

// Validate password
$data['password'] = isset($DATA_OBJ->password) ? $DATA_OBJ->password : '';
if (empty($data['password'])) {
    $errors .= "Please enter a password.";
}

// CSRF Token Validation (ensure CSRF token exists and matches session)
if (!isset($DATA_OBJ->csrf_token) || $DATA_OBJ->csrf_token !== $_SESSION['csrf_token']) {
    $errors .= "CSRF token validation failed.";
}

// If no errors, check the email and password
if (empty($errors)) {
    // Use a parameterized query to prevent SQL injection
    $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $result = $DB->read($query, $data);

    if (is_array($result) && count($result) > 0) {
        $result = $result[0];
        
        // Verify the hashed password
        if (password_verify($data['password'], $result->password)) {
            // Store the user ID securely in the session
            $_SESSION['userid'] = $result->userid;
            $_SESSION['email'] = $result->email;
            $_SESSION['username'] = $result->username;
            $_SESSION['role'] = $result->role;

            // Provide login success message
            $info->message = "You're logged in.";
            $info->data_type = "info";
            echo json_encode($info);
        } else {
            // Incorrect password
            $info->message = "Wrong password.";
            $info->data_type = "error";
            echo json_encode($info);
            exit;
        }
    } else {
        // No user found with that email
        $info->message = "Wrong email.";
        $info->data_type = "error";
        echo json_encode($info);
        exit;
    }
} else {
    // Return the error message if validation failed
    $info->message = $errors;
    $info->data_type = "error";
    echo json_encode($info);
    exit;
}
