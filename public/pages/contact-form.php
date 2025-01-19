<!-- Contact Section -->
<section id="contact" class="contact section light-background">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 g-lg-5">
            <div class="col-lg-5">
                <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                    <h3>Contact Info</h3>
                    <p>YETI College being established in 2005 AD and got official registration, reorganization and approval from Tribhuwan University in 4th Jan 2008 initially.</p>

                    <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="content">
                            <h4>Our Location</h4>
                            <p><?php echo htmlspecialchars($collegeAddress, ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    </div>

                    <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon-box">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="content">
                            <h4>Phone Number</h4>
                            <p><?php echo htmlspecialchars($collegePhone, ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    </div>

                    <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="content">
                            <h4>Email Address</h4>
                            <p><?php echo htmlspecialchars($collegeEmail, ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                    <h3>Get In Touch - Mail</h3>

                    <!-- Add security to the form action -->
                    <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <!-- Sanitize user input using PHP filter_input -->
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required="" value="<?php echo htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                            </div>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required="" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                            </div>

                            <div class="col-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required="" value="<?php echo htmlspecialchars($_POST['subject'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                            </div>

                            <div class="col-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""><?php echo htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                            </div>

                            <div class="col-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>

                                <button type="submit" class="btn">Send Message</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>

</section><!-- /Contact Section -->

<script>
    // Ensure safe form submission using fetch API and display appropriate messages
    document.querySelector(".php-email-form").addEventListener("submit", function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        fetch(form.action, {
            method: "POST",
            body: formData,
        })
            .then((response) => response.text())
            .then((result) => {
                if (result === "success") {
                    document.querySelector(".sent-message").style.display = "block";
                    form.reset(); // Clear the form
                } else {
                    document.querySelector(".error-message").style.display = "block";
                }
            })
            .catch((error) => {
                document.querySelector(".error-message").style.display = "block";
            });
    });
</script>
