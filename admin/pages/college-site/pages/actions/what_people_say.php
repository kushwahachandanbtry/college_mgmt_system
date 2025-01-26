<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    // Collect and sanitize form data
    $overview = mysqli_real_escape_string($conn, $_POST['overview']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);

    // Validation errors array
    $errors = [];
    
    // Validate form data
    if (empty($overview)) {
        $errors[] = 'Please enter overview.';
    }

    if (empty($name)) {
        $errors[] = 'Please enter name.';
    }

    if (empty($batch)) {
        $errors[] = 'Please enter batch.';
    }

    // Validate file upload
    if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
        $errors[] = 'Error occurred during image upload.';
    } else {
        $image = $_FILES['image'];
        $allowed_extensions = ['jpg', 'jpeg', 'png'];  // Allowed image extensions
        $file_extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $file_size = $image['size'];

        // Check if the file is one of the allowed types
        if (!in_array($file_extension, $allowed_extensions)) {
            $errors[] = 'Invalid image format. Only JPG, JPEG, and PNG are allowed.';
        }

        // Check if the file size is within the allowed limit (2MB)
        if ($file_size > 2 * 1024 * 1024) {  // 2MB
            $errors[] = 'Image size must be less than 2MB.';
        }
    }

    // If no errors, proceed with file upload and data insertion
    if (empty($errors)) {
        // Define the upload directory
        $upload_dir = dirname(__DIR__, 5) . '/assets/images/what_people_say/';
        $file_name = basename($image['name']);
        $file_path = $upload_dir . $file_name;

        // Check if the directory exists, if not, create it
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move the uploaded file to the destination folder
        if (move_uploaded_file($image['tmp_name'], $file_path)) {
            // File successfully uploaded, now insert the data into the database
            $image_path_db = 'assets/images/what_people_say/' . $file_name;  // Relative path for DB

            // Insert the data into the 'what_people_say' table
            $sql = "INSERT INTO what_people_say (overview, name, batch, image) 
                    VALUES ('$overview', '$name', '$batch', '$file_name')";

            // Execute the query
            if (mysqli_query($conn, $sql)) {
                $msg = "Added successfully!";
                $msg = urlencode($msg);
                header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=home&msg=$msg");
                exit();
            } else {
                $msg = "Failed due to some reason!";
                $msg = urlencode($msg);
                header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=home&err_msg=$msg");
                exit();
            }
        } else {
            $msg = "Failed to upload the image.";
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=home&err_msg=$msg");
            exit();
        }
    } else {
        // If validation errors exist, redirect with the error message
        foreach ($errors as $error) {
            $msg = $error . "<br>";
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=home&err_msg=$msg");
            exit();
        }
    }
}
?>
