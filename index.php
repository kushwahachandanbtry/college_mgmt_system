<!-- =======================================================
  * Template Name: College management system
  * Author: Chandan Kushwaha
======================================================== -->

<?php 
include 'helpers.php';
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
require 'public/includes/header.php';
include 'public/includes/top_menu.php';

// Redirect if the site is under maintenance
if ($collegeStatus == 'on') {
    echo "<script>window.location.href = '".APP_PATH."public/pages/under_maintenance.php';</script>";
    exit;
}

$message = '';
$messageType = '';
if (isset($_POST['login'])) {
    include 'config.php';

    // Secure the user input by using prepared statements
    $email = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check in `users` table
    $user_sql = "SELECT username, email, image, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $user_sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $db_username, $db_email, $db_image, $db_password);
        mysqli_stmt_fetch($stmt);

        // Verify the password against the hash
        if (password_verify($password, $db_password)) {
            // Start a session and store login info
            $_SESSION['login_user'] = $db_username;
            $_SESSION['user_type'] = 'user';
            $_SESSION['img'] = $db_image;
            $_SESSION['email'] = $db_email;

            // Redirect to home page after successful login
            echo "<script>window.location.href = 'index.php';</script>";
            exit;
        } else {
            $message = "Login failed! Incorrect email or password.";
            $messageType = 'error';
        }
    }

    // Check in `registered_users` table if user doesn't exist in the `users` table
    $registered_sql = "SELECT fname, email, password FROM registered_users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $registered_sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $fname, $email, $reg_password);
        mysqli_stmt_fetch($stmt);

        // Verify the password against the hash
        if (password_verify($password, $reg_password)) {
            // Start a session and store login info
            $_SESSION['login_user'] = $fname;
            $_SESSION['user_type'] = 'registered_user';
            $_SESSION['email'] = $email;

            // Redirect to home page after successful login
            echo "<script>window.location.href = 'index.php';</script>";
            exit;
        } else {
            $message = "Login failed! Incorrect email or password.";
            $messageType = 'error';
        }
    }

    // If no match, show the error message
    if (empty($message)) {
        $message = "Login failed! Incorrect email or password.";
        $messageType = 'error';
    }
}


?>

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid ms-2 me-4 position-relative d-flex align-items-center">
        <a href="<?php echo APP_PATH; ?>"><img class="logo_img" src="./assets/images/logo/<?php echo $logo; ?>" style="width: 150px;" alt="logo"></a>
        <nav id="navmenu" class="navmenu mx-auto">
            <ul>
                <li><a href="?page=home" class="active">Home</a></li>
                <li><a href="?page=about">About</a></li>
                <li><a href="?page=courses">Courses</a></li>
                <li><a href="?page=staff">Our Staff</a></li>
                <li><a href="?page=gallery">Gallery</a></li>
                <li><a href="?page=contact">Contact</a></li>

                <?php if (isset($_SESSION['login_user'])): ?>
                    <?php if ($_SESSION['user_type'] === 'user'): ?>
                        <li><a href="?page=notice">Notice</a></li>
                        <li><a href="?page=exam-schedule">Exam Schedule</a></li>
                        <li><a href="?page=class-routine">Class Routine</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>

        <?php if (isset($_SESSION['login_user'])): ?>
            <a class="btn-getstarted" href="<?php echo APP_PATH; ?>public/actions/logout.php">Logout</a>
            <ul style="list-style: none; margin: 0 0 0 20px; padding: 0;">
                <li class="d-block text-center py-0">
                    <?php if ($_SESSION['user_type'] === 'user'): ?>
                        <img src="<?php echo APP_PATH . 'admin/pages/message_app/' . $_SESSION['img']; ?>" alt="<?php echo htmlspecialchars($_SESSION['login_user']); ?>" style="border-radius: 50%; width: 50px; height: 50px;">
                    <?php endif; ?>
                    <p><?php echo htmlspecialchars($_SESSION['login_user']); ?></p>
                </li>
            </ul>
        <?php else: ?>
            <a class="btn-getstarted" href="?page=get-started">Get Started</a>
        <?php endif; ?>
    </div>
</header>

<?php
// Load pages dynamically
if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'home': include 'public/pages/home.php'; break;
        case 'courses': include 'public/pages/all-cources.php'; break;
        case 'about': include 'public/pages/about-us.php'; break;
        case 'staff': include 'public/pages/our-staff.php'; break;
        case 'gallery': include 'public/pages/gallery.php'; break;
        case 'contact': include 'public/pages/contact.php'; break;
        case 'notice': include 'public/pages/notice.php'; break;
        case 'exam-schedule': include 'public/pages/exam_schedule.php'; break;
        case 'class-routine': include 'public/pages/class_routine.php'; break;
        case 'get-started': include 'public/pages/login.php'; break;
        case 'staff-details': include 'public/pages/single_staff.php'; break;
        case 'course-details': include 'public/pages/single_course.php'; break;
        case 'register': include 'public/pages/register.php'; break;
        case 'thankyou': include 'public/pages/thankyou.php'; break;
        default: include 'public/pages/home.php'; break;
    }
} else {
    include 'public/pages/home.php';
}
?>

<?php require "public/includes/footer.php"; ?>
