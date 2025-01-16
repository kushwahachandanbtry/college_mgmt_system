<?php

include dirname(__DIR__, 3) . '/config.php';

$query = "SELECT attendance FROM attendance";
$result = mysqli_query($conn, $query);
$atten_data_array = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $atten_data = json_decode($row['attendance'], true);
        $atten_data_array[] = $atten_data;
    }
} else {
    echo "Error retrieving data: " . mysqli_error($conn);
}

// Fetch all classes for the dropdown
$classes = [];
$sql2 = "SELECT DISTINCT classes FROM classes";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $classes[] = $row['classes'];
    }
}

// Fetch all subjects for the dropdown
$subjects = [];
$sql3 = "SELECT DISTINCT s_name FROM subjects";
$result3 = mysqli_query($conn, $sql3);
if (mysqli_num_rows($result3) > 0) {
    while ($row = mysqli_fetch_assoc($result3)) {
        $subjects[] = $row['s_name'];
    }
}

if (isset($_POST['download'])) {
    // Clear any previous output to avoid unwanted data
    ob_clean();
    // Set headers for Excel file download
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=attendance_data.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Fetch filter criteria
    $dateTaken = $_POST['dateTaken'] ?? "";
    $classToken = $_POST['classToken'] ?? "";
    $semesterToken = $_POST['semesterToken'] ?? "";
    $subjectsToken = $_POST['subjectsToken'] ?? "";

    // Start generating Excel file content
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>S.N</th>';
    echo '<th>Name</th>';
    echo '<th>Admission ID</th>';
    echo '<th>Class</th>';
    echo '<th>Semester</th>';
    echo '<th>Subject</th>';
    echo '<th>Taken By</th>';
    echo '<th>Date</th>';
    echo '<th>Status</th>';
    echo '</tr>';

    // Initialize row counter
    $i = 1;

    // Loop through attendance data
    foreach ($atten_data_array as $data) {
        // Apply filters based on user input
        if (
            ($dateTaken === "" || $data['date'] === $dateTaken) &&
            ($classToken === "" || $data['class'] === $classToken) &&
            ($semesterToken === "" || $data['semester'] === $semesterToken) &&
            ($subjectsToken === "" || $data['subject'] === $subjectsToken)
        ) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($i++) . '</td>';
            echo '<td>' . htmlspecialchars($data['name']) . '</td>';
            echo '<td>' . htmlspecialchars($data['admission_id']) . '</td>';
            echo '<td>' . htmlspecialchars($data['class']) . '</td>';
            echo '<td>' . htmlspecialchars($data['semester']) . '</td>';
            echo '<td>' . htmlspecialchars($data['subject']) . '</td>';
            echo '<td>' . htmlspecialchars($data['taken_by']) . '</td>';
            echo '<td>' . htmlspecialchars($data['date']) . '</td>';
            echo '<td>' . ($data['status'] == "1" ? "Present" : "Absent") . '</td>';
            echo '</tr>';
        }
    }

    echo '</table>';

    // End script execution to ensure no further content is sent
    exit;
}
?>


<!-- HTML and PHP for displaying and filtering attendance -->
<div class="row">
    <div class="col-lg-12">
        <!-- Form for filtering and downloading attendance -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">View Class Attendance</h6>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row mb-3">
                        <div class="col-3">
                            <label class="form-control-label">Search By Date</label>
                            <input type="date" class="form-control" name="dateTaken">
                        </div>
                        <div class="col-3">
                            <label class="form-control-label">Search By Class</label>
                            <select name="classToken" class="form-control">
                                <option value="" selected>All Classes</option>
                                <?php foreach ($classes as $class) { ?>
                                    <option value="<?php echo htmlspecialchars(strtoupper($class)); ?>">
                                        <?php echo htmlspecialchars(strtoupper($class)); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-3">
                            <label class="form-control-label">Search By Semester</label>
                            <select name="semesterToken" class="form-control">
                                <option value="" selected>All Semesters</option>
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                                <option value="4th">4th</option>
                                <option value="5th">5th</option>
                                <option value="6th">6th</option>
                                <option value="7th">7th</option>
                                <option value="8th">8th</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label class="form-control-label">Search By Subject</label>
                            <select name="subjectsToken" class="form-control">
                                <option value="" selected>All Subjects</option>
                                <?php foreach ($subjects as $subject) { ?>
                                    <option value="<?php echo htmlspecialchars($subject); ?>">
                                        <?php echo htmlspecialchars($subject); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="view" class="btn btn-primary">View Attendance</button>
                    <button type="submit" name="download" class="btn btn-success">Download Attendance</button>
                </form>
            </div>
        </div>

        <!-- Table to display attendance data -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Class Attendance</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Admission ID</th>
                            <th>Class</th>
                            <th>Semester</th>
                            <th>Subject</th>
                            <th>Taken By</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $msg = '';

                        if (isset($_POST['view'])) {
                            $dateTaken = $_POST['dateTaken'] ?? "";
                            $classToken = $_POST['classToken'] ?? "";
                            $semesterToken = $_POST['semesterToken'] ?? "";
                            $subjectsToken = $_POST['subjectsToken'] ?? "";

                            $hasData = false;
                            foreach ($atten_data_array as $data) {
                                if (
                                    ($dateTaken === "" || $data['date'] === $dateTaken) &&
                                    ($classToken === "" || $data['class'] === $classToken) &&
                                    ($semesterToken === "" || $data['semester'] === $semesterToken) &&
                                    ($subjectsToken === "" || $data['subject'] === $subjectsToken)
                                ) {
                                    $hasData = true;
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($i++); ?></td>
                                        <td><?php echo htmlspecialchars($data['name']); ?></td>
                                        <td><?php echo htmlspecialchars($data['admission_id']); ?></td>
                                        <td><?php echo htmlspecialchars($data['class']); ?></td>
                                        <td><?php echo htmlspecialchars($data['semester']); ?></td>
                                        <td><?php echo htmlspecialchars($data['subject']); ?></td>
                                        <td><?php echo htmlspecialchars($data['taken_by']); ?></td>
                                        <td><?php echo htmlspecialchars($data['date']); ?></td>
                                        <td style="color: #fff; background-color: <?php echo $data['status'] == "1" ? "blue" : "red"; ?>;">
                                            <?php echo $data['status'] == "1" ? "Present" : "Absent"; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            if (!$hasData) {
                                $msg = "<tr><td colspan='9' class='text-center text-danger'>No data found!</td></tr>";
                            }
                        } else {
                            foreach ($atten_data_array as $data) {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($i++); ?></td>
                                    <td><?php echo htmlspecialchars($data['name']); ?></td>
                                    <td><?php echo htmlspecialchars($data['admission_id']); ?></td>
                                    <td><?php echo htmlspecialchars($data['class']); ?></td>
                                    <td><?php echo htmlspecialchars($data['semester']); ?></td>
                                    <td><?php echo htmlspecialchars($data['subject']); ?></td>
                                    <td><?php echo htmlspecialchars($data['taken_by']); ?></td>
                                    <td><?php echo htmlspecialchars($data['date']); ?></td>
                                    <td style="color: #fff; background-color: <?php echo $data['status'] == "1" ? "blue" : "red"; ?>;">
                                        <?php echo $data['status'] == "1" ? "Present" : "Absent"; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }

                        echo $msg;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
