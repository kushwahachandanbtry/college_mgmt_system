<?php
/**
 * This file is used to display exam schedule
 *
 * @package college-management-system
 */

/**
 * Requiring header and menu page
 */
require '../includes/menu.php';
?>

<div style="background: #FFC6C5;" class="thankyou-text py-5 ">
    <!-- Section Title -->
    <div class="container section-title" style="margin-bottom: -40px;" data-aos="fade-up">
        <h2>Exam Schedule</h2>
    </div><!-- End Section Title -->
    <?php
    if( !empty( $exam_schedules ) && is_array( $exam_schedules )) {
        foreach( $exam_schedules as $exam_schedule ) {
            ?>
            <div class="container" style="background: #fff; width: 70%; height: 100%;" data-aos="fade-up">
                <div class="notice-content py-5" style="margin: 0 50px;">
                    <div class="d-flex justify-content-between">
                        <h3 class="text-left text-uppercase pt-4" style="font-size: 40px;"><b>Examination</b> <br> Schedule</h3>
                        <img src="../../assets/images/logo/<?php echo urlencode($logo); ?>" alt="logo" style="width: 300px;">
                    </div>
                    <?php
                    $indicators = 'th';
                    switch($exam_schedule['running_sem_or_year']) {
                        case '1':
                            $indicators = 'st';
                            break;

                        case '2':
                            $indicators = 'nd';
                            break;

                        case '3':
                            $indicators = 'rd';
                            break;

                        default:
                            $indicators = 'th';
                            break;
                    }
                    ?>
                    <h3 style="color: #0054A6;">For <?php echo htmlspecialchars( $exam_schedule['class']) . " " . htmlspecialchars( $exam_schedule['running_sem_or_year']) . $indicators.  " " . htmlspecialchars( $exam_schedule['year_or_semester']); ?></h3>
                    <div class="text-center pt-4">
                        <img style="width: 100%; height: 100%;" src="../../assets/images/exam_routine/<?php echo urlencode($exam_schedule['images']); ?>" alt="<?php echo htmlspecialchars( $exam_schedule['class']); ?>">
                    </div>
                </div>
            </div>
            <?php 
        }
    }
    ?>
</div>

<?php
require '../includes/footer.php';
?>


