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
    <form action="actions/teachers.php" method="POST" enctype="multipart/form-data">
        <h5>Add New Teachers</h5>
        <div class="d-flex py-3">
            <div class="">
                <lable>First Name *</lable>
                <input type="text"  name="fname" aria-label="First name" class="form-control py-2 px-4" required>
            </div>
            <div class="mx-5">
                <lable>Last Name *</lable>
                <input type="text"  name="lname" aria-label="Last name" required class="form-control  py-2 px-4">
            </div>
            <div class="">
                <lable>Gender *</lable><br>
                <input value="male" type="radio" name="gender" id="">Male
                <input value="female" type="radio" name="gender" id="">Female
                <input value="others" type="radio" name="gender" id="">Others
            </div>
        </div>
        <div class="d-flex py-3">
            <div class="">
                <lable>Religions *</lable><br>
                <select name="religions"  class="border border-light rounded py-2 px-3" aria-label="Default select example" required>
                    <option class="text-light">Select Your Religion*</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Islam">Islam</option>
                    <option value="Cristian">Cristian</option>
                    <option value="Buddhist">Buddhist</option>
                    <option value="Ohters">Others</option>
                </select>
            </div>
            <div class="mx-5">
                <lable>Email *</lable>
                <input type="email"  name="email" aria-label="email" class="form-control py-2 px-1" required>
            </div>
            <div class="">
                <lable>Address *</lable>
                <input type="text"  name="address" aria-label="admission id" class="form-control py-2 px-4" required>
            </div>
        </div>
        <div class="d-flex py-3">
            <div class="">
                <lable>Phone *</lable>
                <input type="number"  name="Phone" aria-label="phone" class="form-control py-2 px-1" required>
            </div>
            <div class="mx-5">
                <label>Short BIO</label><br>
                <textarea name="shortbio" cols="50" rows="10"></textarea>
            </div>
            <div class="">
                <label for="image">Insert Image *</label><br>
                <input type="file" name="teacher_image" accept="image/*" required>
            </div>
        </div>
        
        <div>
            <button type="submit" name="save">Save</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</div>
