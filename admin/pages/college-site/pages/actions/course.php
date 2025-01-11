<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    // Collect and sanitize form data
    $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
    $course_description = mysqli_real_escape_string($conn, $_POST['course_description']);
    $course_duration = mysqli_real_escape_string($conn, $_POST['course_duration']);
    $categories = mysqli_real_escape_string($conn, $_POST['categories']);
    $course_objectives = mysqli_real_escape_string($conn, $_POST['course_objectives']);
    $course_intake = mysqli_real_escape_string($conn, $_POST['course_intake']);

    //validate
    $errors = [];
    if (empty($course_title)) {
        $errors[] = 'Please enter course title.';
    }

    if (empty($course_description)) {
        $errors[] = 'Please enter course description.';
    }

    if (empty($course_duration)) {
        $errors[] = 'Please enter course duration.';
    }

    if (empty($categories)) {
        $errors[] = 'Please select course category.';
    }

    if (empty($course_objectives)) {
        $errors[] = 'Please enter course objectives.';
    }

    if (empty($course_intake)) {
        $errors[] = 'Please enter course intake.';
    }

    // Define directories for uploads
    $base_upload_dir = dirname(__DIR__, 5) . '/assets/images/courses/';
    $course_image_dir = $base_upload_dir . 'course_images/';
    $syllabus_image_dir = $base_upload_dir . 'syllabus_images/';

    // Ensure directories exist
    if (!is_dir($course_image_dir))
        mkdir($course_image_dir, 0777, true);
    if (!is_dir($syllabus_image_dir))
        mkdir($syllabus_image_dir, 0777, true);

    // Handle course image upload
    $course_image_path = null;
    if (isset($_FILES['course_image']) && $_FILES['course_image']['error'] == 0) {
        $course_image_name = basename($_FILES['course_image']['name']);
        $course_image_path = $course_image_dir . $course_image_name;

        if (!move_uploaded_file($_FILES['course_image']['tmp_name'], $course_image_path)) {
            $errors[] = "Failed to upload course image.";
            exit();
        }
    }

    // Handle syllabus image upload
    $syllabus_image_path = null;
    if (isset($_FILES['syllabus_image']) && $_FILES['syllabus_image']['error'] == 0) {
        $syllabus_image_name = basename($_FILES['syllabus_image']['name']);
        $syllabus_image_path = $syllabus_image_dir . $syllabus_image_name;

        if (!move_uploaded_file($_FILES['syllabus_image']['tmp_name'], $syllabus_image_path)) {
            $errors[] = "Failed to upload syllabus image.";
            exit();
        }
    }

    if (empty($errors)) {
        // Insert the form data into the `courses` table
        $sql = "INSERT INTO courses (course_title, duration, intake, course_description, course_image, categories, course_objectives, syllabus_image) 
        VALUES ('$course_title', '$course_duration', '$course_intake', '$course_description', '$course_image_name',  '$categories', '$course_objectives',  '$syllabus_image_name')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            $msg = "Course added successfully!";
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=cources&msg=$msg");
            exit();
        } else {
            $msg = "Failed, due to some reason!";
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=cources&err_msg=$msg");
            exit();
        }
    } else {
        foreach ($errors as $error) {
            $msg = $error . "<br>";
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=cources&err_msg=$msg");
            exit();
        }
    }

}
