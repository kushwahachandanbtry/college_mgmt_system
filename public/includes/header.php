<!doctype html>
<html lang="en">
<?php
// Securely include the required controller
define('ACCESS_ALLOWED', true);
include dirname(__DIR__, 2) . '/FetchDataController.php';

// Set up constants for security and validation
$og_image_path = 'http://localhost/college_mgmt_system/assets/images/Og_images';
$meta_setting_datas = $meta_setting_datas ?? []; // Ensure variable is defined
$title = $description = $keywords = $canonical = '';
$og_title = $og_description = $og_url = $og_image = '';

// Sanitize and validate incoming GET parameters
$page = isset($_GET['page']) ? filter_var($_GET['page'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : 'home';
$id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;

// Securely process meta settings
if (!empty($meta_setting_datas) && is_array($meta_setting_datas)) {
    foreach ($meta_setting_datas as $meta_setting_data) {
        if ($meta_setting_data['meta_title'] == 'home' && ($page === 'home' || !isset($page))) {
            $title = htmlspecialchars($meta_setting_data['meta_title'], ENT_QUOTES, 'UTF-8');
            $description = htmlspecialchars($meta_setting_data['meta_description'], ENT_QUOTES, 'UTF-8');
            $keywords = htmlspecialchars($meta_setting_data['meta_keywords'], ENT_QUOTES, 'UTF-8');
            $canonical = htmlspecialchars($meta_setting_data['canonical_tag'], ENT_QUOTES, 'UTF-8');
            $og_title = htmlspecialchars($meta_setting_data['og_title'], ENT_QUOTES, 'UTF-8');
            $og_description = htmlspecialchars($meta_setting_data['og_description'], ENT_QUOTES, 'UTF-8');
            $og_url = htmlspecialchars($meta_setting_data['og_url'], ENT_QUOTES, 'UTF-8');
            $og_image = htmlspecialchars($meta_setting_data['og_image'], ENT_QUOTES, 'UTF-8');
        }

        if ($page === 'course-details' && $id) {
            $query = "SELECT course_title FROM courses WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $course = $result->fetch_assoc();
                $course_title = $course['course_title'];
                if ($course_title === $meta_setting_data['pages']) {
                    $title = htmlspecialchars($meta_setting_data['meta_title'], ENT_QUOTES, 'UTF-8');
                    $description = htmlspecialchars($meta_setting_data['meta_description'], ENT_QUOTES, 'UTF-8');
                    $keywords = htmlspecialchars($meta_setting_data['meta_keywords'], ENT_QUOTES, 'UTF-8');
                    $canonical = htmlspecialchars($meta_setting_data['canonical_tag'], ENT_QUOTES, 'UTF-8');
                    $og_title = htmlspecialchars($meta_setting_data['og_title'], ENT_QUOTES, 'UTF-8');
                    $og_description = htmlspecialchars($meta_setting_data['og_description'], ENT_QUOTES, 'UTF-8');
                    $og_url = htmlspecialchars($meta_setting_data['og_url'], ENT_QUOTES, 'UTF-8');
                    $og_image = htmlspecialchars($meta_setting_data['og_image'], ENT_QUOTES, 'UTF-8');
                }
            }
            $stmt->close();
        }
    }
}
?>

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="<?php echo $title; ?>">
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo $canonical; ?>">

    <meta property="og:title" content="<?php echo $og_title; ?>">
    <meta property="og:description" content="<?php echo $og_description; ?>">
    <meta property="og:image" content="<?php echo $og_image_path . '/' . $og_image; ?>">
    <meta property="og:url" content="<?php echo $og_url; ?>">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="vendor.css"> -->
    <title><?php echo htmlspecialchars($collegeName, ENT_QUOTES, 'UTF-8'); ?></title>

    <!-- fontawesome icon link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Favicons -->
    <link href="http://localhost/college_mgmt_system/assets/images/logo/<?php echo htmlspecialchars($logo, ENT_QUOTES, 'UTF-8'); ?>" rel="icon">
    <link href="http://localhost/college_mgmt_system/assets/images/logo/<?php echo htmlspecialchars($logo, ENT_QUOTES, 'UTF-8'); ?>" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="http://localhost/college_mgmt_system/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/college_mgmt_system/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="http://localhost/college_mgmt_system/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="http://localhost/college_mgmt_system/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="http://localhost/college_mgmt_system/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="http://localhost/college_mgmt_system/assets/css/style.css">
</head>

<body class="index-page">
<!-- Content goes here -->
