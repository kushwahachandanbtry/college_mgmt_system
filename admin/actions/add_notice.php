<?php
include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';
if (isset($_POST['post'])) {
    $title = mysqli_real_escape_string($conn, trim($_POST['title']));
    $details = mysqli_real_escape_string($conn, trim($_POST['details']));
    $posted_by = mysqli_real_escape_string($conn, trim($_POST['posted_by']));
    $date = mysqli_real_escape_string($conn, trim($_POST['date']));

    //validation
    $errors = [];
    if( empty( $title ) ) {
        $errors[] = "Please enter a title.";
    }

    if( empty( $details )){
        $errors[] = "Please enter details.";
    }

    if( empty( $posted_by )){
        $errors[] = "Please enter your name.";
    }

    if( empty( $date )){
        $errors[] = "Please enter date.";
    }

    if( empty( $errors )) {
        $sql = "INSERT INTO notice (title, details, posted_by, date ) VALUES ('{$title}', '{$details}', '{$posted_by}', '{$date}')";

        $result = mysqli_query( $conn, $sql );
        if ($result) {
            $msg = "Notice added successfully!";
            header("Location: ".APP_PATH."admin/dashboard.php?content=item14&msg=" . urlencode($msg));
            exit(); // Use exit to prevent further code execution
        } 
    } else {
        $msg = '';
        foreach( $errors as $error ) {
            $msg .= $error . "</br>";
        }
        header("Location: ".APP_PATH."admin/dashboard.php?content=item14&errors=" . urlencode($msg));
    }
    
    
}
?>

