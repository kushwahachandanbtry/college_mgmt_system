<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5). '/constant.php';
    include dirname(__DIR__, 5). '/config.php';

    // Retrieve form data
    $image_name = mysqli_real_escape_string($conn, $_POST['image_name']);
    
    // Handle file upload
    if (isset($_FILES['gallery_image']) && $_FILES['gallery_image']['error'] === UPLOAD_ERR_OK) {
        // Define upload directory
        $upload_dir = dirname(__DIR__, 5) . '/assets/images/gallery/'; // Adjust path as necessary
        $file_name = basename($_FILES['gallery_image']['name']);
        $files_name = $_FILES['gallery_image']['name'];
        $file_path = $upload_dir . $file_name;

        // Check if the directory exists; if not, create it
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Move the uploaded file to the designated folder
        if (move_uploaded_file($_FILES['gallery_image']['tmp_name'], $file_path)) {
            // Prepare SQL query to insert data into the gallery table
            $sql = "INSERT INTO gallery (image_name, image_path) 
                    VALUES ('$image_name', '$files_name')";

            // Execute the query
            if (mysqli_query($conn, $sql)) {
                // Success message and redirect
                $msg = "Image uploaded successfully!";
                header("Location: ".APP_PATH."admin/dashboard.php?content=college-website&page=home&msg=" . urlencode($msg));
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "No file uploaded or there was an upload error.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
