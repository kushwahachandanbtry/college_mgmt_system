<h3><i>Staff</i></h3>
<?php include dirname(__DIR__, 4). '/constant.php'; ?>
<form class="px-5" action="<?php echo APP_PATH . "admin/pages/college-site/pages/actions/staff.php";?>" method="POST" enctype="multipart/form-data">
    <label for="staff-name">Staff Name: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="staff-name" name="staff_name" placeholder="Enter staff name" required>
    </div>

    <label for="staff-phone">Phone Number: </label>
    <div class="input-group flex-nowrap">
        <input type="number" class="form-control" id="staff-phone" name="staff_phone" placeholder="Enter Phone Number" required>
    </div>

    <label for="staff-email">Email: </label>
    <div class="input-group flex-nowrap">
        <input type="email" class="form-control" id="staff-email" name="staff_email" placeholder="Enter Email" required>
    </div>

    <label for="about-staff">About Staff: </label>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave About Staff here" id="about-staff" name="about_staff" required></textarea>
    </div>
    
    <label for="staff-image">Staff Image: </label>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="staff-image" name="staff_image" accept="image/*" required>
    </div>

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>
