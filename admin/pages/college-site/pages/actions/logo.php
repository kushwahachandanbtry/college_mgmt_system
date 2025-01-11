<?php
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';
    if (isset($_POST['save'])) {
        $id = 1;
        // Retrieve the old image
        $sql = "SELECT image FROM home_logo WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $old_image = '';
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $old_image = $row['image'];
        }
    
        // Handling the image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Define the upload directory
            $upload_dir = dirname(__DIR__, 5) . '/assets/images/logo/';
            $file_name = basename($_FILES['image']['name']);
            $file_path = $upload_dir . $file_name;
    
            // Check if the directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
            }
    
            // Move uploaded file to the destination folder
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                // Delete the old image file
                if (!empty($old_image)) {
                    $old_image_path = $upload_dir . $old_image;
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }
    
                // File successfully uploaded, now update the database
                $image_path_db = $file_name; // Store only the filename in the DB
    
                $sql = "UPDATE home_logo 
                        SET  image = '$image_path_db' 
                        WHERE id = $id";
    
                if (mysqli_query($conn, $sql)) {
                    $msg = "Logo update successfully!";
                    $msg = urlencode($msg);
                    header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&msg=$msg");
                    exit();
                } else {
                    $msg = "Logo update Failed!";
                    $msg = urlencode($msg);
                    header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&err_msg=$msg");
                    exit();;
                }
            } else {
                $msg = "Logo update Failed!";
                $msg = urlencode($msg);
                header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&err_msg=$msg");
                exit();
            }
        } else {
    
            if (mysqli_query($conn, $sql)) {
                $msg = "Logo update successfully!";
                $msg = urlencode($msg);
                header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&msg=$msg");
                exit();
            } else {
                $msg = "Logo update failed!";
                $msg = urlencode($msg);
                header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=home&err_msg=$msg");
                exit();
            }
        }
    }
