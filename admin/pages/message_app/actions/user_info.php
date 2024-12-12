<?php
// $data = false;
$info = (object) [];

$data['userid'] = $_SESSION['userid'];

if (empty($errors)) {
    $query = "SELECT * FROM users WHERE userid = :userid LIMIT 1";
    $result = $DB->read($query, $data);
    if (is_array( $result )) {
        $result = $result[0];
        $result->data_type = "user_info";
        //check if image exits
        $image = ($result->gender == "Male") ? "ui/icons/male.png" : "ui/icons/female_users.webp";
        if( file_exists( $result-> image ) ) {
            $image = $result->image;
        }
        $result->image = $image;
        echo json_encode($result);
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
