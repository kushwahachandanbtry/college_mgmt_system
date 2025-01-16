<?php
if (!$_SESSION['role'] == 'admin') {
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
    <form action="actions/parents.php" method="POST" enctype="multipart/form-data">
        <h5>Add Parents</h5>
        <div class="d-flex py-3">
            <div class="">
                <lable>Name *</lable>
                <input type="text"  name="name" aria-label="First name" class="form-control py-2 px-4" required>
            </div>
            <div class="mx-5">
                <lable>Gender *</lable><br>
                <input value="male" type="radio" name="gender" id="">Male
                <input value="female" type="radio" name="gender" id="">Female
                <input value="others" type="radio" name="gender" id="">Others
            </div>
            <div class="mx-5">
                <lable>Occupation *</lable>
                <input type="text"  name="occupation" aria-label="First name" class="form-control py-2 px-4" required>
            </div>
        </div>
        <div class="d-flex py-3">
        
            <div class="">
                <lable>Email *</lable>
                <input type="email"  name="email" aria-label="email" class="form-control py-2 px-1" required>
            </div>
            <div class="mx-5">
                <lable>Address *</lable>
                <input type="text"  name="address" aria-label="admission id" class="form-control py-2 px-4" required>
            </div>
            <div class="mx-5">
                <lable>Phone *</lable>
                <input type="number"  name="Phone" aria-label="phone" class="form-control py-2 px-1" required>
            </div>
        </div>
        <div class="d-flex py-3">
            
            
            <div class="">
                <lable>His/her Children's Name *</lable>
                <input type="text"  name="chName" aria-label="First name" class="form-control py-2 px-4" required>
            </div>
        </div>
        
        <div>
            <button type="submit" name="save">Save</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</div>
