<style>
    input, textarea, select, button {
  font-family: "Muli-Regular";
  color: #333;
  font-size: 13px; }

p, h1, h2, h3, h4, h5, h6, ul {
  margin: 0; }

img {
  max-width: 100%; }

ul {
  padding-left: 0;
  margin-bottom: 0; }

a:hover {
  text-decoration: none; }

:focus {
  outline: none; }

.wrapper {
  min-height: 100vh;
  background-size: cover;
  background-repeat: no-repeat;
  display: flex;
  align-items: center; }

.inner {
  min-width: 850px;
  height: 1500px;
  margin: auto;
  padding-top: 68px;
  padding-bottom: 48px;
  background: url("assets/img/registration-form-2.jpg"); 
background-repeat: no-repeat;
}
  .inner h3 {
    text-transform: uppercase;
    font-size: 22px;
    font-family: "Muli-Bold";
    text-align: center;
    margin-bottom: 32px;
    color: #333;
    letter-spacing: 2px; }

form {
  width: 50%;
  padding-left: 45px; }

.form-group {
  display: flex; }
  .form-group .form-wrapper {
    width: 50%; }
    .form-group .form-wrapper:first-child {
      margin-right: 20px; }

.form-wrapper {
  margin-bottom: 17px; }
  .form-wrapper label {
    margin-bottom: 9px;
    display: block; }

.form-control {
  border: 1px solid #ccc;
  display: block;
  width: 100%;
  height: 40px;
  padding: 0 20px;
  border-radius: 20px;
  font-family: "Muli-Bold";
  background: none; }
  .form-control:focus {
    border: 1px solid #ae3c33; }

select {
  -moz-appearance: none;
  -webkit-appearance: none;
  cursor: pointer;
  padding-left: 20px; }
  select option[value=""][disabled] {
    display: none; }

button {
  border: none;
  width: 152px;
  height: 40px;
  margin: auto;
  margin-top: 29px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0;
  background: #ae3c33;
  font-size: 13px;
  color: #fff;
  text-transform: uppercase;
  font-family: "Muli-SemiBold";
  border-radius: 20px;
  overflow: hidden;
  -webkit-transform: perspective(1px) translateZ(0);
  transform: perspective(1px) translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  position: relative;
  -webkit-transition-property: color;
  transition-property: color;
  -webkit-transition-duration: 0.5s;
  transition-duration: 0.5s; }
  button:before {
    content: "";
    position: absolute;
    z-index: -1;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #f11a09;
    -webkit-transform: scaleX(0);
    transform: scaleX(0);
    -webkit-transform-origin: 0 50%;
    transform-origin: 0 50%;
    -webkit-transition-property: transform;
    transition-property: transform;
    -webkit-transition-duration: 0.5s;
    transition-duration: 0.5s;
    -webkit-transition-timing-function: ease-out;
    transition-timing-function: ease-out; }
  button:hover:before {
    -webkit-transform: scaleX(1);
    transform: scaleX(1);
    -webkit-transition-timing-function: cubic-bezier(0.52, 1.64, 0.37, 0.66);
    transition-timing-function: cubic-bezier(0.52, 1.64, 0.37, 0.66); }

.checkbox {
  position: relative; }
  .checkbox label {
    padding-left: 22px;
    cursor: pointer; }
  .checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer; }
  .checkbox input:checked ~ .checkmark:after {
    display: block; }

.checkmark {
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  height: 12px;
  width: 13px;
  border-radius: 2px;
  background-color: #ebebeb;
  border: 1px solid #ccc;
  font-family: Material-Design-Iconic-Font;
  color: #000;
  font-size: 10px;
  font-weight: bolder; }
  .checkmark:after {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none;
    content: '\f26b'; }

@media (max-width: 991px) {
  .inner {
    min-width: 768px; } }
@media (max-width: 767px) {
  .inner {
    min-width: auto;
    background: none;
    padding-top: 0;
    padding-bottom: 0; }

  form {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px; } }
