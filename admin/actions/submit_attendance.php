<?php
include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';
$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)) {
    foreach ($data as $record) {
        $name = mysqli_real_escape_string($conn, $record['name']);
        $class = mysqli_real_escape_string($conn, $record['class']);
        $semester = mysqli_real_escape_string($conn, $record['semester']);
        $month = mysqli_real_escape_string($conn, $record['month']);
        $year = mysqli_real_escape_string($conn, $record['year']);
        $status = mysqli_real_escape_string($conn, $record['status']);  // JSON-encoded marked days

        $sql = "INSERT INTO attendance (student_name, class, semester, month, year, status)
                VALUES ('$name', '$class', '$semester', '$month', '$year', '$status')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            $msg = "Attendance added successfully!";
            header("Location: ".APP_PATH."admin/dashboard.php?content=item9&msg=" . urlencode($msg));
            exit(); // Use exit to prevent further code execution
        } else {
            echo 'Data was not inserted. Error: ' . mysqli_error($conn); // Display error from database
        }
    }
}
?>
