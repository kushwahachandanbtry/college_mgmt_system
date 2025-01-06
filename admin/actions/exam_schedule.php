<?php
include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

    $class = mysqli_real_escape_string($conn, trim($_POST['class_name']));
    $yearOrSemester = mysqli_real_escape_string($conn, trim($_POST['year_or_semester']));
    $running_sem_or_year = mysqli_real_escape_string($conn, trim( $_POST['running_sem_or_year']));

    echo $yearOrSemester;

    //validation
    $errors = [];
    if(empty( $class ) ) {
        $errors[] = "Please enter a class.";
    }

    if( empty( $yearOrSemester ) ) {
        $errors[] = "Please choose year or semester.";
    }

    if( empty( $running_sem_or_year ) ) {
        $errors[] = "Please enter the semester or year.";
    }

    // Check for image upload
    $upload_dir = dirname(__DIR__, 2) . '/assets/images/exam_routine/';
    $file_name = basename($_FILES['exam_images']['name']);
    $target_file = $upload_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    $check = getimagesize($_FILES['exam_images']['tmp_name']);
    if ($check === false) {
        $errors[] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 2MB)
    if ($_FILES['exam_images']['size'] > 2000000) {
        $errors[] = "Sorry, your file is too large[accepted: 2MB or Less].";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg'])) {
        $errors[] = "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $errors[] = "Your file was not uploaded.";
    } else {
        // Try to upload file
        if (move_uploaded_file($_FILES['exam_images']['tmp_name'], $target_file)) {
            // File upload successful, continue to insert student data
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }

    if( empty( $errors ) ) {
        $sql = "INSERT INTO exam_routine(class, year_or_semester, running_sem_or_year, images)
                VALUES('{$class}', '{$yearOrSemester}', '{$running_sem_or_year}', '{$file_name}')";
        
        $result = mysqli_query($conn, $sql);
        if( $result ) {
            $msg = "Exam schedule added successfully!";
            header("Location: ".APP_PATH."admin/dashboard.php?content=item18&msg=" . urlencode($msg));
        }
    } else {
        $msg = '';
        foreach( $errors as $error ) {
            $msg .= $error . "</br>";
        }
        header("Location: ".APP_PATH."admin/dashboard.php?content=item18&errors=" . urlencode($msg));
    }

}

?>
