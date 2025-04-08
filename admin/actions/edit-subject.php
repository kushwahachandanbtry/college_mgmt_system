<?php
if (isset($_GET['id'])) {
    include dirname(__DIR__, 2) . '/config.php';
    include "../helpers.php";

    $id = $_GET['id'];

    // Fetch classes
    $class_query = mysqli_query($conn, "SELECT * FROM classes");
    $classes = mysqli_fetch_all($class_query, MYSQLI_ASSOC);

    // Fetch teachers
    $teacher_query = mysqli_query($conn, "SELECT * FROM teachers");
    $teachers = mysqli_fetch_all($teacher_query, MYSQLI_ASSOC);

    // Handle update
    if (isset($_POST['save'])) {
        function check_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        $s_name = check_input($_POST['s_name']);
        $class = check_input($_POST['class']);
        $semester = check_input($_POST['semester']);
        $teacher = check_input($_POST['teacher']);

        $sql = "UPDATE subjects SET s_name='$s_name', class='$class', semester='$semester', teacher='$teacher' WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            edit_success_message(); // custom success message
        } else {
            edit_failed_message(); // custom fail message
        }
    }
    go_back('all_subject');
    // Fetch subject to edit
    $sql = "SELECT * FROM subjects WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="adminssion-form py-5 px-5" style="background:#FFFFFF;">
            <form method="POST">
                <h5>Edit Subject <button onclick="goBack();" class="btn btn-info ml-5">Go Back</button></h5>
                <div class="d-flex py-3">
                    <div class="">
                        <label>Subject Name *</label>
                        <input type="text" name="s_name" value="<?php echo $row['s_name']; ?>" class="form-control py-2 px-4" required>
                    </div>

                    <div class="col-3">
                        <label>Select Class<span class="text-danger ml-2">*</span></label>
                        <select name="class" class="form-control" required>
                            <?php foreach ($classes as $classItem): ?>
                                <option value="<?= $classItem['classes']; ?>" <?= $row['class'] == $classItem['classes'] ? 'selected' : ''; ?>>
                                    <?= strtoupper(htmlspecialchars($classItem['classes'])); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-3">
                        <label>Select Semester<span class="text-danger ml-2">*</span></label>
                        <select name="semester" class="form-control" required>
                            <?php
                            $semesters = ['1st','2nd','3rd','4th','5th','6th','7th','8th'];
                            foreach ($semesters as $sem): ?>
                                <option value="<?= $sem; ?>" <?= $row['semester'] == $sem ? 'selected' : ''; ?>><?= $sem; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-3">
                        <label>Select Teacher<span class="text-danger ml-2">*</span></label>
                        <select name="teacher" class="form-control" required>
                            <?php foreach ($teachers as $teacher): 
                                $full_name = $teacher['fname'] . " " . $teacher['lname']; ?>
                                <option value="<?= $full_name; ?>" <?= $row['teacher'] == $full_name ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($full_name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div>
                    <button type="submit" name="save" class="btn btn-success">Save</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
<?php
    }
}
?>
