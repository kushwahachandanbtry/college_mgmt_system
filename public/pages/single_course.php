<?php
/**
 * This file includes all our single page related content
 *
 * @package school-management-system
 */

/**
 * Requiring header and menu file
 */
require '../includes/menu.php';

?>
<?php
$id = $_GET['id'];
$staff = "SELECT * FROM courses WHERE id = '$id'";
$staff_result = mysqli_query($conn, $staff);
if (mysqli_num_rows($staff_result) > 0) {
    while ($row = mysqli_fetch_assoc($staff_result)) {
        ?>
        <div class="course-overlay">
            <img src="../../assets/images/courses/course_images/<?php echo $row['course_image']; ?>" width="100%"
                alt="<?php echo $row['course_title']; ?>" class="img-fluid">
            <h1><?php echo $row['course_title']; ?></h1>
        </div>
        <div class="single-course-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="d-flex text-center justify-content-center pt-4">
                        <h4 
                            style="color: #000; cursor: pointer; border-bottom: 1px solid red; display: inline-block; margin-right: 20px;"
                            id="description-tab" 
                            onclick="showSection('course_data')">
                            Description
                        </h4>
                        <h4 
                            style="color: #000; cursor: pointer; border-bottom: 1px solid red; display: inline-block; margin-left: 20px;"
                            id="syllabus-tab" 
                            onclick="showSection('course_syllabus')">
                            Syllabus
                        </h4>
                    </div>

                        <div class="d-flex justify-content-between px-5 pb-3 py-5">
                            <div class="">
                                <h4 style="color: #000;">Categories:</h4>
                                <h5 style="color: #000;" class=""><i class="fa-solid fa-check"
                                        style="color: red;"></i></i><?php echo $row['categories']; ?></h5>
                            </div>
                            <div class="">
                                <h4 style="color: #000;">Duration:</h4>
                                <h5 style="color: #000;" class=""><i class="fa-solid fa-graduation-cap"
                                        style="color: red;"></i></i></i><?php echo $row['duration'] . " Years"; ?></h5>
                            </div>
                            <div class="py-2">
                                <a class=" btn btn-primary"
                                    href="register.php">Apply Now</a>
                            </div>
                        </div>
                        <div>
                            <h4 class="py-3"><?php echo $row['course_title']; ?></h4>
                            
                        </div>
                        
                        <!-- Content Sections -->
                    <div id="course_data" class="pb-5">
                        <p><?php echo html_entity_decode($row['course_description']); ?></p>
                        <h4 class="py-3">Intake</h4>
                        <p><?php echo html_entity_decode($row['intake']); ?></p>
                        <h4 class="py-3">Objectives</h4>
                        <p><?php echo html_entity_decode($row['course_objectives']); ?></p>
                    </div>

                    <div id="course_syllabus" class="pb-5" style="display: none;">
                        <img src="../../assets/images/courses/syllabus_images/<?php echo $row['syllabus_image']; ?>" 
                            width="100%" 
                            alt="<?php echo $row['syllabus_image']; ?>" 
                            class="img-fluid">
                    </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
    }
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
<?php
require '../includes/footer.php';
?>

