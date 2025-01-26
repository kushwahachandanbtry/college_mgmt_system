<h3><i>Edit Popup</i></h3>
<?php
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];

    if (isset($_POST['update'])) {
        include dirname(__DIR__, 4) . '/helpers.php';


        // Fetch the current image path from the database
        $sql = "SELECT image FROM popup WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $current_image = $row['image'];
        $upload_dir = dirname(__DIR__, 4) . '/assets/images/popup/';

        // Handle file upload
        if (isset($_FILES['popup_image']) && $_FILES['popup_image']['error'] === UPLOAD_ERR_OK) {
            $file_name = basename($_FILES['popup_image']['name']);
            $file_path = $upload_dir . $file_name;

            // Check if the directory exists; if not, create it
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Delete the old image from the directory
            if (file_exists($upload_dir . $current_image)) {
                unlink($upload_dir . $current_image);
            }

            // Move the uploaded file to the designated folder
            if (move_uploaded_file($_FILES['popup_image']['tmp_name'], $file_path)) {
                // Prepare SQL query to update the gallery table
                $sql = "UPDATE popup SET image = '$file_name' WHERE id = $id";

                // Execute the query
                if (mysqli_query($conn, $sql)) { 
                    edit_success_message();
                } else {
                    edit_failed_message();
                }
            } else {
                edit_failed_message();
            }
        } else {
            edit_failed_message();
        }
    }

    // Fetch the current gallery details
    $sql = "SELECT * FROM popup WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <form class="px-5" action="" method="POST" enctype="multipart/form-data">
                

                <label for="gallery-img">Image: </label>
                <div class="input-group mb-3">
                    <div class="mr-3">
                        <img id="gallery" width="200px" height="200px"
                            src="<?php echo APP_PATH . 'assets/images/popup/' . $row['image']; ?>"
                            alt="<?php echo htmlspecialchars($row['image']); ?>">
                        <br>
                        <button type="button" onclick="document.getElementById('imageInput').click();"
                            class="btn btn-secondary mt-2">Change Image</button>
                        <input type="file" id="imageInput" name="popup_image" accept="image/*" style="display: none;"
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
                        const output = document.getElementById('gallery');
                        output.src = reader.result;
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }
            </script>
            <?php
        }
    }
}

