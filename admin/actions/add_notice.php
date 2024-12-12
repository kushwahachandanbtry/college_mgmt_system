<?php
include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';
if (isset($_POST['post'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $posted_by = mysqli_real_escape_string($conn, $_POST['posted_by']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    
    $sql = "INSERT INTO notice (title, details, posted_by, date ) VALUES ('{$title}', '{$details}', '{$posted_by}', '{$date}')";

    $result = mysqli_query( $conn, $sql );
    if ($result) {
        $msg = "Notice added successfully!";
        header("Location: ".APP_PATH."admin/dashboard.php?content=item14&msg=" . urlencode($msg));
        exit(); // Use exit to prevent further code execution
    } else {
        echo 'Data was not inserted. Error: ' . mysqli_error($conn); // Display error from database
    }
}
?>

