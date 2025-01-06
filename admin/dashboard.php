<?php
session_start();
include_once '../FetchDataController.php';
include_once '../constant.php';
include dirname(__DIR__, 1) . '/config.php';
include 'FetchAdminDataController.php';


if (!isset($_SESSION['admin']) && !isset($_SESSION['name'])) {
    // Redirect to login page if neither is set
    header("Location: " . APP_PATH . "admin"); // Adjust URL if necessary
    exit();
}


// echo $_SESSION['admin'];

include('templates/header.php'); ?>

<div class="wrapper">
    <!-- Sidebar Holder -->

    <?php $activePage = isset($_GET['content']) ? $_GET['content'] : '' ?>
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3><a style="color: #fff; text-decoration: none;" href="dashboard.php">Dashboard</a></h3>
        </div>

        <ul class="list-unstyled components">

            <li class="<?= in_array($activePage, ['allusers', 'item0', 'register_users', 'enquiry_users']) ? 'active' : '' ?>">
                <a href="#usersMenu" data-toggle="collapse"
                    aria-expanded="<?= in_array($activePage, ['allusers', 'item0']) ? 'true' : 'false' ?>"
                    class="dropdown-toggle">
                    <i class="fa-solid fa-users pr-2"></i> Users
                </a>
                <ul class="collapse list-unstyled <?= in_array($activePage, ['allusers', 'item0', 'register_users', 'enquiry_users']) ? 'show' : '' ?>"
                    id="usersMenu">
                    <li class="<?= $activePage == 'allusers' ? 'active' : '' ?>">
                        <a href="?content=allusers">All Users</a>
                    </li>
                    <li class="<?= $activePage == 'register_users' ? 'active' : '' ?>">
                        <a href="?content=register_users">Registered Users</a>
                    </li>
                    <li class="<?= $activePage == 'enquiry_users' ? 'active' : '' ?>">
                        <a href="?content=enquiry_users">Enquiry Users</a>
                    </li>
                    <?php if (isset($_SESSION['admin'])) { ?>
                        <li class="<?= $activePage == 'item0' ? 'active' : '' ?>">
                            <a href="?content=item0">Add New Users</a>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <?php if (isset($_SESSION['admin'])) { ?>
                <li class="<?= $activePage == 'college-website' ? 'active' : '' ?>">
                    <a href="?content=college-website"><i class="fa-solid fa-pen-to-square pr-2"></i> Manage Website</a>
                </li>
            <?php } ?>

            <li class="<?= in_array($activePage, ['item15', 'item16']) ? 'active' : '' ?>">
                <a href="#pageSubmenu5" data-toggle="collapse"
                    aria-expanded="<?= in_array($activePage, ['item15', 'item16']) ? 'true' : 'false' ?>"
                    class="dropdown-toggle">
                    <i class="fa-solid fa-landmark pr-2"></i> Class
                </a>
                <ul class="collapse list-unstyled <?= in_array($activePage, ['item15', 'item16']) ? 'show' : '' ?>"
                    id="pageSubmenu5">
                    <li class="<?= $activePage == 'item15' ? 'active' : '' ?>">
                        <a href="?content=item15">All Classes</a>
                    </li>
                    <?php
                    if (isset($_SESSION['admin']) || $_SESSION['role'] == 'teacher') {
                        ?>
                        <li class="<?= $activePage == 'item16' ? 'active' : '' ?>">
                            <a href="?content=item16">Add New Classes</a>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <li class="<?= in_array($activePage, ['item1', 'item2']) ? 'active' : '' ?>">
                <a href="#homeSubmenudd" data-toggle="collapse"
                    aria-expanded="<?= in_array($activePage, ['item1', 'item2']) ? 'true' : 'false' ?>"
                    class="dropdown-toggle">
                    <i class="fa-solid fa-graduation-cap pr-2"></i> Student
                </a>
                <ul class="collapse list-unstyled <?= in_array($activePage, ['item1', 'item2']) ? 'show' : '' ?>"
                    id="homeSubmenudd">
                    <li class="<?= $activePage == 'item1' ? 'active' : '' ?>">
                        <a href="?content=item1">All Student</a>
                    </li>
                    <?php if (isset($_SESSION['admin'])) { ?>
                        <li class="<?= $activePage == 'item2' ? 'active' : '' ?>">
                            <a href="?content=item2">Add Students</a>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <li class="<?= in_array($activePage, ['item3', 'item4', 'item5']) ? 'active' : '' ?>">
                <a href="#pageSubmenu1" data-toggle="collapse"
                    aria-expanded="<?= in_array($activePage, ['item3', 'item4', 'item5']) ? 'true' : 'false' ?>"
                    class="dropdown-toggle">
                    <i class="fa-solid fa-chalkboard-user pr-2"></i> Teachers
                </a>
                <ul class="collapse list-unstyled <?= in_array($activePage, ['item3', 'item4', 'item5']) ? 'show' : '' ?>"
                    id="pageSubmenu1">
                    <li class="<?= $activePage == 'item3' ? 'active' : '' ?>">
                        <a href="?content=item3">All Teachers</a>
                    </li>
                    <?php if (isset($_SESSION['admin'])) { ?>
                        <li class="<?= $activePage == 'item4' ? 'active' : '' ?>">
                            <a href="?content=item4">Add Teachers</a>
                        </li>

                        <li class="<?= $activePage == 'item5' ? 'active' : '' ?>">
                            <a href="?content=item5">Teacher payment</a>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <li class="<?= $activePage == 'item6' ? 'active' : '' ?>">
                <a href="?content=item6"><i class="fa-solid fa-calendar-days pr-2"></i> Class Routine</a>
            </li>

            <li class="<?= in_array($activePage, ['item7', 'item8']) ? 'active' : '' ?>">
                <a href="#pageSubmenu2" data-toggle="collapse"
                    aria-expanded="<?= in_array($activePage, ['item7', 'item8']) ? 'true' : 'false' ?>"
                    class="dropdown-toggle">
                    <i class="fa-solid fa-user pr-2"></i> Parent
                </a>
                <ul class="collapse list-unstyled <?= in_array($activePage, ['item7', 'item8']) ? 'show' : '' ?>"
                    id="pageSubmenu2">
                    <li class="<?= $activePage == 'item7' ? 'active' : '' ?>">
                        <a href="?content=item7">All Parents</a>
                    </li>
                    <?php if (isset($_SESSION['admin'])) { ?>
                        <li class="<?= $activePage == 'item8' ? 'active' : '' ?>">
                            <a href="?content=item8">Add Parent</a>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <li class="<?= in_array($activePage, ['item21', 'item22', 'item23']) ? 'active' : '' ?>">
                <a href="#pageSubmenu7" data-toggle="collapse"
                    aria-expanded="<?= in_array($activePage, ['item21', 'item22', 'item23']) ? 'true' : 'false' ?>"
                    class="dropdown-toggle">
                    <i class="fa-solid fa-clipboard-user"></i> Attendence
                </a>
                <ul class="collapse list-unstyled <?= in_array($activePage, ['item21', 'item22', 'item23']) ? 'show' : '' ?>"
                    id="pageSubmenu7">
                    <li class="<?= $activePage == 'item21' ? 'active' : '' ?>">
                        <a href="?content=item21">Take Attendance</a>
                    </li>
                    <li class="<?= $activePage == 'item22' ? 'active' : '' ?>">
                        <a href="?content=item22">View Class Attendance</a>
                    </li>
                    <li class="<?= $activePage == 'item23' ? 'active' : '' ?>">
                        <a href="?content=item23">View Student Attendance</a>
                    </li>


                </ul>
            </li>

            <li class="<?= in_array($activePage, ['item10', 'item11']) ? 'active' : '' ?>">
                <a href="#pageSubmenu3" data-toggle="collapse"
                    aria-expanded="<?= in_array($activePage, ['item10', 'item11']) ? 'true' : 'false' ?>"
                    class="dropdown-toggle">
                    <i class="fa-solid fa-book pr-2"></i> Library
                </a>
                <ul class="collapse list-unstyled <?= in_array($activePage, ['item10', 'item11']) ? 'show' : '' ?>"
                    id="pageSubmenu3">
                    <li class="<?= $activePage == 'item10' ? 'active' : '' ?>">
                        <a href="?content=item10">All Books</a>
                    </li>
                    <?php if (isset($_SESSION['admin']) || $_SESSION['role'] == 'teacher') { ?>
                        <li class="<?= $activePage == 'item11' ? 'active' : '' ?>">
                            <a href="?content=item11">Add New Book</a>
                        </li>
                    <?php } ?>
                </ul>
            </li>




            <li class="<?= $activePage == 'item14' ? 'active' : '' ?>">
                <a href="?content=item14"><i class="fa-solid fa-flag pr-2"></i> Notice</a>
            </li>

            <li class="<?= $activePage == '' ? 'active' : '' ?>">
                <a target="_blank" href="pages/message_app"><i class="fa-solid fa-message pr-2"></i> Message</a>
            </li>

            <li class="<?= in_array($activePage, ['item18', 'item19']) ? 'active' : '' ?>">
                <a href="#pageSubmenu6" data-toggle="collapse"
                    aria-expanded="<?= in_array($activePage, ['item18', 'item19']) ? 'true' : 'false' ?>"
                    class="dropdown-toggle">
                    <i class="fa-solid fa-clipboard-question pr-2"></i> Exam
                </a>
                <ul class="collapse list-unstyled <?= in_array($activePage, ['item18', 'item19']) ? 'show' : '' ?>"
                    id="pageSubmenu6">
                    <li class="<?= $activePage == 'item18' ? 'active' : '' ?>">
                        <a href="?content=item18">Exam Schedule</a>
                    </li>
                    <li class="<?= $activePage == 'item19' ? 'active' : '' ?>">
                        <a href="?content=item19">Exam Grades</a>
                    </li>
                </ul>
            </li>


            <li class="<?= $activePage == 'item20' ? 'active' : '' ?>">
                <a href="?content=item20"><i class="fa-solid fa-globe pr-2"></i> Map</a>
            </li>

        </ul>
    </nav>
    <!-- End sidebar -->

    <!-- Page Content Holder -->
    <div id="content" >

        <nav  id="navbar" class="navbar py-0 navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>
                
                <?php 
                if( isset( $_SESSION['admin'] ) ) {
                    ?>
                    <div class="text-center text-light" style="margin-left: 350px; background-color: #C43D3D; padding: 10px; border: 1px solid red;">
                        <p style="color: #fff;">WEBSITE ON UNDER MAINTENANCE <span id="statusText"></span></p>
                        <label class="switch">
                            <input type="checkbox" id="statusSwitch">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <?php 
                }

                ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a onclick="handleUserPopup()" class="nav-link mx-5 user-name" href="#">
                                <?php

                                if (isset($_SESSION['userid'])) {
                                    $userid = $_SESSION['userid'];
                                    $image = "SELECT image FROM users WHERE userid = '$userid'";
                                    $image_result = mysqli_query($conn, $image);
                                    if (mysqli_num_rows($image_result) > 0) {
                                        while ($image_row = mysqli_fetch_assoc($image_result)) {
                                            ?>
                                            <img src="pages/message_app/<?php echo $image_row['image']; ?>"
                                                style="width: 60px; height: 60px; border-radius: 50%;" alt="">
                                        <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <img src="../assets/images/logo/<?php echo urlencode($logo); ?>"
                                        style="width: 60px; border: 1px solid red; height: 60px; border-radius: 50%;"
                                        alt="">
                                <?php
                                }

                                ?>
                                <span class="px-2"></span>
                            </a>
                            <div>
                                <p style="font-size: 13px;" class="text-center"><?php
                                if (isset($_SESSION['admin'])) {
                                    echo $_SESSION['admin'];
                                } else {
                                    echo "Welcome, " . $_SESSION['name'];
                                }
                                ?></p>
                            </div>
                        </li>

                        <!-- Popup for user settings -->
                        <div class="user-popup">
                            <div class="user-popup-item">
                                <ul>
                                    <!-- <li><h6>Name</h6></li> -->
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="main-content">
            <div class="content-container">
                <?php
                if (isset($_GET['content'])) {

                    include('content.php');

                } else {
                    ?>
                    <h1 class="text-center pb-3"><?php echo htmlspecialchars($collegeName); ?></h1>
                    <div class="row">
                        <div class="col-12">
                            <?php
                            $notice = "SELECT * FROM notice ORDER BY id DESC LIMIT 1";
                            $notice_result = mysqli_query($conn, $notice);
                            if (mysqli_num_rows($notice_result) > 0) {
                                while ($notice_row = mysqli_fetch_assoc($notice_result)) {
                                    ?>
                                    <div class="alert d-flex alert-primary" role="alert">
                                        <h4 class="text-info pr-5">Latest Notice:</h4>
                                        <div class="text-center py-2" style="align-items: center;">
                                            <h6><?php echo $notice_row['date']; ?></h6>
                                            <h5><?php echo $notice_row['title']; ?></h5>
                                            <p><?php echo $notice_row['details']; ?></p>
                                            <p class="text-primary"><?php echo '@' . $notice_row['posted_by']; ?></p>
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-4">
                            <div class="card text-center" style="">
                                <div class="card-body">
                                    <h5 class="card-title">Users</h5>

                                    <?php
                                    $userCount = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'] ?? 0;
                                    echo "<h2> $userCount </h2>";
                                    ?>
                                    <a href="<?php echo APP_PATH; ?>admin/dashboard.php?content=allusers"
                                        class="text-primary"><i class="fa-solid fa-eye"></i> View </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card text-center" style="">
                                <div class="card-body">
                                    <h5 class="card-title">Students</h5>
                                    <?php
                                    $studentCount = $conn->query("SELECT COUNT(*) AS total FROM students")->fetch_assoc()['total'] ?? 0;
                                    echo "<h2> $studentCount </h2>";
                                    ?>
                                    <a href="<?php echo APP_PATH; ?>admin/dashboard.php?content=item1"
                                        class="text-primary"><i class="fa-solid fa-eye"></i> View </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card text-center" style="">
                                <div class="card-body">
                                    <h5 class="card-title">Teachers</h5>
                                    <?php
                                    $teacherCount = $conn->query("SELECT COUNT(*) AS total FROM teachers")->fetch_assoc()['total'] ?? 0;
                                    echo "<h2> $teacherCount </h2>";
                                    ?>
                                    <a href="<?php echo APP_PATH; ?>admin/dashboard.php?content=item3"
                                        class="text-primary"><i class="fa-solid fa-eye"></i> View </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row py-4">
                        <div class="col-4">
                            <div class="card text-center" style="">
                                <div class="card-body">
                                    <h5 class="card-title">Books Available</h5>
                                    <?php
                                    $bookCount = $conn->query("SELECT COUNT(*) AS total FROM books")->fetch_assoc()['total'] ?? 0;
                                    echo "<h2> $bookCount </h2>";
                                    ?>
                                    <a href="<?php echo APP_PATH; ?>admin/dashboard.php?content=item10"
                                        class="text-primary"><i class="fa-solid fa-eye"></i> View </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card text-center" style="">
                                <div class="card-body">
                                    <h5 class="card-title">Attendence</h5>

                                    <a href="<?php echo APP_PATH; ?>admin/dashboard.php?content=item22"
                                        class="text-primary"><i class="fa-solid fa-eye"></i> View </a>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['admin'])) { ?>
                            <div class="col-4">
                                <div class="card text-center" style="">
                                    <div class="card-body">
                                        <h5 class="card-title">Website</h5>
                                        <a href="<?php echo APP_PATH; ?>admin/dashboard.php?content=college-website"
                                            class="text-primary"><i class="fa-solid fa-pen-to-square"></i> Manage Website </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row my-4">
                        <div class="col">
                            <canvas id="dashboardChart"></canvas>
                        </div>
                    </div>



                    <?php
                }

                ?>

                <!-- <h1>Welcome to admin dashboard</h1> -->
            </div>
        </div>

    </div>





</div>

<?php include('templates/footer.php'); ?>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- JS for dashboard chart -->
<script>
    // Use PHP to inject data into JavaScript
    const data = {
        labels: ['Users', 'Students', 'Teachers', 'Books Available'],
        datasets: [{
            label: 'Count',
            data: [
                <?php echo $userCount; ?>,
                <?php echo $studentCount; ?>,
                <?php echo $teacherCount; ?>,
                <?php echo $bookCount; ?>
            ],
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
            borderColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Count'
                    },
                    ticks: {
                        stepSize: 1, // Ensure only whole numbers appear
                        callback: function (value) {
                            return Number.isInteger(value) ? value : null; // Show only whole numbers
                        }
                    }
                }
            }
        }
    };

    // Initialize Chart
    new Chart(document.getElementById('dashboardChart'), config);

    //undermaintenence button
document.getElementById("statusSwitch").addEventListener("change", function () {
    const status = this.checked ? "on" : "off";
    document.getElementById("statusText").innerText = status.charAt(0).toUpperCase() + status.slice(1);

    // Make AJAX request to update the status in the database
    fetch("actions/update_status.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ status: status }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data.message);
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});

</script>

