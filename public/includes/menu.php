<?php
/**
 * This file is used to all menu
 *
 * @package college-management-system
 */

/**
 * Requiring a header page
 */
include dirname(__DIR__, 2). '/helpers.php';
$currentPage = basename($_SERVER['PHP_SELF']);
require 'header.php';
include 'top_menu.php';

if( $collegeStatus == 'on' ) {
    header("Location: ".APP_PATH."public/pages/under_maintenance.php");
    exit;
} 

?>

<header id="header"  class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <?php 
        if( $currentPage === 'index.php') {
            ?>
            <a href="<?php echo APP_PATH; ?>"><img src="./assets/images/logo/<?php echo $logo; ?>" style="width: 150px; " alt="logo"></a>
            <?php 
        } else {
            ?>
            <a href="<?php echo APP_PATH; ?>"><img src="../../assets/images/logo/<?php echo $logo; ?>" style="width: 150px; " alt="logo"></a>
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
            </ul>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="<?php echo APP_PATH; ?>public/pages/login.php">Get
            Started</a>

    </div>
</header>
