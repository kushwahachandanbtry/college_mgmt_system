<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    // Retrieve form data
    $image_name = mysqli_real_escape_string($conn, $_POST['image_name']);

    $errors = [];

    // Validate image name
    if (empty($image_name)) {
        $errors[] = 'Please enter the image name.';
    }

    // Validate file upload
    if (!isset($_FILES['gallery_image']) || $_FILES['gallery_image']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'An error occurred while uploading the image.';
    } else {
        $image = $_FILES['gallery_image'];
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $file_extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $file_size = $image['size'];

        // Check file type
        if (!in_array($file_extension, $allowed_extensions)) {
            $errors[] = 'Invalid image format. Only JPG, JPEG, and PNG are allowed.';
        }

        // Check file size (less than 2MB)
        if ($file_size > 2 * 1024 * 1024) { // 2MB in bytes
            $errors[] = 'Image size must be less than 2MB.';
        }
    }

    // If there are no errors, process the upload
    if (empty($errors)) {
        if (isset($_FILES['gallery_image']) && $_FILES['gallery_image']['error'] === UPLOAD_ERR_OK) {
            // Define upload directory
            $upload_dir = dirname(__DIR__, 5) . '/assets/images/gallery/';
            $file_name = basename($image['name']);
            $file_path = $upload_dir . $file_name;

            // Create directory if it does not exist
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Move the uploaded file to the designated folder
            if (move_uploaded_file($image['tmp_name'], $file_path)) {
                // Prepare SQL query to insert data into the gallery table
                $sql = "INSERT INTO gallery (image_name, image_path) 
                        VALUES ('$image_name', '$file_name')";

                // Execute the query
                if (mysqli_query($conn, $sql)) {
                    // Success message and redirect
                    $msg = "Image uploaded successfully!";
                    header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=home&msg=" . urlencode($msg));
                    exit();
                } else {
                    $msg = "Failed to save the image details in the database.";
                    header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=home&err_msg=" . urlencode($msg));
                    exit();
                }
            } else {
                $msg = "Failed to move the uploaded image.";
                header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=home&err_msg=" . urlencode($msg));
                exit();
            }
        }
    } else {
        // Redirect back with error messages
        foreach ($errors as $error) {
            $msg = $error . "<br>";
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=home&err_msg=" . urlencode($msg));
            exit();
        }
    }
}
