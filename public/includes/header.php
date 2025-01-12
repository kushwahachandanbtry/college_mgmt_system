<!doctype html>
<html lang="en">
<?php
include dirname(__DIR__, 2) . '/FetchDataController.php';
$og_image_path = 'http://localhost/college_mgmt_system/assets/images/Og_images';
$page = basename($_SERVER['PHP_SELF']);
$title = '';
$description = '';
$keywords = '';
$canonical = '';
$og_title = '';
$og_description = '';
$og_url = '';
$og_image = '';
if (!empty($meta_setting_datas) && is_array($meta_setting_datas)) {
    foreach ($meta_setting_datas as $meta_setting_data) {
        if( $meta_setting_data['meta_title'] == 'home') {
            if ($page == 'index.php') {
                $title = $meta_setting_data['meta_title'];
                $description = $meta_setting_data['meta_description'];
                $keywords = $meta_setting_data['meta_keywords'];
                $canonical = $meta_setting_data['canonical_tag'];
                $og_title = $meta_setting_data['og_title'];
                $og_description = $meta_setting_data['og_description'];
                $og_url = $meta_setting_data['og_url'];
                $og_image = $meta_setting_data['og_image'];
            }
        }

        if ($page == 'single_course.php') {
            if( isset( $_GET['id']) ) {
                if( $_GET['id'] == $meta_setting_data['pages']) {
                    $title = $meta_setting_data['meta_title'];
                    $description = $meta_setting_data['meta_description'];
                    $keywords = $meta_setting_data['meta_keywords'];
                    $canonical = $meta_setting_data['canonical_tag'];
                    $og_title = $meta_setting_data['og_title'];
                    $og_description = $meta_setting_data['og_description'];
                    $og_url = $meta_setting_data['og_url'];
                    $og_image = $meta_setting_data['og_image'];
                }
            }
            
        }
    }
}
?>

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="<?php echo htmlspecialchars($title); ?>">
    <meta name="description" content="<?php echo htmlspecialchars($description); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($keywords); ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">

    <meta property="og:title" content="<?php echo htmlspecialchars($og_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($og_description); ?>">
    <meta property="og:image" content=<?php echo $og_image_path . '/' . $og_image ?>>
    <meta property="og:url" content="<?php echo htmlspecialchars($og_url); ?>">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="vendor.css">
    <title><?php echo $collegeName; ?></title>
    <!-- fontawesome icon link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">

    <!-- Favicons -->
    <link href="http://localhost/college_mgmt_system/assets/images/logo/<?php echo $logo; ?>" rel="icon">
    <link href="http://localhost/college_mgmt_system/assets/images/logo/<?php echo $logo; ?>" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="http://localhost/college_mgmt_system/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/college_mgmt_system/assets/vendor/bootstrap-icons/bootstrap-icons.css"
        rel="stylesheet">
    <link href="http://localhost/college_mgmt_system/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="http://localhost/college_mgmt_system/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="http://localhost/college_mgmt_system/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- main css -->
    <link rel="stylesheet" href="http://localhost/college_mgmt_system/assets/css/style.css">

    <!-- =======================================================
  * Template Name: School management system
  * Author: Chandan Kushwaha
    ======================================================== -->
</head>

<body class="index-page">
