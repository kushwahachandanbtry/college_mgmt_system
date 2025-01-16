<?php

include dirname(__DIR__, 3). '/config.php';
// Get selected class and semester
$selected_class = isset($_POST['class']) ? $_POST['class'] : '';
$selected_semester = isset($_POST['semester']) ? $_POST['semester'] : '';

// Fetch students based on selected class and semester
$students = [];
$sql = "SELECT fname, lname, admissionid, class, semester FROM students WHERE 1";
if ($selected_class) {
    $sql .= " AND class = '$selected_class'";
}
if ($selected_semester) {
    $sql .= " AND semester = '$selected_semester'";
}
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $students[] = $row;
    }
}

// Fetch all classes for the dropdown
$classes = [];
$sql2 = "SELECT DISTINCT classes FROM classes";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $classes[] = $row;
    }
}

//populate subjects 
$subjects = [];
if ($selected_class && $selected_semester) {
    $sql3 = "SELECT DISTINCT s_name FROM subjects WHERE class = '$selected_class' AND semester = '$selected_semester'";
    $result3 = mysqli_query($conn, $sql3);
    if (mysqli_num_rows($result3) > 0) {
        while ($row = mysqli_fetch_assoc($result3)) {
            $subjects[] = $row;
        }
    }
}


if (isset($_POST['save'])) {
    // Sanitize input data
    $name = mysqli_real_escape_string($conn, $_POST['fname']) . " " . mysqli_real_escape_string($conn, $_POST['lname']);
    $admission_id = mysqli_real_escape_string($conn, $_POST['admission_id']);
    $class = mysqli_real_escape_string($conn, $_POST['classes']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $status = mysqli_real_escape_string($conn, isset($_POST['status']) ? "1" : "0");
    $date = date("Y-m-d");
    $taken_by = $_SESSION['name'];

    // Create attendance data array
    $atten_data = array(
        "name" => $name,
        "admission_id" => $admission_id,
        "class" => $class,
        "semester" => $semester,
        "subject" => $subject,
        "status" => $status,
        "date" => $date,
        "taken_by" => $taken_by
    );

    // Convert the array to JSON
    $json_data = json_encode($atten_data);

    // Escape the JSON string for safe use in the SQL query
    $json_data_escaped = mysqli_real_escape_string($conn, $json_data);

    // SQL query to insert the JSON data into the attendance column
    $query = "INSERT INTO attendance (attendance) VALUES ('$json_data_escaped')";

    // Execute the query
    $results = mysqli_query($conn, $query);

    // Check the result and handle response
    if ($results) {
        ?>
        <div class="container text-center mx-auto" style="width: 400px;">
            <div id="alertBox" class="alert alert-success text-center" role="alert">
                <h5 class="fst-italic">Attendance Saved</h5>
            </div>
        </div>

        <script>
        // JavaScript to hide the alert after 3 seconds (3000 milliseconds)
        setTimeout(function () {
            var alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.style.display = 'none'; // Hide the alert box
            }
        }, 2000); // 2000 milliseconds = 2 seconds
        </script>
        <?php
    } else {
        ?>
        <div class="container text-center mx-auto" style="width: 400px;">
            <div id="alertBox" class="alert alert-success text-center" role="alert">
                <h5 class="fst-italic">Failed</h5>
            </div>
        </div>

        <script>
        // JavaScript to hide the alert after 3 seconds (3000 milliseconds)
        setTimeout(function () {
            var alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.style.display = 'none'; // Hide the alert box
            }
        }, 2000); // 2000 milliseconds = 2 seconds
        </script>
        <?php
    }
}



?>

<style>
    form input {
        border: none;
        background: none;
        width: 100%;
    }
    form input[type='checkbox']{
        font-size: 100px;
    }
</style>


<!-- Input Group -->
<form method="post">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">All Student in Class
                        <select name="class" onchange="this.form.submit()">
                            <option value="" disabled>Select Classes</option>
                            <?php 
                            if( !empty( $classes ) && is_array($classes )) {
                                foreach ($classes as $class) {
                                    $is_selected = ($selected_class == strtoupper($class['classes'])) ? 'selected' : '';
                                    echo "<option value='" . strtoupper($class['classes']) . "' $is_selected>" . strtoupper($class['classes']) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </h6>
                    <h6 class="m-0 font-weight-bold text-primary">Select Semester
                        <select name="semester" onchange="this.form.submit()">
                            <option value="" disabled>Select semester</option>
                            <option value="1st" <?php echo ($selected_semester == "1st") ? "selected" : ""; ?>>1st</option>
                            <option value="2nd" <?php echo ($selected_semester == "2nd") ? "selected" : ""; ?>>2nd</option>
                            <option value="3rd" <?php echo ($selected_semester == "3rd") ? "selected" : ""; ?>>3rd</option>
                            <option value="4th" <?php echo ($selected_semester == "4th") ? "selected" : ""; ?>>4th</option>
                            <option value="5th" <?php echo ($selected_semester == "5th") ? "selected" : ""; ?>>5th</option>
                            <option value="6th" <?php echo ($selected_semester == "6th") ? "selected" : ""; ?>>6th</option>
                            <option value="7th" <?php echo ($selected_semester == "7th") ? "selected" : ""; ?>>7th</option>
                            <option value="8th" <?php echo ($selected_semester == "8th") ? "selected" : ""; ?>>8th</option>
                        </select>
                    </h6>


                    <h6 class="m-0 font-weight-bold text-primary">Select Subject
                        <select name="subject">
                            <option value="" disabled <?php echo empty($subjects) ? 'selected' : ''; ?>>Select subject</option>
                            <?php 
                            if (!empty($subjects) && is_array($subjects)) {
                                foreach ($subjects as $subject) {
                                    $is_selected = isset($_POST['subject']) && $_POST['subject'] == $subject['s_name'] ? 'selected' : '';
                                    echo "<option value='" . htmlspecialchars($subject['s_name']) . "' $is_selected>" . htmlspecialchars($subject['s_name']) . "</option>";
                                }
                            } else {
                                echo "<option value='' disabled>No subjects available</option>";
                            }
                            ?>
                        </select>
                    </h6>

                    <h6 class="m-0 font-weight-bold text-danger">Note: <i>Click on the
                            checkboxes besides each student to take attendance!</i></h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>S.N</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Admission ID</th>
                                <th>Class</th>
                                <th>Semester</th>
                                <th>Check</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1; // Counter for row numbering
                            foreach ($students as $row) { // Loop through each record in $students
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><input name="fname" type="text" value="<?php echo htmlspecialchars($row['fname']); ?>" readonly></td>
                                    <td><input name="lname" type="text" value="<?php echo htmlspecialchars($row['lname']); ?>" readonly></td>
                                    <td><input name="admission_id" type="text" value="<?php echo htmlspecialchars($row['admissionid']); ?>" readonly></td>
                                    <td><input name="classes" type="text" value="<?php echo htmlspecialchars($row['class']); ?>" readonly></td>
                                    <td><input name="semester" type="text" value="<?php echo htmlspecialchars($row['semester']); ?>" readonly></td>
                                    <td><input name="status" type="checkbox" name="attendance[<?php echo $i; ?>]"></td>
                                </tr>
                                <?php 
                                $i++; // Increment row counter
                            }
                            ?>
                        </tbody>
                    </table>
                    <br>
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </div>
    </div>
</form>
