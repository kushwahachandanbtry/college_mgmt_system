<style>
    .card-style2 {
        position: relative;
        display: flex;
        transition: all 300ms ease;
        border: 1px solid rgba(0, 0, 0, 0.09);
        padding: 0;
        height: 100%;
    }

    .card-style2 .card-img {
        position: relative;
        display: block;
        background: #ffffff;
        overflow: hidden;
        border-radius: 0.25rem;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .card-style2 .card-img img {
        transition: all 0.3s linear 0s;
    }

    .card-style2:hover .card-img img {
        transform: scale(1.05);
    }

    .card-style2 .date {
        position: absolute;
        right: 30px;
        top: 30px;
        z-index: 1;
        color: #2662A8;
        overflow: hidden;
        padding-bottom: 10px;
        line-height: 24px;
        text-align: center;
        border: 2px solid #ededed;
        display: inline-block;
        background-color: #ffffff;
        text-transform: uppercase;
        border-radius: 0.25rem;
    }

    .card-style2 .date span {
        position: relative;
        color: #ffffff;
        font-weight: 500;
        font-size: 20px;
        display: block;
        text-align: center;
        padding: 12px;
        margin-bottom: 10px;
        background-color: red;
        border-radius: 0.25rem;
    }

    .card-style2 .card-body {
        position: relative;
        display: block;
        background: #ffffff;
        padding: 2rem;
    }

    .card-style2 .card-body h3 {
        margin-bottom: 0.8rem;
    }

    .card-style2 .card-body h3 a {
        color: #2662A8;
    }

    .card-style2 .card-body h3 a:hover {
        color: red;
    }

    .card-style2 .card-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.09);
        background: transparent;
        padding-right: 2rem;
        padding-left: 2rem;
        -ms-flex-align: end;
        align-items: flex-end;
    }

    .card-style2 .card-footer ul {
        display: flex;
        justify-content: space-between;
        list-style: none;
        margin-bottom: 0;
    }

    .card-style2 .card-footer ul li {
        font-size: 15px;
    }

    .card-style2 .card-footer ul li a {
        color: #394952;
    }

    .card-style2 .card-footer ul li a:hover {
        color: #2662A8;
    }

    .card-style2 .card-footer ul li i {
        color: #2662A8;
        font-size: 14px;
        margin-right: 8px;
    }
</style>
<div class="blog-overlay overlay">
    <h1>Blog</h1>
</div>
<section>
    <div class="container">
        <!-- Section Title -->
        <div class="container section-title" style="margin-bottom: -40px;" data-aos="fade-up">
            <h2>Latest Blog</h2>
        </div><!-- End Section Title -->
        <div class="row">
            <?php
            if (!empty($blogs) && is_array($blogs)) {
                foreach ($blogs as $blog) {
                    $date_object = DateTime::createFromFormat('Y-M-d', $blog['publish_date']);
                    $formatted_date = $date_object->format('dM');
                    $day = $date_object->format('d');
                    $month = $date_object->format('M');
                    ?>
                    <div class="col-lg-4 my-2 col-md-6 mb-2-6">
                        <article class="card card-style2">
                            <div class="card-img">
                                <img class="rounded-top" style="width: 100%;"
                                    src="assets/images/blogs/<?php echo urlencode($blog['image']); ?>"
                                    alt="<?php echo htmlspecialchars($blog['heading']); ?>">
                                <div class="date">
                                    <span><?php echo htmlspecialchars($day); ?></span><?php echo htmlspecialchars($month); ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="h5"><a
                                        href="?page=blog_details&&id=<?php echo urlencode($blog['id']); ?>"><?php echo htmlspecialchars($blog['heading']); ?></a>
                                </h3>
                                <p class="display-30">
                                    <?php echo text_limit(strip_tags(htmlspecialchars_decode($blog['overview'], ENT_QUOTES)), 150); ?>
                                </p>
                                <a href="?page=blog_details&&id=<?php echo urlencode($blog['id']); ?>"
                                    class="btn btn-primary read-more">Read More</a>
                            </div>
                            <div class="card-footer">
                                <ul>
                                    <li><a href="javascript:void(0)"><i
                                                class="fas fa-user"></i><?php echo htmlspecialchars($blog['publisher']); ?></a>
                                    </li>
                                    <?php
                                    $blog_id = $blog['id'];
                                    $comment_count_query = "SELECT COUNT(*) AS count FROM comment WHERE commented_heading = '{$blog_id}'";
                                    $comment_count_result = mysqli_query($conn, $comment_count_query);

                                    if ($comment_count_result) {
                                        $row = mysqli_fetch_assoc($comment_count_result);
                                        $total_comments = $row['count'];
                                    } else {
                                        $total_comments = 0;
                                    }
                                    ?>
                                    <li><a href="?page=blog_details&&id=<?php echo urlencode($blog['id']); ?>"><i
                                                class="far fa-comment-dots"></i><span><?php echo htmlspecialchars($total_comments); ?></span></a>
                                    </li>
                                </ul>
                            </div>
                        </article>
                    </div>
                <?php }
            } ?>

        </div>


    </div>
</section>
