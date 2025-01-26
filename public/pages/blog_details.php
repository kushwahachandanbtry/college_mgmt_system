<style>
    .blog-listing {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .gray-bg {
        background-color: #f5f5f5;
    }

    /* Blog 
---------------------*/
    .blog-grid {
        box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
        border-radius: 5px;
        overflow: hidden;
        background: #ffffff;
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .blog-grid .blog-img {
        position: relative;
    }

    .blog-grid .blog-img .date {
        position: absolute;
        background: #fc5356;
        color: #ffffff;
        padding: 8px 15px;
        left: 10px;
        top: 10px;
        border-radius: 4px;
    }

    .blog-grid .blog-img .date span {
        font-size: 22px;
        display: block;
        line-height: 22px;
        font-weight: 700;
    }

    .blog-grid .blog-img .date label {
        font-size: 14px;
        margin: 0;
    }

    .blog-grid .blog-info {
        padding: 20px;
    }

    .blog-grid .blog-info h5 {
        font-size: 22px;
        font-weight: 700;
        margin: 0 0 10px;
    }

    .blog-grid .blog-info h5 a {
        color: #20247b;
    }

    .blog-grid .blog-info p {
        margin: 0;
    }

    .blog-grid .blog-info .btn-bar {
        margin-top: 20px;
    }


    /* Blog Sidebar
-------------------*/
    .blog-aside .widget {
        box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
        border-radius: 5px;
        overflow: hidden;
        background: #ffffff;
        margin-top: 15px;
        margin-bottom: 15px;
        width: 100%;
        display: inline-block;
        vertical-align: top;
    }

    .blog-aside .widget-body {
        padding: 15px;
    }

    .blog-aside .widget-title {
        padding: 15px;
        border-bottom: 1px solid #eee;
    }

    .blog-aside .widget-title h3 {
        font-size: 20px;
        font-weight: 700;
        color: #fc5356;
        margin: 0;
    }

    .blog-aside .widget-author .media {
        margin-bottom: 15px;
    }

    .blog-aside .widget-author p {
        font-size: 16px;
        margin: 0;
    }

    .blog-aside .widget-author .avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        overflow: hidden;
    }

    .blog-aside .widget-author h6 {
        font-weight: 600;
        color: #20247b;
        font-size: 22px;
        margin: 0;
        padding-left: 20px;
    }

    .blog-aside .post-aside {
        margin-bottom: 15px;
    }

    .blog-aside .post-aside .post-aside-title h5 {
        margin: 0;
    }

    .blog-aside .post-aside .post-aside-title a {
        font-size: 18px;
        color: #20247b;
        font-weight: 600;
    }

    .blog-aside .post-aside .post-aside-meta {
        padding-bottom: 10px;
    }

    .blog-aside .post-aside .post-aside-meta a {
        color: #6F8BA4;
        font-size: 12px;
        text-transform: uppercase;
        display: inline-block;
        margin-right: 10px;
    }

    .blog-aside .latest-post-aside+.latest-post-aside {
        border-top: 1px solid #eee;
        padding-top: 15px;
        margin-top: 15px;
    }

    .blog-aside .latest-post-aside .lpa-right {
        width: 90px;
    }

    .blog-aside .latest-post-aside .lpa-right img {
        border-radius: 3px;
    }

    .blog-aside .latest-post-aside .lpa-left {
        padding-right: 15px;
    }

    .blog-aside .latest-post-aside .lpa-title h5 {
        margin: 0;
        font-size: 15px;
    }

    .blog-aside .latest-post-aside .lpa-title a {
        color: #20247b;
        font-weight: 600;
    }

    .blog-aside .latest-post-aside .lpa-meta a {
        color: #6F8BA4;
        font-size: 12px;
        text-transform: uppercase;
        display: inline-block;
        margin-right: 10px;
    }

    .tag-cloud a {
        padding: 4px 15px;
        font-size: 13px;
        color: #ffffff;
        background: #20247b;
        border-radius: 3px;
        margin-right: 4px;
        margin-bottom: 4px;
    }

    .tag-cloud a:hover {
        background: #fc5356;
    }

    .blog-single {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .article {
        box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
        border-radius: 5px;
        overflow: hidden;
        background: #ffffff;
        padding: 15px;
        margin: 15px 0 30px;
    }

    .article .article-title {
        padding: 10px 0 10px;
        border-top: 1px dashed #ddd;
    }

    .article .article-title h6 {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .article .article-title h6 a {
        text-transform: uppercase;
        color: #fc5356;
        border-bottom: 1px solid #fc5356;
    }

    .article .article-title h2 {
        color: #20247b;
        font-weight: 600;
    }

    .article .article-title .media {
        padding-top: 15px;

        padding-bottom: 20px;

    }

    .article .article-title .media .avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        overflow: hidden;
        padding: 5px;
        border: 1px solid red;
    }

    .article .article-title .media .media-body {
        padding-left: 8px;
    }

    .article .article-title .media .media-body label {
        font-weight: 600;
        color: #fc5356;
        margin: 0;
    }

    .article .article-title .media .media-body span {
        display: block;
        font-size: 12px;
    }

    .article .article-content {
        padding-top: 20px;
    }

    .article .article-content h1,
    .article .article-content h2,
    .article .article-content h3,
    .article .article-content h4,
    .article .article-content h5,
    .article .article-content h6 {
        color: #20247b;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .article .article-content blockquote {
        max-width: 600px;
        padding: 15px 0 30px 0;
        margin: 0;
    }

    .article .article-content blockquote p {
        font-size: 20px;
        font-weight: 500;
        color: #fc5356;
        margin: 0;
    }

    .article .article-content blockquote .blockquote-footer {
        color: #20247b;
        font-size: 16px;
    }

    .article .article-content blockquote .blockquote-footer cite {
        font-weight: 600;
    }

    .article .tag-cloud {
        padding-top: 10px;
    }

    .article-comment {
        box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
        border-radius: 5px;
        overflow: hidden;
        background: #ffffff;
        padding: 20px;
    }

    .article-comment h4 {
        color: #20247b;
        font-weight: 700;
        margin-bottom: 25px;
        font-size: 22px;
    }

    img {
        max-width: 100%;
    }

    img {
        vertical-align: middle;
        border-style: none;
    }

    /* Contact Us
---------------------*/
    .contact-name {
        margin-bottom: 30px;
    }

    .contact-name h5 {
        font-size: 22px;
        color: #20247b;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .contact-name p {
        font-size: 18px;
        margin: 0;
    }

    .social-share a {
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50%;
        color: #ffffff;
        text-align: center;
        margin-right: 10px;
    }

    .social-share .dribbble {
        box-shadow: 0 8px 30px -4px rgba(234, 76, 137, 0.5);
        background-color: #ea4c89;
    }

    .social-share .behance {
        box-shadow: 0 8px 30px -4px rgba(0, 103, 255, 0.5);
        background-color: #0067ff;
    }

    .social-share .linkedin {
        box-shadow: 0 8px 30px -4px rgba(1, 119, 172, 0.5);
        background-color: #0177ac;
    }

    .contact-form .form-control {
        border: none;
        border-bottom: 1px solid #20247b;
        background: transparent;
        border-radius: 0;
        padding-left: 0;
        box-shadow: none !important;
    }

    .contact-form .form-control:focus {
        border-bottom: 1px solid #fc5356;
    }

    .contact-form .form-control.invalid {
        border-bottom: 1px solid #ff0000;
    }

    .contact-form .send {
        margin-top: 20px;
    }

    @media (max-width: 767px) {
        .contact-form .send {
            margin-bottom: 20px;
        }
    }

    .section-title h2 {
        font-weight: 700;
        color: #20247b;
        font-size: 45px;
        margin: 0 0 15px;
        border-left: 5px solid #fc5356;
        padding-left: 15px;
    }

    .section-title {
        padding-bottom: 45px;
    }

    .contact-form .send {
        margin-top: 20px;
    }

    .px-btn {
        padding: 0 50px 0 20px;
        line-height: 60px;
        position: relative;
        display: inline-block;
        color: #20247b;
        background: none;
        border: none;
    }

    .px-btn:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        border-radius: 30px;
        background: transparent;
        border: 1px solid rgba(252, 83, 86, 0.6);
        border-right: 1px solid transparent;
        -moz-transition: ease all 0.35s;
        -o-transition: ease all 0.35s;
        -webkit-transition: ease all 0.35s;
        transition: ease all 0.35s;
        width: 60px;
        height: 60px;
    }

    .px-btn .arrow {
        width: 13px;
        height: 2px;
        background: currentColor;
        display: inline-block;
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto;
        right: 25px;
    }

    .px-btn .arrow:after {
        width: 8px;
        height: 8px;
        border-right: 2px solid currentColor;
        border-top: 2px solid currentColor;
        content: "";
        position: absolute;
        top: -3px;
        right: 0;
        display: inline-block;
        -moz-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    table td {
        border: 1px solid #000;
        text-align: center;
    }
</style>
<?php
if (isset($_GET['id'])) {
    $isLoggedIn = isset($_SESSION['user_id']); // Check if the user is logged in
    $userId = $isLoggedIn ? $_SESSION['user_id'] : null;
    if (isset($_POST['comment'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        $commented_heading = mysqli_real_escape_string($conn, $_POST['commented_heading']);

        $errors = [];
        $msg = '';
        $err_msg = '';
        if (empty($name)) {
            $errors[] = 'Please enter your name';
        }

        if (empty($message)) {
            $errors[] = 'Please enter your message';
        }

        if (empty($email)) {
            $errors[] = 'Please enter your email';
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Please enter a valid email address';
            }
        }

        if (empty($errors)) {
            $sql = "INSERT INTO comment(name, email, message, commented_heading) VALUES('{$name}','{$email}','{$message}','{$commented_heading}')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $msg = "Commented Successfull!!!";
            }
        } else {
            foreach ($errors as $error) {
                $err_msg = $error;
            }
        }
    }


    $id = $_GET['id'];
    $blog_sql = "SELECT * FROM blogs WHERE id = $id";
    $blog_result = mysqli_query($conn, $blog_sql);
    if (mysqli_num_rows($blog_result) > 0) {
        while ($row = mysqli_fetch_assoc($blog_result)) {
            ?>
            <div class="blog-single gray-bg">
                <div class="container">
                    <div class="row align-items-start">
                        <div class="col-lg-8 m-15px-tb">
                            <article class="article">
                                <div class="article-img">
                                    <img height="500px" width="100%"
                                        src="assets/images/blogs/<?php echo urlencode($row['image']); ?>" title=""
                                        alt="<?php echo urlencode($row['image']); ?>">
                                </div>
                                <div class="article-title ">
                                    <h2><?php echo htmlspecialchars($row['heading']); ?></h2>
                                    <div class="d-flex justify-content-between">
                                        <div class="media">
                                            <?php
                                            $email = $row['publisher'];
                                            $author_sql = "SELECT username,image FROM users WHERE email = '{$email}'";
                                            $author_result = mysqli_query($conn, $author_sql);
                                            if (mysqli_num_rows($author_result) > 0) {
                                                while ($author = mysqli_fetch_assoc($author_result)) {
                                                    ?>
                                                    <div class="avatar">
                                                        <img src="assets/images/users/<?php echo urlencode($author['image']); ?>" title=""
                                                            alt="<?php echo urlencode($author['image']); ?>">
                                                    </div>
                                                    <div class="media-body">
                                                        <label><?php echo htmlspecialchars($author['username']); ?></label>
                                                        <?php
                                                }
                                            }
                                            ?>


                                                <span><?php echo htmlspecialchars($row['publish_date']); ?></span>
                                            </div>
                                        </div>
                                        <div class="share pt-4">
                                            <h4 class="text-center">Share With</h4>
                                            <ul class="d-flex" style="list-style:none;">
                                                <?php
                                                // Dynamically generate the current page URL
                                                $currentUrl = urlencode("https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                                                $blogTitle = urlencode($row['heading']); // Assuming you have a $blog['title']
                                                ?>
                                                <li style="font-size: 30px;" class="px-3">
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $currentUrl; ?>"
                                                        target="_blank">
                                                        <i style="color: #fc5356;" class="fa-brands fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li style="font-size: 30px;" class="px-3">
                                                    <a href="https://www.instagram.com/?url=<?php echo $currentUrl; ?>"
                                                        target="_blank">
                                                        <i style="color: #fc5356;" class="fa-brands fa-square-instagram"></i>
                                                    </a>
                                                </li>
                                                <li style="font-size: 30px;" class="px-3">
                                                    <a href="https://api.whatsapp.com/send?text=<?php echo $blogTitle . '%20' . $currentUrl; ?>"
                                                        target="_blank">
                                                        <i style="color: #fc5356;" class="fa-brands fa-square-whatsapp"></i>
                                                    </a>
                                                </li>
                                                <li style="font-size: 30px;" class="px-3">
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $currentUrl; ?>"
                                                        target="_blank">
                                                        <i style="color: #fc5356;" class="fa-brands fa-linkedin"></i>
                                                    </a>
                                                </li>
                                                <li style="font-size: 30px;" class="px-3">
                                                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo $currentUrl; ?>&description=<?php echo $blogTitle; ?>"
                                                        target="_blank">
                                                        <i style="color: #fc5356;" class="fa-brands fa-pinterest"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="article-content">
                                    <?php echo htmlspecialchars_decode($row['overview']); ?>
                                </div>
                            </article>
                            <div class="contact-form article-comment">
                                <h4>Leave a Comment</h4>
                                <form id="contact-form" action="" method="POST">
                                    <div class="row">
                                        <?php
                                        if (!empty($msg)) {
                                            ?>
                                            <div class="alert alert-primary text-center" role="alert">
                                                <?php echo htmlspecialchars($msg); ?>
                                            </div>
                                            <?php
                                        }
                                        if (!empty($err_msg)) {
                                            ?>
                                            <div class="alert alert-danger text-center" role="alert">
                                                <?php echo htmlspecialchars($err_msg); ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <input required name="commented_heading" id="name" hidden class="form-control" type="text"
                                            value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input required name="name" id="name" placeholder="Name *" class="form-control"
                                                    type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input name="email" id="email" placeholder="Email *" class="form-control"
                                                    type="email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="message" id="message" placeholder="Your message *" rows="4"
                                                    class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="send">
                                                <button name="comment" class="px-btn theme"><span>Submit</span> <i
                                                        class="arrow"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row d-flex justify-content-center mt-5">
                                <div class="">
                                    <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                                        <h3 class="text-center pt-3">Comments</h3>
                                        <div class="card-body p-3">
                                            <?php
                                            $commentQuery = "SELECT c.*, 
                                            (SELECT COUNT(*) FROM votes v WHERE v.comment_id = c.id) AS vote_count, 
                                            (SELECT COUNT(*) FROM votes v WHERE v.comment_id = c.id AND v.user_id = ?) AS user_voted 
                                                FROM comment c 
                                                ORDER BY c.id DESC 
                                                LIMIT 5"; // Get the 5 latest comments
                                                
                                                $stmt = $conn->prepare($commentQuery);
                                                $stmt->bind_param("i", $userId);
                                                $stmt->execute();
                                                $commentResult = $stmt->get_result();

                                            while ($commentRow = $commentResult->fetch_assoc()) {
                                                $userVoted = $commentRow['user_voted'] > 0;
                                                ?>
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <p><?php echo htmlspecialchars($commentRow['message']); ?></p>
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex flex-row align-items-center">
                                                                <p class="small mb-0 ms-2">
                                                                    <?php echo htmlspecialchars($commentRow['name']); ?>
                                                                </p>
                                                            </div>
                                                            <div class="d-flex flex-row align-items-center">
                                                                <p class="small text-muted mb-0">Upvote?</p>
                                                                <i class="far fa-thumbs-up mx-2 fa-xs text-body vote-button"
                                                                    style="cursor:pointer; <?php echo $userVoted ? 'color: blue;' : ''; ?>"
                                                                    data-id="<?php echo $commentRow['id']; ?>"></i>
                                                                <p
                                                                    class="small text-muted mb-0 vote-count-<?php echo $commentRow['id']; ?>">
                                                                    <?php echo $commentRow['vote_count']; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function () {
                                    $('.vote-button').on('click', function () {
                                        var commentId = $(this).data('id');
                                        var button = $(this);

                                        $.ajax({
                                            url: 'public/pages/vote.php',
                                            method: 'POST',
                                            data: { id: commentId },
                                            success: function (response) {
                                                if (response.success) {
                                                    // Update the vote count
                                                    $('.vote-count-' + commentId).text(response.newCount);

                                                    // Toggle the button color based on whether the user voted or not
                                                    if (response.userVoted) {
                                                        button.css('color', 'blue');
                                                    } else {
                                                        button.css('color', '');
                                                    }
                                                } else {
                                                    if (response.redirect) {
                                                        // Redirect the user to the login page if they are not logged in
                                                        window.location.href = 'login.php';
                                                    } else {
                                                        alert('Error: ' + response.message);
                                                    }
                                                }
                                            },
                                            error: function () {
                                                alert('An error occurred while processing your request.');
                                            }
                                        });
                                    });
                                });

                            </script>
                        </div>
                        <div class="col-lg-4 m-15px-tb blog-aside">
                            <!-- Courses -->
                            <div class="widget widget-author">
                                <div class="widget-title">
                                    <h3>Our Courses</h3>
                                </div>
                                <div class="widget-body">
                                    <?php
                                    if (!empty($courses) && is_array($courses)) {
                                        foreach ($courses as $course) {
                                            ?>
                                            <div class="latest-post-aside media">
                                                <div class="lpa-left media-body">
                                                    <div class="lpa-title">
                                                        <h5><a href="?page=course-details&id=<?php echo urlencode($course['id']); ?>">
                                                                <?php echo htmlspecialchars($course['course_title']); ?>
                                                            </a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <!-- End Courses -->
                            <!-- Trending Post -->
                            <!-- <div class="widget widget-post">
                        <div class="widget-title">
                            <h3>Trending Now</h3>
                        </div>
                        <div class="widget-body">

                        </div>
                    </div> -->
                            <!-- End Trending Post -->
                            <!-- Latest Post -->
                            <div class="widget widget-latest-post">
                                <div class="widget-title">
                                    <h3>Latest Post</h3>
                                </div>
                                <div class="widget-body">
                                    <?php
                                    $latest_blog_sql = "SELECT * FROM blogs ORDER BY id DESC LIMIT 5";
                                    $latest_blog_result = mysqli_query($conn, $latest_blog_sql);
                                    if (mysqli_num_rows($latest_blog_result) > 0) {
                                        while ($latest_blog_row = mysqli_fetch_assoc($latest_blog_result)) {
                                            ?>
                                            <div class="latest-post-aside media">
                                                <div class="lpa-left media-body">
                                                    <div class="lpa-title">
                                                        <h5><a
                                                                href="?page=blog_details&&id=<?php echo urlencode($latest_blog_row['id']); ?>"><?php echo htmlspecialchars($latest_blog_row['heading']); ?></a>
                                                        </h5>
                                                    </div>
                                                    <div class="lpa-meta">
                                                        <a class="name" href="#">
                                                            <?php echo htmlspecialchars($latest_blog_row['publisher']); ?>
                                                        </a>
                                                        <a class="date" href="#">
                                                            <?php echo htmlspecialchars($latest_blog_row['publish_date']); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="lpa-right">
                                                    <a href="#">
                                                        <img src="assets/images/blogs/<?php echo urlencode($latest_blog_row['image']); ?>"
                                                            title="" alt="<?php echo urlencode($latest_blog_row['image']); ?>">
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }

                                    ?>

                                </div>
                            </div>
                            <!-- End Latest Post -->
                            <!-- widget Tags -->
                            <!-- <div class="widget widget-tags">
                                <div class="widget-title">
                                    <h3>Latest Tags</h3>
                                </div>
                                <div class="widget-body">
                                    <div class="nav tag-cloud">
                                        <a href="#">Design</a>
                                        <a href="#">Development</a>
                                        <a href="#">Travel</a>
                                        <a href="#">Web Design</a>
                                        <a href="#">Marketing</a>
                                        <a href="#">Research</a>
                                        <a href="#">Managment</a>
                                    </div>
                                </div>
                            </div> -->
                            <!-- End widget Tags -->
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    }
}
