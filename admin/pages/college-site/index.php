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
            <h5 class="fst-italic"><?php echo htmlspecialchars($_GET['err_msg']); ?></h5>
        </div>
    </div>
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
                    <img style="margin-left: -70px; " width="130px" src="./../assets/images/logo/<?php echo urlencode( $logo ); ?>" alt="logo">
                    
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
                        <li><a href="<?php $base_url ?>dashboard.php?content=college-website&&page=cources">cources</a>
                        </li>
                    </div>
                    <div class="text-center">
                        <i class="fa-solid fa-address-book"></i>
                        <li><a href="<?php $base_url ?>dashboard.php?content=college-website&&page=contact">contact</a>
                        </li>
                    </div>
                    <div class="text-center">
                        <i class="fa-solid fa-users"></i>
                        <li><a href="<?php $base_url ?>dashboard.php?content=college-website&&page=staff">staff</a></li>
                    </div>
                    <div class="text-center">
                        <i class="fa-brands fa-envira"></i>
                        <li><a href="<?php $base_url ?>dashboard.php?content=college-website&&page=gallery">gallery</a>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    <?php
    include_once 'init.php';
    // In your main file where you get $_GET['page']:
    if(isset( $_GET['page'] ) ) {
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
        <div class="webpage-index-content bg-light" id="content-container"></div>
        <script>

        </script>
    </div>
    <?php
    }
    ?>
</div>
</div>
