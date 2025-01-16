<?php

include_once 'templates/header.php';
include_once '../FetchDataController.php';
include_once '../constant.php';


$error = ""; // Initialize an empty error message
session_start();
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['login'])) {

        $current_user = mysqli_real_escape_string($conn, $_POST['email']);
        $admin_passwords = mysqli_real_escape_string($conn, md5($_POST['password']));
        $current_password = mysqli_real_escape_string($conn, $_POST['password']);


        // Fetch user info from the database
        $query = "SELECT userid, email, password, role, username FROM users WHERE email = '$current_user' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password

            if ($current_user === $user['email'] && $admin_passwords === $user['password']) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['name'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['userid'] = $user['userid'];
                header("Location: " . APP_PATH . "admin/dashboard.php");
                exit();
            }

            if ($current_password == $user['password']) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['username'];
                $_SESSION['userid'] = $user['userid'];

                // Redirect to dashboard
                header("Location: " . APP_PATH . "admin/dashboard.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No account found with this email.";
        }
    }
}


?>

<div class="main-login">
    <div class="login-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <form action="" method="POST">
                        <img src="../assets/images/logo/<?php echo urlencode($logo); ?>" alt="logo">
                        <div class="email my-4">
                            <input type="email" name="email" placeholder="Enter Your Email">
                        </div>
                        <div class="email my-4">
                            <input type="password" name="password" placeholder="Enter Your Password">
                        </div>
                        <!-- Display the error message here if it exists -->
                        <div id="errorMsg" class="alert alert-danger d-none" role="alert">
                            <?php echo $error; ?>
                        </div>
                        <div class="">
                            <button class="btn login-btn my-1" type="submit" name="login">Login</button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6 left-login-image">
                    <div class="image-container">
                        <img src="../assets/images/login.jpg" alt="">
                        <div class="overlay">
                            <p>Education is the most powerful weapon which you can use to change the world.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "templates/footer.php" ?>

<script>
    // Check if there is an error message, and hide it after 3 seconds
    document.addEventListener("DOMContentLoaded", function () {
        const errorMsg = document.getElementById("errorMsg");

        if (errorMsg && errorMsg.innerText.trim() !== "") {
            errorMsg.classList.add("d-block");
            setTimeout(() => {
                errorMsg.style.display = 'none';
                errorMsg.classList.remove("d-block");
            }, 3000); // 3 seconds delay
        }
    });
</script>
