<h3><i>Edit What People Say's</i></h3>

<?php
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];

    include dirname(__DIR__, 4) . '/helpers.php';

    if (isset($_POST['update'])) {
        // Collect form data and sanitize inputs
        $overview = mysqli_real_escape_string($conn, $_POST['overview']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $batch = mysqli_real_escape_string($conn, $_POST['batch']);

        // Retrieve the old image
        $sql = "SELECT image FROM what_people_say WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $old_image = '';
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $old_image = $row['image'];
        }

        // Handling the image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Define the upload directory
            $upload_dir = dirname(__DIR__, 4) . '/assets/images/what_people_say/';
            $file_name = basename($_FILES['image']['name']);
            $file_path = $upload_dir . $file_name;

            // Check if the directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
            }

            // Move uploaded file to the destination folder
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                // Delete the old image file
                if (!empty($old_image)) {
                    $old_image_path = $upload_dir . $old_image;
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }

                // File successfully uploaded, now update the database
                $image_path_db = $file_name; // Store only the filename in the DB

                $sql = "UPDATE what_people_say 
                        SET overview = '$overview', 
                            name = '$name', 
                            batch = '$batch', 
                            image = '$image_path_db' 
                        WHERE id = $id";

                if (mysqli_query($conn, $sql)) {
                    edit_success_message();
                } else {
                    edit_failed_message();
                }
            } else {
                edit_failed_message();
            }
        } else {
            // Update without changing the image
            $sql = "UPDATE what_people_say 
                    SET overview = '$overview', 
                        name = '$name', 
                        batch = '$batch' 
                    WHERE id = $id";

            if (mysqli_query($conn, $sql)) {
                edit_success_message();
            } else {
                edit_failed_message();
            }
        }
    }

    // Fetch existing data for the edit form
    $sql = "SELECT * FROM what_people_say WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
?>
            <form class="px-5" action="" method="POST" enctype="multipart/form-data">
                <label for="floatingTextarea">Overview: </label>
                <div class="form-floating">
                    <textarea class="form-control" rows="7" placeholder="Leave Overview here" id="floatingTextarea"
                        name="overview"><?php echo $row['overview']; ?></textarea>
                </div>
                <label for="card-title">Name: </label>
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" id="card-title" placeholder="Name" name="name"
                        value="<?php echo $row['name']; ?>">
                </div>
                <label for="batch">Batch: </label>
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" id="batch" placeholder="Batch" name="batch"
                        value="<?php echo $row['batch']; ?>">
                </div>
                <label for="inputGroupFile02">Image: </label>
                <div class="input-group mb-3">
                    <div class="mr-3">
                        <img id="featuresImagePreview" width="200px" height="200px"
                            src="<?php echo APP_PATH . 'assets/images/what_people_say/' . $row['image']; ?>" alt="Image">
                        <br>
                        <button type="button" onclick="document.getElementById('imageInput').click();"
                            class="btn btn-secondary mt-2">Change Image</button>
                        <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;"
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
                        const output = document.getElementById('featuresImagePreview');
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
