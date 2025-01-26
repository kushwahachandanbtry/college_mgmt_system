<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    // Retrieve form data and sanitize inputs
    $staff_name = mysqli_real_escape_string($conn, $_POST['staff_name']);
    $staff_phone = mysqli_real_escape_string($conn, $_POST['staff_phone']);
    $staff_email = mysqli_real_escape_string($conn, $_POST['staff_email']);
    $about_staff = mysqli_real_escape_string($conn, $_POST['about_staff']);

    // Validation errors array
    $errors = [];

    // Validate input fields
    if (empty($staff_name)) {
        $errors[] = 'Please enter staff name.';
    }

    if (empty($staff_phone)) {
        $errors[] = 'Please enter phone number.';
    } elseif (strlen($staff_phone) > 10 || !ctype_digit($staff_phone)) {
        $errors[] = 'Please enter a valid phone number.';
    }

    if (empty($staff_email)) {
        $errors[] = 'Please enter email.';
    } elseif (!filter_var($staff_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email.';
    }

    if (empty($about_staff)) {
        $errors[] = 'Please enter description about staff.';
    }

    // Validate file upload
    if (!isset($_FILES['staff_image']) || $_FILES['staff_image']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Please insert an image.';
    } else {
        $staff_image = $_FILES['staff_image'];
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $file_extension = strtolower(pathinfo($staff_image['name'], PATHINFO_EXTENSION));
        $file_size = $staff_image['size'];

        // Validate file extension
        if (!in_array($file_extension, $allowed_extensions)) {
            $errors[] = 'Invalid image format. Only JPG, JPEG, and PNG are allowed.';
        }

        // Validate file size
        if ($file_size > 2 * 1024 * 1024) {
            $errors[] = 'Image size must be less than 2MB.';
        }
    }

    // If there are no errors, process the upload
    if (empty($errors)) {
        // Define upload directory
        $upload_dir = dirname(__DIR__, 5) . '/assets/images/staff/';
        $file_name = basename($staff_image['name']);
        $file_path = $upload_dir . $file_name;

        // Create directory if it does not exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Move the uploaded file to the destination folder
        if (move_uploaded_file($staff_image['tmp_name'], $file_path)) {
            // Insert staff data into the database
            $sql = "INSERT INTO staff (staff_name, staff_phone, staff_email, about_staff, staff_image) 
                    VALUES ('$staff_name', '$staff_phone', '$staff_email', '$about_staff', '$file_name')";

            // Execute the query
            if (mysqli_query($conn, $sql)) {
                // Redirect with success message
                $msg = "Staff information saved successfully!";
                header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=staff&msg=" . urlencode($msg));
                exit();
            } else {
                // Redirect with database error message
                $msg = "Failed to save staff information due to a database error.";
                header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=staff&err_msg=" . urlencode($msg));
                exit();
            }
        } else {
            $msg = "Failed to upload the image.";
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=staff&err_msg=" . urlencode($msg));
            exit();
        }
    } else {
        // Redirect with validation error messages
        foreach ($errors as $error) {
            $msg = $error . "<br>";
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=staff&err_msg=" . urlencode($msg));
            exit();
        }
    }
}
