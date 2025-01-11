<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    // Collect form data and sanitize inputs
    $service_title = mysqli_real_escape_string($conn, $_POST['service_title']);
    $service_description = mysqli_real_escape_string($conn, $_POST['service_description']);


    //validate 
    $errors = [];
    if (empty($service_title)) {
        $errors[] = 'Plese enter title.';
    }

    if (empty($service_description)) {
        $errors[] = 'Plese enter description.';
    }

    if (empty($errors)) {
        $sql = "INSERT INTO services ( service_title, service_description) 
        VALUES ( '$service_title', '$service_description')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            $msg = "Service added successfully!";
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
            $msg = $error . "<br>";
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&err_msg=$msg");
            exit();
        }
    }

}
