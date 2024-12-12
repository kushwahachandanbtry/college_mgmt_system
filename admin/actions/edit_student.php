<?php
if (isset($_GET['id'])) {

    // include "go_back.php";
    include dirname(__DIR__, 2). '/config.php';
    include "../helpers.php";

    $id = $_GET['id'];


    if (isset($_POST['update'])) {
        // assign all variable null data
        $fname = $lname = $gender = $dob = $blood = $religion = $email = $admissionid = $section = $number = $shortbio = $class = '';
        
        /**
         * Remove all tags and scripts and return as a string
         *
         * @param [any] $data
         * @return string
         */
        function check_input($data) {
            $data = trim($data);
            $data  = stripslashes($data);
            $data  = htmlspecialchars($data);
            return $data;
        }
    
        $fname = check_input($_POST['fname']);
        $lname = check_input($_POST['lname']);
        $gender = check_input($_POST['gender']);
        $dob = check_input($_POST['dob']);
        $blood = check_input($_POST['blood']);
        $religion = check_input($_POST['religion']);
        $email = check_input($_POST['email']);
        $admissionid = check_input($_POST['admissionid']);
        $section = check_input($_POST['section']);
        $number = check_input($_POST['phone']);
        $shortbio = check_input($_POST['shortbio']);
        $class = check_input($_POST['class']);
        $semester = check_input($_POST['semester']);
    
        $errors = array(); // assign all errors in this array
    
        // check valid email or not
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please Enter Valid Email.';
        }
    
        // check valid date or not
        if (strtotime($dob) === false) {
            $errors[] = 'Your date is not Valid.';
        }
    
        // for valid year
        $dateparts = explode('-', $dob);
        $year      = $dateparts[0];
        if (strlen($year) !== 4) {
            $errors[] = 'Invalid Your Year Format';
        }
    
        // for valid month
        $month = $dateparts[1];
        if ($month < 1 || $month > 12) {
            $errors[] = 'Invalid Your Month format';
        }
    
        // for valid day
        $day = $dateparts[2];
        if ($day < 1 || $day > 31) {
            $errors[] = 'Invalid day';
        }
    
        // Check for image upload
$upload_dir = dirname(__DIR__, 2) . '/assets/images/students/';
$file_name = '';  // Initialize as empty

if (!empty($_FILES['student_image']['tmp_name'])) {
    $file_name = basename($_FILES['student_image']['name']);
    $target_file = $upload_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    $check = getimagesize($_FILES['student_image']['tmp_name']);
    if ($check === false) {
        $errors[] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($_FILES['student_image']['size'] > 5000000) {
        $errors[] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Attempt file upload if validations pass
    if ($uploadOk && !move_uploaded_file($_FILES['student_image']['tmp_name'], $target_file)) {
        $errors[] = "Sorry, there was an error uploading your file.";
    }
} else {
    // No new image, so retrieve existing image filename from database
    $sql = "SELECT image FROM students WHERE id = '{$id}'";
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
    
        // Error field is empty, then insert valid data
        if (empty($errors)) {
            $sql = "UPDATE students SET fname = '{$fname}', lname ='{$lname}' , gender = '{$gender}', dob ='{$dob}', blood = '{$blood}',
            religion = '{$religion}', email ='{$email}', admissionid = '{$admissionid}', section = '{$section}', shortbio ='{$shortbio}',
            Phone = '{$number}', class = '{$class}', image = '{$file_name}', semester = '{$semester}' WHERE id = '{$id}' ";
            
            $result = mysqli_query($conn, $sql);
            if ($result) {
                edit_success_message();
            } else {
                edit_failed_message();
            }
        }
    }

    go_back('item1');

    $sql = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>

<div class="adminssion-form py-5 px-5" style="background:#FFFFFF;">
    <form action="" method="POST" enctype="multipart/form-data">
        <p class="submit-msg"></p>
        <h5>Edit Student <button onclick="goBack();" class="btn btn-info ml-5">Go Back</button></h5>
        
        <div class="d-flex py-">
            <div class="mr-3">
                <img id="studentImagePreview" width="200px" height="200px" src="../assets/images/students/<?php echo $row['image']; ?>" alt="Student">
                <br>
                <button type="button" onclick="document.getElementById('imageInput').click();" class="btn btn-secondary mt-2">Change Image</button>
                <input type="file" id="imageInput" name="student_image" accept="image/*" style="display: none;" onchange="previewImage(event)">
            </div>
            <div class="">
                <lable>First Name *</lable>
                <input type="text" value="<?php echo $row['fname']; ?>"  name="fname" aria-label="First name" class="form-control py-2 px-4">
            </div>
            <div class="mx-3">
                <lable>Last Name *</lable>
                <input type="text" value="<?php echo $row['lname']; ?>"  name="lname" aria-label="Last name" class="form-control  py-2 px-4">
            </div>
            <div class="mr-5">
            <lable class="mx-3">Select Your Blood Group *</lable><br>
                <select name="blood" class="border border-light rounded py-2 px-3 mx-1" aria-label="Default select example">
                    <option class="text-light">Select Your Blood Group*</option>
                    <option <?php echo $row['blood'] === 'A+' ? "selected" : ''; ?> value="A+">A+</option>
                    <option <?php echo $row['blood'] === 'A-' ? "selected" : ''; ?> value="A-">A-</option>
                    <option <?php echo $row['blood'] === 'B+' ? "selected" : ''; ?> value="B+">B+</option>
                    <option <?php echo $row['blood'] === 'B-' ? "selected" : ''; ?> value="B-">B-</option>
                    <option <?php echo $row['blood'] === 'o+' ? "selected" : ''; ?> value="o+">O+</option>
                    <option <?php echo $row['blood'] === 'o-' ? "selected" : ''; ?> value="o-">O-</option>
                </select>
            </div>
        </div>
        <div class="d-flex py-3">
            
            <div class="">
                <lable>Religions *</lable><br>
                <select name="religion" class="border border-light rounded py-2 px-3" aria-label="Default select example">
                    <option class="text-light">Select Your Religion*</option>
                    <option <?php echo $row['religion'] === 'Islam' ? "selected" : ''; ?> value="Islam">Islam</option>
                    <option <?php echo $row['religion'] === 'Cristian' ? "selected" : ''; ?> value="Cristian">Cristian</option>
                    <option <?php echo $row['religion'] === 'Hindu' ? "selected" : ''; ?> value="Hindu">Hindu</option>
                    <option <?php echo $row['religion'] === 'Buddhist' ? "selected" : ''; ?> value="Buddhist">Buddhist</option>
                    <option <?php echo $row['religion'] === 'Others' ? "selected" : ''; ?> value="Others">Others</option>
                </select>
            </div>
            <div class="ml-5">
                <lable>Email *</lable>
                <input type="email" value="<?php echo $row['email']; ?>"  name="email" aria-label="email" class="form-control py-2 px-1">
            </div>
            <div class="mx-3">
                <lable>Adminssion ID *</lable>
                <input type="text"  value="<?php echo $row['admissionid']; ?>" name="admissionid" aria-label="admission id" class="form-control py-2 px-4">
            </div>
            <div class="">
            <lable class="mx-3">Class *</lable><br>
            <?php
            $sql2 = "SELECT classes FROM classes";
            $result2 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                ?>
                <select name="class" class="border border-light rounded py-2 px-5 mx-1" aria-label="Default select example">
                <?php
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    ?>
                    <option value="<?php echo $row2['classes']; ?>"><?php echo $row2['classes']; ?></option>
                <?php
                }
                ?>
                </select>
            <?php } ?>
            </div>
        </div>
        <div class="d-flex py-3">
            
            
            <div class="">
                <lable>Section *</lable><br>
                <select name="section" class="border border-light rounded py-2 px-3" aria-label="Default select example">
                    <option class="text-light">Select Your Section*</option>
                    <option <?php echo $row['section'] === 'A' ? "selected" : ''; ?> value="A">A</option>
                    <option <?php echo $row['section'] === 'B' ? "selected" : ''; ?> value="B">B</option>
                    <option <?php echo $row['section'] === 'C' ? "selected" : ''; ?> value="C">C</option>
                </select>
            </div>
            <div class="mx-5">
                <lable>Phone *</lable>
                <input type="number" value="<?php echo $row['phone']; ?>"  name="phone" pattern="[0-9]*" inputmode="numeric" aria-label="phone" class="form-control py-2 px-1">
            </div>
            <div class="mx-3">
                <lable>Gender *</lable><br>
                <input <?php echo $row['gender'] === 'male' ? "checked" : ''; ?>  value="male" type="radio" name="gender" id="">Male
                <input <?php echo $row['gender'] === 'female' ? "checked" : ''; ?> value="female" type="radio" name="gender" id="">Female
                <input <?php echo $row['gender'] === 'others' ? "checked" : ''; ?> value="others" type="radio" name="gender" id="">Others
            </div>
            <div class="mx-">
                <lable>Date Of Birth *</lable>
                <input type="date" value="<?php echo $row['dob']; ?>"  name="dob" aria-label="dob" class="form-control py-2 px-4">
            </div>
        </div>
        <div class="d-flex pt-5 pb-3 justify-content-between">
        <div class="mx-">
                <lable>Date Of Birth *</lable>
                <input type="text" value="<?php echo $row['semester']; ?>"  name="semester" aria-label="semester" class="form-control py-2 px-4">
            </div>
            <div class="">
                <label>Short BIO</label><br>
                <textarea cols="50" rows="10" name="shortbio"><?php echo $row['shortbio']; ?></textarea>
            </div>
            
        </div>
        <div class="d-flex pb-5">
        
            
        </div>
        <div class="">
            <button type="submit" name="update" class="save">Update</button>
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
