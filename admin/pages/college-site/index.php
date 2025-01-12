<?php

if (!isset($_SESSION['admin'])) {
    exit();
}
if (isset($_GET['msg'])) {
    ?>
    <div class="container text-center mx-auto" style="width: 400px;">
        <div id="alertBox" class="alert alert-success text-center" role="alert">
            <h5 class="fst-italic"><?php echo htmlspecialchars($_GET['msg']); ?></h5>
        </div>
    </div>

    <script>
        // Ensure baseUrl is correctly assigned as a JavaScript string
        var baseUrl = "<?php echo htmlspecialchars(APP_PATH, ENT_QUOTES, 'UTF-8'); ?>";

        // JavaScript to hide the alert after 2 seconds (2000 milliseconds)
        setTimeout(function () {
            var alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.style.display = 'none';
            }

            // After hiding the alert, redirect to the desired URL
            var page = "<?php echo isset($_GET['page']) ? htmlspecialchars($_GET['page'], ENT_QUOTES, 'UTF-8') : ''; ?>";
            window.location.href = baseUrl + "/admin/dashboard.php?content=college-website&&page=" + page;
        }, 2000); // 2000 milliseconds = 2 seconds
    </script>
    <?php
}



if (isset($_GET['err_msg'])) {
    ?>
    <div class="container text-center mx-auto" style="width: 400px;">
        <div id="alertBox" class="alert alert-danger text-center" role="alert">
            <h5 class="fst-italic"><?php echo htmlspecialchars_decode(htmlspecialchars($_GET['err_msg'])); ?></h5>
        </div>
    </div>
    <script>
        // Ensure baseUrl is correctly assigned as a JavaScript string
        var baseUrl = "<?php echo htmlspecialchars(APP_PATH, ENT_QUOTES, 'UTF-8'); ?>";

        // JavaScript to hide the alert after 2 seconds (2000 milliseconds)
        setTimeout(function () {
            var alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.style.display = 'none';
            }

            // After hiding the alert, redirect to the desired URL
            var page = "<?php echo isset($_GET['page']) ? htmlspecialchars($_GET['page'], ENT_QUOTES, 'UTF-8') : ''; ?>";
            window.location.href = baseUrl + "/admin/dashboard.php?content=college-website&&page=" + page;
        }, 5000); // 2000 milliseconds = 2 seconds
    </script>
    <?php
}
?>
<div class="container college-index bg-dark">

    <div class="row">
        <?php
        $base_url = APP_PATH;
        ?>
        <div class="col-12">
            <div>
                <ul class="d-flex justify-content-around pt-3">
                    <img style="margin-left: -70px; " width="130px"
                        src="./../assets/images/logo/<?php echo urlencode($logo); ?>" alt="logo">

                    <div class="text-center">
                        <i class="fa-solid fa-house"></i>
                        <li><a href="<?php $base_url ?>dashboard.php?content=college-website&&page=home">Home</a></li>
                    </div>
                    <div class="text-center">
                        <i class="fa-solid fa-address-card"></i>
                        <li><a href="<?php $base_url ?>dashboard.php?content=college-website&&page=about">About</a></li>
                    </div>
                    <div class="text-center">
                        <i class="fa-brands fa-discourse"></i>
                        <li><a href="<?php $base_url ?>dashboard.php?content=college-website&&page=cources">CourSes</a>
                        </li>
                    </div>
                    <div class="text-center">
                        <i class="fa-solid fa-address-book"></i>
                        <li><a href="<?php $base_url ?>dashboard.php?content=college-website&&page=contact">Contact</a>
                        </li>
                    </div>
                    <div class="text-center">
                        <i class="fa-solid fa-users"></i>
                        <li><a href="<?php $base_url ?>dashboard.php?content=college-website&&page=staff">Staff</a></li>
                    </div>
                    <div class="text-center">
                        <i class="fa-brands fa-envira"></i>
                        <li><a href="<?php $base_url ?>dashboard.php?content=college-website&&page=gallery">Gallery</a>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    <?php
    include_once 'init.php';
    // In your main file where you get $_GET['page']:
    if (isset($_GET['page'])) {
        $data = $_GET['page'];
        $init = new Init($data);
        ?>
        <div class="d-flex py-2">
            <div class="webpage-side-menu">
                <ul id="menu">
                    <?php

                    $menu_items = $init->load_menu();
                    if (is_array($menu_items) && !empty($menu_items)) {
                        foreach ($menu_items as $menu_item) {
                            ?>
                            <li class="py-2"><a
                                    href="<?php $base_url ?>pages/college-site/pages/<?php echo $menu_item . '.php'; ?>"><?php echo $menu_item; ?></a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="webpage-index-content bg-light" id="content-container">
                <?php
                if (isset($_GET['content_web_edit'])) {
                    $content = $_GET['content_web_edit'];
                    if ($_GET['page'] == 'home') {
                        switch ($content) {
                            case 'edit_faq':
                                include 'pages/edit_faq.php';
                                break;

                            case 'edit_features':
                                include 'pages/edit_features.php';
                                break;

                            case 'edit_testimonials':
                                include 'pages/edit_testimonials.php';
                                break;

                            case 'edit_services':
                                include 'pages/edit_services.php';
                                break;
                        }
                    }
                    if ($_GET['page'] == 'about') {
                        switch ($content) {
                            case 'edit_videos':
                                include 'pages/edit_videos.php';
                                break;
                        }
                    }

                    if ($_GET['page'] == 'cources') {
                        switch ($content) {
                            case 'edit_courses':
                                include 'pages/edit_courses.php';
                                break;

                            case 'edit_meta_data':
                                include 'pages/edit_meta_data.php';
                                break;
                        }

                        
                    }

                    if ($_GET['page'] == 'contact') {
                        switch ($content) {
                            case 'edit_contact':
                                include 'pages/edit_contact.php';
                                break;
                        }
                    }

                    if ($_GET['page'] == 'staff') {
                        switch ($content) {
                            case 'edit_staff':
                                include 'pages/edit_staff.php';
                                break;
                        }
                    }

                    if ($_GET['page'] == 'gallery') {
                        switch ($content) {
                            case 'edit_gallery':
                                include 'pages/edit_gallery.php';
                                break;
                        }
                    }


                }
                ?>
            </div>
            <div class="" id="edit-content-container"></div>
            <script>

            </script>
        </div>
        <?php
    }
    ?>
</div>
</div>
