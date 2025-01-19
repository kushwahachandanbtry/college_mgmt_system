<?php

include_once 'templates/header.php';
include_once '../FetchDataController.php';
include_once '../constant.php';

// Initialize error message
$error = "";
session_start();

// Generate a new session ID to prevent session fixation
session_regenerate_id(true);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['login'])) {

        // Sanitize user input to prevent XSS
        $current_user = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $current_password = $_POST['password'];

        // Validate email format
        if (!filter_var($current_user, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } else {
            // Use prepared statements to prevent SQL injection
            $query = "SELECT userid, email, password, role, username FROM users WHERE email = ? LIMIT 1";
            if ($stmt = mysqli_prepare($conn, $query)) {
                mysqli_stmt_bind_param($stmt, "s", $current_user);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                // Check if user exists
                if (mysqli_num_rows($result) == 1) {
                    $user = mysqli_fetch_assoc($result);

                    // Verify the password using password_verify()
                    if (password_verify($current_password, $user['password'])) {
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['name'] = $user['username'];
                        $_SESSION['role'] = $user['role'];
                        $_SESSION['userid'] = $user['userid'];

                        // Redirect to the dashboard
                        header("Location: " . APP_PATH . "admin/dashboard.php");
                        exit();
                    } else {
                        $error = "Invalid password.";
                    }
                } else {
                    $error = "No account found with this email.";
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                $error = "Database query failed.";
            }
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
                            <input type="email" name="email" placeholder="Enter Your Email" required>
                        </div>
                        <div class="email my-4">
                            <input type="password" name="password" placeholder="Enter Your Password" required>
                        </div>
                        <!-- Display the error message here if it exists -->
                        <?php if (!empty($error)) : ?>
                            <div id="errorMsg" class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>
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
