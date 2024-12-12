<?php
$myid = $_SESSION['userid'];
$query = "SELECT * FROM users WHERE userid != '$myid' LIMIT 10";
$contact_users = $DB->read( $query, [] );

$contact_datas = '
<div style="text-align:center animation: appear 1s ease;">
';
if( is_array( $contact_users ) ) {

    //check for new messages
    $msgs = array();
    $me = $_SESSION['userid'];
    $sql = "SELECT * FROM message WHERE receiver = '$me' && received = 0";
    $mymgs = $DB->read( $sql, [] );

    if( is_array( $mymgs ) ) {
        foreach( $mymgs as $row2 ) {
            $sender = $row2->sender;
            if( isset( $msgs[$sender] ) ) {
                $msgs[$sender]++;
            } else {
                $msgs[$sender] = 1;
            }
        }
    }

    foreach( $contact_users as $user ) {
        
        $images = ($user->gender == "Female") ? 'ui/icons/female_users.webp' : 'ui/icons/male.png';
        if( file_exists( $user->image ) ) {
            $images = $user->image;
        }


        $contact_datas .="
            <div id='contact' userid='$user->userid' style='text-align: center; position: relative; cursor: pointer;' onclick='start_chat(event)'>
                <img src='$images' alt=''>
                <br>$user->username";
        if( count( $msgs ) > 0 && isset( $msgs[$user->userid] ) ) {

            $contact_datas .=" <div style='height: 20px; width: 20px; border-radius: 50%; background-color: orange; color: #fff; position: absolute; left: 0; top: 0;'>".$msgs[$user->userid]."</div>";
        }

        $contact_datas .="    </div>";
    }
}
$contact_datas .= '</div>';

// $result = $result[0];
$info->message = $contact_datas;
$info->data_type = "contacts";
echo json_encode($info);
die;
        
$info->message = "No data were found.";
$info->data_type = "error";
echo json_encode($info);

?>


