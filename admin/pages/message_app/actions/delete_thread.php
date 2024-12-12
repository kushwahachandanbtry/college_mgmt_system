<?php 
$arr['userid'] = "null";
if( isset( $DATA_OBJ->find->userid ) ) {
    $arr['userid'] = $DATA_OBJ->find->userid;
}

$arr['sender'] = $_SESSION['userid'];
$arr['receiver'] = $arr['userid'];
$sql = "SELECT * FROM message WHERE (sender = :sender && receiver = :receiver) || (sender = :receiver && receiver = :sender) ";
$result = $DB->read($sql, $arr);

if( is_array( $result ) ) {
    foreach( $result as $row ) {
        if( $_SESSION['userid'] == $row->sender) {
            $sql = "UPDATE message SET deleted_sender = 1 WHERE id = '$row->id' LIMIT 1";
            $DB->write($sql);
        }
        if( $_SESSION['userid'] == $row->receiver) {
            $sql = "UPDATE message SET deleted_receiver = 1 WHERE id = '$row->id' LIMIT 1";
            $DB->write($sql);
        }
    }
}





