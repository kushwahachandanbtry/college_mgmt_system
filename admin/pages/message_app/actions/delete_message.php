<?php 
$arr['rowid'] = "null";
if( isset( $DATA_OBJ->find->rowid ) ) {
    $arr['rowid'] = $DATA_OBJ->find->rowid;
}

$sql = "SELECT * FROM message WHERE id = :rowid LIMIT 1";
$result = $DB->read($sql, $arr);

if( is_array( $result ) ) {
    $row = $result[0];
    if( $_SESSION['userid'] == $row->sender) {
        $sql = "UPDATE message SET deleted_sender = 1 WHERE id = '$row->id' LIMIT 1";
        $DB->write($sql);
    }
    if( $_SESSION['userid'] == $row->receiver) {
        $sql = "UPDATE message SET deleted_receiver = 1 WHERE id = '$row->id' LIMIT 1";
        $DB->write($sql);
    }
}





