<?php
if (!isset($_SESSION['admin'])) {
    exit();
}
include "../helpers.php";
if (isset($_GET['msg'])) {
    add_success_message($_GET['msg']);
}
if (isset($_GET['errors'])) {
    add_failled_message($_GET['errors']);
}
?>





<div class="adminssion-form py-5 px-5" style="background:#FFFFFF;">
    <form action="actions/add-users.php" method="POST" enctype="multipart/form-data">
        <h5>Add Users</h5>
        <div class="d-flex py-3">
            <div class="">
                <label>Name *</label>
                <input type="text"  name="name" aria-label="First name" class="form-control py-2 px-4" required>
            </div>

            <div class="mx-5">
                <label>Email * <span class="text-warning">(Email must be unique)</span></label>
                <input type="text"  name="email" aria-label="First name" class="form-control py-2 px-4" required>
            </div>
            <div class="">
                <label>Password *</label>
                <input type="password"  name="password" aria-label="First name" class="form-control py-2 px-4" required>
            </div>
            
        </div>
        <div class="d-flex py-3">
        <div class="mr-5">
            <label class="">Select Role *</label><br>
                <select name="role" class="border border-light rounded py-2 px-3 mx-1" aria-label="Default select example" required>
                    <option class="text-light">Select Role</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teachers</option>
                    <option value="parent">Parents</option>
                </select>
            </div>
            <div>
                <label for="image">Insert Image *</label><br>
                <input type="file" name="student_image" accept="image/*" required>
            </div>
        </div>
        
        <div>
            <button type="submit" name="save">Save</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</div>
