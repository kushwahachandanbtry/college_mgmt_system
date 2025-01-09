<h3><i>Edit Features</i></h3>
<?php
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];

    if (isset($_POST['update'])) {
        include dirname(__DIR__, 4) . '/helpers.php';

        // Collect form data and sanitize inputs
        $features_title = mysqli_real_escape_string($conn, $_POST['features_title']);
        $features_heading = mysqli_real_escape_string($conn, $_POST['features_heading']);
        $features_description = mysqli_real_escape_string($conn, $_POST['features_description']);

        // Retrieve the old image
        $sql = "SELECT features_image FROM features WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $old_image = '';
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $old_image = $row['features_image'];
        }

        // Handling the image upload
        if (isset($_FILES['features_image']) && $_FILES['features_image']['error'] == 0) {
            // Define the upload directory
            $upload_dir = dirname(__DIR__, 4) . '/assets/images/features/';
            $file_name = basename($_FILES['features_image']['name']);
            $file_path = $upload_dir . $file_name;

            // Check if the directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Create directory if not exists
            }

            // Move uploaded file to the destination folder
            if (move_uploaded_file($_FILES['features_image']['tmp_name'], $file_path)) {
                // Delete the old image file
                if (!empty($old_image)) {
                    $old_image_path = $upload_dir . $old_image;
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }

                // File successfully uploaded, now update the database
                $image_path_db = $file_name; // relative path for storing in DB
                $sql = "UPDATE features 
                        SET features_title = '$features_title', 
                            features_heading = '$features_heading', 
                            features_description = '$features_description', 
                            features_image = '$image_path_db' 
                        WHERE id = $id";

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
            // Update without changing the image
            $sql = "UPDATE features 
                    SET features_title = '$features_title', 
                        features_heading = '$features_heading', 
                        features_description = '$features_description' 
                    WHERE id = $id";

            if (mysqli_query($conn, $sql)) {
                edit_success_message();
            } else {
                edit_failed_message();
            }
        }
    }


    $sql = "SELECT * FROM features WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <form class="px-5" action="" method="POST" enctype="multipart/form-data">

                <label for="card-title">Features Title: </label>
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" id="card-title" placeholder="Features Title" name="features_title"
                        value="<?php echo $row['features_title']; ?>">
                </div>
                <label for="card-s">Features Heading: </label>
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" id="card-s" placeholder="Features Title" name="features_heading"
                        value="<?php echo $row['features_heading']; ?>">
                </div>
                <label for="floatingTextareas">Features Description: </label>
                <div class="form-floating">
                    <textarea cols="30" rows="8" class="form-control" placeholder="Leave a features description here"
                        id="floatingTextareas" name="features_description"><?php echo $row['features_description']; ?></textarea>
                </div>
                <label for="inputGroupFile02">Features Image: </label>
                <div class="input-group mb-3">
                    <div class="mr-3">
                        <img id="featuresImagePreview" width="200px" height="200px"
                            src="<?php echo APP_PATH . 'assets/images/features/' . $row['features_image']; ?>" alt="Student">
                        <br>
                        <button type="button" onclick="document.getElementById('imageInput').click();"
                            class="btn btn-secondary mt-2">Change Image</button>
                        <input type="file" id="imageInput" name="features_image" accept="image/*" style="display: none;"
                            onchange="previewImage(event)">
                    </div>
                </div>

                <div class="py-3">
                    <button type="submit" class="btn btn-primary" name="update">Save</button>
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
