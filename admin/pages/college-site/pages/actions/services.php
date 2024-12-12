<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5). '/constant.php';
    include dirname(__DIR__, 5). '/config.php';

    // Collect form data and sanitize inputs
    $service_title = mysqli_real_escape_string($conn, $_POST['service_title']);
    $service_description = mysqli_real_escape_string($conn, $_POST['service_description']);



    // Insert the service data into the services table
    $sql = "INSERT INTO services ( service_title, service_description) 
                    VALUES ( '$service_title', '$service_description')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        $msg = "Service added successfully!";
        $msg = urlencode($msg);
        header("Location: ".APP_PATH."admin/dashboard.php?content=college-website&&page=home&msg=$msg");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Failed to upload the image.";
}
?>

