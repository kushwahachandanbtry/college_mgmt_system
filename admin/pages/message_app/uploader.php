<?php 

session_start();
if( ! isset( $_SESSION['userid'] ) ) {
    if( isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type != 'login' && $DATA_OBJ->data_type != 'signup' ) {
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }
}
require_once "classes/init.php";

$DB = new Database();
$info = (object)[];
$data_types = "";
if( isset( $_POST['data_type'] ) ) {
    $data_types = $_POST['data_type'];
}

$destination = "";
if( isset( $_FILES['file'] ) && $_FILES['file']['name'] != '' ) {

    $allowed[] = 'image/jpeg';
    $allowed[] = 'image/png';
    $allowed[] = 'image/jpg';

    if( $_FILES['file']['error'] == 0 && in_array($_FILES['file']['type'], $allowed)) {
        $name = $_FILES['file']['name'];
        $folder = 'uploads/';
        if( ! file_exists( $folder ) ) {
            mkdir( $folder, 0777, true );
        }
        $destination = $folder . $_FILES['file']['name'];

        move_uploaded_file($_FILES['file']['tmp_name'], $destination );

        $info->message = "Your image was uploaded";
        $info->data_type = $data_types;
        echo json_encode($info);
    }
}



if( $data_types == "change_profile_image" ) {
    if( $destination != "" ) {

        //save to database
        $id = $_SESSION['userid'];
        $query = "UPDATE users SET image = '$destination' WHERE userid = '$id' LIMIT 1";
        $DB->write($query, []);
    }
} else if( $data_types == "send_image" ) {
    //user found
    $arr['userid'] = "null";
    if( isset( $_POST['userid'] ) ) {
        $arr['userid'] = addslashes( $_POST['userid'] );
    }

    $arr['message'] = '';
    $arr['date'] = date("Y-m-d H:i:s");
    $arr['sender'] = $_SESSION['userid'];
    $arr['msgid'] = get_random_string_max(60);
    $arr['file'] = $destination;

        $arr2['sender'] = $_SESSION['userid'];
        $arr2['receiver'] = $DATA_OBJ->find->userid;
        $sql2 = "SELECT * FROM message WHERE (sender = :sender && receiver = :receiver) || (sender = :receiver && receiver = :sender) LIMIT 1";
        $result2 = $DB->read($sql2, $arr2);

        if( is_array( $result2 ) ) {
            $arr['msgid'] = $result2[0]->msgid;
        }


    $query = "INSERT INTO message (sender, receiver, message, date, msgid, files ) VALUES(:sender, :userid, :message, :date, :msgid, :file)";
    $DB->write($query, $arr);
}

function get_random_string_max( $length ) {
    $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8,9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' );
    $text = "";
    $length = rand(4, $length);
    for( $i = 0; $i < $length; $i++) {
        $random = rand(0, 61);
        $text .= $array[$random];
    }
    return $text;
}
