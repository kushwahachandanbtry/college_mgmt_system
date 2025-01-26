<?php
include dirname(__DIR__,2) . '/config.php';

$query = "SELECT course_title FROM courses";
$result = $conn->query($query);

$courses = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row['course_title'];
    }
}

// Return JSON response
echo json_encode($courses);

