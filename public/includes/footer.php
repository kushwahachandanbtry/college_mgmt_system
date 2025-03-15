<?php
// Assuming this is part of a secure environment where variables like $collegePhone, $courses, $logo, and $collegeName are defined and sanitized

// Sanitize dynamically generated data, e.g., course titles, phone numbers, etc.
$collegePhone = htmlspecialchars($collegePhone, ENT_QUOTES, 'UTF-8');
$collegeName = htmlspecialchars($collegeName, ENT_QUOTES, 'UTF-8');
?>

<!-- footer section -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <ul>
                    <li>
                        <h4 style="border-bottom: 2px solid #061A70; display: inline-block;">About</h4>
                    </li>
                    <li>
                        <p>At <?php echo $collegeName; ?>, we believe education is the foundation of a successful and fulfilling life. Our college is committed to providing a transformative learning experience that empowers students to excel academically.</p>
                    </li>
                    <li class="ph-number">
                        <a href="tel:+977<?php echo $collegePhone; ?>"><i class="fa-solid fa-phone"></i> +977, <?php echo $collegePhone; ?></a>
                    </li>
                    <li class="time">
                        <a href=""><i class="fa-solid fa-clock"></i> Sun - Fri 6.00 - 18.00</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4">
                <ul class="footer-courses">
                    <li>
                        <h4 style="border-bottom: 2px solid #061A70; display: inline-block;">Outstanding Courses</h4>
                    </li>
                    <?php 
                    // Ensure $courses is an array and not empty
                    if( !empty($courses) && is_array($courses) ) {
                        foreach($courses as $course) {
                            // Sanitize course title for output
                            $courseTitle = htmlspecialchars($course['course_title'], ENT_QUOTES, 'UTF-8');
                            $courseUrl = htmlspecialchars("?page=course-details&id=" . $course['id'], ENT_QUOTES, 'UTF-8');
                            ?>
                            <li>
                                <a href="<?php echo $courseUrl; ?>" class="text-capitalize"><?php echo $courseTitle; ?></a>
                            </li>
                            <?php 
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-lg-2">
                <ul>
                    <li>
                        <h4 style="border-bottom: 2px solid #061A70; display: inline-block;">Support</h4>
                    </li>
                    <li>
                        <a href="?page=about">About Us</a>
                    </li>
                    <li>
                        <a href="?page=staff">Our Staff</a>
                    </li>
                    <li>
                        <a href="?page=courses">Available Courses</a>
                    </li>
                    <li>
                        <a href="?page=gallery">Gallery</a>
                    </li>
                    <li>
                        <a href="?page=contact">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3">
                <ul>
                    <li>
                        <h4 style="border-bottom: 2px solid #061A70; display: inline-block;">Flexible Learning</h4>
                    </li>
                    <li>
                        <p>At <?php echo $collegeName; ?>, we believe education is the foundation of a successful and fulfilling life.</p>
                    </li>
                    <li class="py-2">
                        <?php 
                        // Secure the logo path to avoid XSS and directory traversal
                        $logoPath = htmlspecialchars($logo, ENT_QUOTES, 'UTF-8');
                        $currentPage = basename($_SERVER['PHP_SELF']);
                        if ($currentPage == 'index.php') {
                            ?>
                            <img src="assets/images/logo/<?php echo $logoPath; ?>" alt="logo" class="img-fluid">
                            <?php
                        } else {
                            ?>
                            <img src="../../assets/images/logo/<?php echo $logoPath; ?>" alt="logo" class="img-fluid">
                            <?php 
                        }
                        ?>
                    </li>
                </ul>
            </div>
            <hr>
            <div class="end-footer">
                <div>
                    <p class="py-2"><?php echo date("Y"); ?> &#169; <?php echo $collegeName; ?>, All Rights Reserved, Developed By: <a target="_blank" class="text-primary" href="https://github.com/kushwahachandanbtry"><u>Chandan Kushwaha</u></a></p>
                </div>
                <div class="d-flex">
                    <div class="">
                        <p class="py-2">Call Us: <?php echo $collegePhone; ?> </p>
                    </div>
                    <div class="">
                        <ul class="d-flex">
                            <div>
                                <li>
                                    <p class="py-2">Follow Us</p>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <a target="_blank" href="https://www.facebook.com/YETICollege"><i class="fa-brands fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.instagram.com/yetiintlcollege/"><i class="fa-brands fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.youtube.com/@YETIInternationalCollege"><i class="fa-brands fa-youtube"></i></a>
                                </li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="http://localhost/college_mgmt_system/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="http://localhost/college_mgmt_system/assets/vendor/php-email-form/validate.js"></script>
<script src="http://localhost/college_mgmt_system/assets/vendor/aos/aos.js"></script>
<script src="http://localhost/college_mgmt_system/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="http://localhost/college_mgmt_system/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="http://localhost/college_mgmt_system/assets/vendor/purecounter/purecounter_vanilla.js"></script>

<!-- Main JS File -->
<script src="http://localhost/college_mgmt_system/assets/js/main.js"></script>

</body>
</html>
