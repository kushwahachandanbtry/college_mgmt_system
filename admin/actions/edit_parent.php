<?php
if (isset($_GET['id'])) {

    // include "go_back.php";
    include dirname(__DIR__, 2). '/config.php';
    include "../helpers.php";

    $id = $_GET['id'];


    if ( isset( $_POST['update'] ) ) {
        // assign in all variable null data
        $name = $gender = $occupation = $email = $address = $number = $childerns_name = '';
    
    
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
    
        $name = check_input( $_POST['name'] );
    
        $gender = check_input( $_POST['gender'] );
    
        $occupation = check_input( $_POST['occupation'] );
    
        $email = check_input( $_POST['email'] );
    
        $address = check_input( $_POST['address'] );
    
        $number = check_input( $_POST['Phone'] );
    
        $childerns_name = check_input( $_POST['chName'] );
    
        $errors = array(); // assign all errors in this array
    
    
        // check valid email or not
        if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
            $errors[] = 'Please Enter Valid Email.';
        }
    
    
        // check error field is empty or have some error
        if ( ! empty( $errors ) ) {
            foreach ( $errors as $error ) {
                echo $error;
            }
        }
    
    
        // Error field is emtpty the insert valid data
        if ( empty( $errors ) ) {
    
            
            $sql = "UPDATE parents SET name = '{$name}', gender = '{$gender}', occupation = '{$occupation}', email = '{$email}',
            address = '{$address}', phone = '{$number}', childrens_name = '{$childerns_name}' WHERE id = '{$id}' ";
    
            $result = mysqli_query( $conn, $sql );
            if ( $result ) {
                edit_success_message();
            } else {
                edit_failed_message();
            }
        }
    }

    go_back('item7');

    $sql = "SELECT * FROM parents WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>

<div class="adminssion-form py-5 px-5" style="background:#FFFFFF;">
    <form action="" method="POST" enctype="multipart/form-data">
        <h5>Edit Parent <button onclick="goBack();" class="btn btn-info ml-5">Go Back</button></h5>
        <div class="d-flex py-3">
            <div class="">
                <lable>Name *</lable>
                <input type="text" value="<?php echo $row['name']; ?>" name="name" aria-label="First name" class="form-control py-2 px-4">
            </div>
            <div class="mx-5">
                <lable>Gender *</lable><br>
                <input <?php echo $row['gender'] == 'male' ? 'checked' : ''; ?> value="male" type="radio" name="gender" id="">Male
                <input <?php echo $row['gender'] == 'female' ? 'checked' : ''; ?> value="female" type="radio" name="gender" id="">Female
                <input <?php echo $row['gender'] == 'others' ? 'checked' : ''; ?> value="others" type="radio" name="gender" id="">Others
            </div>
            <div class="mx-5">
                <lable>Occupation *</lable>
                <input type="text" value="<?php echo $row['occupation']; ?>" name="occupation" aria-label="First name" class="form-control py-2 px-4">
            </div>
        </div>
        <div class="d-flex py-3">
        
            <div class="">
                <lable>Email *</lable>
                <input type="email" value="<?php echo $row['email']; ?>" name="email" aria-label="email" class="form-control py-2 px-1">
            </div>
            <div class="mx-5">
                <lable>Address *</lable>
                <input type="text" value="<?php echo $row['address']; ?>" name="address" aria-label="admission id" class="form-control py-2 px-4">
            </div>
            <div class="mx-5">
                <lable>Phone *</lable>
                <input type="number" value="<?php echo $row['phone']; ?>" name="Phone" aria-label="phone" class="form-control py-2 px-1">
            </div>
        </div>
        <div class="d-flex py-3">
            
            
            <div class="">
                <lable>His/her Children's Name *</lable>
                <input type="text" value="<?php echo $row['childrens_name']; ?>" name="chName" aria-label="First name" class="form-control py-2 px-4">
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
