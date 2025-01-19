<?php
include dirname(__DIR__, 2). '/config.php';
if( $_SERVER['REQUEST_METHOD'] === "POST" ) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM gallery WHERE id = {$id}";
    if(mysqli_query( $conn, $sql )) {
        echo json_encode(['success' => true ] );
    } else {
        echo json_encode(['success' => false ]);
    }
}

