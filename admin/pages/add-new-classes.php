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
    <form action="actions/classes.php" method="POST" enctype="multipart/form-data">
        <h5>Add New Classes</h5>
        <div class="d-flex py-3">
            <div class="">
                <lable>Class's Name *</lable>
                <input type="text"  name="classes" aria-label="classes name" class="form-control py-2 px-4" required>
            </div>
            

            <div class="ml-5">
                <lable>Affliated University's Name *</lable>
                <input type="text"  name="university" aria-label="university name" class="form-control py-2 px-4" required>
            </div>
        </div>
        <div>
            <button type="submit" name="save">Save</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</div>
