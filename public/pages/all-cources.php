<?php
/**
 * This page contains all cources page
 *
 * @package school-management-system
 */

/**
 * Requiring header and menu page
 */

require '../includes/menu.php';
// include 'config.php';
?>

<div class="all-course-overlay overlay">
    <h1>All courses</h1>
</div>


<div class="all-course-list">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <?php
                    // Check if a category is selected
                    $selected_category = isset($_GET['category']) ? $_GET['category'] : 'All';

                    // Default query to show all courses
                    $courses_query = "SELECT * FROM courses";

                    // Filter courses based on category
                    if ($selected_category !== 'All') {
                        $courses_query = "SELECT * FROM courses WHERE categories = '$selected_category'";
                    }

                    // Execute the query
                    $courses_result = mysqli_query($conn, $courses_query);

                    if (mysqli_num_rows($courses_result) > 0) {
                        while ($row = mysqli_fetch_assoc($courses_result)) {
                            ?>
                            <div class="col-lg-4 py-4">
                                <a href="single_course.php?id=<?php echo htmlspecialchars( $row['id'] ); ?>">
                                    <div class="card-group">
                                        <div class="card mx-4 col-lg-3">
                                            <img src="../../assets/images/courses/course_images/<?php echo urlencode($row['course_image']); ?>"
                                                class="card-img-top" alt="">
                                            <div class="card-body">
                                                <h5 style="color: #B21237;" class="card-title">
                                                    <?php echo $row['course_title']; ?>
                                                </h5>
                                                <p class="card-text"><?php echo text_limit(htmlspecialchars( $row['course_description'] ), 100) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<h4>Comming soon...</h4>";
                    }
                    ?>
                </div>

            </div>
            <div class="col-lg-3">
                <div class="enquiry-for-courrces text-center">
                    <form>
                        <h4 style="color: #fff;">Courses for free</h4>
                        <p>It's time to learn</p>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Your Name" aria-label="Username"
                                aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Your Email" aria-label="email"
                                aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Your Phone Number"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn text-light" style="background-color: #134E94;" type="button">Get It
                                Now</button>
                        </div>
                    </form>
                </div>
                <div class="cource-category">
                    <h4>Categories</h4>
                    <ul>
                        <li>
                            <a href="?category=Graduate"><i class="fa-solid fa-book"></i> Graduate</a>
                        </li>
                        <li>
                            <a href="?category=Undergraduate"><i class="fa-solid fa-pen"></i> Undergraduate</a>
                        </li>
                        <li>
                            <a href="?category=Professional"><i class="fa-solid fa-laptop"></i> Professional</a>
                        </li>
                        <li>
                            <a href="?category=All"><i class="fa-solid fa-list"></i> All</a>
                        </li>
                    </ul>
                </div>

                <div class="cource-category">
                    <h4>You May Like</h4>
                    <ul>
                        <li>
                            <a href="" class="d-flex">
                                <div class="video">
                                    <iframe width="120" height="auto" src="https://www.youtube.com/embed/KKVNhm7afvo"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                                <div class="v-name">
                                    <h6>𝟭𝟮𝘁𝗵 𝗔𝗻𝗻𝘂𝗮𝗹 𝗗𝗮𝘆, 𝗙𝗮𝗿𝗲𝘄𝗲𝗹𝗹 𝗮𝗻𝗱 𝗪𝗲𝗹𝗰𝗼𝗺𝗲
                                        𝗣𝗿𝗼𝗴𝗿𝗮𝗺 𝟮𝟬𝟴𝟬 || Yeti International College</h6>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="d-flex">
                                <div class="video">
                                    <iframe width="120" height="auto" src="https://www.youtube.com/embed/oS-kTqin4G4"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                                <div class="v-name">
                                    <h6>Shikha Shrestha || BCA || Student || 2080</h6>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="d-flex">
                                <div class="video">
                                    <iframe width="120" height="auto" src="https://www.youtube.com/embed/y303ehxxWQs"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                                <div class="v-name">
                                    <h6>Apsara Kathayat || Student || Yeti Int'l College || 2080</h6>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
    require '../includes/footer.php';
    ?>

