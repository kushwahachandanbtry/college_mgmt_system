<?php
include dirname(__DIR__, 2). '/config.php';
if (isset($_GET['id'])) {

    // include "go_back.php";
    include "../helpers.php";

    $id = $_GET['id'];


    if ( isset( $_POST['update'] ) ) {
        // assign in all variable null data
        $title = $details = $posted_by = $date = '';
    
    
        /**
         * Remove all tags and scripts and return as a string
         *
         * @param [any] $data
         * @return string
         */
        function check_input( $data ) {
            $data = trim( $data );
            $data = stripslashes( $data );
            $data = htmlspecialchars( $data );
            return $data;
        }
    
        $title = check_input( $_POST['title'] );
    
        $details = check_input( $_POST['details'] );
    
        $posted_by = check_input( $_POST['posted_by'] );
    
        $date = check_input( $_POST['date'] );
    
        $errors = []; // assign all errors in this array
    
        // check error field is empty or have some error
        if ( ! empty( $errors ) ) {
            foreach ( $errors as $error ) {
                echo $error;
            }
        }
    
    
        // Error field is emtpty the insert valid data
        if ( empty( $errors ) ) {
            $sql = "UPDATE notice SET title = '{$title}', details = '{$details}', posted_by = '{$posted_by}', date = '{$date}' WHERE id = '{$id}'";
    
    
            $result = mysqli_query( $conn, $sql );
            if ( $result ) {
                edit_success_message();
            } else {
                edit_failed_message();
            }
        }
    }

    go_back('all_notice');

    $sql = "SELECT * FROM notice WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>

<div class="container-fluid py-5">
    <div class="row">
        <div class="col-lg-12 py-4" style="background-color: #FFF;">
            
            <form method="POST" action="">
                <h5>Edit Notice <button onclick="goBack();" class="btn btn-info ml-5">Go Back</button></h5>
                <div class="">
                    <lable>Title </lable>
                    <input style="background-color: #F0F1F3" type="text" name="title" aria-label="Subject name"
                        class="form-control py-2 px-4" value="<?php echo htmlspecialchars($row['title']);  ?>">
                </div>
                <div class="py-4">
                    <lable>Details</lable><br>
                    <textarea class="py-2 px-2"  name="details" id="" style="width: 100%;" rows="10"><?php echo htmlspecialchars($row['details']) ;?></textarea>
                </div>
                <div class="py-4">
                    <lable>Posted By</lable><br>
                    <input value="<?php echo htmlspecialchars($row['posted_by']);  ?>" style="background-color: #F0F1F3" type="text" name="posted_by" 
                        aria-label="Posted by" class="form-control py-2 px-4">

                </div>
                <div class="py-4">
                    <lable>Date</lable><br>
                    <?php
                    date_default_timezone_set('Asia/Kathmandu');
                    ?>
                    <input style="background-color: #F0F1F3" value="<?php echo htmlspecialchars($row['date']); ?>"
                        type="text" readonly name="date" aria-label="Date" class="form-control py-2 px-4">


                </div>
                <div class="class-routine">
                    <button class="py-2 px-4"
                        style="background-color: #0D6EFD; color: #fff; border:none; cursor:pointer;" type="submit"
                        name="update">Update</button>
                    <button class="py-2 px-4"
                        style="background-color: #042954; color: #fff; border:  none; cursor: pointer"
                        type="reset">Reset</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php }
    }
} ?>
