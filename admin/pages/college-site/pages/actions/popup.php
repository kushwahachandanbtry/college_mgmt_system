<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    //validate
    $errors = [];

    if (!isset($_FILES['image']) && $_FILES['image']['error'] != 0) {
        $errors[] = 'Image uploading, error occured.';
    }

    if (empty($errors)) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Define the upload directory
            $upload_dir = dirname(__DIR__, 5) . '/assets/images/popup/';
            $file_name = basename($_FILES['image']['name']);
            $file_path = $upload_dir . $file_name;

            // Check if the directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Create directory if not exists
            }

            // Move uploaded file to the destination folder
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {

                // Insert the data into the what_people_say table
                $sql = "INSERT INTO popup (image) 
                        VALUES ( '$file_name')";

                // Execute the query
                if (mysqli_query($conn, $sql)) {
                    $msg = "Added successfully!";
                    $msg = urlencode($msg);
                    header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&msg=$msg");
                    exit();
                } else {
                    $msg = "Failed, due to some reason!";
                    $msg = urlencode($msg);
                    header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&err_msg=$msg");
                    exit();
                }
            }
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


