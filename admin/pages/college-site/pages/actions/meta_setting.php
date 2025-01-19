<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5) . '/constant.php';
    include dirname(__DIR__, 5) . '/config.php';

    // Collect and sanitize form data
    $pages = mysqli_real_escape_string($conn, $_POST['pages']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $canonical_tag = mysqli_real_escape_string($conn, $_POST['canonical_tag']);

    $og_title = mysqli_real_escape_string($conn, $_POST['og_title']);
    $og_description = mysqli_real_escape_string($conn, $_POST['og_description']);
    $og_url = mysqli_real_escape_string($conn, $_POST['og_url']);

    //validate
    $errors = [];
    if (empty($pages)) {
        $errors[] = 'Please select a page.';
    }

    if (empty($meta_title)) {
        $errors[] = 'Please enter meta title.';
    }

    if (empty($meta_description)) {
        $errors[] = 'Please enter meta description.';
    }

    if (empty($meta_keywords)) {
        $errors[] = 'Please enter meta keywords.';
    }

    if (empty($canonical_tag)) {
        $errors[] = 'Please enter canonical tag.';
    }

    if (empty($og_title)) {
        $errors[] = 'Please enter OG title.';
    }

    if (empty($og_description)) {
        $errors[] = 'Please enter OG description.';
    }

    if (empty($og_url)) {
        $errors[] = 'Please enter OG URL.';
    }

    if (!isset($_FILES['og_image'])) {
        $errors[] = 'Please insert an OG image.';
    }

    if (empty($errors)) {
        if (isset($_FILES['og_image']) && $_FILES['og_image']['error'] == 0) {
            // Define the upload directory
            $upload_dir = dirname(__DIR__, 5) . '/assets/images/Og_images/';
            $file_name = basename($_FILES['og_image']['name']);
            $file_path = $upload_dir . $file_name;

            // Check if the directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Create directory if not exists
            }

            // Move uploaded file to the destination folder
            if (move_uploaded_file($_FILES['og_image']['tmp_name'], $file_path)) {
                // File successfully uploaded, now insert into the database
                $image_path_db = $file_name; // relative path for storing in DB

                // Insert the service data into the services table
                $sql = "INSERT INTO meta_setting (pages, meta_title, meta_description, meta_keywords, canonical_tag, og_title, og_description, og_url, og_image) 
                        VALUES ('$pages', '$meta_title', '$meta_description', '$meta_keywords', '$canonical_tag', '$og_title', '$og_description', '$og_url', '$image_path_db')";

                // Execute the query
                if (mysqli_query($conn, $sql)) {
                    $msg = "Meta setting added added successfully!";
                    $msg = urlencode($msg);
                    header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=cources&msg=$msg");
                    exit();
                } else {
                    $msg = "Failed, due to some reason!";
                    $msg = urlencode($msg);
                    header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=cources&err_msg=$msg");
                    exit();
                }
            }
        }
    } else {
        foreach ($errors as $error) {
            $msg = $error;
            $msg = urlencode($msg);
            header("Location: " . APP_PATH . "admin/dashboard.php?content=college-website&&page=cources&err_msg=$msg");
            exit();
        }
    }

}
