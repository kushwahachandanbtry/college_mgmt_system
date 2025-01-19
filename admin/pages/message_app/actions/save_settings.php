<?php
// Initialize response object
$info = (object) [];
$data['userid'] = $_SESSION['userid'];

// Initialize an empty errors string to collect validation messages
$errors = '';

// Sanitize and validate username
$data['username'] = isset($DATA_OBJ->username) ? filter_var($DATA_OBJ->username, FILTER_SANITIZE_STRING) : '';
if (empty($data['username'])) {
    $errors .= "Please enter a valid username. <br>";
} else {
    if (strlen($data['username']) < 4) {
        $errors .= "Username must be more than 4 characters. <br>";
    }
    if (!preg_match("/^[a-zA-Z0-9]*$/", $data['username'])) {
        $errors .= "Please enter a valid username (only letters and numbers allowed). <br>";
    }
}

// Sanitize and validate email
$data['email'] = isset($DATA_OBJ->email) ? filter_var($DATA_OBJ->email, FILTER_SANITIZE_EMAIL) : '';
if (empty($data['email'])) {
    $errors .= "Please enter a valid email. <br>";
} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors .= "Invalid email format. <br>";
}

// Validate password and confirm password
$data['password'] = isset($DATA_OBJ->password) ? $DATA_OBJ->password : '';
$data['confirm_password'] = isset($DATA_OBJ->confirm_password) ? $DATA_OBJ->confirm_password : '';
if (empty($data['password'])) {
    $errors .= "Please enter a valid password. <br>";
} else {
    if ($data['password'] !== $data['confirm_password']) {
        $errors .= "Password and confirm password must match. <br>";
    }
    if (strlen($data['password']) < 8) {
        $errors .= "Password must be more than 8 characters. <br>";
    } else {
        // Hash the password before saving it
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
    }
}

// Validate gender
$data['gender'] = isset($DATA_OBJ->gender) ? filter_var($DATA_OBJ->gender, FILTER_SANITIZE_STRING) : '';
if (empty($data['gender'])) {
    $errors .= "Please select a gender. <br>";
}

// Validate role
$data['role'] = isset($DATA_OBJ->role) ? filter_var($DATA_OBJ->role, FILTER_SANITIZE_STRING) : '';
if (empty($data['role'])) {
    $errors .= "Please select a role. <br>";
}

if (empty($errors)) {
    // Prepare the update query with parameterized values to prevent SQL injection
    $query = "UPDATE users SET username = :username, email = :email, gender = :gender, password = :password, role = :role WHERE userid = :userid LIMIT 1";
    $result = $DB->write($query, $data);
    
    if ($result) {
        $info->message = "Your data was saved!";
        $info->data_type = "save_setting";
        echo json_encode($info);
        exit; // Ensure no further output
    } else {
        $info->message = "Your data was NOT saved!";
        $info->data_type = "save_setting";
        echo json_encode($info);
        exit; // Ensure no further output
    }
} else {
    // Return the error messages if there are any validation errors
    $info->message = $errors;
    $info->data_type = "save_setting";
    echo json_encode($info);
    exit; // Ensure no further output
}
