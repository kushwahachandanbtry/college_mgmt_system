<?php
if (isset($_GET['id'])) {

    // include "go_back.php";
    include dirname(__DIR__, 2). '/config.php';
    include "../helpers.php";

    $id = $_GET['id'];


    if ( isset( $_POST['update'] ) ) {
        // assign in all variable null data
        $tname = $gender = $time = $email = $address = $classes = $sections = $Phone = '';
    
    
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
    
        $classes = check_input( $_POST['classes'] );
    
        $errors = array(); // assign all errors in this array

    
        // check error field is empty or have some error
        if ( ! empty( $errors ) ) {
            foreach ( $errors as $error ) {
                echo $error;
            }
        }
    
    
        // Error field is emtpty the insert valid data
        if ( empty( $errors ) ) {
    
            // print_r( $conn );
            $sql = "UPDATE classes SET classes = '{$classes}' WHERE id = '{$id}'";
    
    
    
            $result = mysqli_query( $conn, $sql );
            if ( $result ) {    
                edit_success_message();
            } else {
                edit_failed_message();
            }
        }
    }

    go_back('item15');

    $sql = "SELECT * FROM classes WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>

<div class="adminssion-form py-5 px-5" style="background:#FFFFFF;">
    <form action="" method="POST" enctype="multipart/form-data">
        <h5>Edit Class <button onclick="goBack();" class="btn btn-info ml-5">Go Back</button></h5>
        <div class="d-flex py-3">

        <div class="">
                <lable>Class Name *</lable>
                <input type="text"  name="classes" value="<?php echo $row['classes']; ?>" aria-label="First name" class="form-control py-2 px-4">
            </div>
        </div>
       
        <div>
            <button type="submit" name="update">Update</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</div>

<?php }
    }
} ?>
