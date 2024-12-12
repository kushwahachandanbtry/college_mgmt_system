<?php
include dirname(__DIR__, 2). '/config.php';
// Retrieve data from the POST request
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['status'])) {
    $status = $data['status'];

    // Update the status in the database
    $query = "UPDATE status_table SET status = ? WHERE id = 1"; // Adjust WHERE clause as needed
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $status);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Status updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update status."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid data."]);
}

$conn->close();
?>
