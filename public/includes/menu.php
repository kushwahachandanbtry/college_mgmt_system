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

if (isset($_SESSION['login_user']) || isset($_GET['login_user'])) {
    $loginUser = $_GET['login_user'];
    $username = '';
    $img = '';
    function check_table($conn, $table, $loginUser)
    {
        $sql = "SELECT * FROM $table WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $loginUser);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($table == 'registered_users') {
                        $username = $row['fname'];
                        return $username;
                    } else {
                        $img = $row['image'];
                        $username = $row['username'];
                        return ['img' => $img, 'username' => $username];
                    }

                }
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Failed to prepare the SQL statement.";
        }
    }
    // Check in both tables
    $username = check_table($conn, 'registered_users', $loginUser);
    if (!$username) {
        $username = check_table($conn, 'users', $loginUser);
    }

    ?>
    <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid ms-2 me-4 position-relative d-flex align-items-center">
        <?php
        if ($currentPage === 'index.php') {
            ?>
            <a href="<?php echo APP_PATH; ?>"><img class="logo_img" src="./assets/images/logo/<?php echo $logo; ?>" style="width: 150px; "
                    alt="logo"></a>
            <?php
        } else {
            ?>
            <a href="<?php echo APP_PATH; ?>"><img class="logo_img" src="../../assets/images/logo/<?php echo $logo; ?>"
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
        if (isset($loginUser)) {
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
        } else {
            ?>
            <a class="btn-getstarted" href="<?php echo APP_PATH; ?>public/pages/login.php">Get
                Started</a>
            <ul style="list-style: none; margin: 0 0 0 20px; padding: 0;">
                <li class="d-block text-center py-0" style="margin: 0; padding: 0;">
                    <i style="border: 1px solid #C43D3D; padding: 8px; border-radius: 50%; font-size: 25px; color: #C43D3D;"
                        class="fa-solid fa-user"></i>
                    <p style="margin: 0; padding: 0; color: #000;">Guest</p>
                </li>
            </ul>
            <?php
        }
        ?>
    </div>
</header>
    <?php 

} else {
    ?>
    <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid ms-2 me-4 position-relative d-flex align-items-center">
        <?php
        if ($currentPage === 'index.php') {
            ?>
            <a href="<?php echo APP_PATH; ?>"><img class="logo_img" src="./assets/images/logo/<?php echo $logo; ?>" style="width: 150px; "
                    alt="logo"></a>
            <?php
        } else {
            ?>
            <a href="<?php echo APP_PATH; ?>"><img class="logo_img" src="../../assets/images/logo/<?php echo $logo; ?>"
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
                
            </ul>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <?php
        if (isset($loginUser)) {
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
        } else {
            ?>
            <a class="btn-getstarted" href="<?php echo APP_PATH; ?>public/pages/login.php">Get
                Started</a>
            <ul style="list-style: none; margin: 0 0 0 20px; padding: 0;">
                <li class="d-block text-center py-0" style="margin: 0; padding: 0;">
                    <i style="border: 1px solid #C43D3D; padding: 8px; border-radius: 50%; font-size: 25px; color: #C43D3D;"
                        class="fa-solid fa-user"></i>
                    <p style="margin: 0; padding: 0; color: #000;">Guest</p>
                </li>
            </ul>
            <?php
        }
        ?>
    </div>
</header>
    <?php 
}


mysqli_close($conn);
?>


