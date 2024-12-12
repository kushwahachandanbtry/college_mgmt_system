<?php
if (isset($_GET['id'])) {

    include dirname(__DIR__, 2). '/config.php';
    include "../helpers.php";

    $id = $_GET['id'];


    if (isset($_POST['update'])) {
        // assign in all variable null data
        $fname = $lname = $gender = $religion = $email = $address = $number = $shortbio = '';
    
    
        /**
         * Remove all tags and scripts and return as a string
         *
         * @param [any] $data
         * @return string
         */
        function check_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    
        $fname = check_input($_POST['fname']);
    
        $lname = check_input($_POST['lname']);
    
        $gender = check_input($_POST['gender']);
    
        $religion = check_input($_POST['religions']);
    
        $email = check_input($_POST['email']);
    
        $address = check_input($_POST['address']);
    
        $number = check_input($_POST['Phone']);
    
        $shortbio = check_input($_POST['shortbio']);
    
        $errors = array(); // assign all errors in this array
        
        // Check for image upload
$upload_dir = dirname(__DIR__, 2) . '/assets/images/teachers/';
$file_name = '';  // Initialize as empty

if (!empty($_FILES['teacher_image']['tmp_name'])) {
    $file_name = basename($_FILES['teacher_image']['name']);
    $target_file = $upload_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    $check = getimagesize($_FILES['teacher_image']['tmp_name']);
    if ($check === false) {
        $errors[] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($_FILES['teacher_image']['size'] > 5000000) {
        $errors[] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Attempt file upload if validations pass
    if ($uploadOk && !move_uploaded_file($_FILES['teacher_image']['tmp_name'], $target_file)) {
        $errors[] = "Sorry, there was an error uploading your file.";
    }
} else {
    // No new image uploaded, retrieve existing image filename from database
    $sql = "SELECT image FROM teachers WHERE id = '{$id}'";
    $result = mysqli_query($conn, $sql);
    if ($result && $existing_data = mysqli_fetch_assoc($result)) {
        $file_name = $existing_data['image'];  // Use existing image filename
    } else {
        $errors[] = "Could not retrieve existing image information.";
    }
}

        // check error field is empty or have some error
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error . "<br>"; // Display each error
            }
        }
    
        // check valid email or not
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please Enter Valid Email.';
        }
    
    
        // check error field is empty or have some error
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error;
            }
        }
    
    
        // Error field is emtpty the insert valid data
        if (empty($errors)) {
    
            // print_r( $conn );
            $sql = "UPDATE teachers SET fname = '{$fname}', lname = '{$lname}', gender = '{$gender}', religions = '{$religion}',
            email = '{$email}', address = '{$address}', phone = '{$number}', shortbio = '{$shortbio}', image = '{$file_name}' WHERE id = '{$id}' ";
    
    
    
            $result = mysqli_query($conn, $sql);
            if ($result) {
                edit_success_message();
            } else {
                edit_failed_message();
            }
        }
    }
    

    go_back('item3');

    $sql = "SELECT * FROM teachers WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>

<div class="adminssion-form py-5 px-5" style="background:#FFFFFF;">
    <form action="" method="POST" enctype="multipart/form-data">
        <h5>Edit Teacher <button onclick="goBack();" class="btn btn-info ml-5">Go Back</button></h5>
        <div class="d-flex py-3">
        <div class="mr-3">
                <img id="studentImagePreview" width="200px" height="200px" src="../assets/images/teachers/<?php echo $row['image']; ?>" alt="Student">
                <br>
                <button type="button" onclick="document.getElementById('imageInput').click();" class="btn btn-secondary mt-2">Change Image</button>
                <input type="file" id="imageInput" name="teacher_image" accept="image/*" style="display: none;" onchange="previewImage(event)">
            </div>
            <div class="">
                <lable>First Name *</lable>
                <input type="text" value="<?php echo $row['fname']; ?>"  name="fname" aria-label="First name" class="form-control py-2 px-4">
            </div>
            <div class="mx-5">
                <lable>Last Name *</lable>
                <input type="text" value="<?php echo $row['lname']; ?>" name="lname" aria-label="Last name" class="form-control  py-2 px-4">
            </div>
            <div class="">
                <lable>Religions *</lable><br>
                <select name="religions"  class="border border-light rounded py-2 px-3" aria-label="Default select example">
                    <option class="text-light">Select Your Religion*</option>
                    <option <?php echo $row['religions'] == 'Hindu' ? 'selected' : ''; ?> value="Hindu">Hindu</option>
                    <option <?php echo $row['religions'] == 'Islam' ? 'selected' : ''; ?> value="Islam">Islam</option>
                    <option <?php echo $row['religions'] == 'Cristian' ? 'selected' : ''; ?> value="Cristian">Cristian</option>
                    <option <?php echo $row['religions'] == 'Buddhist' ? 'selected' : ''; ?> value="Buddhist">Buddhist</option>
                    <option <?php echo $row['religions'] == 'Ohters' ? 'selected' : ''; ?> value="Ohters">Others</option>
                </select>
            </div>
        </div>
        <div class="d-flex py-3">
        <div class="">
                <lable>Gender *</lable><br>
                <input <?php echo $row['gender'] == 'male' ? 'checked' : ''; ?> value="male" type="radio" name="gender" id="">Male
                <input <?php echo $row['gender'] == 'female' ? 'checked' : ''; ?> value="female" type="radio" name="gender" id="">Female
                <input <?php echo $row['gender'] == 'others' ? 'checked' : ''; ?> value="others" type="radio" name="gender" id="">Others
            </div>
            
            <div class="mx-5">
                <lable>Email *</lable>
                <input type="email" value="<?php echo $row['email']; ?>" name="email" aria-label="email" class="form-control py-2 px-1">
            </div>
            <div class="">
                <lable>Address *</lable>
                <input type="text" value="<?php echo $row['address']; ?>" name="address" aria-label="admission id" class="form-control py-2 px-4">
            </div>
        </div>
        <div class="d-flex py-3">
            <div class="">
                <lable>Phone *</lable>
                <input type="number" value="<?php echo $row['Phone']; ?>" name="Phone" aria-label="phone" class="form-control py-2 px-1">
            </div>
            <div class="mx-5">
                <label>Short BIO</label><br>
                <textarea name="shortbio" cols="50" rows="10"><?php echo $row['shortbio']; ?></textarea>
            </div>
        </div>
        
        <div>
            <button type="submit" name="update">Update</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</div>

<script>
    //function for preview image in edit section
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('studentImagePreview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<?php }
    }
} ?>
