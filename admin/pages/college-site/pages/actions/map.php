<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    // Retrieve form data
    $map = mysqli_real_escape_string($conn, $_POST['map']);

    $errors = [];
    if (empty($map)) {
        $errors[] = 'Please enter map IFRAME.';
    }

    if (empty($errors)) {
        // Prepare SQL query to insert data into college_info table
        $sql = "INSERT INTO map (iframe) VALUES ('$map')";
        // echo $sql;

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            // Success message and redirect
            $msg = "Map inserted successfully!";
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=contact&msg=" . urlencode($msg));
            exit();
        } else {
            $msg = "Failed, due to some reason!";
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=contact&err_msg=" . urlencode($msg));
            exit();
        }
    } else {
        foreach ($errors as $error) {
            $msg = $error . "<br>";
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=contact&err_msg=" . urlencode($msg));
            exit();
        }
    }
}
