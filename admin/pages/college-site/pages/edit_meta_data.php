<h3><i>Edit Meta Settings</i></h3>
<?php
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];

    if (isset($_POST['update'])) {
        include dirname(__DIR__, 4) . '/helpers.php';
        include dirname(__DIR__, 4) . '/FetchDataControll.php';
    
        // Collect and sanitize form data
        $pages = mysqli_real_escape_string($conn, $_POST['pages']);
        $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
        $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
        $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
        $canonical_tag = mysqli_real_escape_string($conn, $_POST['canonical_tag']);
    
        $og_title = mysqli_real_escape_string($conn, $_POST['og_title']);
        $og_description = mysqli_real_escape_string($conn, $_POST['og_description']);
        $og_url = mysqli_real_escape_string($conn, $_POST['og_url']);
    
        // Get the current image name from the database
        $current_image_query = "SELECT og_image FROM meta_setting WHERE id = $id";
        $current_image_result = mysqli_query($conn, $current_image_query);
        $current_image = '';
    
        if ($current_image_result && mysqli_num_rows($current_image_result) > 0) {
            $current_image_row = mysqli_fetch_assoc($current_image_result);
            $current_image = $current_image_row['og_image'];
        }
    
        if (isset($_FILES['og_image']) && $_FILES['og_image']['error'] == 0) {
            // Define the upload directory
            $upload_dir = dirname(__DIR__, 4) . '/assets/images/Og_images/';
            $file_name = basename($_FILES['og_image']['name']);
            $file_path = $upload_dir . $file_name;
    
            // Check if the directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
            }
    
            // Delete the old image file if it exists
            if (file_exists($upload_dir . $current_image) && !empty($current_image)) {
                unlink($upload_dir . $current_image);
            }
    
            // Move the uploaded file to the destination folder
            if (move_uploaded_file($_FILES['og_image']['tmp_name'], $file_path)) {
                $current_image = $file_name; // Update the image name
            }
        }
    
        // Update the database with the new or previous image
        $sql = "UPDATE meta_setting SET pages = '$pages', meta_title ='$meta_title', meta_description ='$meta_description',
                                        meta_keywords = '$meta_keywords', canonical_tag ='$canonical_tag',
                                        og_title ='$og_title', og_description ='$og_description',
                                        og_url = '$og_url', og_image ='$current_image' WHERE id = $id";
    
        // Execute the query
        if (mysqli_query($conn, $sql)) {
            edit_success_message();
        } else {
            edit_failed_message();
        }
    }
    


    $sql = "SELECT * FROM meta_setting WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <form class="px-5" action="" method="POST" enctype="multipart/form-data">
                <div class="form-floating py-3">
                    <label for="select_page">Select Page*: </label>
                    <select id="select_page" name="pages" class="form-control col-12">
                        <option value="" disabled>Select Pages</option>
                        <option <?php echo $row['meta_title'] == 'home' ? 'selected' : ''; ?> value="home">Home Page</option>
                        <?php
                        if (!empty($courses) && is_array($courses)) {
                            foreach ($courses as $course) {
                                
                                ?>
                                <option <?php echo $course['id'] == $row['pages'] ? 'selected' : ''; ?>
                                    value="<?php echo htmlspecialchars($course['id']); ?>" >
                                    <?php echo htmlspecialchars($course['course_title']); ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <h4 class="text-center text-info" for="meta_title">Meta Tags </h4>
                <hr>
                <label for="meta_title">Meta Title*: </label>
                <div class="form-floating">
                    <textarea class="form-control" cols="20" rows="4"
                        placeholder="Hint: For best - 6–12 words (approximately 50–60 characters)." id="meta_title"
                        name="meta_title"><?php echo htmlspecialchars($row['meta_title']); ?></textarea>
                </div>

                <label for="meta_description">Meta Description*: </label>
                <div class="form-floating">
                    <textarea class="form-control" cols="20" rows="5"
                        placeholder="Hint: For best - 20–30 words (approximately 120–160 characters)." id="meta_description"
                        name="meta_description"><?php echo htmlspecialchars($row['meta_description']); ?></textarea>
                </div>

                <label for="meta_keywords">Meta Keywords*: </label>
                <div class="form-floating">
                    <textarea class="form-control" cols="20" rows="4" placeholder="Hint: For best - 10–15 words or phrases."
                        id="meta_keywords" name="meta_keywords"><?php echo htmlspecialchars($row['meta_keywords']); ?></textarea>
                </div>

                <label for="canonical_tag">Canonical Tags*: </label>
                <div class="form-floating">
                    <textarea class="form-control" cols="20" rows="3" placeholder="https://www.yourcollege" id="canonical_tag"
                        name="canonical_tag"><?php echo htmlspecialchars($row['canonical_tag']); ?></textarea>
                </div>

                <br>
                <h4 class="text-center text-info" for="meta_title">Open Graph Tags </h4>
                <hr>
                <label for="og_title">og Title: </label>
                <div class="form-floating">
                    <textarea class="form-control" cols="20" rows="5"
                        placeholder="hint: [Your College Name/Course Name] - Excellence in Education" id="og_title"
                        name="og_title"><?php echo htmlspecialchars($row['og_title']); ?></textarea>
                </div>

                <label for="og_description">og Description: </label>
                <div class="form-floating">
                    <textarea class="form-control" palceholder="" cols="20" rows="6"
                        placeholder="hint: it’s best to keep it short and concise—around 1–2 sentences or 50–160 characters"
                        id="og_description"
                        name="og_description"><?php echo htmlspecialchars($row['og_description']); ?></textarea>
                </div>

                <label for="og_url">og URL: </label>
                <div class="form-floating">
                    <textarea class="form-control" cols="20" rows="3"
                        placeholder="hint: https://www.yourcollege.edu or https://www.yourcollege.edu/courses.php" id="og_url"
                        name="og_url"><?php echo htmlspecialchars($row['og_url']); ?></textarea>
                </div>

                <label for="og_image">og Image: </label>
                <p class="text-info">Hint: Use 1200 x 630 pixels as the standard size. Ensure the aspect ratio is 1.91:1. Keep the
                    file size under 1 MB to ensure fast loading. JPEG: Best for photos with lots of colors.</p>
                <div class="input-group mb-3">
                    <div class="mr-3">
                        <img id="ogImagePreview" width="200px" height="200px"
                            src="<?php echo APP_PATH . 'assets/images/Og_images/' . $row['og_image']; ?>" alt="Student">
                        <br>
                        <button type="button" onclick="document.getElementById('imageInput').click();"
                            class="btn btn-secondary mt-2">Change Image</button>
                        <input type="file" id="imageInput" name="og_image" accept="image/*" style="display: none;"
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
                        const output = document.getElementById('ogImagePreview');
                        output.src = reader.result;
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }
            </script>
            <?php
        }
    }
}
