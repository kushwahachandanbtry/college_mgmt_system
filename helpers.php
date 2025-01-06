<?php


/**
 * Return back to the previous page
 * 
 * @return string|null
 */
function go_back($content)
{
    // Get the current URL
    $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    // Parse the URL to modify the query parameters
    $parsedUrl = parse_url($currentUrl);
    parse_str($parsedUrl['query'], $queryParams);

    // Update the query parameters
    $queryParams['content'] = $content;
    unset($queryParams['id']); // Remove the 'id' parameter

    // Build the new query string
    $newQuery = http_build_query($queryParams);
    $newUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . $parsedUrl['path'] . '?' . $newQuery;
    ?>
    <script>
        function goBack() {
            const newUrl = "<?php echo $newUrl; ?>";
            window.history.pushState({ path: newUrl }, '', newUrl);
        }
    </script>
    <?php
}

/**
 * Show add successfull alert result
 * 
 * @return string|null
 */
function add_success_message($msg)
{
    ?>
    <div class="container text-center mx-auto" style="width: 400px;">
        <div id="alertBox" class="alert alert-success text-center" role="alert">
            <h5 class="fst-italic"><?php echo htmlspecialchars($msg); ?></h5>
        </div>
    </div>

    <script>
        // JavaScript to hide the alert after 3 seconds (3000 milliseconds)
        setTimeout(function () {
            var alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.style.display = 'none'; // Hide the alert box
            }
        }, 2000); // 2000 milliseconds = 2 seconds
    </script>
    <?php
}

function add_failled_message($error){
    ?>
    <div class="container text-center mx-auto" style="width: 400px; height: 100%;">
        <div id="alertBox" class="alert alert-danger text-center" role="alert">
            <h5 class="fst-italic"><?php echo htmlspecialchars_decode($error); ?></h5>
        </div>
    </div>
    <script>
        // JavaScript to hide the alert after 3 seconds (3000 milliseconds)
        setTimeout(function () {
            var alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.style.display = 'none'; // Hide the alert box
            }
        }, 9000); // 2000 milliseconds = 2 seconds
    </script>
    <?php 
}

/**
 * Show edit successfull alert result
 * 
 * @return string|null
 */
function edit_success_message()
{
    ?>
    <div class="container text-center mx-auto" style="width: 400px;">
        <div id="alertBox" class="alert alert-success text-center" role="alert">
            <h5 class="fst-italic">Update successfully!</h5>
        </div>
    </div>
    <script>
        setTimeout(function () {
            var alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.style.display = 'none';
            }
        }, 2000);
    </script>
    <?php
}

/**
 * Show edit failed alert result
 * 
 * @return null|string
 */
function edit_failed_message()
{
    ?>
    <div class="container text-center mx-auto" style="width: 400px;">
        <div id="alertBox" class="alert alert-danger text-center" role="alert">
            <h5 class="fst-italic">Failed!</h5>
        </div>
    </div>
    <script>
        setTimeout(function () {
            var alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.style.display = 'none';
            }
        }, 2000);
    </script>
    <?php
}


/**
 * Show delete confirmation alert result
 * 
 * @return string|null
 */
function delete_data_message()
{
    ?>
    <!-- Custom Confirmation Modal -->
    <div id="confirmModal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 8px; width: 300px; text-align: center;">
            <p>Are you sure you want to delete this record?</p>
            <button id="confirmYes"
                style="background-color: #dc3545; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; margin-right: 10px;">Yes</button>
            <button id="confirmNo"
                style="background-color: #6c757d; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">No</button>
        </div>
    </div>

    <!-- Notification box for success message -->
    <div id="notificationBox" class="container text-center mx-auto" style="width: 400px; display: none;">
        <div id="alertBox" class="alert alert-success text-center" role="alert">
            <h5 class="fst-italic">Deleted successfully</h5>
        </div>
    </div>
    <?php
}

/**
 * Show pagination bottom of the page
 * 
 * @return string|null
 */
function get_pagination($table_name, $conn, $limit, $page, $url)
{
    ?>
    <div class="pagination py-5 text-center">
        <nav aria-label="Page navigation example mx-auto">
            <?php

            $sql1 = "SELECT * FROM $table_name";

            $result1 = mysqli_query($conn, $sql1);

            if (mysqli_num_rows($result1) > 0) {
                $total_records = mysqli_num_rows($result1);

                $total_pages = ceil($total_records / $limit);
                ?>
                <ul class="pagination justify-content-center">

                    <?php
                    if ($page > 1) {
                        ?>
                        <li class="page-item"><a class="page-link" href=" <?php echo $url . $page - 1; ?>">Prev</a>
                        </li>
                        <?php
                    }
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $page) {
                            $active = 'active';
                        } else {
                            $active = '';
                        }
                        ?>
                        <li class="page-item <?php echo $active; ?>"><a class="page-link"
                                href=" <?php echo $url . $i; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php
                    }
                    if ($total_pages > $page) {
                        ?>
                        <li class="page-item"><a class="page-link" href=" <?php echo $url . $page + 1; ?>">Next</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
            }
            ?>
        </nav>
    </div>
    <?php
}

/**
 * Handle text to show some limit characters
 * 
 * @return string|null
 */
function text_limit($x, $length)
{
    if (strlen($x) <= $length) {
        echo $x;
    } else {
        $y = substr($x, 0, $length) . '...';
        echo $y;
    }
}


