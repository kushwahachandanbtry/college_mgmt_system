<?php

if (isset($_POST['save'])) {

    include dirname(__DIR__, 5). '/constant.php';
    include dirname(__DIR__, 5). '/config.php';

    // Check if the image file is uploaded
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {

        // Get file name and temporary name
        $file_name = $_FILES['img']['name'];
        $tmp_name = $_FILES['img']['tmp_name'];

        // Define the absolute path to the logo directory
        
        $main_folder = dirname(__DIR__, 5);
        // Output the path
        $upload_folder = $main_folder . '/assets/images/logo';
        // echo "Main folder path: " . $main_folder;

        // Check if the folder exists
        if ($upload_folder === false) {
            echo "Directory does not exist or cannot be resolved.<br>";
            exit(); // Stop execution if the directory doesn't exist
        }

        $file_path = $upload_folder . '/' . $file_name;  // Construct the final file path

        // DEBUG: Print the absolute file path for verification
        // echo "Resolved absolute file path: " . $file_path . "<br>";

        // Move the uploaded file to the destination folder
        if (move_uploaded_file($tmp_name, $file_path)) {

            // SQL query to insert the file name into the database
            $sql = "INSERT INTO home_logo(image) VALUES('{$file_name}')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                // If the query is successful, set a success message
                $msg = "Logo inserted successfully!";
                $msg = urlencode($msg);

                // Redirect with a success message
                header("Location: ".APP_PATH."admin/dashboard.php?content=college-website&&page=home&msg=$msg");
                exit();
            } else {
                echo "Database insert failed: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to move the uploaded file.<br>";
            echo "Temporary file location: " . $tmp_name . "<br>";
        }

    } else {
        echo "No image selected or upload error.<br>";
    }
}

?>
