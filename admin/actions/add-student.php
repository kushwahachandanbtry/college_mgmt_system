<?php
include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';
// fetch all data from input field and check valid input or not
if (isset($_POST['save'])) {
    // assign all variable null data
    $fname = $lname = $gender = $dob = $blood = $religion = $email = $admissionid = $section = $number = $shortbio = $class = '';
    
    /**
     * Remove all tags and scripts and return as a string
     *
     * @param [any] $data
     * @return string
     */
    function check_input($data) {
        $data = trim($data);
        $data  = stripslashes($data);
        $data  = htmlspecialchars($data);
        return $data;
    }

    $fname = check_input($_POST['fname']);
    $lname = check_input($_POST['lname']);
    $gender = check_input($_POST['gender']);
    $dob = check_input($_POST['dob']);
    $blood = check_input($_POST['blood']);
    $religion = check_input($_POST['religion']);
    $email = check_input($_POST['email']);
    $admissionid = check_input($_POST['admissionid']);
    $section = check_input($_POST['section']);
    $number = check_input($_POST['phone']);
    $shortbio = check_input($_POST['shortbio']);
    $class = check_input($_POST['class']);
    $semester = check_input($_POST['semester']);

    $errors = []; // assign all errors in this array

    // check valid email or not
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please Enter Valid Email.';
    }

    // check valid date or not
    if (strtotime($dob) === false) {
        $errors[] = 'Your date is not Valid.';
    }

    // for valid year
    $dateparts = explode('-', $dob);
    $year      = $dateparts[0];
    if (strlen($year) !== 4) {
        $errors[] = 'Invalid Your Year Format';
    }

    // for valid month
    $month = $dateparts[1];
    if ($month < 1 || $month > 12) {
        $errors[] = 'Invalid Your Month format';
    }

    // for valid day
    $day = $dateparts[2];
    if ($day < 1 || $day > 31) {
        $errors[] = 'Invalid day';
    }

    // Check for image upload
    $upload_dir = dirname(__DIR__, 2) . '/assets/images/students/';
    $file_name = basename($_FILES['student_image']['name']);
    $target_file = $upload_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    $check = getimagesize($_FILES['student_image']['tmp_name']);
    if ($check === false) {
        $errors[] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($_FILES['student_image']['size'] > 5000000) {
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
        if (move_uploaded_file($_FILES['student_image']['tmp_name'], $target_file)) {
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

    // Error field is empty, then insert valid data
    if (empty($errors)) {
        include_once 'config.php';
        $sql = "INSERT INTO students(fname, lname, gender, dob, blood, religion, email, admissionid, section, shortbio, Phone, class, semester, image )
                VALUES('{$fname}', '{$lname}', '{$gender}', '{$dob}', '{$blood}', '{$religion}', '{$email}', '{$admissionid}', '{$section}', '{$shortbio}', '{$number}', '{$class}', '{$semester}', '{$file_name}')";
        
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $msg = "Student added successfully!";
            header("Location: ".APP_PATH."admin/dashboard.php?content=item2&msg=" . urlencode($msg));
            exit(); // Use exit to prevent further code execution
        } else {
            echo 'Data was not inserted. Error: ' . mysqli_error($conn); // Display error from database
        }
    }
}
?>
