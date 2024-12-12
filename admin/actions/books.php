
<?php
include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';
// fetch all data from input field and chek valid input or not
if ( isset( $_POST['save'] ) ) {
	// assign in all variable null data
	$bname = $wname = $class = $pubdate = $book_id = $uploade = '';


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

	$bname = check_input( $_POST['bname'] );

	$wname = check_input( $_POST['wname'] );

	$class = check_input( $_POST['class'] );

	$pubdate = check_input( $_POST['pubdate'] );

	$book_id = check_input( $_POST['book-id'] );

	$uploade = check_input( $_POST['uploade'] );

	$errors = array(); // assign all errors in this array

	// check error field is empty or have some error
	if ( ! empty( $errors ) ) {
		foreach ( $errors as $error ) {
			echo $error;
		}
	}


	// Error field is emtpty the insert valid data
	if ( empty( $errors ) ) {
		include_once 'config.php';

		
		$sql = "INSERT INTO books( bname, wname, class, pubdate, book_id, uploade )
                VALUES('{$bname}', '{$wname}', '{$class}', '{$pubdate}', '{$book_id}', '{$uploade}' )";


		$result = mysqli_query( $conn, $sql );
		if ( $result ) {
            $msg = "Book added successfully!";
			header( "Location: ".APP_PATH."admin/dashboard.php?content=item11&msg=" . urlencode($msg) );
		} else {
			echo 'Data are not inserted!!!';
		}
	}
}
