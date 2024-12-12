<?php

include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';
// fetch all data from input field and chek valid input or not
if (isset($_POST['save'])) {
    // assign in all variable null data
    $fname = $lname = $gender = $religion = $email = $address = $number = $shortbio = '';


    /**
     * Remove all tags and scripts and return as a string
     *
     * @param [any] $data
     * @return string
     */
    function check_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $fname = check_input($_POST['fname']);

    $lname = check_input($_POST['lname']);

    $gender = check_input($_POST['gender']);

    $religion = check_input($_POST['religions']);

    $email = check_input($_POST['email']);

    $address = check_input($_POST['address']);

    $number = check_input($_POST['Phone']);

    $shortbio = check_input($_POST['shortbio']);

    $errors = array(); // assign all errors in this array
// Check for image upload
    $upload_dir = dirname(__DIR__, 2) . '/assets/images/teachers/';
    $file_name = basename($_FILES['teacher_image']['name']);
    $target_file = $upload_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    $check = getimagesize($_FILES['teacher_image']['tmp_name']);
    if ($check === false) {
        $errors[] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($_FILES['teacher_image']['size'] > 5000000) {
        $errors[] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $errors[] = "Your file was not uploaded.";
    } else {
        // Try to upload file
        if (move_uploaded_file($_FILES['teacher_image']['tmp_name'], $target_file)) {
            // File upload successful, continue to insert student data
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }

    // check error field is empty or have some error
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>"; // Display each error
        }
    }

    // check valid email or not
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please Enter Valid Email.';
    }


    // check error field is empty or have some error
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error;
        }
    }


    // Error field is emtpty the insert valid data
    if (empty($errors)) {

        // print_r( $conn );
        $sql = "INSERT INTO teachers(fname, lname, gender, religions, email, address, phone, shortbio, image )
        VALUES('{$fname}', '{$lname}', '{$gender}', '{$religion}', '{$email}', '{$address}', '{$number}', '{$shortbio}', '{$file_name}' )";



        $result = mysqli_query($conn, $sql);
        if ($result) {
            $msg = "Teacher added successfully!";
            header("Location: ".APP_PATH."admin/dashboard.php?content=item4&msg=" . urlencode($msg));
        } else {
            echo 'Data are not inserted!!!';
        }
    }
}
