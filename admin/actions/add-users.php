<?php
include dirname(__DIR__, 2) . '/constant.php';
include dirname(__DIR__, 2) . '/config.php';
// fetch all data from input field and check valid input or not
if (isset($_POST['save'])) {
    $name = $email = $password = $role = '';
    $errors = [];

    // Helper function to sanitize input
    function check_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Generate a random ID
    function generate_id($max)
    {
        $rand = '';
        $rand_count = rand(0, $max);
        for ($i = 0; $i < $rand_count; $i++) {
            $r = rand(0, 9);
            $rand .= $r;
        }
        return $rand;
    }

    $userid = generate_id(20);
    $name = check_input($_POST['name'] ?? '');
    $email = check_input($_POST['email'] ?? '');
    $password = check_input($_POST['password'] ?? '');
    $role = check_input($_POST['role'] ?? '');

    // Validate fields
    if (empty($name)) {
        $errors[] = "Please enter your name.";
    }
    if (empty($email)) {
        $errors[] = "Please enter an email.";
    }
    if (empty($password)) {
        $errors[] = "Please enter a password.";
    }
    if (empty($role)) {
        $errors[] = "Please select a role.";
    }

    // Validate email
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email.';
    }

    // Validate password length
    if (!empty($password) && strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters.';
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $errors[] = "The email address is already registered.";
    }
    $stmt->close();

    // Validate file upload
    if (empty($_FILES['student_image']['name'])) {
        $errors[] = "Please select an image.";
    } else {
        $upload_dir = dirname(__DIR__, 2) . '/assets/images/users/';
        $file_name = basename($_FILES['student_image']['name']);
        $target_file = $upload_dir . uniqid() . "_" . $file_name; // Generate a unique file name
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $tmp_name = $_FILES['student_image']['tmp_name'];

        // Check if the file is an image
        if (getimagesize($tmp_name) === false) {
            $errors[] = "File is not a valid image.";
            $uploadOk = 0;
        }

        // Check file size (limit 5MB)
        if ($_FILES['student_image']['size'] > 5000000) {
            $errors[] = "File size exceeds 5MB.";
            $uploadOk = 0;
        }

        // Check file extension
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $errors[] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        // Upload file if no errors
        if ($uploadOk && !move_uploaded_file($tmp_name, $target_file)) {
            $errors[] = "Failed to upload the image.";
        }
    }

    $file = basename($target_file);

    // If no errors, insert data into the database
    if (empty($errors)) {
        // Hash the password securely before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO users (userid, username, email, password, role, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $userid, $name, $email, $hashed_password, $role, $file);

        if ($stmt->execute()) {
            $msg = "User added successfully!";
            header("Location: " . APP_PATH . "admin/dashboard.php?content=item0&msg=" . urlencode($msg));
            exit();
        } else {
            $errors[] = "Failed to add user to the database.";
        }
    }

    // If errors exist, redirect with error messages
    if (!empty($errors)) {
        $msg = implode('</br>', $errors);
        header("Location: " . APP_PATH . "admin/dashboard.php?content=item0&errors=" . urlencode($msg));
        exit();
    }
}
