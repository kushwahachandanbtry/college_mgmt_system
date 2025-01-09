<h3><i>Edit Staff</i></h3>
<?php
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];

    if (isset($_POST['update'])) {
        include dirname(__DIR__, 4) . '/helpers.php';

        // Retrieve form data
        $staff_name = mysqli_real_escape_string($conn, $_POST['staff_name']);
        $staff_phone = mysqli_real_escape_string($conn, $_POST['staff_phone']);
        $staff_email = mysqli_real_escape_string($conn, $_POST['staff_email']);
        $about_staff = mysqli_real_escape_string($conn, $_POST['about_staff']);

        // Fetch the current image to delete later if updated
        $sql_fetch = "SELECT staff_image FROM staff WHERE id = $id";
        $result_fetch = mysqli_query($conn, $sql_fetch);
        $current_image = mysqli_fetch_assoc($result_fetch)['staff_image'];

        // Handle file upload
        if (isset($_FILES['staff_image']) && $_FILES['staff_image']['error'] === UPLOAD_ERR_OK) {
            // Define upload directory
            $upload_dir = dirname(__DIR__, 5) . '/assets/images/staff/';
            $file_name = basename($_FILES['staff_image']['name']);
            $file_path = $upload_dir . $file_name;

            // Check if the directory exists; if not, create it
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Move the uploaded file to the designated folder
            if (move_uploaded_file($_FILES['staff_image']['tmp_name'], $file_path)) {
                // Delete the old image
                if ($current_image && file_exists($upload_dir . $current_image)) {
                    unlink($upload_dir . $current_image);
                }

                // Update database with the new image
                $sql = "UPDATE staff SET staff_name = '$staff_name', staff_phone = '$staff_phone',
                                        staff_email = '$staff_email', about_staff = '$about_staff',
                                        staff_image = '$file_name' WHERE id = $id";
            } else {
                edit_failed_message();
                exit();
            }
        } else {
            // Update database without changing the image
            $sql = "UPDATE staff SET staff_name = '$staff_name', staff_phone = '$staff_phone',
                                    staff_email = '$staff_email', about_staff = '$about_staff' WHERE id = $id";
        }

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            edit_success_message();
        } else {
            edit_failed_message();
        }
    }

    // Fetch the current staff details
    $sql = "SELECT * FROM staff WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <form class="px-5" action="" method="POST" enctype="multipart/form-data">
                <label for="staff-name">Staff Name: </label>
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" id="staff-name" name="staff_name" placeholder="Enter staff name"
                        value="<?php echo htmlspecialchars($row['staff_name']); ?>">
                </div>

                <label for="staff-phone">Phone Number: </label>
                <div class="input-group flex-nowrap">
                    <input type="number" class="form-control" id="staff-phone" name="staff_phone" placeholder="Enter Phone Number"
                        value="<?php echo htmlspecialchars($row['staff_phone']); ?>">
                </div>

                <label for="staff-email">Email: </label>
                <div class="input-group flex-nowrap">
                    <input type="email" class="form-control" id="staff-email" name="staff_email" placeholder="Enter Email"
                        value="<?php echo htmlspecialchars($row['staff_email']); ?>">
                </div>

                <label for="about-staff">About Staff: </label>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave About Staff here" rows="7" id="about-staff" name="about_staff"
                        required><?php echo htmlspecialchars($row['about_staff']); ?></textarea>
                </div>

                <label for="staff-image">Staff Image: </label>
                <div class="input-group mb-3">
                    <div class="mr-3">
                        <img id="staffImagePreview" width="200px" height="200px"
                            src="<?php echo APP_PATH . 'assets/images/staff/' . $row['staff_image']; ?>" alt="<?php echo htmlspecialchars($row['staff_image']); ?>">
                        <br>
                        <button type="button" onclick="document.getElementById('imageInput').click();"
                            class="btn btn-secondary mt-2">Change Image</button>
                        <input type="file" id="imageInput" name="staff_image" accept="image/*" style="display: none;"
                            onchange="previewImage(event)">
                    </div>
                </div>

                <div class="py-3">
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>
            <script>
                function previewImage(event) {
                    const reader = new FileReader();
                    reader.onload = function () {
                        const output = document.getElementById('staffImagePreview');
                        output.src = reader.result;
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }
            </script>
        <?php
        }
    }
}
?>
