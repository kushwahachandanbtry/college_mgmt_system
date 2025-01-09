<h3><i>Edi FAQ</i></h3>
<?php
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
if (isset($_POST['update'])) {
    include dirname(__DIR__, 4). '/helpers.php';

    // Collect form data and sanitize inputs
    $FAQ_title = mysqli_real_escape_string($conn, $_POST['FAQ_title']);
    $FAQ_description = mysqli_real_escape_string($conn, $_POST['FAQ_description']);




    // Insert the service data into the services table
    $sql = "UPDATE faq SET FAQ_title ='$FAQ_title' , FAQ_description = '$FAQ_description' WHERE id = $id";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        edit_success_message();
    } else {
        edit_failed_message();
    }
}



    $sql = "SELECT * FROM faq WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <form class="px-5" action="" method="POST" enctype="">

                <label for="card-title">FAQ Title: </label>
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" id="card-title" value="<?php echo $row['FAQ_title'] ?>"
                        placeholder="FAQ Title" name="FAQ_title">
                </div>
                <label for="floatingTextareas">FAQ Description: </label>
                <div class="form-floating">
                    <textarea cols="30" rows="8" class="form-control" placeholder="Leave a FAQ description here"
                        id="floatingTextareas" name="FAQ_description"><?php echo $row['FAQ_description'] ?></textarea>
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



