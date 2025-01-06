<?php
include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input data
    $class = mysqli_real_escape_string($conn, $_POST['class_name']);
    $routineData = $_POST['routine'];

    // Encode the routine array as JSON
    $routineJson = json_encode($routineData);

    // Insert data into routines table
    $sql = "INSERT INTO routines (class, routine) VALUES ('$class', '$routineJson')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $msg = "Routine added successfully!";
			header( "Location: ".APP_PATH."admin/dashboard.php?content=item6&msg=" . urlencode($msg) );
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>