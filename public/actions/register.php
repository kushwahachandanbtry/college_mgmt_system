<?php
if (isset($_POST['submit'])) {
    include dirname(__DIR__, 2) . '/constant.php';
    include dirname(__DIR__, 2) . '/config.php';
    // Initialize error array
    $errors = [];

    // Trim and sanitize inputs
    $fname = trim($_POST['fname']);
    $mname = trim($_POST['mname']);
    $lname = trim($_POST['lname']);
    $phnumber = trim($_POST['pnumber']);
    $fathername = trim($_POST['fathername']);
    $email = trim($_POST['email']);
    $pass = md5($_POST['pass']);
    $cources = trim($_POST['cource']);
    $gender = trim($_POST['gender']);
    $paddress = trim($_POST['paddress']);

    // Validate first name
    if (empty($fname)) {
        $errors['fname'] = "First name is required.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
        $errors['fname'] = "First name should only contain letters and spaces.";
    }

    // Validate last name
    if (empty($lname)) {
        $errors[] = "Last name is required.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lname)) {
        $errors['lname'] = "Last name should only contain letters and spaces.";
    }

    // Validate phone number
    if (empty($phnumber)) {
        $errors['phnumber'] = "Phone number is required.";
    } elseif (!preg_match("/^[0-9]{10}$/", $phnumber)) {
        $errors['phnumber'] = "Phone number must be a 10-digit number.";
    }


    // Validate email
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate password
    if (empty($pass)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($pass) < 8) {
        $errors['password'] = "Password must be at least 8 characters long.";
    } else {
        // Hash the password
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
    }

    // Validate courses
    if (empty($cources)) {
        $errors['course'] = "Course is required.";
    }

    // Validate gender
    if (empty($gender)) {
        $errors['gender'] = "Gender is required.";
    }

    // Validate address
    if (empty($paddress)) {
        $errors['address'] = "Permanent address is required.";
    }

    if (!empty($errors)) {
        // Encode errors as JSON and pass via URL
        $error_query = http_build_query(['errors' => json_encode($errors)]);
        header("Location: " . APP_PATH . "public/pages/register.php?" . $error_query);
        exit;
    }

    // Escape strings for SQL
    $fname = mysqli_real_escape_string($conn, $fname);
    $mname = mysqli_real_escape_string($conn, $mname);
    $lname = mysqli_real_escape_string($conn, $lname);
    $phnumber = mysqli_real_escape_string($conn, $phnumber);
    $fathername = mysqli_real_escape_string($conn, $fathername);
    $email = mysqli_real_escape_string($conn, $email);
    $cources = mysqli_real_escape_string($conn, $cources);
    $gender = mysqli_real_escape_string($conn, $gender);
    $paddress = mysqli_real_escape_string($conn, $paddress);

    // Insert into database
    $sql = "INSERT INTO registered_users (fname, mname, lname, phone, fathername, email, password, course, gender, address)
        VALUES ('$fname', '$mname', '$lname', '$phnumber', '$fathername', '$email', '$hashed_password', '$cources', '$gender', '$paddress')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location:" . APP_PATH . "public/pages/thankyou.php");
    } else {
        echo "<div class='alert alert-danger'>Your data is not Submitted due to some error!!!</div>";
    }

}

?>

