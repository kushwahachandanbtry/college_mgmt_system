<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    // Collect form data and sanitize inputs
    $features_title = mysqli_real_escape_string($conn, $_POST['features_title']);
    $features_heading = mysqli_real_escape_string($conn, $_POST['features_heading']);
    $features_description = mysqli_real_escape_string($conn, $_POST['features_description']);

    //validate
    $errors = [];
    if (empty($features_title)) {
        $errors[] = 'Please enter title.';
    }

    if (empty($features_heading)) {
        $errors[] = 'Please enter heading.';
    }

    if (empty($features_description)) {
        $errors[] = 'Please enter description.';
    }

    if (!isset($_FILES['features_image']) && $_FILES['features_image']['error'] !== 0) {
        $errors[] = 'Error occured in image uploaded.';
    }

    if (empty($errors)) {
        if (isset($_FILES['features_image']) && $_FILES['features_image']['error'] == 0) {
            // Define the upload directory
            $upload_dir = dirname(__DIR__, 5) . '/assets/images/features/';
            $file_name = basename($_FILES['features_image']['name']);
            $file_path = $upload_dir . $file_name;

            // Check if the directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Create directory if not exists
            }

            // Move uploaded file to the destination folder
            if (move_uploaded_file($_FILES['features_image']['tmp_name'], $file_path)) {
                // File successfully uploaded, now insert into the database
                $image_path_db = $file_name; // relative path for storing in DB

                // Insert the service data into the services table
                $sql = "INSERT INTO features ( features_title, features_heading, features_description, features_image) 
                        VALUES ( '$features_title', '$features_heading', '$features_description', '$image_path_db')";

                // Execute the query
                if (mysqli_query($conn, $sql)) {
                    $msg = "Features added successfully!";
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
            $msg = $error;
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&err_msg=$msg");
            exit();
        }
    }
}

