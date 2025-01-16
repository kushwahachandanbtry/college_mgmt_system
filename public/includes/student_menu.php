<?php
/**
 * This file is used to all menu
 *
 * @package college-management-system
 */

/**
 * Requiring a header page
 */
include dirname(__DIR__, 2) . '/helpers.php';
$currentPage = basename($_SERVER['PHP_SELF']);
require 'header.php';
include 'top_menu.php';

if ($collegeStatus == 'on') {
    header("Location: " . APP_PATH . "public/pages/under_maintenance.php");
    exit;
}

?>


<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid ms-2 me-4 position-relative d-flex align-items-center">
        <?php
        if ($currentPage === 'index.php') {
            ?>
            <a href="<?php echo APP_PATH; ?>"><img src="./assets/images/logo/<?php echo $logo; ?>" style="width: 150px; "
                    alt="logo"></a>
            <?php
        } else {
            ?>
            <a href="<?php echo APP_PATH; ?>"><img src="../../assets/images/logo/<?php echo $logo; ?>"
                    style="width: 150px; " alt="logo"></a>
            <?php
        }
        ?>
        <a href="index.html" class="logo d-flex align-items-center me-auto">
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="<?php echo APP_PATH; ?>" class="active">Home</a></li>
                <li><a href="<?php echo APP_PATH; ?>public/pages/about-us.php">About</a></li>
                <li><a href="<?php echo APP_PATH; ?>public/pages/all-cources.php">Courses</a></li>

                <li><a href="<?php echo APP_PATH; ?>public/pages/our-staff.php">Our Staff</a></li>
                <li><a href="<?php echo APP_PATH; ?>public/pages/gallery.php">Gallery</a></li>

                <li><a href="<?php echo APP_PATH; ?>public/pages/contact.php">Contact</a></li>
                <li><a href="<?php echo APP_PATH; ?>public/pages/notice.php">Notice</a></li>
                <li><a href="<?php echo APP_PATH; ?>public/pages/exam_schedule.php">Exam Schedule</a></li>
                <li><a href="<?php echo APP_PATH; ?>public/pages/class_routine.php">Class Routine</a></li>

            </ul>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <?php
        ?>
        <a class="btn-getstarted" href="<?php echo APP_PATH; ?>public/actions/logout.php">Logout</a>

        <ul style="list-style: none; margin: 0 0 0 20px; padding: 0;">
            <li class="d-block text-center py-0" style="margin: 0; padding: 0;">
                <?php
                if (is_array($username)) {
                    ?>
                    <img src="<?php echo APP_PATH . 'admin/pages/message_app/' . $username['img']; ?>"
                        alt="<?php echo $username['username']; ?>" style="border-radius: 50%; width: 50px; height: 50px;">

                    <p style="margin: 0; padding: 0; color: #000;">
                        <?php echo htmlspecialchars($username['username']); ?>
                    </p>
                    <?php
                } else {
                    ?>
                    <i style="border: 1px solid #C43D3D; padding: 8px; border-radius: 50%; font-size: 25px; color: #C43D3D;"
                        class="fa-solid fa-user"></i>

                    <p style="margin: 0; padding: 0; color: #000;"><?php echo htmlspecialchars($username); ?>
                    </p>
                    <?php
                }
                ?>

            </li>
        </ul>
        <?php

        ?>
    </div>
</header>
