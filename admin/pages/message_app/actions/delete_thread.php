<?php 
// Ensure the user ID is passed
$arr['userid'] = "null";
if( isset( $DATA_OBJ->find->userid ) ) {
    $arr['userid'] = $DATA_OBJ->find->userid;
}

// Get sender and receiver
$arr['sender'] = $_SESSION['userid'];
$arr['receiver'] = $arr['userid'];

// Fetch messages between sender and receiver
$sql = "SELECT * FROM message WHERE (sender = :sender AND receiver = :receiver) OR (sender = :receiver AND receiver = :sender)";
$result = $DB->read($sql, $arr);

// If messages are found, delete them
if( is_array( $result ) ) {
    foreach( $result as $row ) {
        // Check if the current user is the sender or receiver
        if( $_SESSION['userid'] == $row->sender || $_SESSION['userid'] == $row->receiver ) {
            // Perform the DELETE operation
            $sql = "DELETE FROM message WHERE id = :rowid LIMIT 1";
            $DB->write($sql, ['rowid' => $row->id]);
        }
    }

    // Optionally, return success response
    $info = (object)[];
    $info->message = "Thread deleted successfully.";
    $info->data_type = "info";
    echo json_encode($info);
} else {
    // Handle case where no messages are found
    $info = (object)[];
    $info->message = "No messages found for the specified thread.";
    $info->data_type = "error";
    echo json_encode($info);
}
?>
