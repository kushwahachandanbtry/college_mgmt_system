<?php
/**
 * This file is used to display exam schedule
 *
 * @package college-management-system
 */

/**
 * Requiring header and menu page
 */
?>

<div style="background: #FFC6C5;" class="thankyou-text py-5 ">

    <div class="container-fluid text-center">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
        <h2>Class Routine</h2>
        </div><!-- End Section Title -->

        <?php

        // Check if the class_routines data exists and is an array
        if (!empty($class_routines) && is_array($class_routines)) {
            foreach ($class_routines as $class_routine) {
                $i = 1;
                // Decode the JSON data from the routine field (ensure data is properly validated)
                $datas = isset($class_routine['routine']) ? $class_routine['routine'] : '';
                $decode_data = json_decode($datas, true);
                
                // Validate JSON decoding
                if (json_last_error() !== JSON_ERROR_NONE) {
                    echo "<p>Error in class routine data.</p>";
                    continue;
                }
                ?>
                <div class="routine-list bg-light mx-5 py-3 mb-5" data-aos="fade-up">
                    <form action="" method="post">
                        <div class="py-3">
                            <h3>Routine of <span class="text-danger"><?php echo htmlspecialchars($class_routine['class']); ?></span> Class</h3>
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
                                        <!-- Safely output the value of $row['id'] by using htmlspecialchars -->
                                        <input type="text" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" hidden>
                                        <td><?php echo htmlspecialchars(ucfirst($day), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo isset($schedule['1st']) ? htmlspecialchars($schedule['1st'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
                                        <td><?php echo isset($schedule['2nd']) ? htmlspecialchars($schedule['2nd'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
                                        <td><?php echo isset($schedule['3rd']) ? htmlspecialchars($schedule['3rd'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
                                        <td><?php echo isset($schedule['break']) ? htmlspecialchars($schedule['break'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
                                        <td><?php echo isset($schedule['4th']) ? htmlspecialchars($schedule['4th'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
                                        <td><?php echo isset($schedule['5th']) ? htmlspecialchars($schedule['5th'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
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