</style>

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
<div class="wrapper" style="background-image: url('assets/img/bg-registration-form-2.jpg');">
			<div class="inner">
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
					<h3>Registration Form</h3>
					<div class="form-group">
						<div class="form-wrapper">
							<label for="">First Name *</label>
							<input type="text" required value="<?php echo htmlspecialchars($fname ?? '', ENT_QUOTES, 'UTF-8'); ?>" name="fname" class="form-control">
						</div>
                        <span style="color: red;"><?= $errors['fname'] ?? '' ?></span>

                        <div class="form-wrapper">
							<label for="">Middle Name</label>
							<input type="text" name="mname" value="<?php echo htmlspecialchars($mname ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
						</div>
						
					</div>
                    
                    <div class="form-group">
						<div class="form-wrapper">
							<label for="">Last Name</label>
							<input type="text" name="lname" required value="<?php echo htmlspecialchars($lname ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
						</div>
                        <span style="color: red;"><?= $errors['lname'] ?? '' ?></span>

                        <div class="form-wrapper">
							<label for="">Phone Number</label>
							<input type="number" name="pnumber" required value="<?php echo htmlspecialchars($phnumber ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
						</div>
                        <span style="color: red;"><?= $errors['pnumber'] ?? '' ?></span>
						
					</div>
                    <div class="form-group">
						<div class="form-wrapper">
							<label for="">Father Name</label>
							<input type="text" name="fathername" value="<?php echo htmlspecialchars($fathername ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
						</div>
                        <div class="form-wrapper">
							<label for="">Permanent Address</label>
							<input type="text" name="paddress" required value="<?php echo htmlspecialchars($paddress ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
						</div>
                        <span style="color: red;"><?= $errors['address'] ?? '' ?></span>
						
					</div>
                    <div class="form-group">
						<div class="form-wrapper">
							<label for="">Gender</label>
							<input type="radio" name="gender" value="male" required <?php echo isset($gender) && $gender == 'male' ? 'checked' : ''; ?>><span>Male</span>
                            <input type="radio" name="gender" value="female" required <?php echo isset($gender) && $gender == 'female' ? 'checked' : ''; ?>><span>Female</span>
						</div>
                        <span style="color: red;"><?= $errors['gender'] ?? '' ?></span>
                        <div class="form-wrapper">
							<label for="">Courses</label>
							<select class="form-select" name="cource">
                    <option disabled>Select Your Cources</option>
                    <option value="BCA" <?php echo isset($cources) && $cources == 'BCA' ? 'selected' : ''; ?>>BCA</option>
                    <option value="BHM" <?php echo isset($cources) && $cources == 'BHM' ? 'selected' : ''; ?>>BHM</option>
                    <option value="BBA" <?php echo isset($cources) && $cources == 'BBA' ? 'selected' : ''; ?>>BBA</option>
                    <option value="MBA" <?php echo isset($cources) && $cources == 'MBA' ? 'selected' : ''; ?>>MBA</option>
                    <option value="ARTS" <?php echo isset($cources) && $cources == 'ARTS' ? 'selected' : ''; ?>>ARTS</option>
                </select></br>
                <span style="color: red;"><?= $errors['course'] ?? '' ?></span>
						</div>
						
					</div>
					<div class="form-wrapper">
						<label for="">Email</label>
						<input type="email" name="email" required value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="form-control">
					</div>
                    <span style="color: red;"><?= $errors['email'] ?? '' ?></span>

					<div class="form-wrapper">
						<label for="">Password</label>
						<input type="password" name="pass" required class="form-control">
					</div>
                    <span style="color: red;"><?= $errors['password'] ?? '' ?></span>
					
					<div class="checkbox">
						<label>
							<input type="checkbox"> I caccept the Terms of Use & Privacy Policy.
							<span class="checkmark"></span>
						</label>
					</div>
					<button name="submit" type="submit">Register Now</button>
				</form>
			</div>
		</div>
