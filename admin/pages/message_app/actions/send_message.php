<?php 
$arr['userid'] = "null";
if( isset( $DATA_OBJ->find->userid ) ) {
    $arr['userid'] = $DATA_OBJ->find->userid;
}

$sql = "SELECT * FROM users WHERE userid = :userid LIMIT 1";
$result = $DB->read($sql, $arr);

if( is_array( $result ) ) {
    //user found
    $arr['message'] = $DATA_OBJ->find->message;
    $arr['date'] = date("Y-m-d H:i:s");
    $arr['sender'] = $_SESSION['userid'];
    $arr['msgid'] = get_random_string_max(60);

        $arr2['sender'] = $_SESSION['userid'];
        $arr2['receiver'] = $DATA_OBJ->find->userid;
        $sql2 = "SELECT * FROM message WHERE (sender = :sender && receiver = :receiver) || (sender = :receiver && receiver = :sender) LIMIT 1";
        $result2 = $DB->read($sql2, $arr2);

        if( is_array( $result2 ) ) {
            $arr['msgid'] = $result2[0]->msgid;
        }


    $query = "INSERT INTO message (sender, receiver, message, date, msgid ) VALUES(:sender, :userid, :message, :date, :msgid)";
    $DB->write($query, $arr);

    $user = $result[0];
    $images = ($user->gender == "Female") ? 'ui/icons/female_users.webp' : 'ui/icons/male.png';
        if( file_exists( $user->image ) ) {
            $images = $user->image;
        }
    $user->image = $images;

    $contact_datas ="
        <div id='active_contact' >
            <img src='$user->image  ' alt=''>
            $user->username
        </div>";

    $messages ="
        <div id='messages_holder_parent' style=' height: 630px; '>
        <div id='messages_holder' style=' height: 445px; overflow-y: scroll;'>";
        
        //read from db
        $a['msgid'] = $arr['msgid'];
        $sql2 = "SELECT * FROM message WHERE msgid = :msgid";
        $result2 = $DB->read($sql2, $a);

        if( is_array( $result2 ) ) {
            foreach( $result2 as $data ) {
                $myuser = $DB->get_user( $data->sender) ;
                if( $_SESSION['userid'] == $data->sender ) {
                    $messages .= message_right( $data, $myuser );
                } else {
                    $messages .= message_left( $data, $myuser );
                }
            }
        }
            
    $messages .= message_controls();

    $info->user = $contact_datas;
    $info->messages = $messages;
    $info->data_type = "send_message";
    echo json_encode($info);
} else {
    //user not found
    $info->user = "No chats were found.";
    $info->data_type = "send_message";
    echo json_encode($info);
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
