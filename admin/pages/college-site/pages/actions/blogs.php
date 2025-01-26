<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';
    session_start();
    $heading = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']); // Contains the HTML content
    $image = $_FILES['image'];
    $publisher = $_SESSION['email'];
    $publish_date = date("Y-M-d");

    $errors = [];

    // Validate Heading
    if (empty($heading)) {
        $errors[] = 'Please enter a heading.';
    }

    // Validate Description
    if (empty($description)) {
        $errors[] = 'Please enter a description.';
    }

    // Validate Image
    if (empty($image['name'])) {
        $errors[] = 'Please insert an image.';
    } else {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $fileSize = $image['size'];

        // Check file extension
        if (!in_array($fileExtension, $allowedExtensions)) {
            $errors[] = 'Invalid image format. Only JPG, JPEG, and PNG are allowed.';
        }

        // Check file size (max 2MB)
        if ($fileSize > 2 * 1024 * 1024) {
            $errors[] = 'Image size must be less than 2MB.';
        }
    }

    // Check if there are any errors
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            $msg = $error . "<br>";
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=blogs&err_msg=$msg");
            exit();
        }
    } else {
        // Save the image
        $targetDir = dirname(__DIR__, 5) . '/assets/images/blogs/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Store only the image name
        $imageName = basename($image["name"]);
        $targetFile = $targetDir . $imageName;

        if (move_uploaded_file($image["tmp_name"], $targetFile)) {
            // Insert data
            $stmt = $conn->prepare("INSERT INTO blogs (heading, overview, image, publisher, publish_date) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $heading, $description, $imageName, $publisher, $publish_date);
            if ($stmt->execute()) {
                $msg = "Blog added successfully!";
                $msg = urlencode($msg);
                header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=blogs&msg=$msg");
                exit();
            } else {
                $msg = "Failed, due to some reason!";
                $msg = urlencode($msg);
                header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=blogs&err_msg=$msg");
                exit();
            }
        } else {
            $msg = "Failed to upload the image.";
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=blogs&err_msg=$msg");
            exit();
        }
    }
}
