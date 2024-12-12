<?php 
$arr['userid'] = "null";
if( isset( $DATA_OBJ->find->userid ) ) {
    $arr['userid'] = $DATA_OBJ->find->userid;
}

$refresh = false;
$seen = false;
if( $DATA_OBJ->data_type == 'chat_refresh' ) {
    $refresh = true;
    $seen = $DATA_OBJ->find->seen;
}
$sql = "SELECT * FROM users WHERE userid = :userid LIMIT 1";
$result = $DB->read($sql, $arr);

if( is_array( $result ) ) {
    //user found
    $user = $result[0];
    $images = ($user->gender == "Female") ? 'ui/icons/female_users.webp' : 'ui/icons/male.png';
        if( file_exists( $user->image ) ) {
            $images = $user->image;
        }
    $user->image = $images;
    $contact_datas = "";
    if( ! $refresh ) {
        $contact_datas ="
            <div id='active_contact' >
                <img src='$images' alt=''>
                $user->username
            </div>";
    }
    $messages = '';
    $new_message = false;
    if( ! $refresh ) {
    $messages ="
        <div id='messages_holder_parent' onclick='set_seen(event)' style=' height: 600px; border-bottom-right-radius: 20px;'>
        <div id='messages_holder' style=' height: 455px; overflow-y: scroll;'>";
    }
        //read from db
        $a['sender'] = $_SESSION['userid'];
        $a['receiver'] = $arr['userid'];
        $sql2 = "SELECT * FROM message WHERE (sender = :sender && receiver = :receiver && deleted_sender = 0) || (sender = :receiver && receiver = :sender && deleted_receiver = 0) ";
        $result2 = $DB->read($sql2, $a);

        if( is_array( $result2 ) ) {
            foreach( $result2 as $data ) {
                $myuser = $DB->get_user( $data->sender) ;

                if( $data->received == 0 && $data->receiver == $_SESSION['userid']) {
                    $new_message = true;
                }
                if( $data->receiver == $_SESSION['userid'] && $data->received == 1 && $seen == true ) {
                    $DB->write("UPDATE message SET seen = 1 WHERE id = '$data->id' LIMIT 1");
                }

                if( $data->receiver == $_SESSION['userid'] ) {
                    $DB->write("UPDATE message SET received = 1 WHERE id = '$data->id' LIMIT 1");
                }


                if( $_SESSION['userid'] == $data->sender ) {
                    $messages .= message_right( $data, $myuser );
                } else {
                    $messages .= message_left( $data, $myuser );
                }
            }
        }
    if( ! $refresh ) {      
        $messages .= message_controls();
    }

    $info->user = $contact_datas;
    $info->messages = $messages;
    $info->new_message = $new_message;
    $info->data_type = "chats";
    if( $refresh ) {
        $info->data_type = "chat_refresh";
        
    }
    echo json_encode($info);
} else {
    //read from db
    $a['userid'] = $_SESSION['userid'];
    $sql2 = "SELECT * FROM message WHERE (sender = :userid || receiver = :userid) GROUP BY msgid";
    $result2 = $DB->read($sql2, $a);

    if( is_array( $result2 ) ) {
        foreach( $result2 as $data ) {
            $other_user = $data->sender;
            if( $data->sender == $_SESSION['userid'] ) {
                $other_user = $data->receiver;
            }
            $myuser = $DB->get_user( $other_user) ;

            $images = ($myuser->gender == "Female") ? 'ui/icons/female_users.webp' : 'ui/icons/male.png';
            if( file_exists( $myuser->image ) ) {
                $images = $myuser->image;
            }
            $myuser->image = $images;

            $contact_datas .="
                <div id='active_contact' userid='$myuser->userid' style='text-align: center;' onclick='start_chat(event)'>
                    <img src='$myuser->image' alt=''>
                    $myuser->username<br>
                    <span style='font-size: 11px;'>$data->message</span>
                </div>";
        }
    }
    //user not found
    $info->user = $contact_datas;
    $info->messages = "";
    $info->data_type = "chats";
    echo json_encode($info);
}




