<!-- footer section -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <ul>
                    <li>
                        <h4 style="border-bottom: 4px solid #fff; display: inline-block;">About</h4>
                    </li>
                    <li>
                        <p>At Yeti Int'l College, we believe education is the foundation of a successful and fulfilling life. Our college is committed to providing a transformative learning experience that empowers students to excel academically.</p>
                    </li>
                    <li class="ph-number">
                        <a href=""><i class="fa-solid fa-phone"></i> +977, <?php echo $collegePhone; ?></a>
                    </li>
                    <li class="time">
                        <a href=""><i class="fa-solid fa-clock"></i> Sun - Fri 8.00 - 18.00</a>
                    </li>
            </ul>
            </div>
            <div class="col-lg-4">
                <ul class="footer-cources">
                    <li>
                        <h4 style="border-bottom: 4px solid #fff; display: inline-block;">Outstanding Cources</h4>
                    </li>
                    <?php 
                        if( !empty( $courses ) && is_array( $courses ) ) {
                            foreach( $courses as $course ) {
                                ?>
                                <li>
                                    <a href="<?php echo APP_PATH . 'public/pages/single_course.php?id='.$course['id']; ?>" class="text-capitalize"><?php echo htmlspecialchars( $course['course_title'] ); ?></a>
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
                        <h4 style="border-bottom: 4px solid #fff; display: inline-block;">Support</h4>
                    </li>
                    <li>
                        <a href="<?php echo APP_PATH . 'public/pages/about-us.php'; ?>">About Us</a>
                    </li>
                    <li>
                        <a href="<?php echo APP_PATH . 'public/pages/our-staff.php'; ?>">Our Staff</a>
                    </li>
                    <li>
                        <a href="<?php echo APP_PATH . 'public/pages/all-cources.php'; ?>">Available Courses</a>
                    </li>
                    <li>
                        <a href="<?php echo APP_PATH . 'public/pages/gallery.php'; ?>">Gallery</a>
                    </li>
                    <li>
                        <a href="<?php echo APP_PATH . 'public/pages/contact.php'; ?>">Contact Us</a>
                    </li>
            </ul>
            </div>
            <div class="col-lg-3">
                <ul>
                    <li>
                        <h4 style="border-bottom: 4px solid #fff; display: inline-block;">Flexible Learning</h4>
                    </li>
                    <li class="py-5">
                        <?php $currentPage = basename($_SERVER['PHP_SELF']); 
                        if( $currentPage == 'index.php' ) {
                            ?>
                            <img src="assets/images/logo/<?php echo $logo; ?>" style="background-color: none;" class="img-fluid">
                            <?php
                        } else {
                            ?>
                            <img src="../../assets/images/logo/<?php echo $logo; ?>" style="background-color: none;" class="img-fluid">
                            <?php 
                        }
                        ?>
                        
                    </li>
                    </ul>
            </div>
            <hr>
            <div class="end-footer">
            <div>
            <p class="py-2">© <?php echo date("Y"); ?> Chandan Kushwaha, All Rights Reserved</p>
            </div>
            <div class="d-flex">
                <div class="">
                    <p class="py-2">Call ME: +977, 9823196848 </p>
                </div>
                <div class="">
                    <ul class="d-flex">
                        <div>
                            <li>
                                <p class="py-2">Follow ME</p>
                            </li>
                        </div>
                        <div>
                            <li>
                                <a target="_blank" href="https://www.facebook.com/profile.php?id=100030758771026"><i class="fa-brands fa-facebook"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.instagram.com/chandankushwaha5702/"><i class="fa-brands fa-instagram"></i></a>
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
