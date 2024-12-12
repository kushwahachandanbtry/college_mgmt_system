<?php
// $data = false;
$info = (object) [];

$data['email'] = $DATA_OBJ->email;
if( empty( $DATA_OBJ->email ) ) {
    $errors = "Please enter a email";
}

if( empty( $DATA_OBJ->password ) ) {
    $errors = "Please enter a password";
}

if (empty($errors)) {
    $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $result = $DB->read($query, $data);
    if (is_array( $result )) {
        $result = $result[0];
        if( $result->password == $DATA_OBJ->password ) {
            $_SESSION['userid'] = $result->userid;
            $info->message = "You're logged in.";
            $info->data_type = "info";
            echo json_encode($info);
        } else {
            $info->message = "Wrong password.";
            $info->data_type = "error";
            echo json_encode($info);
        exit;
        }
    } else {
        $info->message = "Wrong Email.";
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
