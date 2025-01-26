<?php
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];

    if (isset($_POST['update'])) {
        include dirname(__DIR__, 4) . '/helpers.php';

        // Collect and sanitize form data
        $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
        $course_description = mysqli_real_escape_string($conn, $_POST['course_description']);
        $course_duration = mysqli_real_escape_string($conn, $_POST['course_duration']);
        $categories = mysqli_real_escape_string($conn, $_POST['categories']);
        $course_objectives = mysqli_real_escape_string($conn, $_POST['course_objectives']);
        $course_intake = mysqli_real_escape_string($conn, $_POST['course_intake']);

        // Define directories for uploads
        $base_upload_dir = dirname(__DIR__, 4) . '/assets/images/courses/';
        $course_image_dir = $base_upload_dir . 'course_images/';
        $syllabus_image_dir = $base_upload_dir . 'syllabus_images/';

        // Ensure directories exist
        if (!is_dir($course_image_dir))
            mkdir($course_image_dir, 0777, true);
        if (!is_dir($syllabus_image_dir))
            mkdir($syllabus_image_dir, 0777, true);

        // Fetch current images from the database
        $query = "SELECT course_image, syllabus_image FROM courses WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $current_images = mysqli_fetch_assoc($result);

        // Validate and handle course image upload
        $course_image_name = $current_images['course_image'];
        if (isset($_FILES['course_image']) && $_FILES['course_image']['error'] == 0) {
            // Validate image format
            $allowed_extensions = ['jpg', 'jpeg', 'png'];
            $file_extension = strtolower(pathinfo($_FILES['course_image']['name'], PATHINFO_EXTENSION));
            $file_size = $_FILES['course_image']['size'];

            if (!in_array($file_extension, $allowed_extensions)) {
                echo "Invalid course image format. Only JPG, JPEG, and PNG are allowed.";
                exit();
            }

            if ($file_size > 2 * 1024 * 1024) { // 2MB
                echo "Course image size must be less than 2MB.";
                exit();
            }

            // Delete old course image if exists
            $old_course_image_path = $course_image_dir . $current_images['course_image'];
            if (file_exists($old_course_image_path)) {
                unlink($old_course_image_path);
            }

            // Upload the new course image
            $course_image_name = basename($_FILES['course_image']['name']);
            $course_image_path = $course_image_dir . $course_image_name;
            if (!move_uploaded_file($_FILES['course_image']['tmp_name'], $course_image_path)) {
                echo "Failed to upload course image.";
                exit();
            }
        }

        // Validate and handle syllabus image upload
        $syllabus_image_name = $current_images['syllabus_image'];
        if (isset($_FILES['syllabus_image']) && $_FILES['syllabus_image']['error'] == 0) {
            // Validate image format
            $allowed_extensions = ['jpg', 'jpeg', 'png'];
            $file_extension = strtolower(pathinfo($_FILES['syllabus_image']['name'], PATHINFO_EXTENSION));
            $file_size = $_FILES['syllabus_image']['size'];

            if (!in_array($file_extension, $allowed_extensions)) {
                echo "Invalid syllabus image format. Only JPG, JPEG, and PNG are allowed.";
                exit();
            }

            if ($file_size > 2 * 1024 * 1024) { // 2MB
                echo "Syllabus image size must be less than 2MB.";
                exit();
            }

            // Delete old syllabus image if exists
            $old_syllabus_image_path = $syllabus_image_dir . $current_images['syllabus_image'];
            if (file_exists($old_syllabus_image_path)) {
                unlink($old_syllabus_image_path);
            }

            // Upload the new syllabus image
            $syllabus_image_name = basename($_FILES['syllabus_image']['name']);
            $syllabus_image_path = $syllabus_image_dir . $syllabus_image_name;
            if (!move_uploaded_file($_FILES['syllabus_image']['tmp_name'], $syllabus_image_path)) {
                echo "Failed to upload syllabus image.";
                exit();
            }
        }

        // Update the form data in the `courses` table
        $sql = "UPDATE courses SET 
            course_title = '$course_title', 
            duration = '$course_duration', 
            intake = '$course_intake', 
            course_description = '$course_description', 
            course_image = '$course_image_name', 
            categories = '$categories', 
            course_objectives = '$course_objectives', 
            syllabus_image = '$syllabus_image_name'
            WHERE id = $id";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            edit_success_message();
        } else {
            edit_failed_message();
        }
    }

    // Fetch current course details for the form
    $sql = "SELECT * FROM courses WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <form class="px-5" action="" method="POST" enctype="multipart/form-data">
                <label for="card-title">Course Title: </label>
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" id="card-title" placeholder="Course Title" name="course_title"
                        value="<?php echo htmlspecialchars($row['course_title']); ?>">
                </div>
                <label for="duration">Course Duration (Year): </label>
                <div class="input-group flex-nowrap">
                    <input type="number" class="form-control" id="duration" placeholder="Course Duration time"
                        name="course_duration" value="<?php echo htmlspecialchars($row['duration']); ?>">
                </div>
                <label for="intake">Course Intake: </label>
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" id="intake" placeholder="Intake" name="course_intake"
                        value="<?php echo htmlspecialchars($row['intake']); ?>">
                </div>
                <div class="form-floating py-3">
                    <select id="country" name="categories" class="form-control col-12">
                        <option value="" disabled>Select Categories</option>
                        <option <?php echo ($row['categories'] == 'Graduate' ? 'selected' : ''); ?> value="Graduate">Graduate</option>
                        <option <?php echo ($row['categories'] == 'Undergraduate' ? 'selected' : ''); ?> value="Undergraduate">Undergraduate</option>
                        <option <?php echo ($row['categories'] == 'Professional' ? 'selected' : ''); ?> value="Professional">Professional</option>
                    </select>
                </div>
                <label for="course_description">Course Description: </label>
                <div class="form-floating">
                    <textarea class="form-control" cols="20" rows="10" placeholder="Leave about Course Description"
                        id="course_description" name="course_description"><?php echo htmlspecialchars($row['course_description']); ?></textarea>
                </div>

                <label for="course_objectives">Course Objectives: </label>
                <div class="form-floating">
                    <textarea class="form-control" cols="20" rows="10" placeholder="Course Objectives" id="course_objectives"
                        name="course_objectives"><?php echo htmlspecialchars($row['course_objectives']); ?></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="input-group mb-3">
                        <label for="course_syllabus">Syllabus Image: </label>
                        <div class="mr-3">
                            <img id="syllabusImage" width="200px" height="200px"
                                src="<?php echo APP_PATH . 'assets/images/courses/syllabus_images/' . $row['syllabus_image']; ?>"
                                alt="<?php echo htmlspecialchars($row['syllabus_image']); ?>">
                            <br>
                            <button type="button" onclick="document.getElementById('imageInput').click();"
                                class="btn btn-secondary mt-2">Change Image</button>
                            <input type="file" id="imageInput" name="syllabus_image" accept="image/*" style="display: none;"
                                onchange="previewSyllabusImage(event)">
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="inputGroupFile02">Course Image/icon: </label>
                        <div class="mr-3">
                            <img id="syllabusThumbnailImage" width="200px" height="200px"
                                src="<?php echo APP_PATH . 'assets/images/courses/course_images/' . $row['course_image']; ?>"
                                alt="<?php echo htmlspecialchars($row['course_image']); ?>">
                            <br>
                            <button type="button" onclick="document.getElementById('imageInputthumb').click();"
                                class="btn btn-secondary mt-2">Change Image</button>
                            <input type="file" id="imageInputthumb" name="course_image" accept="image/*" style="display: none;"
                                onchange="previewThumbnailImage(event)">
                        </div>
                    </div>
                </div>

                <div class="py-3">
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>
            <script>
                function previewSyllabusImage(event) {
                    const reader = new FileReader();
                    reader.onload = function () {
                        const output = document.getElementById('syllabusImage');
                        output.src = reader.result;
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }

                function previewThumbnailImage(event) {
                    const reader = new FileReader();
                    reader.onload = function () {
                        const output = document.getElementById('syllabusThumbnailImage');
                        output.src = reader.result;
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }
            </script>
            <?php
        }
    }
}
