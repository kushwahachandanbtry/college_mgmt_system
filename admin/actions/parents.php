<?php
include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';
// fetch all data from input field and chek valid input or not
if ( isset( $_POST['save'] ) ) {
	// assign in all variable null data
	$name = $gender = $occupation = $email = $address = $number = $childerns_name = '';


	/**
	 * Remove all tags and scripts and return as a string
	 *
	 * @param [any] $data
	 * @return string
	 */
	function check_input( $data ) {
		$data = trim( $data );
		$data = stripslashes( $data );
		$data = htmlspecialchars( $data );
		return $data;
	}

	$name = check_input( $_POST['name'] );

	$gender = check_input( $_POST['gender'] );

	$occupation = check_input( $_POST['occupation'] );

	$email = check_input( $_POST['email'] );

	$address = check_input( $_POST['address'] );

	$number = check_input( $_POST['Phone'] );

    $childerns_name = check_input( $_POST['chName'] );

	$errors = [];

    //validation
    if( empty( $name )){
        $errors[] = "Please enter name.";
    }

    if( empty( $gender )) {
        $errors[] = "Please choose a gender.";
    }

    if( empty( $occupation )) {
        $errors[] = "Please enter occupation.";
    }

    if( empty( $email )){
        $errors[] = "Please enter email.";
    }

    if( empty( $address )) {
        $errors[] = "Please enter address.";
    }

    if( empty( $number )) {
        $errors[] = "Please enter phone number.";
    }

    if( empty( $childerns_name )) {
        $errors[] = "Please write children's name.";
    }

    

	// check valid email or not
	if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
		$errors[] = 'Please Enter Valid Email.';
	}



	// Error field is emtpty the insert valid data
	if ( empty( $errors ) ) {

		
		$sql = "INSERT INTO parents(name, gender, occupation, email, address, phone, childrens_name )
                VALUES('{$name}', '{$gender}', '{$occupation}', '{$email}', '{$address}', '{$number}', '{$childerns_name}' )";


		$result = mysqli_query( $conn, $sql );
		if ( $result ) {
            $msg = "Parent added successfully!";
			header( "Location: ".APP_PATH."admin/dashboard.php?content=item8&msg=" . urlencode($msg) );
		}
	} else {
        $msg = '';
        foreach( $errors as $error ) {
            $msg .= $error . "</br>";
        }
        header( "Location: ".APP_PATH."admin/dashboard.php?content=item8&errors=" . urlencode($msg) );
    }
}
