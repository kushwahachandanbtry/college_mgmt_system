<?php 
if (isset($_GET['id'])) {

include dirname(__DIR__, 2). '/config.php';
include "../helpers.php";
go_back('allusers');
$id = $_GET['id'];
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check for image upload
    $file_name = '';
    if (isset($_FILES['user_image']['tmp_name']) && !empty($_FILES['user_image']['tmp_name'])) {
        $upload_dir = dirname(__DIR__, 2) . '/admin/pages/message_app/uploads/';
        $file_name = basename($_FILES['user_image']['name']);
        $target_file = $upload_dir . $file_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if image file is an actual image
        $check = getimagesize($_FILES['user_image']['tmp_name']);
        if ($check === false) {
            $errors[] = "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (limit to 5MB)
        if ($_FILES['user_image']['size'] > 5000000) {
            $errors[] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
            // Try to upload file
            if (move_uploaded_file($_FILES['user_image']['tmp_name'], $target_file)) {
                // File upload successful, continue to insert student data
            } else {
                $errors[] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    $sql1 = "UPDATE users SET username = '{$name}', email = '{$email}', password = '{$password}', role = '{$role}'";
    if ($file_name) {
        $file_name = 'uploads/' . $file_name;
        $sql1 .= ", image = '{$file_name}'";
    }
    $sql1 .= " WHERE id = {$id}";

    $result1 = mysqli_query($conn, $sql1);
    if ($result1) {
        edit_success_message();
    } else {
        edit_failed_message();
    }
}

$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <!-- HTML form for editing user -->
        <div class="adminssion-form py-5 px-5" style="background:#FFFFFF;">
            <form action="" method="POST" enctype="multipart/form-data">
                <h5>Edit User <button onclick="goBack();" class="btn btn-info ml-5">Go Back</button></h5>
                
                <div class="d-flex py-3">
                    <div class="mr-3">
                        <img id="studentImagePreview" width="200px" height="200px" src="../admin/pages/message_app/<?php echo $row['image']; ?>" alt="Student">
                        <br>
                        <button type="button" onclick="document.getElementById('imageInput').click();" class="btn btn-secondary mt-2">Change Image</button>
                        <input type="file" id="imageInput" name="user_image" accept="image/*" style="display: none;" onchange="previewImage(event)">
                    </div>
                    <div class="">
                        <label>Name</label>
                        <input type="text" value="<?php echo $row['username']; ?>" name="name" aria-label="First name"
                            class="form-control py-2 px-4">
                    </div>

                    <div class="mx-5">
                        <label>Email</label>
                        <input type="email" value="<?php echo $row['email']; ?>" name="email" aria-label="First name"
                            class="form-control py-2 px-4">
                    </div>
                    <div class="mx-5">
                        <label>Password</label>
                        <input type="password" readonly value="<?php echo $row['password']; ?>" name="password"
                            aria-label="First name" class="form-control py-2 px-4">
                    </div>
                    <div class="">
                        <label class="">Select Role</label><br>
                        <select name="role" class="border border-light rounded py-2 px-3 mx-1"
                            aria-label="Default select example">
                            <option <?php echo $row['role'] == 'student' ? 'selected' : ''; ?> value="student">Student</option>
                            <option <?php echo $row['role'] == 'teacher' ? 'selected' : ''; ?> value="teacher">Teacher</option>
                            <option <?php echo $row['role'] == 'parent' ? 'selected' : ''; ?> value="parent">Parent</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button type="submit" name="update">Update</button>
                    <button type="reset">Reset</button>
                </div>
            </form>
        </div>
        <?php 
    }
}
} ?>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('studentImagePreview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
