
<?php
include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';
// fetch all data from input field and chek valid input or not
if ( isset( $_POST['save'] ) ) {
	// assign in all variable null data
	$classes = $university = '';


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


	$classes = check_input( $_POST['classes'] );
	$university = check_input( $_POST['university'] );

	$errors = []; // assign all errors in this array

    if( empty( $classes ) ) {
        $errors[] = "Please write a proper class name.";
    }

    if( empty( $university ) ) {
        $errors[] = "Please write a universisty name.";
    }
	

	// Error field is emtpty the insert valid data
	if ( empty( $errors ) ) {

		// print_r( $conn );
		$sql = "INSERT INTO classes(classes, university) VALUES('{$classes}', '{$university}')";
		$result = mysqli_query( $conn, $sql );
		if ( $result ) {    
            $msg = "Classes added successfully!";
			header( "Location: ".APP_PATH."admin/dashboard.php?content=item16&msg=" . urlencode($msg) );
		} 
	} else {
        $msg = '';
        foreach( $errors as $error ) {
            $msg .= $error . "</br>";
        }
        header( "Location: ".APP_PATH."admin/dashboard.php?content=item16&errors=" . urlencode($msg) );
    }
}
