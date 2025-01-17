<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    // Collect form data and sanitize inputs
    $FAQ_title = mysqli_real_escape_string($conn, $_POST['FAQ_title']);
    $FAQ_description = mysqli_real_escape_string($conn, $_POST['FAQ_description']);

    $errors = [];
    if (empty($FAQ_title)) {
        $errors[] = 'Please enter title.';
    }

    if (empty($FAQ_description)) {
        $errors[] = 'Please enter description.';
    }

    if (empty($errors)) {
        // Insert the service data into the services table
        $sql = "INSERT INTO faq ( FAQ_title, FAQ_description ) 
        VALUES ( '$FAQ_title', '$FAQ_description' )";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            $msg = "FAQ added successfully!";
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&msg=$msg");
            exit();
        } else {
            $msg = "Failed, due to some reason!";
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&err_msg=$msg");
            exit();
        }
    } else {
        foreach ($errors as $error) {
            $msg = $error;
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&err_msg=$msg");
            exit();
        }
    }
}

