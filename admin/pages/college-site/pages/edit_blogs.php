<h3><i>Edit Blogs</i></h3>
<?php
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];

    if (isset($_POST['update'])) {
        include dirname(__DIR__, 4) . '/helpers.php';

        // Collect form data and sanitize inputs
        $heading = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        // Retrieve the old image
        $sql = "SELECT image FROM blogs WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $old_image = '';
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $old_image = $row['image'];
        }

        // Handling the image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Validate image file format and size
            $allowed_extensions = ['jpg', 'jpeg', 'png'];
            $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $file_size = $_FILES['image']['size'];

            // Check if file extension is allowed
            if (!in_array($file_extension, $allowed_extensions)) {
                echo "Invalid file format. Only JPG, JPEG, and PNG are allowed.";
                exit();
            }

            // Check if file size is less than 2MB (2 * 1024 * 1024 bytes)
            if ($file_size > 2 * 1024 * 1024) {
                echo "Image size must be less than 2MB.";
                exit();
            }

            // Define the upload directory
            $upload_dir = dirname(__DIR__, 4) . '/assets/images/blogs/';
            $file_name = basename($_FILES['image']['name']);
            $file_path = $upload_dir . $file_name;

            // Check if the directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Create directory if not exists
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
                $image_path_db = $file_name; // relative path for storing in DB
                $sql = "UPDATE blogs 
                        SET heading = '$heading', 
                            overview = '$description',
                            image = '$image_path_db' 
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
            $sql = "UPDATE blogs 
                    SET heading = '$heading', 
                        overview = '$description' 
                    WHERE id = $id";

            if (mysqli_query($conn, $sql)) {
                edit_success_message();
            } else {
                edit_failed_message();
            }
        }
    }

    // Retrieve the feature data to populate the form
    $sql = "SELECT * FROM blogs WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <form class="px-5" action="" method="POST" enctype="multipart/form-data">
    <label for="card-title">Heading: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="card-title" placeholder="Heading" name="name" value="<?php echo htmlspecialchars($row['heading']); ?>">
    </div>

    <label for="editor">Description: </label>
    <!-- Toolbar for the text editor -->
    <div class="editor-toolbar py-2">
        <button type="button" onclick="formatText('bold')" title="Bold"><b>B</b></button>
        <button type="button" onclick="formatText('italic')" title="Italic"><i>I</i></button>
        <button type="button" onclick="formatText('underline')" title="Underline"><u>U</u></button>
        <button type="button" onclick="formatText('insertUnorderedList')" title="Bullet List">• List</button>
        <button type="button" onclick="formatText('insertOrderedList')" title="Numbered List">1. List</button>
        <button type="button" onclick="addTable()" title="Table">Table</button>
        <button type="button" onclick="formatText('formatBlock', 'H1')" title="Heading 1">H1</button>
        <button type="button" onclick="formatText('formatBlock', 'H2')" title="Heading 2">H2</button>
        <button type="button" onclick="formatText('formatBlock', 'H3')" title="Heading 3">H3</button>
        <button type="button" onclick="formatText('formatBlock', 'H4')" title="Heading 4">H4</button>
        <button type="button" onclick="formatText('formatBlock', 'H5')" title="Heading 5">H5</button>
        <button type="button" onclick="formatText('formatBlock', 'H6')" title="Heading 6">H6</button>
    </div>

    <!-- Editable content area -->
    <div id="editor" contenteditable="true" class="form-control" 
        style="min-height: 200px; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <?php echo htmlspecialchars_decode($row['overview']); ?>
    </div>

    <!-- Hidden textarea to store editor content -->
    <textarea name="description" placeholder="Leave description here..." id="hiddenOverview" style="display: none;" required><?php echo $row['overview']; ?></textarea>

    <label for="inputGroupFile02">Featured Image: </label>
    <div class="mr-3">
                        <img id="blogImagePreview" width="200px" height="200px"
                            src="<?php echo APP_PATH . 'assets/images/blogs/' . $row['image']; ?>" alt="Blog Image">
                        <br>
                        <button type="button" onclick="document.getElementById('imageInput').click();"
                            class="btn btn-secondary mt-2">Change Image</button>
                        <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;"
                            onchange="previewImage(event)">
                    </div>

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="update" onclick="syncEditorContent()">Update</button>
        <button type="reset" class="btn btn-danger" onclick="resetEditor()">Reset</button>
    </div>
</form>
            <script>
                function previewImage(event) {
                    const reader = new FileReader();
                    reader.onload = function () {
                        const output = document.getElementById('blogImagePreview');
                        output.src = reader.result;
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }
            </script>
            <?php
        }
    }
}
