<?php
/**
 * This file includes all our single page related content
 *
 * @package college-management-system
 */

/**
 * Requiring header and menu file
 */
include dirname(__DIR__, 2) . '/config.php';

?>

<div class="single-image-item">
    <div class="container">
        <div class="row">
        <?php
        // Check if 'id' is set and is numeric
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = (int) $_GET['id'];  // Sanitize input by casting it to an integer
            
            // Prepared statement to fetch staff details
            $stmt = $conn->prepare("SELECT * FROM staff WHERE id = ?");
            $stmt->bind_param("i", $id); // "i" denotes integer parameter type
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-lg-12 py-5 text-center">
                        <img src="assets/images/staff/<?php echo htmlspecialchars($row['staff_image'], ENT_QUOTES, 'UTF-8'); ?>" 
                            alt="<?php echo htmlspecialchars($row['staff_name'], ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid">
                        <h4 class="py-3"><?php echo htmlspecialchars($row['staff_name'], ENT_QUOTES, 'UTF-8'); ?></h4>
                        <div class="d-flex justify-content-around">
                            <h5 style="color: #0054A6;">
                                <i class="fa-solid fa-envelope" style="padding-right: 10px; color: red;"></i>
                                <?php echo htmlspecialchars($row['staff_email'], ENT_QUOTES, 'UTF-8'); ?>
                            </h5>
                            <h5 style="color: #0054A6;">
                                <i class="fa-solid fa-phone" style="padding-right: 10px; color: red;"></i>
                                <?php echo htmlspecialchars($row['staff_phone'], ENT_QUOTES, 'UTF-8'); ?>
                            </h5>
                        </div>
                        <p style="text-align: left;"><?php echo nl2br(htmlspecialchars($row['about_staff'], ENT_QUOTES, 'UTF-8')); ?></p>
                    </div>
                    <?php
                }
            }
            $stmt->close();  // Close the prepared statement
        } else {
            echo "Invalid staff ID.";
        }
        ?>
        </div>
    </div>
</div>
