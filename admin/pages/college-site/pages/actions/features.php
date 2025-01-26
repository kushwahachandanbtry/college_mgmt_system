<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    // Collect form data and sanitize inputs
    $features_title = mysqli_real_escape_string($conn, $_POST['features_title']);
    $features_heading = mysqli_real_escape_string($conn, $_POST['features_heading']);
    $features_description = mysqli_real_escape_string($conn, $_POST['features_description']);

    // Validate inputs
    $errors = [];
    if (empty($features_title)) {
        $errors[] = 'Please enter the title.';
    }

    if (empty($features_heading)) {
        $errors[] = 'Please enter the heading.';
    }

    if (empty($features_description)) {
        $errors[] = 'Please enter the description.';
    }

    if (!isset($_FILES['features_image']) || $_FILES['features_image']['error'] !== 0) {
        $errors[] = 'An error occurred while uploading the image.';
    } else {
        $image = $_FILES['features_image'];
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $file_extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $file_size = $image['size'];

        // Validate file type
        if (!in_array($file_extension, $allowed_extensions)) {
            $errors[] = 'Invalid image format. Only JPG, JPEG, and PNG are allowed.';
        }

        // Validate file size (max 2MB)
        if ($file_size > 2 * 1024 * 1024) { // 2MB in bytes
            $errors[] = 'Image size must be less than 2MB.';
        }
    }

    // If no errors, proceed with the upload and database insertion
    if (empty($errors)) {
        if (isset($_FILES['features_image']) && $_FILES['features_image']['error'] == 0) {
            // Define the upload directory
            $upload_dir = dirname(__DIR__, 5) . '/assets/images/features/';
            $file_name = basename($image['name']);
            $file_path = $upload_dir . $file_name;

            // Check if the directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Create directory if not exists
            }

            // Move uploaded file to the destination folder
            if (move_uploaded_file($image['tmp_name'], $file_path)) {
                // File successfully uploaded, now insert into the database
                $image_path_db = $file_name; // Relative path for storing in DB

                // Insert the feature data into the features table
                $sql = "INSERT INTO features (features_title, features_heading, features_description, features_image) 
                        VALUES ('$features_title', '$features_heading', '$features_description', '$image_path_db')";

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
            } else {
                $msg = "Failed to upload the image.";
                $msg = urlencode($msg);
                header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&err_msg=$msg");
                exit();
            }
        }
    } else {
        // Redirect back with error messages
        foreach ($errors as $error) {
            $msg = $error;
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&err_msg=$msg");
            exit();
        }
    }
}
