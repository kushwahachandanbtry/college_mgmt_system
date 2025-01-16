<?php
include dirname(__DIR__, 3) . '/config.php';

// Retrieving attendance data
$query = "SELECT attendance FROM attendance";
$result = mysqli_query($conn, $query);
$atten_data_array = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Decode the JSON data
        $atten_data = json_decode($row['attendance'], true);
        $atten_data_array[] = $atten_data;
    }
} else {
    echo "Error retrieving data: " . mysqli_error($conn);
}

// Initialize filter variables
$studentName = $_POST['student_name'] ?? "";

// Filtered attendance data
$filtered_data = array_filter($atten_data_array, function($data) use ($studentName) {
    return empty($studentName) || strpos(strtolower($data['name']), strtolower($studentName)) !== false;
});

if (isset($_POST['download'])) {
    // Clear any previous output to avoid unwanted data
    ob_clean();

    // Set headers for Excel file download
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=attendance_data.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

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

    // Loop through the filtered attendance data
    foreach ($filtered_data as $data) {
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

    echo '</table>';

    // End script execution to ensure no further content is sent
    exit;
}

?>

<div class="row">
    <div class="col-lg-12">
        <!-- Form Basic -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">View Class Attendance</h6>
            </div>
            <div class="card-body d-flex justify-content-between">
                <form method="post">
                    <div class="form-group row mb-3">
                        <div class="col-xl-12">
                            <label class="form-control-label">Search By Student Name<span class="text-danger ml-2">*</span></label>
                            <input type="text" class="form-control" name="student_name" id="exampleInputFirstName" placeholder="Name">
                        </div>
                    </div>
                    <button type="submit" name="view" class="btn btn-primary">View Attendance</button>
                    <button type="submit" name="download" class="btn btn-success">Download Attendance</button>
                </form>
            </div>
        </div>

        <!-- Input Group -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Class Attendance</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Admission ID</th>
                                    <th>Class</th>
                                    <th>Semester</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <?php 
                            $i = 1;
                            foreach ($filtered_data as $data) { 
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo htmlspecialchars($i++); ?></td>
                                        <td><?php echo htmlspecialchars($data['name']); ?></td>
                                        <td><?php echo htmlspecialchars($data['admission_id']); ?></td>
                                        <td><?php echo htmlspecialchars($data['class']); ?></td>
                                        <td><?php echo htmlspecialchars($data['semester']); ?></td>
                                        <td><?php echo htmlspecialchars($data['date']); ?></td>
                                        <td style="color: #fff; background-color: <?php echo $data['status'] == "1" ? "blue" : "red"; ?>;">
                                            <?php echo $data['status'] == "1" ? "Present" : "Absent"; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page level custom scripts -->
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable(); // ID From dataTable
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
</script>
