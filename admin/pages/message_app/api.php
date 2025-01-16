<?php 
header('Content-Type: application/json');
error_reporting(0); // Hide warnings and errors from output
ini_set('display_errors', 0);

$info = (object)[];
$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode( $DATA_RAW );
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

$errors = '';

if( isset( $DATA_OBJ->data_type ) && $DATA_OBJ->data_type == 'signup' ) {
    //signup
    include "actions/signup.php";
}elseif( isset( $DATA_OBJ->data_type ) && $DATA_OBJ->data_type == 'login' ) {
    //login
    include "actions/login.php";
}elseif( isset( $DATA_OBJ->data_type ) && $DATA_OBJ->data_type == 'logout' ) {
    //login
    include "actions/logout.php";
}elseif( isset( $DATA_OBJ->data_type ) && $DATA_OBJ->data_type == 'user_info' ) {
    //user info
    include "actions/user_info.php";
}elseif( isset( $DATA_OBJ->data_type ) && ($DATA_OBJ->data_type == 'chats' || $DATA_OBJ->data_type == 'chat_refresh') ) {
    //contact info
    include "includes/chats.php";
}elseif( isset( $DATA_OBJ->data_type ) && $DATA_OBJ->data_type == 'contacts' ) {
    //contact info
    include "includes/contacts.php";
}elseif( isset( $DATA_OBJ->data_type ) && $DATA_OBJ->data_type == 'settings' ) {
    //contact info
    include "includes/settings.php";
}elseif( isset( $DATA_OBJ->data_type ) && $DATA_OBJ->data_type == 'save_setting' ) {
    //contact info
    include "actions/save_settings.php";
}elseif( isset( $DATA_OBJ->data_type ) && $DATA_OBJ->data_type == 'send_message' ) {
    //send message
    include "actions/send_message.php";
}elseif( isset( $DATA_OBJ->data_type ) && $DATA_OBJ->data_type == 'delete_message' ) {
    //delete message
    include "actions/delete_message.php";
}elseif( isset( $DATA_OBJ->data_type ) && $DATA_OBJ->data_type == 'delete_thread' ) {
    //delete thread
    include "actions/delete_thread.php";
}


function message_left( $data, $user ) {
    $images = ($user->gender == "Female") ? 'ui/icons/female_users.webp' : 'ui/icons/male.png';
        if( file_exists( $user->image ) ) {
            $images = $user->image;
        }
    $user->image = $images;
    $a = "
    <div id='message_left' >
                <div></div>
                <img id='prof_img' src='$user->image' alt=''>
                <b>$user->username</b><br>
                $data->message <br><br>";
                if( $data->files != "" && file_exists( $data->files ) ) {
                    $a .= "
                    <img src='$data->files' alt='image' style='width: 100%; cursor: pointer;' onclick='image_open(event)'/> <br><br>";
                }

            $a .= "<span style='color: #999; font-size: 11px;'>".date("jS M Y H:i:s a", strtotime($data->date))."</span>
                <img id='trash' src='ui/icons/trash.png' alt='trash' onclick='message_delete(event)' msgid='$data->id' />
            </div>";

    return $a;
}

function message_right( $data, $user ) {
    $images = ($user->gender == "Female") ? 'ui/icons/female_users.webp' : 'ui/icons/male.png';
        if( file_exists( $user->image ) ) {
            $images = $user->image;
        }
    $user->image = $images;
    $a = "
    <div id='message_right' > 
        <div>";
    if( $data->seen) {
        $a .= "<img src='ui/icons/blue_tick.png' alt='tick' style='width: 20px; height: 20px;' />";
    } elseif( $data->received) {
        $a .= "<img src='ui/icons/gray_tick.png' alt='tick' style='width: 20px; height: 20px;' />";
    }
    $a .= "
                </div>
                <img id='prof_img' src='$user->image' alt=''>
                <b>$user->username</b><br>
                $data->message <br><br>";
                if( $data->files != "" && file_exists( $data->files ) ) {
                    $a .= "
                    <img src='$data->files' alt='image' style='width: 100%; cursor: pointer;' onclick='image_open(event)'/> <br><br>";
                }

                $a .= "
                <span style='color: #fff; opacity: .8; font-size: 11px;'>".date("jS M Y H:i:s a", strtotime($data->date))."</span>
                <img id='trash' src='ui/icons/trash.png' alt='trash' onclick='message_delete(event)' msgid='$data->id' />
            </div>
    ";

    return $a;
}

function message_controls() {
    return "
    </div>
    <span onclick='delete_thread(event)' style='color: purple; cursor: pointer'>Delete this thread </span>
        <div style='display:flex; width: 100%; height: 40px; margin-top: -25px;'>
            <label for='message_file'><img src='ui/icons/attach.png' alt='Attach File' style='width: 37px; opacity: .7; margin: 2px;' /></label>
            <input type='file' id='message_file' name='file' style='display:none;' onchange='send_image(this.files)' />
            <input id='message_text' onkeyup='enter_pressed(event)' style='flex:6; border: none; font-size: 14px; border: solid thin #aaa; border-bottom: none;' type='text' placeholder='Write your messages here...'  />
            <input style='flex:1; cursor: pointer;' type='button' value='send' onclick='send_message(event)' />
        </div>
        </div>
    ";
}

