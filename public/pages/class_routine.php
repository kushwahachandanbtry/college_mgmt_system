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

    <div class="container-fluid text-center">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
        <h2>Class Routine</h2>
        </div><!-- End Section Title -->

        <?php

        if (!empty($class_routines) && is_array($class_routines)) {
            foreach ($class_routines as $class_routine) {
                $i = 1;
                // Decode the JSON data from the routine field
                $datas = $class_routine['routine'];
                $decode_data = json_decode($datas, true);
                ?>
                <div class="routine-list bg-light mx-5 py-3 mb-5" data-aos="fade-up" >
                    <form action="">
                        <div class="py-3">
                            <h3>Routine of <span class="text-danger"><?php echo $class_routine['class']; ?></span> Class</h3>
                        </div>

                        <div class="pb-4">
                            <table id="smsTable" class="table table-striped table-hover">
                                <tr class="bg-info">
                                    <th>Days</th>
                                    <th>1st Period</th>
                                    <th>2nd Period</th>
                                    <th>3rd Period</th>
                                    <th>Break</th>
                                    <th>4th Period</th>
                                    <th>5th Period</th>
                                </tr>
                                <?php
                                // Loop through each day and display its schedule
                                foreach ($decode_data as $day => $schedule) {
                                    ?>
                                    <tr>
                                        <input type="text" value="<?php echo $row['id']; ?>" hidden>
                                        <td><?php echo ucfirst($day); ?></td>
                                        <td><?php echo isset($schedule['1st']) ? $schedule['1st'] : ''; ?></td>
                                        <td><?php echo isset($schedule['2nd']) ? $schedule['2nd'] : ''; ?></td>
                                        <td><?php echo isset($schedule['3rd']) ? $schedule['3rd'] : ''; ?></td>
                                        <td><?php echo isset($schedule['break']) ? $schedule['break'] : ''; ?></td>
                                        <td><?php echo isset($schedule['4th']) ? $schedule['4th'] : ''; ?></td>
                                        <td><?php echo isset($schedule['5th']) ? $schedule['5th'] : ''; ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>

                    </form>
                </div>
                <?php
            }
        }

        ?>







    </div>
</div>
    <?php
    require '../includes/footer.php';
    ?>

