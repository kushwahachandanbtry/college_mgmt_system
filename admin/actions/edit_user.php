<?php 
if (isset($_GET['id'])) {

    include dirname(__DIR__, 2). '/config.php';
    include "../helpers.php";
    go_back('allusers');
    $id = $_GET['id'];
    
    if (isset($_POST['update'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $file_name = '';

        // Fetch the current image filename from the database
        $sql_fetch_image = "SELECT image FROM users WHERE id = {$id}";
        $result_image = mysqli_query($conn, $sql_fetch_image);
        $current_image = '';
        if ($result_image && mysqli_num_rows($result_image) > 0) {
            $row = mysqli_fetch_assoc($result_image);
            $current_image = $row['image'];
        }

        // Check for image upload
        if (isset($_FILES['user_image']['tmp_name']) && !empty($_FILES['user_image']['tmp_name'])) {
            $upload_dir = dirname(__DIR__, 2) . '/assets/images/users/';
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
                    // Delete the previous image if it exists
                    if (!empty($current_image) && file_exists($upload_dir . $current_image)) {
                        unlink($upload_dir . $current_image); // Delete the file
                    }
                } else {
                    $errors[] = "Sorry, there was an error uploading your file.";
                }
            }
        }

        $sql1 = "UPDATE users SET username = '{$name}', email = '{$email}'";
        if ($file_name) {
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
                            <img id="studentImagePreview" width="200px" height="200px" src="../assets/images/users/<?php echo $row['image']; ?>" alt="Student">
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
