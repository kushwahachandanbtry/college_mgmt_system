<!-- Services Section -->
<section id="services" class="services section light-background">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">

            <?php
            $currentPage = basename($_SERVER['PHP_SELF']);

            // Check if the $services array is populated
            if (!empty($services)):
                foreach ($services as $service):
                    ?>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-card d-flex">
                            <div class="icon flex-shrink-0">
                                <i class="bi bi-activity"></i>
                            </div>
                            <div>
                                <h3><?php echo htmlspecialchars($service['service_title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                <?php
                                // Check if the current page is 'index.php' and display limited text if true
                                if ($currentPage == 'index.php') {
                                    ?>
                                    <p><?php echo text_limit(htmlspecialchars($service['service_description'], ENT_QUOTES, 'UTF-8'), 200); ?>
                                    </p>
                                    <a href="http://localhost/school_management_system/public/pages/about-us.php"
                                        class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
                                <?php
                                } else {
                                    ?>
                                    <p><?php echo htmlspecialchars($service['service_description'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div><!-- End Service Card -->
                <?php
                endforeach;
            else:
                echo "<h4>Comming soon...</h4>";
            endif;

            ?>

        </div>

    </div>

</section><!-- /Services Section -->
