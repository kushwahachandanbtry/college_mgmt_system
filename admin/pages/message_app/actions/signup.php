<?php
// Initialize empty object for returning information
$info = (object) [];
$errors = ''; // Ensure that errors are defined

// Generate unique user ID
$data['userid'] = $DB->generate_id(20);
$data['date'] = date("Y-m-d H:i:s");

// Validate and sanitize username
$data['username'] = isset($DATA_OBJ->username) ? filter_var($DATA_OBJ->username, FILTER_SANITIZE_STRING) : '';
if (empty($data['username'])) {
    $errors .= "Please enter a valid username. <br>";
} else {
    if (strlen($data['username']) < 4) {
        $errors .= "Username must be more than 4 characters. <br>";
    }
    if (!preg_match("/^[a-zA-Z0-9]*$/", $data['username'])) {
        $errors .= "Username can only contain letters and numbers. <br>";
    }
}

// Validate and sanitize email
$data['email'] = isset($DATA_OBJ->email) ? filter_var($DATA_OBJ->email, FILTER_SANITIZE_EMAIL) : '';
if (empty($data['email'])) {
    $errors .= "Please enter a valid email. <br>";
} else {
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors .= "Please enter a valid email. <br>";
    }
}

// Validate password and confirm password
$data['password'] = isset($DATA_OBJ->password) ? $DATA_OBJ->password : '';
if (empty($data['password'])) {
    $errors .= "Please enter a valid password.<br>";
} else {
    if ($data['password'] != $DATA_OBJ->confirm_password) {
        $errors .= "Password and confirm password must match.<br>";
    }
    if (strlen($data['password']) < 8) {
        $errors .= "Password must be more than 8 characters.<br>";
    }
}

// Hash the password before storing
$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

// Validate gender
$data['gender'] = isset($DATA_OBJ->gender) ? filter_var($DATA_OBJ->gender, FILTER_SANITIZE_STRING) : '';
if (empty($data['gender'])) {
    $errors .= "Please select a gender.<br>";
}

// Validate role
$data['role'] = isset($DATA_OBJ->role) ? filter_var($DATA_OBJ->role, FILTER_SANITIZE_STRING) : '';
if (empty($data['role'])) {
    $errors .= "Please select a role.<br>";
}

// If no errors, insert into the database
if (empty($errors)) {
    // SQL query with parameterized values to prevent SQL injection
    $query = "INSERT INTO users (userid, username, email, gender, password, role, date) 
            VALUES (:userid, :username, :email, :gender, :password, :role, :date)";
    
    // Execute query safely with prepared statements
    $result = $DB->write($query, $data);
    
    if ($result) {
        // Return success message if the user profile was created successfully
        $info->message = "Your profile was created!";
        $info->data_type = "info";
        echo json_encode($info);
        exit;
    } else {
        // Return failure message if the profile was not created
        $info->message = "Your profile was NOT created!";
        $info->data_type = "error";
        echo json_encode($info);
        exit;
    }
} else {
    // Return errors if validation failed
    $info->message = $errors;
    $info->data_type = "error";
    echo json_encode($info);
    exit;
}
