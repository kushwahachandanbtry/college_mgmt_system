<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5). '/constant.php';
    include dirname(__DIR__, 5). '/config.php';

    // Retrieve form data
    $map = mysqli_real_escape_string($conn, $_POST['map']);

    // Prepare SQL query to insert data into college_info table
    $sql = "INSERT INTO map (iframe) VALUES ('$map')";
    // echo $sql;

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Success message and redirect
        $msg = "Map inserted successfully!";
        // echo $msg;
        header("Location: ".APP_PATH."admin/dashboard.php?content=college-website&page=contact&msg=" . urlencode($msg));
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}


?>
