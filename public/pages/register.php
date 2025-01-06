<?php
/**
 * This file is used to register users
 *
 * @package college-management-system
 */

/**
 * Requiring header and menu page
 */
require '../includes/menu.php';

// Decode errors from the query string
$errors = [];
if (isset($_GET['errors'])) {
    $errors = json_decode($_GET['errors'], true);
}
?>

<!-- New register student form -->
<div class="studentForm  mt-5 py-5" style="background-color: #FFC6C5">
    <div class="new-studentRegister-form show-form py-5 px-5">
        <div class="container py-5 px-5" style="background-color: #FFF; width: 60%;">
            <h1 class="text-center">Registration Form</h1>

            <form action="../actions/register.php" method="POST">
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">First Name *</span>
                    <input type="text" class="form-control" name="fname" placeholder="First Name" aria-label=""
                        aria-describedby="addon-wrapping">
                </div>
                <span style="color: red;"><?= $errors['fname'] ?? '' ?></span>
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Middle Name</span>
                    <input type="text" class="form-control" name="mname" placeholder="Middle Name" aria-label="mname"
                        aria-describedby="addon-wrapping">
                </div>
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Last Name *</span>
                    <input type="text" class="form-control" name="lname" placeholder="Last Name" aria-label="lname"
                        aria-describedby="addon-wrapping" required>
                </div>
                <span style="color: red;"><?= $errors['lname'] ?? '' ?></span>
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Phone Number *</span>
                    <input type="number" class="form-control" name="pnumber" placeholder="Phone Number"
                        aria-label="pnumber" aria-describedby="addon-wrapping" required>
                </div>
                <span style="color: red;"><?= $errors['pnumber'] ?? '' ?></span>
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Email *</span>
                    <input type="email" class="form-control" name="email" placeholder="Email" aria-label="email"
                        aria-describedby="addon-wrapping" required>
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
                        aria-label="fname" aria-describedby="addon-wrapping">
                </div>
                <div class="input-group py-2 flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Permanenet Address *</span>
                    <input type="text" class="form-control" name="paddress" placeholder="Permanenet Address"
                        aria-label="password" aria-describedby="addon-wrapping" required>
                </div>
                <span style="color: red;"><?= $errors['address'] ?? '' ?></span>
                <div class="gender">
                    <label>Gender *</label>
                    <input type="radio" name="gender" value="male" required><span>Male</span>
                    <input type="radio" name="gender" value="female" required><span>Female</span>
                    <input type="radio" name="gender" value="others" required><span>Others</span>
                </div>
                <span style="color: red;"><?= $errors['gender'] ?? '' ?></span>
                <select class="form-select" name="cource">
                    <option disabled>Select Your Cources</option>
                    <option value="BCA">BCA</option>
                    <option value="BHM">BHM</option>
                    <option value="BBA">BBA</option>
                    <option value="MBA">MBA</option>
                    <option value="ARTS">ARTS</option>
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

<?php
require '../includes/footer.php';
?>

