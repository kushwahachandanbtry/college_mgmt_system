<?php
// =======================================================
// * Template Name: College management system
// * Author: Chandan Kushwaha
// =======================================================

include 'helpers.php';
include 'config.php';
session_start();

// Ensure the popup is always shown when the page is loaded or refreshed
$_SESSION['show_popup'] = true;

// Include required files
require 'public/includes/header.php';
include 'public/includes/top_menu.php';

// Redirect if the site is under maintenance
if ($collegeStatus == 'on') {
    echo "<script>window.location.href = '" . APP_PATH . "public/pages/under_maintenance.php';</script>";
    exit;
}

// Handle login functionality
$message = '';
$messageType = '';
if (isset($_POST['login'])) {
    // Secure the user input
    $email = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check in `users` table
    $user_sql = "SELECT id, username, email, image, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $user_sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $db_id, $db_username, $db_email, $db_image, $db_password);
        mysqli_stmt_fetch($stmt);

        // Verify the password
        if (password_verify($password, $db_password)) {
            $_SESSION['login_user'] = $db_username;
            $_SESSION['user_id'] = $db_id;
            $_SESSION['user_type'] = 'user';
            $_SESSION['img'] = $db_image;
            $_SESSION['email'] = $db_email;
            echo "<script>window.location.href = 'index.php';</script>";
            exit;
        } else {
            $message = "Login failed! Incorrect email or password.";
            $messageType = 'error';
        }
    }

    // Check in `registered_users` table
    $registered_sql = "SELECT id, fname, email, password FROM registered_users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $registered_sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $reg_id, $fname, $email, $reg_password);
        mysqli_stmt_fetch($stmt);

        // Verify the password
        if (password_verify($password, $reg_password)) {
            $_SESSION['login_user'] = $fname;
            $_SESSION['user_id'] = $reg_id;
            $_SESSION['user_type'] = 'registered_user';
            $_SESSION['email'] = $email;
            echo "<script>window.location.href = 'index.php';</script>";
            exit;
        } else {
            $message = "Login failed! Incorrect email or password.";
            $messageType = 'error';
        }
    }

    // If no match, show an error message
    if (empty($message)) {
        $message = "Login failed! Incorrect email or password.";
        $messageType = 'error';
    }
}

?>

<!-- Admission Popup -->

<?php
$popup_sql = "SELECT image FROM popup ORDER BY id DESC LIMIT 1";
$popup_result = mysqli_query($conn, query: $popup_sql);
if (mysqli_num_rows($popup_result) > 0) {
    while ($popup_row = mysqli_fetch_assoc($popup_result)) {
        ?>
        <div id="popupOverlay" style="display: none;"></div>
        <div id="admissionPopup" style="display: none;">
            <button id="closePopup"
                style="right: 0; top: 0; position: absolute; padding: 10px 10px; background-color:rgb(255, 0, 0); color: white; border: none; border-radius: 5px; cursor: pointer;">
                <i class="fa-solid fa-delete-left"></i>
            </button>
            <img src="assets/images/popup/<?php echo urlencode($popup_row['image']); ?>" alt="Admission Open"
                style="width: 100%; height: 590px; border-radius: 8px;">

        </div>
        <?php
    }
}
?>




<script>
    // Check if the popup should be displayed
    const shouldShowPopup = <?php echo $_SESSION['show_popup'] ? 'true' : 'false'; ?>;

    if (shouldShowPopup) {
        const popup = document.getElementById('admissionPopup');
        const overlay = document.getElementById('popupOverlay');
        const closeButton = document.getElementById('closePopup');

        // Show the popup
        popup.style.display = 'block';
        overlay.style.display = 'block';
        overlay.style.position = 'fixed';
        overlay.style.top = '0';
        overlay.style.left = '0';
        overlay.style.width = '100%';
        overlay.style.height = '100%';
        overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        overlay.style.zIndex = '999';

        // Style the popup
        popup.style.position = 'fixed';
        popup.style.top = '50%';
        popup.style.left = '50%';
        popup.style.transform = 'translate(-50%, -50%)';
        popup.style.zIndex = '1000';
        popup.style.backgroundColor = '#fff';
        popup.style.padding = '10px';
        popup.style.borderRadius = '8px';
        popup.style.textAlign = 'center';
        popup.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';

        // Close popup on button click
        closeButton.addEventListener('click', () => {
            popup.style.display = 'none';
            overlay.style.display = 'none';
        });

        // Close popup when clicking outside of it
        overlay.addEventListener('click', () => {
            popup.style.display = 'none';
            overlay.style.display = 'none';
        });
    }
