<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';
    // Retrieve form data
    $staff_name = mysqli_real_escape_string($conn, $_POST['staff_name']);
    $staff_phone = mysqli_real_escape_string($conn, $_POST['staff_phone']);
    $staff_email = mysqli_real_escape_string($conn, $_POST['staff_email']);
    $about_staff = mysqli_real_escape_string($conn, $_POST['about_staff']);

    $errors = [];
    if (empty($staff_name)) {
        $errors[] = 'Please enter staff name.';
    }

    if (empty($staff_phone)) {
        $errors[] = 'Please enter phone number.';
    }

    if (strlen($staff_phone) > 10) {
        $errors[] = 'Please enter valid phone number.';
    }

    if (empty($staff_email)) {
        $errors[] = 'Please enter email.';
    }

    if (!empty($staff_email) && !filter_var($staff_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email.';
    }

    if (empty($about_staff)) {
        $errors[] = 'Please enter description about staff.';
    }

    if (!isset($_FILES['staff_image']) && $_FILES['staff_image']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'plese insert an image.';
    }

    // Handle file upload
    if (empty($errors)) {
        if (isset($_FILES['staff_image']) && $_FILES['staff_image']['error'] === UPLOAD_ERR_OK) {
            // Define upload directory
            $upload_dir = dirname(__DIR__, 5) . '/assets/images/staff/'; // Update directory path for staff images
            $file_name = basename($_FILES['staff_image']['name']);
            $files_name = $_FILES['staff_image']['name'];
            $file_path = $upload_dir . $file_name;

            // Check if the directory exists; if not, create it
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Move the uploaded file to the designated folder
            if (move_uploaded_file($_FILES['staff_image']['tmp_name'], $file_path)) {
                // Prepare SQL query to insert data into the staff table
                $sql = "INSERT INTO staff (staff_name, staff_phone, staff_email, about_staff, staff_image) 
                        VALUES ('$staff_name', '$staff_phone', '$staff_email', '$about_staff', '$files_name')";

                // Execute the query
                if (mysqli_query($conn, $sql)) {
                    // Success message and redirect
                    $msg = "Staff information saved successfully!";
                    header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=staff&msg=" . urlencode($msg));
                    exit();
                } else {
                    $msg = "Failed, due to some reason.";
                    header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=staff&err_msg=" . urlencode($msg));
                    exit();
                }
            }
        }
    } else {
        foreach ($errors as $error) {
            $msg = $error . "<br>";
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&page=staff&err_msg=" . urlencode($msg));

        }
    }
}


