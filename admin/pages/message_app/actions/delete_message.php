<?php 
$arr['rowid'] = "null";
if( isset( $DATA_OBJ->find->rowid ) ) {
    $arr['rowid'] = $DATA_OBJ->find->rowid;
}

// Fetch the message to check the sender/receiver
$sql = "SELECT * FROM message WHERE id = :rowid LIMIT 1";
$result = $DB->read($sql, $arr);

if( is_array( $result ) ) {
    $row = $result[0];
    
    // Check if the current user is the sender or receiver and delete the message
    if( $_SESSION['userid'] == $row->sender || $_SESSION['userid'] == $row->receiver ) {
        // Delete the message
        $sql = "DELETE FROM message WHERE id = :rowid LIMIT 1";
        $DB->write($sql, ['rowid' => $row->id]);
    }
}
