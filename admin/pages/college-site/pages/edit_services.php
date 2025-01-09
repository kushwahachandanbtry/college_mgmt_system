<h3><i>Edit Services</i></h3>

<?php
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];

    include dirname(__DIR__, 4) . '/helpers.php';
    if (isset($_POST['update'])) {

        // Collect form data and sanitize inputs
        $service_title = mysqli_real_escape_string($conn, $_POST['service_title']);
        $service_description = mysqli_real_escape_string($conn, $_POST['service_description']);



        // Insert the service data into the services table
        $sql = "UPDATE services SET service_title = '$service_title', service_description = '$service_description' WHERE id = $id";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            edit_success_message();
        } else {
            edit_failed_message();
        }
    } 



    $sql = "SELECT * FROM services WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <form class="px-5" action="" method="POST" enctype="multipart/form-data">

                <label for="card-title">Service Title: </label>
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" id="card-title" placeholder="Service Title" name="service_title"
                        value="<?php echo htmlspecialchars($row['service_title']); ?>">
                </div>
                <label for="floatingTextareas">Service Description: </label>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a service Description here" id="floatingTextareas"
                        name="service_description"><?php echo htmlspecialchars($row['service_description']); ?></textarea>
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
