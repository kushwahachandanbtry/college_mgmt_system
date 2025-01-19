<?php
/**
 * This file is used to register users
 *
 * @package college-management-system
 */

/**
 * Requiring header and menu page
 */

// Decode errors from the query string
$errors = [];
$message = '';
if (isset($_POST['submit'])) {
    include dirname(__DIR__, 2) . '/config.php';

    // Trim and sanitize inputs
    $fname = trim($_POST['fname']);
    $mname = trim($_POST['mname']);
    $lname = trim($_POST['lname']);
    $phnumber = trim($_POST['pnumber']);
    $fathername = trim($_POST['fathername']);
    $email = trim($_POST['email']);
    $pass = $_POST['pass'];
    $cources = trim($_POST['cource']);
    $gender = trim($_POST['gender']);
    $paddress = trim($_POST['paddress']);

    // Validation and displaying the first error encountered
    if (empty($fname)) {
        $errors['fname'] = "First name is required.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
        $errors['fname'] = "First name should only contain letters and spaces.";
    }

    if (empty($lname) && empty($errors)) {
        $errors['lname'] = "Last name is required.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lname) && empty($errors)) {
        $errors['lname'] = "Last name should only contain letters and spaces.";
    }

    if (empty($phnumber) && empty($errors)) {
        $errors['phnumber'] = "Phone number is required.";
    } elseif (!preg_match("/^[0-9]{10}$/", $phnumber) && empty($errors)) {
        $errors['phnumber'] = "Phone number must be a 10-digit number.";
    }

    if (empty($email) && empty($errors)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && empty($errors)) {
        $errors['email'] = "Invalid email format.";
    }

    if (empty($pass) && empty($errors)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($pass) < 8 && empty($errors)) {
        $errors['password'] = "Password must be at least 8 characters long.";
    }

    if (empty($cources) && empty($errors)) {
        $errors['course'] = "Course is required.";
    }

    if (empty($gender) && empty($errors)) {
        $errors['gender'] = "Gender is required.";
    }

    if (empty($paddress) && empty($errors)) {
        $errors['address'] = "Permanent address is required.";
    }

    // Sanitizing inputs and escaping data for database insertion
    $fname = mysqli_real_escape_string($conn, htmlspecialchars($fname, ENT_QUOTES, 'UTF-8'));
    $mname = mysqli_real_escape_string($conn, htmlspecialchars($mname, ENT_QUOTES, 'UTF-8'));
    $lname = mysqli_real_escape_string($conn, htmlspecialchars($lname, ENT_QUOTES, 'UTF-8'));
    $phnumber = mysqli_real_escape_string($conn, htmlspecialchars($phnumber, ENT_QUOTES, 'UTF-8'));
    $fathername = mysqli_real_escape_string($conn, htmlspecialchars($fathername, ENT_QUOTES, 'UTF-8'));
    $email = mysqli_real_escape_string($conn, htmlspecialchars($email, ENT_QUOTES, 'UTF-8'));
    $cources = mysqli_real_escape_string($conn, htmlspecialchars($cources, ENT_QUOTES, 'UTF-8'));
    $gender = mysqli_real_escape_string($conn, htmlspecialchars($gender, ENT_QUOTES, 'UTF-8'));
    $paddress = mysqli_real_escape_string($conn, htmlspecialchars($paddress, ENT_QUOTES, 'UTF-8'));

    // Hash the password before saving it
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Insert into the database
    $sql = "INSERT INTO registered_users (fname, mname, lname, phone, fathername, email, password, course, gender, address)
        VALUES ('$fname', '$mname', '$lname', '$phnumber', '$fathername', '$email', '$hashed_pass', '$cources', '$gender', '$paddress')";

    if (mysqli_query($conn, $sql)) {
        $message = 'Registration successful!';
    } else {
        echo "<div class='alert alert-danger'>Data submission failed due to an error!</div>";
    }
}

?>

