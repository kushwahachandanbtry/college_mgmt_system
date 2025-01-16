<?php
include './FetchAdminDataController.php';
include "../helpers.php";
if (isset($_GET['msg'])) {
    add_success_message($_GET['msg']);
}
if (isset($_GET['errors'])) {
    add_failled_message($_GET['errors']);
}
?>
<div class="container-fluid">
    <?php
    if( $_SESSION['role'] == 'admin' ||  $_SESSION['role'] == 'teacher' ) {
    ?>
        <button class="mt-4 add-routine btn btn-primary"><a href="?content=add-routine">Add New Routine</a></button>
    <?php } ?>

    <?php

delete_data_message();
if (!empty($class_routines) && is_array($class_routines)) {
    foreach ($class_routines as $class_routine) {
    $i = 1;
        // Decode the JSON data from the routine field
        $datas = $class_routine['routine'];
        $decode_data = json_decode($datas, true);
?>
    <div class="routine-list my-5">
        <form action="">
            <div class="py-3 d-flex">
                <h2><?php echo $i++; ?></h2>
                <h3>Routine of <span class="text-danger"><?php echo $class_routine['class']; ?></span> Class</h3>
            </div>

            <div class="pb-4">
                <table border="1" align="center" cellspacing="0" cellpadding="">
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
            <?php if( $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher' ) { ?>
                <div class="text-center py-3">
                    <a style="background: #0D6EFD; padding: 5px 15px; color: #fff; font-size: 18px; border-radius: 10px;" href="?content=edit_routine&&id=<?php echo $row['id']; ?>">Edit</a>
                    <a style="background: red; cursor: pointer; padding: 5px 15px; color: #fff; font-size: 18px; border-radius: 10px;" onclick="confirmDelete(<?php echo $row['id']; ?>, 'routine')">Delete</a>
                </div>
            <?php } ?>
        </form>
    </div>
<?php
    }
}
// Close the database connection
$conn->close();
?>






