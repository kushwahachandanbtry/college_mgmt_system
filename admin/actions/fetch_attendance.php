<?php
include dirname(__DIR__, 2). '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class = $_POST['class'];
    $semester = $_POST['semester'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    $attendanceData = [];

    // Fetch attendance data from the database for the selected parameters
    $sql = "SELECT student_name, day, status FROM attendance 
            WHERE class = ? AND semester = ? AND month = ? AND year = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $class, $semester, $month, $year);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $studentName = $row['student_name'];
        $day = $row['day'];
        $status = $row['status'];

        // Organize data by student name, with day and status as key-value pairs
        if (!isset($attendanceData[$studentName])) {
            $attendanceData[$studentName] = [];
        }
        $attendanceData[$studentName][$day] = $status;
    }

    $stmt->close();
    $conn->close();

    // Send attendance data as JSON
    echo json_encode($attendanceData);
}
?>
