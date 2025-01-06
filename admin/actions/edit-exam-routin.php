<?php
if (isset($_GET['id'])) {

    include dirname(__DIR__, 2) . '/config.php';
    include "../helpers.php";
    go_back('item18');
    $id = $_GET['id'];
    if (isset($_POST['update'])) {
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        $running_sem_or_year = mysqli_real_escape_string($conn, $_POST['running_sem_or_year']);
        $year_or_semester = mysqli_real_escape_string($conn, $_POST['year_or_semester']);
    
        // Check for image upload
        $file_name = '';
        if (isset($_FILES['exam_routine_image']['tmp_name']) && !empty($_FILES['exam_routine_image']['tmp_name'])) {
            $upload_dir = dirname(__DIR__, 2) . '/assets/images/exam_routine/';
            $file_name = basename($_FILES['exam_routine_image']['name']);
            $target_file = $upload_dir . $file_name;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            // Check if image file is an actual image
            $check = getimagesize($_FILES['exam_routine_image']['tmp_name']);
            if ($check === false) {
                $errors[] = "File is not an image.";
                $uploadOk = 0;
            }
    
            // Check file size (limit to 2MB)
            if ($_FILES['exam_routine_image']['size'] > 2000000) {
                $errors[] = "Sorry, your file is too large [Accepted: 2MB or less].";
                $uploadOk = 0;
            }
    
            // Allow certain file formats
            if (!in_array($imageFileType, ['jpg', 'png', 'jpeg'])) {
                $errors[] = "Sorry, only JPG, JPEG & PNG files are allowed.";
                $uploadOk = 0;
            }
    
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 1) {
                // Retrieve the current image name from the database
                $sql_get_image = "SELECT images FROM exam_routine WHERE id = {$id}";
                $result_get_image = mysqli_query($conn, $sql_get_image);
                if ($result_get_image && mysqli_num_rows($result_get_image) > 0) {
                    $row = mysqli_fetch_assoc($result_get_image);
                    $current_image = $row['images'];
    
                    // Delete the current image if it exists
                    if (!empty($current_image) && file_exists($upload_dir . $current_image)) {
                        unlink($upload_dir . $current_image);
                    }
                }
    
                // Try to upload the new file
                if (move_uploaded_file($_FILES['exam_routine_image']['tmp_name'], $target_file)) {
                    $sql1 = "UPDATE exam_routine 
                             SET class = '{$class}', year_or_semester = '{$year_or_semester}', 
                                 running_sem_or_year = '{$running_sem_or_year}', images = '{$file_name}' 
                             WHERE id = {$id}";
    
                    $result1 = mysqli_query($conn, $sql1);
                    if ($result1) {
                        edit_success_message();
                    } else {
                        edit_failed_message();
                    }
                } else {
                    $errors[] = "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
    

    $sql = "SELECT * FROM exam_routine WHERE id = $id";
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
                            <img id="routine_image_priview" width="200px" height="200px"
                                src="../assets/images/exam_routine/<?php echo $row['images']; ?>"
                                alt="<?php echo $row['images']; ?>">
                            <br>
                            <button type="button" onclick="document.getElementById('imageInput').click();"
                                class="btn btn-secondary mt-2">Change Image</button>
                            <input type="file" id="imageInput" name="exam_routine_image" accept="image/*" style="display: none;"
                                onchange="previewImage(event)">
                        </div>
                        <div class="">
                            <label>Class</label>
                            <input type="text" value="<?php echo $row['class']; ?>" name="class" aria-label="First name"
                                class="form-control py-2 px-4">
                        </div>

                        <div class="mx-5">
                            <label>Running Semester or Year</label>
                            <input type="text" value="<?php echo $row['running_sem_or_year']; ?>" name="running_sem_or_year"
                                aria-label="First name" class="form-control py-2 px-4">
                        </div>
                        <div class="">
                            <label class="">Semester or Year</label><br>
                            <select name="year_or_semester" class="border border-light rounded py-2 px-3 mx-1"
                                aria-label="Default select example">
                                <option <?php echo $row['year_or_semester'] == 'year' ? 'selected' : ''; ?> value="year">Year</option>
                                <option <?php echo $row['year_or_semester'] == 'semester' ? 'selected' : ''; ?> value="semester">
                                    Semester</option>
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
        reader.onload = function () {
            const output = document.getElementById('routine_image_priview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
