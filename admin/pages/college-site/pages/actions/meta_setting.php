<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    // Collect and sanitize form data
    $pages = mysqli_real_escape_string($conn, $_POST['pages']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $canonical_tag = mysqli_real_escape_string($conn, $_POST['canonical_tag']);
    $og_title = mysqli_real_escape_string($conn, $_POST['og_title']);
    $og_description = mysqli_real_escape_string($conn, $_POST['og_description']);
    $og_url = mysqli_real_escape_string($conn, $_POST['og_url']);

    $errors = [];

    // Validate form fields
    if (empty($pages)) {
        $errors[] = 'Please select a page.';
    }
    if (empty($meta_title)) {
        $errors[] = 'Please enter meta title.';
    }
    if (empty($meta_description)) {
        $errors[] = 'Please enter meta description.';
    }
    if (empty($meta_keywords)) {
        $errors[] = 'Please enter meta keywords.';
    }
    if (empty($canonical_tag)) {
        $errors[] = 'Please enter canonical tag.';
    }
    if (empty($og_title)) {
        $errors[] = 'Please enter OG title.';
    }
    if (empty($og_description)) {
        $errors[] = 'Please enter OG description.';
    }
    if (empty($og_url)) {
        $errors[] = 'Please enter OG URL.';
    }

    // Validate OG image
    if (!isset($_FILES['og_image']) || $_FILES['og_image']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Please insert a valid OG image.';
    } else {
        $og_image = $_FILES['og_image'];
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $file_extension = strtolower(pathinfo($og_image['name'], PATHINFO_EXTENSION));
        $file_size = $og_image['size'];

        // Validate file extension
        if (!in_array($file_extension, $allowed_extensions)) {
            $errors[] = 'Invalid OG image format. Only JPG, JPEG, and PNG are allowed.';
        }

        // Validate file size (less than 2MB)
        if ($file_size > 2 * 1024 * 1024) {
            $errors[] = 'OG image size must be less than 2MB.';
        }
    }

    // If there are no errors, process the upload
    if (empty($errors)) {
        // Define the upload directory
        $upload_dir = dirname(__DIR__, 5) . '/assets/images/Og_images/';
        $file_name = basename($og_image['name']);
        $file_path = $upload_dir . $file_name;

        // Create directory if it does not exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move uploaded file to the destination folder
        if (move_uploaded_file($og_image['tmp_name'], $file_path)) {
            // Prepare SQL query to insert data into the meta_setting table
            $image_path_db = $file_name; // Store only the file name in the database
            $sql = "INSERT INTO meta_setting (pages, meta_title, meta_description, meta_keywords, canonical_tag, og_title, og_description, og_url, og_image) 
                    VALUES ('$pages', '$meta_title', '$meta_description', '$meta_keywords', '$canonical_tag', '$og_title', '$og_description', '$og_url', '$image_path_db')";

            // Execute the query
            if (mysqli_query($conn, $sql)) {
                $msg = "Meta setting added successfully!";
                header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=cources&msg=" . urlencode($msg));
                exit();
            } else {
                $msg = "Failed to save meta setting due to a database error.";
                header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=cources&err_msg=" . urlencode($msg));
                exit();
            }
        } else {
            $msg = "Failed to upload the OG image.";
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=cources&err_msg=" . urlencode($msg));
            exit();
        }
    } else {
        // Redirect with error messages
        foreach ($errors as $error) {
            $msg = $error . "<br>";
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=cources&err_msg=" . urlencode($msg));
            exit();
        }
    }
}
