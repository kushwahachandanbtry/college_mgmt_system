<?php

/**
 * Return back to the previous page
 * 
 * @return string|null
 */
function go_back($content)
{
    // Sanitize content to avoid XSS
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

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
    // Sanitize and escape the message to avoid XSS
    $msg = htmlspecialchars($msg, ENT_QUOTES, 'UTF-8');
    ?>
    <div class="container text-center mx-auto" style="width: 400px;">
        <div id="alertBox" class="alert alert-success text-center" role="alert">
            <h5 class="fst-italic"><?php echo $msg; ?></h5>
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

function add_failled_message($error)
{
    // Sanitize and escape the error message to avoid XSS
    $error = htmlspecialchars($error, ENT_QUOTES, 'UTF-8');
    ?>
    <div class="container text-center mx-auto" style="width: 400px; height: 100%;">
        <div id="alertBox" class="alert alert-danger text-center" role="alert">
            <h5 class="fst-italic"><?php echo $error; ?></h5>
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

function data_add_success_message()
{
    ?>
    <div class="container text-center mx-auto" style="width: 400px;">
        <div id="alertBox" class="alert alert-success text-center" role="alert">
            <h5 class="fst-italic">Added successfully!</h5>
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

function data_add_failed_message()
{
    ?>
    <div class="container text-center mx-auto" style="width: 400px;">
        <div id="alertBox" class="alert alert-danger text-center" role="alert">
            <h5 class="fst-italic">Added failed!</h5>
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
            // Use prepared statements to avoid SQL injection
            $stmt = $conn->prepare("SELECT * FROM $table_name");
            $stmt->execute();
            $result1 = $stmt->get_result();

            if ($result1->num_rows > 0) {
                $total_records = $result1->num_rows;

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
        echo htmlspecialchars($x, ENT_QUOTES, 'UTF-8'); // Escape the text before displaying
    } else {
        $y = substr($x, 0, $length) . '...';
        echo htmlspecialchars($y, ENT_QUOTES, 'UTF-8'); // Escape the text before displaying
    }
}

/**
 * Handle send email
 * @param mixed $to
 * @param mixed $subject
 * @param mixed $body
 * @return bool
 */
function sendEmail($to, $subject, $body) {
    $headers = "From: no-reply@example.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    return mail($to, $subject, $body, $headers);
}
