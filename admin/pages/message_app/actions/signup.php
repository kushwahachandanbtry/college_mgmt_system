<?php
// $data = false;
$info = (object) [];
$data['userid'] = $DB->generate_id(20);
$data['date'] = date("Y-m-d H:i:s");

// Validate username
$data['username'] = $DATA_OBJ->username;
if (empty($DATA_OBJ->username)) {
    $errors .= "Please enter a valid username. <br>";
} else {
    if (strlen($DATA_OBJ->username) < 4) {
        $errors .= "Username must be more than 4 characters. <br>";
    }
    if (!preg_match("/^[a-zA-Z0-9]*$/", $DATA_OBJ->username)) {
        $errors .= "Please enter a valid username. <br>";
    }
}

// Validate email
$data['email'] = $DATA_OBJ->email;
if (empty($DATA_OBJ->email)) {
    $errors .= "Please enter a valid email. <br>";
} else {
    if (!filter_var($DATA_OBJ->email, FILTER_VALIDATE_EMAIL)) {
        $errors .= "Please enter a valid email. <br>";
    }
}

// Validate password
$data['password'] = $DATA_OBJ->password;
if (empty($DATA_OBJ->password)) {
    $errors .= "Please enter a valid password.<br>";
} else {
    if ($DATA_OBJ->password != $DATA_OBJ->confirm_password) {
        $errors .= "Password and confirm password must match.<br>";
    }
    if (strlen($DATA_OBJ->password) < 8) {
        $errors .= "Password must be more than 8 characters.<br>";
    }
}

// Validate gender
$data['gender'] = $DATA_OBJ->gender;
if (empty($DATA_OBJ->gender)) {
    $errors .= "Please select a gender.<br>";
}

// Validate role
$data['role'] = $DATA_OBJ->role;
if (empty($DATA_OBJ->role)) {
    $errors .= "Please select a role.<br>";
}

// If no errors, insert into the database
if (empty($errors)) {
    $query = "INSERT INTO users(userid, username, email, gender, password, role, date) 
            VALUES(:userid, :username, :email, :gender, :password, :role, :date)";
    $result = $DB->write($query, $data);
    if ($result) {
        $info->message = "Your profile was created!";
        $info->data_type = "info";
        echo json_encode($info);
        exit;
    } else {
        $info->message = "Your profile was NOT created!";
        $info->data_type = "error";
        echo json_encode($info);
        exit;
    }
} else {
    $info->message = $errors;
    $info->data_type = "error";
    echo json_encode($info);
    exit;
}

