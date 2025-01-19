<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
                    <h1>The Rise of Higher Education in Nepal</h1>
                    <p> Exploring the Top Colleges and Their Impact on Society</p>
                    <div class="d-flex">
                        <a href="?page=get-started" class="btn-get-started">Get Started</a>
                        <a href="https://www.youtube.com/watch?v=KKVNhm7afvo"
                            class="glightbox btn-watch-video d-flex align-items-center"><i
                                class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->


    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 align-items-center justify-content-between">

                <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
                    <span class="about-meta">MORE ABOUT US</span>
                    <h2 class="about-title">Exploring the Top Colleges and Their Impact on Society</h2>
                    <p class="about-description">At <?php echo htmlspecialchars($collegeName); ?>, we believe
                        education is the foundation of a successful and fulfilling life. Our college is committed to
                        providing a transformative learning experience that empowers students to excel academically,
                        grow personally, and prepare for a promising future.</p>

                    <div class="row feature-list-wrapper">
                        <div class="col-md-6">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Academic Excellence</li>
                                <li><i class="bi bi-check-circle-fill"></i> World-Class Facilities</li>
                                <li><i class="bi bi-check-circle-fill"></i> Vibrant Campus Life</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Student-Centered Approach</li>
                                <li><i class="bi bi-check-circle-fill"></i> Global Opportunities</li>
                            </ul>
                        </div>
                    </div>

                    <!-- <div class="info-wrapper">
                        <div class="row gy-4">
                            <div class="col-lg-5">
                                <div class="profile d-flex align-items-center gap-3">
                                    <img src="assets/img/avatar-1.webp" alt="CEO Profile" class="profile-image">
                                    <div>
                                        <h4 class="profile-name">Mario Smith</h4>
                                        <p class="profile-position">CEO &amp; Founder</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="contact-info d-flex align-items-center gap-2">
                                    <i class="bi bi-telephone-fill"></i>
                                    <div>
                                        <p class="contact-label">Call us anytime</p>
                                        <p class="contact-number">+123 456-789</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>

                <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="image-wrapper">
                        <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                            <img src="assets/img/bbs.jpeg" alt="Business Meeting"
                                class="img-fluid main-image rounded-4">
                            <img src="assets/img/me.jpg" alt="Team Discussion" class="img-fluid small-image rounded-4">
                        </div>
                        <div class="experience-badge floating">
                            <h3>15+ <span>Years</span></h3>
                            <p>Of experience in education service</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /About Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Features</h2>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="d-flex justify-content-center">

                <!-- Dynamic Nav Tabs -->
                <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
                    <?php if (!empty($features)): ?>
                        <?php foreach ($features as $index => $feature): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($index === 0) ? 'active show' : ''; ?>" data-bs-toggle="tab"
                                    data-bs-target="#features-tab-<?php echo htmlspecialchars($feature['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <h4 class="text-capitalize">
                                        <?php echo htmlspecialchars($feature['features_title'], ENT_QUOTES, 'UTF-8'); ?></h4>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h4>Coming soon...</h4>
                    <?php endif; ?>
                </ul><!-- End Nav Tabs -->

            </div>

            <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

                <!-- Dynamic Tab Content -->
                <?php if (!empty($features)): ?>
                    <?php foreach ($features as $index => $feature): ?>
                        <div class="tab-pane fade <?php echo ($index === 0) ? 'active show' : ''; ?>"
                            id="features-tab-<?php echo htmlspecialchars($feature['id'], ENT_QUOTES, 'UTF-8'); ?>">
                            <div class="row">
                                <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                                    <h3><?php echo htmlspecialchars($feature['features_heading'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                    <p class="fst-italic">
                                        <?php echo nl2br(htmlspecialchars($feature['features_description'], ENT_QUOTES, 'UTF-8')); ?>
                                    </p>
                                </div>
                                <div class="col-lg-6 order-1 order-lg-2 text-center">
                                    <?php
                                    $image_path = 'assets/images/features/' . basename($feature['features_image']);
                                    $image_alt = htmlspecialchars(pathinfo($feature['features_image'], PATHINFO_FILENAME), ENT_QUOTES, 'UTF-8');
                                    ?>
                                    <img src="<?php echo htmlspecialchars($image_path, ENT_QUOTES, 'UTF-8'); ?>"
                                        alt="<?php echo $image_alt; ?>" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h4>Coming soon...</h4>
                <?php endif; ?>

            </div><!-- End Tab Content -->

        </div>

    </section>
    <!-- /Features Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row justify-content-center align-items-center position-relative">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-4 text-capitalize mb-4">get your future secured with YETI Int'l</h2>
                    <a href="?page=get-started" class="btn btn-cta">Grab Opportunity</a>
                </div>

                <!-- Abstract Background Elements -->
                <div class="shape shape-1">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M47.1,-57.1C59.9,-45.6,68.5,-28.9,71.4,-10.9C74.2,7.1,71.3,26.3,61.5,41.1C51.7,55.9,35,66.2,16.9,69.2C-1.3,72.2,-21,67.8,-36.9,57.9C-52.8,48,-64.9,32.6,-69.1,15.1C-73.3,-2.4,-69.5,-22,-59.4,-37.1C-49.3,-52.2,-32.8,-62.9,-15.7,-64.9C1.5,-67,34.3,-68.5,47.1,-57.1Z"
                            transform="translate(100 100)"></path>
                    </svg>
                </div>

                <div class="shape shape-2">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M41.3,-49.1C54.4,-39.3,66.6,-27.2,71.1,-12.1C75.6,3,72.4,20.9,63.3,34.4C54.2,47.9,39.2,56.9,23.2,62.3C7.1,67.7,-10,69.4,-24.8,64.1C-39.7,58.8,-52.3,46.5,-60.1,31.5C-67.9,16.4,-70.9,-1.4,-66.3,-16.6C-61.8,-31.8,-49.7,-44.3,-36.3,-54C-22.9,-63.7,-8.2,-70.6,3.6,-75.1C15.4,-79.6,28.2,-58.9,41.3,-49.1Z"
                            transform="translate(100 100)"></path>
                    </svg>
                </div>

                <!-- Dot Pattern Groups -->
                <div class="dots dots-1">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <pattern id="dot-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                        </pattern>
                        <rect width="100" height="100" fill="url(#dot-pattern)"></rect>
                    </svg>
                </div>

                <div class="dots dots-2">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <pattern id="dot-pattern-2" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                        </pattern>
                        <rect width="100" height="100" fill="url(#dot-pattern-2)"></rect>
                    </svg>
                </div>

                <div class="shape shape-3">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M43.3,-57.1C57.4,-46.5,71.1,-32.6,75.3,-16.2C79.5,0.2,74.2,19.1,65.1,35.3C56,51.5,43.1,65,27.4,71.7C11.7,78.4,-6.8,78.3,-23.9,72.4C-41,66.5,-56.7,54.8,-65.4,39.2C-74.1,23.6,-75.8,4,-71.7,-13.2C-67.6,-30.4,-57.7,-45.2,-44.3,-56.1C-30.9,-67,-15.5,-74,0.7,-74.9C16.8,-75.8,33.7,-70.7,43.3,-57.1Z"
                            transform="translate(100 100)"></path>
                    </svg>
                </div>
            </div>

        </div>

    </section><!-- /Call To Action Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>What student's say about us ?</h2>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row g-5">
                <?php if (!empty($testimonials)): ?>
                    <?php foreach ($testimonials as $testimonial): ?>
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="testimonial-item">
                                <?php
                                // Sanitize the image file path and ensure it's safe
                                $image_path = 'assets/images/what_people_say/' . basename($testimonial['image']);
                                ?>
                                <img src="<?php echo htmlspecialchars($image_path, ENT_QUOTES, 'UTF-8'); ?>"
                                    class="testimonial-img"
                                    alt="<?php echo htmlspecialchars(pathinfo($testimonial['image'], PATHINFO_FILENAME), ENT_QUOTES, 'UTF-8'); ?>">

                                <h3><?php echo htmlspecialchars($testimonial['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                <h4><?php echo htmlspecialchars($testimonial['batch'], ENT_QUOTES, 'UTF-8'); ?></h4>

                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>

                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span><?php echo nl2br(htmlspecialchars($testimonial['overview'], ENT_QUOTES, 'UTF-8')); ?></span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->
                    <?php endforeach; ?>
                <?php else: ?>
                    <h4>Coming soon...</h4>
                <?php endif; ?>

            </div>

        </div>


    </section><!-- /Testimonials Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>BCA</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>BBS</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="153" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>MBA</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>BHM</p>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>

    </section><!-- /Stats Section -->

    <!-- Services Section -->
    <?php include "public/pages/services.php"; ?>
    <!-- /Services Section -->

    <!-- Faq Section -->
    <section class="faq-9 faq section light-background" id="faq">
        <div class="container">
            <div class="row">

                <!-- FAQ Title and Description -->
                <div class="col-lg-5" data-aos="fade-up">
                    <h2 class="faq-title">Have a question? Check out the FAQ</h2>
                    <p class="faq-description">Here are some commonly asked questions and their answers to help you out.
                    </p>
                    <div class="faq-arrow d-none d-lg-block" data-aos="fade-up" data-aos-delay="200">
                        <svg class="faq-arrow" width="200" height="211" viewBox="0 0 200 211" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M198.804 194.488C189.279 189.596 179.529 185.52 169.407 182.07L169.384 182.049C169.227 181.994 169.07 181.939 168.912 181.884C166.669 181.139 165.906 184.546 167.669 185.615C174.053 189.473 182.761 191.837 189.146 195.695C156.603 195.912 119.781 196.591 91.266 179.049C62.5221 161.368 48.1094 130.695 56.934 98.891C84.5539 98.7247 112.556 84.0176 129.508 62.667C136.396 53.9724 146.193 35.1448 129.773 30.2717C114.292 25.6624 93.7109 41.8875 83.1971 51.3147C70.1109 63.039 59.63 78.433 54.2039 95.0087C52.1221 94.9842 50.0776 94.8683 48.0703 94.6608C30.1803 92.8027 11.2197 83.6338 5.44902 65.1074C-1.88449 41.5699 14.4994 19.0183 27.9202 1.56641C28.6411 0.625793 27.2862 -0.561638 26.5419 0.358501C13.4588 16.4098 -0.221091 34.5242 0.896608 56.5659C1.8218 74.6941 14.221 87.9401 30.4121 94.2058C37.7076 97.0203 45.3454 98.5003 53.0334 98.8449C47.8679 117.532 49.2961 137.487 60.7729 155.283C87.7615 197.081 139.616 201.147 184.786 201.155L174.332 206.827C172.119 208.033 174.345 211.287 176.537 210.105C182.06 207.125 187.582 204.122 193.084 201.144C193.346 201.147 195.161 199.887 195.423 199.868C197.08 198.548 193.084 201.144 195.528 199.81C196.688 199.192 197.846 198.552 199.006 197.935C200.397 197.167 200.007 195.087 198.804 194.488ZM60.8213 88.0427C67.6894 72.648 78.8538 59.1566 92.1207 49.0388C98.8475 43.9065 106.334 39.2953 114.188 36.1439C117.295 34.8947 120.798 33.6609 124.168 33.635C134.365 33.5511 136.354 42.9911 132.638 51.031C120.47 77.4222 86.8639 93.9837 58.0983 94.9666C58.8971 92.6666 59.783 90.3603 60.8213 88.0427Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                </div>

                <!-- FAQ Items -->
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="300">
                    <div class="faq-container">

                        <?php
                        // Check if there are FAQs to display
                        if (!empty($faqs)) {
                            foreach ($faqs as $index => $faq) {
                                // Define active class for the first FAQ item
                                $activeClass = $index === 0 ? 'faq-active' : '';
                                ?>
                                <div class="faq-item <?= htmlspecialchars($activeClass, ENT_QUOTES, 'UTF-8') ?>">
                                    <h3><?= htmlspecialchars($faq['FAQ_title'], ENT_QUOTES, 'UTF-8') ?></h3>
                                    <div class="faq-content">
                                        <p><?= nl2br(htmlspecialchars($faq['FAQ_description'], ENT_QUOTES, 'UTF-8')) ?></p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p>No FAQs available at the moment. Please check back later.</p>';
                        }
                        ?>

                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- /Faq Section -->

    <!-- Call To Action 2 Section -->
    <section id="call-to-action-2" class="call-to-action-2 section dark-background">

        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <h3>Call To Action</h3>
                        <p>Click below to connect with us. Whether you’re looking for program details, admissions
                            support, or just want to learn more, we’re here to guide you every step of the way.</p>
                        <a class="cta-btn" href="?page=contact">Get in Touch Now!</a>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Call To Action 2 Section -->

    <!-- Contact form -->
    <?php include "public/pages/contact-form.php"; ?>
    <!-- /Contact form -->

    <!-- Class Section -->
    <section id="clients" class="clients section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper init-swiper">
                <div class="container section-title" style="margin-bottom: -30px;">
                    <h2>Classes</h2>
                </div><!-- End Section Title -->
                <script type="application/json" class="swiper-config">
{
  "loop": true,
  "speed": 600,
  "autoplay": {
    "delay": 5000
  },
  "slidesPerView": "auto",
  "pagination": {
    "el": ".swiper-pagination",
    "type": "bullets",
    "clickable": true
  },
  "breakpoints": {
    "320": {
      "slidesPerView": 2,
      "spaceBetween": 4
    },
    "480": {
      "slidesPerView": 3,
      "spaceBetween": 6
    },
    "640": {
      "slidesPerView": 4,
      "spaceBetween": 8
    },
    "992": {
      "slidesPerView": 4,
      "spaceBetween": 12
    }
  }
}
</script>
                <div class="swiper-wrapper align-items-center">
                    <?php if (!empty($courses)): ?>
                        <?php foreach ($courses as $course): ?>
                            <div class="swiper-slide">
                                <a href="?page=course-details&id=<?php echo urlencode($course['id']); ?>">
                                    <div class="card-group">
                                        <div class="card col-lg-3">
                                            <img src="assets/images/courses/course_images/<?php echo htmlspecialchars($course['course_image'], ENT_QUOTES, 'UTF-8'); ?>"
                                                class="card-img-top" alt="">
                                            <div class="card-body">
                                                <h5 style="color: #B21237;" class="card-title">
                                                    <?php echo htmlspecialchars($course['course_title'], ENT_QUOTES, 'UTF-8'); ?>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h4>Coming soon...</h4>
                    <?php endif; ?>
                </div>

                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Class Section -->
</main>
