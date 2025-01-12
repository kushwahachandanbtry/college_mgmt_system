<?php
include dirname(__DIR__, 5). '/config.php';
if( $_SERVER['REQUEST_METHOD'] === "POST" ) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM services WHERE id = {$id}";
    if(mysqli_query( $conn, $sql )) {
        echo json_encode(['success' => true ] );
    } else {
        echo json_encode(['success' => false ]);
    }
}

echo "fetched successfull";
