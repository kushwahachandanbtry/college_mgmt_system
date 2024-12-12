<?php
if (isset($_POST['save'])) {

    include dirname(__DIR__, 5). '/constant.php';
    include dirname(__DIR__, 5). '/config.php';

    // Define the folder where the images will be stored
    $upload_folder = 'uploads/';

    // Array to store the uploaded image names
    $image_names = array();

    // Check if files were uploaded
    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['name'] as $key => $name) {
            $tmp_name = $_FILES['images']['tmp_name'][$key];
            $file_name = basename($name);

            // Set destination to move the file
            $main_folder = dirname(__DIR__, 5);
            $upload_folder = $main_folder . '/assets/images/slider';

            if ($upload_folder === false) {
                echo 'Directory does not exist or cannot be resolved. <br>';
                exit();
            }

            $file_path = $upload_folder . '/' . $file_name;

            // Move uploaded file to destination folder
            if (move_uploaded_file($tmp_name, $file_path)) {
                // Add the uploaded file name to the array
                $image_names[] = $file_name;
            } else {
                echo "Failed to move the uploaded file: $file_name. <br>";
                echo "Temporary file location: " . $tmp_name . "<br>";
            }
        }

        // Convert the array of image names to a JSON string
        $slider_images = json_encode($image_names);

        // SQL query to insert the JSON string into the slider table
        $sql = "INSERT INTO slider (slider_img) VALUES ('$slider_images')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            $msg = "Slider inserted successfully!";
            $msg = urlencode($msg);
            header("Location: ".APP_PATH."admin/dashboard.php?content=college-website&&page=home&msg=$msg");
            exit();
        } else {
            echo "Database insert failed: " . mysqli_error($conn);
        }
    } else {
        echo "Please upload at least one image.";
    }
}
?>
