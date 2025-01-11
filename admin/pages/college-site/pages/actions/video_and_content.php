<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    // Collect form data and sanitize inputs
    $video_heading = mysqli_real_escape_string($conn, $_POST['video_heading']);
    $video_description = mysqli_real_escape_string($conn, $_POST['video_description']);
    $vieo_link = mysqli_real_escape_string($conn, $_POST['video_file']);

    //validate 
    $errors = [];
    if (empty($video_heading)) {
        $errors[] = 'Please enter heading.';
    }

    if (empty($video_description)) {
        $errors[] = 'Please enter description.';
    }

    if (empty($vieo_link)) {
        $errors[] = 'Please enter video link.';
    }

    if (empty($errors)) {
        $sql = "INSERT INTO video_and_content (video_heading, video_description, video_file) 
        VALUES ('$video_heading', '$video_description', '$vieo_link')";

        if (mysqli_query($conn, $sql)) {
            $msg = "Video and content added successfully!";
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=about&msg=$msg");
            exit();
        } else {
            $msg = "Failed, due to some reason!";
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=about&err_msg=$msg");
            exit();
        }
    } else {
        foreach ($errors as $error) {
            $msg = $error . "<br>";
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=about&err_msg=$msg");
            exit();
        }
    }
}
