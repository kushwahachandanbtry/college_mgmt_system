<?php
include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

    $class = $_POST['class_name'];
    $exam_time = $_POST['exam-time'];

    //fetch routin subject name

    $array_data = array(
        'date'    => array(
            $_POST['date1'],
            $_POST['date2'],
            $_POST['date3'],
            $_POST['date4'],
            $_POST['date5'],
        ),
        'subject'    => array(
            $_POST['sub1'],
            $_POST['sub2'],
            $_POST['sub3'],
            $_POST['sub4'],
            $_POST['sub5'],
        ),
    );



    //including config file


    $data_json = json_encode( $array_data );

    $sql = "INSERT INTO exam_routine ( class, schedule, time ) VALUES( '{$class }', '$data_json', '{$exam_time}' )";

    $result = mysqli_query( $conn, $sql );

    if( $result ) {
        $msg = "Exam schedule added successfully!";
        header( "Location: ".APP_PATH."admin/dashboard.php?content=item18&msg=" . urlencode($msg) );
    } else {
        echo 'Data was not inserted. Error: ' . mysqli_error($conn); // Display error from database
    }

}

?>
