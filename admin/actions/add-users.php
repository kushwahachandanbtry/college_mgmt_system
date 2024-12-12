<?php
include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';
// fetch all data from input field and chek valid input or not
if ( isset( $_POST['save'] ) ) {
	// assign in all variable null data
	$name = $email = $password = $role = '';


	/**
	 * Remove all tags and scripts and return as a string
	 *
	 * @param [any] $data
	 * @return string
	 */
	function check_input( $data ) {
		$data = trim( $data );
		$data  = stripslashes( $data );
		$data  = htmlspecialchars( $data );
		return $data;
	}
//generate random id
    function generate_id( $max ) {
        $rand = '';
        $rand_count = rand(0, $max);
        for( $i = 0; $i < $rand_count; $i++ ) {
            $r = rand(0,9);
            $rand .= $r;
        }
        return $rand;
    }

    $userid = generate_id(20);
	$name = check_input( $_POST['name'] );

	$email = check_input( $_POST['email'] );

	$password = check_input( $_POST['password'] );
	$role = check_input( $_POST['role'] );

	$errors = array(); // assign all errors in this array

	// check valid email or not
	if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
		$errors[] = 'Please Enter Valid Email.';
	}

    if( strlen( $password ) < 8 ) {
        $errors[] = 'Please password must be more than 8 characters';
    }
	
    // Check for image upload
    $upload_dir = dirname(__DIR__, 2) . '/admin/pages/message_app/uploads/';
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

    // Check file extension
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        $errors[] = "Invalid file type. Only JPG, JPEG, PNG, & GIF are allowed.";
        $uploadOk = 0;
    }

    // Optionally validate MIME type
    $fileMimeType = mime_content_type($_FILES['student_image']['tmp_name']);
    if (!in_array($fileMimeType, ['image/jpeg', 'image/png', 'image/gif'])) {
        $errors[] = "Invalid file type based on MIME type.";
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
	if ( ! empty( $errors ) ) {
		foreach ( $errors as $error ) {
			echo $error;
		}
	}

    $file = 'uploads/'.$file_name;

	// Error field is emtpty the insert valid data
	if ( empty( $errors ) ) {
		include_once 'config.php';
		$sql = "INSERT INTO users(userid, username, email, password, role, image )
            VALUES('{$userid}', '{$name}', '{$email}', '{$password}', '{$role}', '{$file}' )";


		$result = mysqli_query( $conn, $sql );
		if ( $result ) {
            $msg = "User added successfully!";
            header( "Location: ".APP_PATH."admin/dashboard.php?content=item0&msg=" . urlencode($msg));
		} else {
			echo 'Data are not inserted.';
		}
	}
}
