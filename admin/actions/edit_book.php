<?php
include dirname(__DIR__, 2). '/config.php';
if (isset($_GET['id'])) {

    // include "go_back.php";
    include "../helpers.php";

    $id = $_GET['id'];


    if ( isset( $_POST['update'] ) ) {
        // assign in all variable null data
        $bname = $wname = $class = $pubdate = $book_id = $uploade = '';
    
    
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
    
        $bname = check_input( $_POST['bname'] );
    
        $wname = check_input( $_POST['wname'] );
    
        $class = check_input( $_POST['class'] );
    
        $pubdate = check_input( $_POST['pubdate'] );
    
        $book_id = check_input( $_POST['book-id'] );
    
        $uploade = check_input( $_POST['uploade'] );
    
        $errors = array(); // assign all errors in this array
    
        // check error field is empty or have some error
        if ( ! empty( $errors ) ) {
            foreach ( $errors as $error ) {
                echo $error;
            }
        }
    
    
        // Error field is emtpty the insert valid data
        if ( empty( $errors ) ) {
            include_once 'config.php';
    
            
            $sql = "UPDATE books SET bname = '{$bname}', wname = '{$wname}', class = '{$class}', pubdate = '{$pubdate}',
            book_id = '{$book_id}', uploade = '{$uploade}' WHERE id = '{$id}'";
    
    
            $result = mysqli_query( $conn, $sql );
            if ( $result ) {
                edit_success_message();
            } else {
                edit_failed_message();
            }
        }
    }

    go_back('item10');

    $sql = "SELECT * FROM books WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>

<div class="adminssion-form py-5 px-5" style="background:#FFFFFF;">
    <form action="" method="POST">
        <h5>Edit Book <button onclick="goBack();" class="btn btn-info ml-5">Go Back</button></h5>
        <div class="d-flex py-3">
            <div class="">
                <lable>Book Name *</lable>
                <input type="text" value="<?php echo $row['bname'];  ?>"  name="bname" aria-label="Book name" class="form-control py-2 px-4">
            </div>
            <div class="mx-5">
                <lable>Writer Name *</lable>
                <input type="text" value="<?php echo $row['wname'];  ?>" name="wname" aria-label="Writer name" class="form-control  py-2 px-4">
            </div>
            <div class="">
                <lable>Class *</lable><br>
                <select name="class"  class="border border-light rounded py-2 px-4" aria-label="Default select example">
                    <option class="text-light">Select Your Class*</option>
                    <option <?php echo $row['class'] == 'BBA' ? 'selected' : ''; ?> value="BBA">BBA</option>
                    <option <?php echo $row['class'] == 'BCA' ? 'selected' : ''; ?> value="BCA">BCA</option>
                    <option <?php echo $row['class'] == 'BHM' ? 'selected' : ''; ?> value="BGM">BHM</option>
                    <option <?php echo $row['class'] == 'MBA' ? 'selected' : ''; ?> value="MBA">MBA</option>
                    <option <?php echo $row['class'] == 'Finance' ? 'selected' : ''; ?> value="Finance">Finance</option>
                </select>
            </div>
            <div class="mx-5">
                <lable>Published Date *</lable>
                <input type="pdate" value="<?php echo $row['pubdate'];  ?>"  name="pubdate" aria-label="published date" class="form-control py-2 px-4">
            </div>
        </div>
        
        <div class="d-flex py-3">
            <div class="">
                <lable>ID NO *</lable>
                <input type="text" value="<?php echo $row['book_id'];  ?>"  name="book-id" aria-label="book id" class="form-control py-2 px-4">
            </div>
            <div class="mx-5">
            <lable class="mx-3">Upload Date</lable><br>
            <input type="text" value="<?php echo $row['uploade'];  ?>"  name="uploade" aria-label="upload date" class="form-control py-2 px-4">
                </select>
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