<!-- New register student form -->
<div class="studentForm py-5" style="background-color: #FFC6C5">
    <div class="new-studentRegister-form show-form py-5 px-5">
        <div class="container py-5 px-5" style="background-color: #FFF; width: 60%;">
            <h1 class="text-center">Registration Form</h1>
            <?php if( !empty( $errors ) && is_array( $errors ) ) {
                foreach( $errors as $error ) {
                    ?>
                    <div class='alert alert-danger'><?php echo htmlspecialchars( $error ); ?></div>
                    <?php 
                }
            } 
            if( !empty( $message )) {
                ?>
                <div class='alert alert-success'><?php echo htmlspecialchars( $message ); ?></div>
                <?php 
            }
            ?>
            <form action="" method="POST">
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">First Name *</span>
                    <input type="text" class="form-control" name="fname" placeholder="First Name" aria-label=""
                        aria-describedby="addon-wrapping" value="<?php echo htmlspecialchars($fname ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <span style="color: red;"><?= $errors['fname'] ?? '' ?></span>
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Middle Name</span>
                    <input type="text" class="form-control" name="mname" placeholder="Middle Name" aria-label="mname"
                        aria-describedby="addon-wrapping" value="<?php echo htmlspecialchars($mname ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Last Name *</span>
                    <input type="text" class="form-control" name="lname" placeholder="Last Name" aria-label="lname"
                        aria-describedby="addon-wrapping" required value="<?php echo htmlspecialchars($lname ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <span style="color: red;"><?= $errors['lname'] ?? '' ?></span>
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Phone Number *</span>
                    <input type="number" class="form-control" name="pnumber" placeholder="Phone Number"
                        aria-label="pnumber" aria-describedby="addon-wrapping" required value="<?php echo htmlspecialchars($phnumber ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <span style="color: red;"><?= $errors['pnumber'] ?? '' ?></span>
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Email *</span>
                    <input type="email" class="form-control" name="email" placeholder="Email" aria-label="email"
                        aria-describedby="addon-wrapping" required value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <span style="color: red;"><?= $errors['email'] ?? '' ?></span>
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Password *</span>
                    <input type="password" class="form-control" name="pass" placeholder="Password" aria-label="password"
                        aria-describedby="addon-wrapping" required>
                </div>
                <span style="color: red;"><?= $errors['password'] ?? '' ?></span>
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Father Name</span>
                    <input type="text" class="form-control" name="fathername" placeholder="Father Name"
                        aria-label="fname" aria-describedby="addon-wrapping" value="<?php echo htmlspecialchars($fathername ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Permanenet Address *</span>
                    <input type="text" class="form-control" name="paddress" placeholder="Permanenet Address"
                        aria-label="password" aria-describedby="addon-wrapping" required value="<?php echo htmlspecialchars($paddress ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <span style="color: red;"><?= $errors['address'] ?? '' ?></span>
                <div class="gender">
                    <label>Gender *</label>
                    <input type="radio" name="gender" value="male" required <?php echo isset($gender) && $gender == 'male' ? 'checked' : ''; ?>><span>Male</span>
                    <input type="radio" name="gender" value="female" required <?php echo isset($gender) && $gender == 'female' ? 'checked' : ''; ?>><span>Female</span>
                    <input type="radio" name="gender" value="others" required <?php echo isset($gender) && $gender == 'others' ? 'checked' : ''; ?>><span>Others</span>
                </div>
                <span style="color: red;"><?= $errors['gender'] ?? '' ?></span>
                <select class="form-select" name="cource">
                    <option disabled>Select Your Cources</option>
                    <option value="BCA" <?php echo isset($cources) && $cources == 'BCA' ? 'selected' : ''; ?>>BCA</option>
                    <option value="BHM" <?php echo isset($cources) && $cources == 'BHM' ? 'selected' : ''; ?>>BHM</option>
                    <option value="BBA" <?php echo isset($cources) && $cources == 'BBA' ? 'selected' : ''; ?>>BBA</option>
                    <option value="MBA" <?php echo isset($cources) && $cources == 'MBA' ? 'selected' : ''; ?>>MBA</option>
                    <option value="ARTS" <?php echo isset($cources) && $cources == 'ARTS' ? 'selected' : ''; ?>>ARTS</option>
                </select></br>
                <span style="color: red;"><?= $errors['course'] ?? '' ?></span>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" name="submit" type="submit">SUBMIT</button>
                </div>
            </form>
            <!-- /New register student form -->

        </div>
    </div>
</div>
