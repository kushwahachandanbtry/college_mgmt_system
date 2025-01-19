<?php 
// Include the constants file securely
include dirname(__DIR__, 2) . '/constant.php'; 

// Sanitize dynamic variables to ensure security
$collegeAddress = htmlspecialchars($collegeAddress, ENT_QUOTES, 'UTF-8');
$collegePhone = htmlspecialchars($collegePhone, ENT_QUOTES, 'UTF-8');
$collegeEmail = htmlspecialchars($collegeEmail, ENT_QUOTES, 'UTF-8');
?>

<div class="top_menu">
    <div class="d-flex justify-content-between">
        <ul class="d-none d-sm-flex"> <!-- This will be hidden on mobile devices -->
            <div class="d-flex">
                <li>
                    <i class="fa-solid fa-location-dot"></i><?php echo $collegeAddress; ?>
                </li>
                <li><i class="fa-solid fa-phone"></i><?php echo $collegePhone; ?></li>
                <li><i class="fa-solid fa-envelope"></i><?php echo $collegeEmail; ?></li>
            </div>
        </ul>
        
        <ul class="d-none d-sm-flex"> <!-- This will be hidden on mobile devices -->
            <div class="d-flex">
                <li>
                    <a target="_blank" href="https://www.facebook.com/@YETICollege"><i class="fa-brands fa-facebook"></i></a>
                </li>
                <li><a target="_blank" href="https://www.instagram.com/yetiintlcollege/"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a target="_blank" href="https://www.youtube.com/@YETIInternationalCollege/"><i class="fa-brands fa-youtube"></i></a></li>
            </div>
        </ul>

        <!-- Mobile View: Shows only on smaller screens -->
        <ul class="d-flex d-sm-none"> <!-- This will only be visible on mobile devices -->
            <div class="d-flex">
                <li>
                    <!-- Sanitize the phone number link properly -->
                    <a href="tel:+977<?php echo $collegePhone; ?>"><i class="fa-solid fa-phone"></i></a>
                </li>
                <li>
                    <!-- Sanitize the email link properly -->
                    <a href="mailto:<?php echo $collegeEmail; ?>"><i class="fa-solid fa-envelope"></i></a>
                </li>
            </div>
        </ul>
    </div>
</div>
