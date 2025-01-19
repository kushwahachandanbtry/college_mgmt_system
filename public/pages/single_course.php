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

<?php
// Use prepared statements to prevent SQL injection
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];  // Sanitize the input by casting to integer

    // Prepared statement to fetch the course details
    $stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" denotes that $id is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="course-overlay">
                <img src="assets/images/courses/course_images/<?php echo htmlspecialchars($row['course_image'], ENT_QUOTES, 'UTF-8'); ?>" width="100%" 
                    alt="<?php echo htmlspecialchars($row['course_title'], ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid">
                <h1><?php echo htmlspecialchars($row['course_title'], ENT_QUOTES, 'UTF-8'); ?></h1>
            </div>
            <div class="single-course-item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="d-flex text-center justify-content-center pt-4">
                            <h4 style="color: #000; cursor: pointer; border-bottom: 1px solid red; display: inline-block; margin-right: 20px;"
                                id="description-tab" 
                                onclick="showSection('course_data')">
                                Description
                            </h4>
                            <h4 style="color: #000; cursor: pointer; border-bottom: 1px solid red; display: inline-block; margin-left: 20px;"
                                id="syllabus-tab" 
                                onclick="showSection('course_syllabus')">
                                Syllabus
                            </h4>
                        </div>

                            <div class="d-flex justify-content-between px-5 pb-3 py-5">
                                <div class="">
                                    <h4 style="color: #000;">Categories:</h4>
                                    <h5 style="color: #000;" class=""><i class="fa-solid fa-check" style="color: red;"></i><?php echo htmlspecialchars($row['categories'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                </div>
                                <div class="">
                                    <h4 style="color: #000;">Duration:</h4>
                                    <h5 style="color: #000;" class=""><i class="fa-solid fa-graduation-cap" style="color: red;"></i><?php echo htmlspecialchars($row['duration'], ENT_QUOTES, 'UTF-8') . " Years"; ?></h5>
                                </div>
                                <div class="py-2">
                                    <a class="btn btn-primary" href="?page=get-started">Apply Now</a>
                                </div>
                            </div>
                            <div>
                                <h4 class="py-3"><?php echo htmlspecialchars($row['course_title'], ENT_QUOTES, 'UTF-8'); ?></h4>
                            </div>
                            
                            <!-- Content Sections -->
                        <div id="course_data" class="pb-5">
                            <p><?php echo nl2br(htmlspecialchars($row['course_description'], ENT_QUOTES, 'UTF-8')); ?></p>
                            <h4 class="py-3">Intake</h4>
                            <p><?php echo nl2br(htmlspecialchars($row['intake'], ENT_QUOTES, 'UTF-8')); ?></p>
                            <h4 class="py-3">Objectives</h4>
                            <p><?php echo nl2br(htmlspecialchars($row['course_objectives'], ENT_QUOTES, 'UTF-8')); ?></p>
                        </div>

                        <div id="course_syllabus" class="pb-5" style="display: none;">
                            <img src="assets/images/courses/syllabus_images/<?php echo htmlspecialchars($row['syllabus_image'], ENT_QUOTES, 'UTF-8'); ?>" 
                                width="100%" 
                                alt="<?php echo htmlspecialchars($row['syllabus_image'], ENT_QUOTES, 'UTF-8'); ?>" 
                                class="img-fluid">
                        </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php
        }
    }
    $stmt->close(); // Close the prepared statement
} else {
    echo "Invalid course ID.";
}
?>

<script>
    function showSection(sectionId) {
        // Hide all sections
        document.getElementById('course_data').style.display = 'none';
        document.getElementById('course_syllabus').style.display = 'none';

        // Show the selected section
        document.getElementById(sectionId).style.display = 'block';
    }
</script>
