<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5). '/constant.php';
    include dirname(__DIR__, 5). '/config.php';

    // Collect form data and sanitize inputs
    $video_heading = mysqli_real_escape_string($conn, $_POST['video_heading']);
    $video_description = mysqli_real_escape_string($conn, $_POST['video_description']);
    $vieo_link = mysqli_real_escape_string( $conn, $_POST['video_file']);



    // Insert the video data into the video_and_content table
    $sql = "INSERT INTO video_and_content (video_heading, video_description, video_file) 
                    VALUES ('$video_heading', '$video_description', '$vieo_link')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        $msg = "Video and content added successfully!";
        $msg = urlencode($msg);
        header("Location: ".APP_PATH."admin/dashboard.php?content=college-website&&page=about&msg=$msg");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

