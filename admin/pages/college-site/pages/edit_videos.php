<h3><i>Edit Video & Content</i></h3>
<?php

if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];

    include dirname(__DIR__, 4) . '/helpers.php';
    if (isset($_POST['update'])) {

        // Collect form data and sanitize inputs
        $video_heading = mysqli_real_escape_string($conn, $_POST['video_heading']);
        $video_description = mysqli_real_escape_string($conn, $_POST['video_description']);
        $vieo_link = mysqli_real_escape_string($conn, $_POST['video_file']);



        // Insert the video data into the video_and_content table
        $sql = "UPDATE video_and_content SET video_heading = '$video_heading', video_description = '$video_description', video_file = '$vieo_link' WHERE id = $id";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            edit_success_message();
        } else {
            edit_failed_message();
        }
    }


    $sql = "SELECT * FROM video_and_content WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <form class="px-5" action="" method="POST">
                <label for="inputGroupFile02">Insert Video Link: </label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="inputGroupFile02" name="video_file"
                        value="<?php echo htmlspecialchars($row['video_file']); ?>">
                </div>
                <label for="card-title">Heading of Video: </label>
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" id="card-title" placeholder="Heading of Video" name="video_heading"
                        value="<?php echo htmlspecialchars($row['video_heading']); ?>">
                </div>
                <label for="floatingTextarea">Video Description: </label>
                <div class="form-floating">
                    <textarea class="form-control" rows="7" placeholder="Video Description" id="floatingTextarea"
                        name="video_description"><?php echo htmlspecialchars($row['video_description']); ?></textarea>
                </div>

                <div class="py-3">
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>
            <?php
        }
    }


}
