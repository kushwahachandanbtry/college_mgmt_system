<?php
include "../helpers.php";
if (isset($_GET['msg'])) {
    add_success_message($_GET['msg']);
}
if (isset($_GET['errors'])) {
    add_failled_message($_GET['errors']);
}
?>

<div class="adminssion-form py-5 px-5" style="background:#FFFFFF;">
    <form action="actions/subjects.php" method="POST" enctype="multipart/form-data">
        <h5>Add New Subject</h5>
        <div class="d-flex py-3">
            <div class="">
                <lable>Subject Name *</lable>
                <input type="text" name="s_name" aria-label="First name" class="form-control py-2 px-4" required>
            </div>

            <div class="col-3">
                <label class="form-control-label">Select Class<span class="text-danger ml-2">*</span></label>
                <select name="class" class="border border-light rounded  px-3"
                    aria-label="Default select example" required>
                    <option class="text-light">Select Your semester*</option>
                    <?php
                    if (!empty($classes) && is_array($classes)) {
                        foreach ($classes as $class) {
                            ?>
                            <option value="<?php echo htmlspecialchars($class['classes']); ?>">
                                <?php echo htmlspecialchars(strtoupper($class['classes'])); ?></option>
                        <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-3">
                <label class="form-control-label">Select Semester<span class="text-danger ml-2">*</span></label>
                <select name="semester" class="border border-light rounded  px-3"
                    aria-label="Default select example" required>
                    <option class="text-light">Select Your semester*</option>
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
                <label class="form-control-label">Select Teachers<span class="text-danger ml-2">*</span></label>
                <select name="teacher" class="border border-light rounded  px-3"
                    aria-label="Default select example" required>
                    <option class="text-light">Select Your semester*</option>
                    <?php
                    if (!empty($teachers) && is_array($teachers)) {
                        foreach ($teachers as $teacher) {
                            ?>
                            <option value="<?php echo htmlspecialchars($teacher['fname'] . " " . $teacher['lname']); ?>">
                                <?php echo htmlspecialchars($teacher['fname'] . " " . $teacher['lname']); ?></option>
                        <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div>
            <button type="submit" name="save">Save</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</div>
