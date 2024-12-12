<?php
// $data = false;
$info = (object) [];
$data['userid'] = $_SESSION['userid'];

//validate username
$data['username'] = $DATA_OBJ->username;
if (empty($DATA_OBJ->username)) {
    $errors .= "Please enter valid uesrname. <br>";
} else {
    if (strlen($DATA_OBJ->username) < 4) {
        $errors .= "Username must be more than 4 characters. <br>";
    }
    if (!preg_match("/^[a-z A-Z 0-9]*$/", $DATA_OBJ->username)) {
        $errors .= "Please enter a valid username. <br>";
    }
}

//validate email
$data['email'] = $DATA_OBJ->email;

// Check if the email is empty or invalid
if (empty($DATA_OBJ->email)) {
    $errors .= "Please enter a valid email. <br>";
} else {
    // Validate email using filter_var for simplicity and accuracy
    if (!filter_var($DATA_OBJ->email, FILTER_VALIDATE_EMAIL)) {
        $errors .= "Please enter a valid email. <br>";
    }
}

//validate password
$data['password'] = $DATA_OBJ->password;
if (empty($DATA_OBJ->password)) {
    $errors = "Please enter valid password";
} else {
    if ($DATA_OBJ->password != $DATA_OBJ->confirm_password) {
        $errors = "Password and confirm password must be matched.";
    }
    if ($DATA_OBJ->password < 8) {
        $errors = "Password must be more than 8 characters.";
    }
}


//validate gender
$data['gender'] = $DATA_OBJ->gender;
if( empty( $DATA_OBJ->gender ) ) {
    $errors = "Please select related gender.";
}

// Validate role
$data['role'] = $DATA_OBJ->role;
if (empty($DATA_OBJ->role)) {
    $errors .= "Please select a role.<br>";
}

if (empty($errors)) {
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
    $info->message = $errors;
    $info->data_type = "save_setting";
    echo json_encode($info);
    exit; // Ensure no further output
}