</script>

<style>






</style>
<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid ms-2 me-4 position-relative d-flex align-items-center">
        <a href="<?php echo APP_PATH; ?>"><img class="logo_img" src="./assets/images/logo/<?php echo $logo; ?>"
                style="width: 150px;" alt="logo"></a>
        <nav id="navmenu" class="navmenu mx-auto">
            <ul>
                <li><a href="?page=home" class="">Home</a></li>
                <li><a href="?page=about">About</a></li>
                <li class="submenu">
                    <a href="?page=courses">Courses<i class="fa-solid fa-angle-down"></i></a>
                    <ul class="dropdown">
                        <?php
                        if (!empty($courses) && is_array($courses)) {
                            foreach ($courses as $course) {
                                ?>
                                <li class="submenu">
                                    <a
                                        href="?page=course-details&id=<?php echo urlencode($course['id']); ?>"><?php echo htmlspecialchars($course['course_title']); ?></a>
                                </li>
                                <?php
                            }
                        }
                        ?>

                        <li><a href="?page=courses">All</a></li>
                    </ul>
                </li>


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
                <li><a href="?page=blog">Blogs</a></li>
            </ul>
        </nav>

        <?php if (isset($_SESSION['login_user'])): ?>
            <a class="btn-getstarted" href="<?php echo APP_PATH; ?>public/actions/logout.php">Logout</a>
            <ul style="list-style: none; margin: 0 0 0 20px; padding: 0;">
                <li class="d-block text-center py-0">
                    <?php if ($_SESSION['user_type'] === 'user'): ?>
                        <img src="<?php echo APP_PATH . 'assets/images/users/' . $_SESSION['img']; ?>"
                            alt="<?php echo htmlspecialchars($_SESSION['login_user']); ?>"
                            style="border-radius: 50%; width: 50px; height: 50px;">
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

include 'public/includes/chatbot.php';
// Load pages dynamically
if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'home':
            include 'public/pages/home.php';
            break;
        case 'courses':
            include 'public/pages/all-cources.php';
            break;
        case 'about':
            include 'public/pages/about-us.php';
            break;
        case 'staff':
            include 'public/pages/our-staff.php';
            break;
        case 'gallery':
            include 'public/pages/gallery.php';
            break;
        case 'contact':
            include 'public/pages/contact.php';
            break;
        case 'blog':
            include 'public/pages/blog.php';
            break;
        case 'notice':
            include 'public/pages/notice.php';
            break;
        case 'exam-schedule':
            include 'public/pages/exam_schedule.php';
            break;
        case 'class-routine':
            include 'public/pages/class_routine.php';
            break;
        case 'get-started':
            include 'public/pages/login.php';
            break;
        case 'staff-details':
            include 'public/pages/single_staff.php';
            break;
        case 'course-details':
            include 'public/pages/single_course.php';
            break;
        case 'register':
            include 'public/pages/register.php';
            break;
        case 'thankyou':
            include 'public/pages/thankyou.php';
            break;
        case 'blog_details':
            include 'public/pages/blog_details.php';
            break;
        default:
            include 'public/pages/home.php';
            break;
    }
} else {
    include 'public/pages/home.php';
}
?>

<?php require "public/includes/footer.php"; ?>

