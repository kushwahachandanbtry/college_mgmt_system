<?php
include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';
// fetch all data from input field and chek valid input or not
if ( isset( $_POST['save'] ) ) {
	// assign in all variable null data
	$s_name = $class = $semester = $teacher = '';


	/**
	 * Remove all tags and scripts and return as a string
	 *
	 * @param [any] $data
	 * @return string
	 */
	
	$s_name =  mysqli_real_escape_string($conn, $_POST['s_name']) ;

	$class = mysqli_real_escape_string($conn, $_POST['class']) ;

	$semester = mysqli_real_escape_string($conn, $_POST['semester']) ;

	$teacher = mysqli_real_escape_string($conn, $_POST['teacher']) ;

	$errors = [];

    //validation
    if( empty( $s_name )){
        $errors[] = "Please enter name.";
    }

    if( empty( $class )) {
        $errors[] = "Please select realted class.";
    }

    if( empty( $semester )) {
        $errors[] = "Please select realted semester.";
    }

    if( empty( $teacher )){
        $errors[] = "Please select realted teacher.";
    }


	// Error field is emtpty the insert valid data
	if ( empty( $errors ) ) {

		
		$sql = "INSERT INTO subjects(s_name, class, semester, teacher )
                            VALUES('{$s_name}', '{$class}', '{$semester}', '{$teacher}')";

		$result = mysqli_query( $conn, $sql );
		if ( $result ) {
            $msg = "Subjects added successfully!";
			header( "Location: ".APP_PATH."admin/dashboard.php?content=add_subject&msg=" . urlencode($msg) );
		}
	} else {
        $msg = '';
        foreach( $errors as $error ) {
            $msg .= $error . "</br>";
        }
        header( "Location: ".APP_PATH."admin/dashboard.php?content=add_subject&errors=" . urlencode($msg) );
    }
}
