<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    // Collect form data and sanitize inputs
    $overview = mysqli_real_escape_string($conn, $_POST['overview']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);

    //validate
    $errors = [];
    if (empty($overview)) {
        $errors[] = 'Plese enter overview.';
    }

    if (empty($name)) {
        $errors[] = 'Plese enter name.';
    }

    if (empty($batch)) {
        $errors[] = 'Plese enter batch.';
    }

    if (!isset($_FILES['image']) && $_FILES['image']['error'] != 0) {
        $errors[] = 'Image uploading, error occured.';
    }

    if (empty($errors)) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Define the upload directory
            $upload_dir = dirname(__DIR__, 5) . '/assets/images/what_people_say/';
            $file_name = basename($_FILES['image']['name']);
            $file_path = $upload_dir . $file_name;

            // Check if the directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Create directory if not exists
            }

            // Move uploaded file to the destination folder
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                // File successfully uploaded, now insert into the database
                $image_path_db = 'assets/images/what_people_say/' . $file_name; // relative path for storing in DB

                // Insert the data into the what_people_say table
                $sql = "INSERT INTO what_people_say (overview, name, batch, image) 
                        VALUES ('$overview', '$name', '$batch', '$file_name')";

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
