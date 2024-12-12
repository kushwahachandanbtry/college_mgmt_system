
<?php
include dirname(__DIR__, 2). '/config.php';
include "../helpers.php";
go_back('item6');

if( isset( $_GET['id'] ) ) {
    $id = $_GET['id'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $class = $_POST['class_name'];
    
        $array_data = array(
            'sunday' => array(
                '1st' => $_POST['sunday_1st'],
                '2nd' => $_POST['sunday_2nd'],
                '3rd' => $_POST['sunday_3rd'],
                'break' => $_POST['sunday_break'],
                '4th' => $_POST['sunday_4th'],
                '5th' => $_POST['sunday_5th'],
            ),
            'monday' => array(
                '1st' => $_POST['monday_1st'],
                '2nd' => $_POST['monday_2nd'],
                '3rd' => $_POST['monday_3rd'],
                'break' => $_POST['monday_break'],
                '4th' => $_POST['monday_4th'],
                '5th' => $_POST['monday_5th'],
            ),
            'tuesday' => array(
                '1st' => $_POST['tuesday_1st'],
                '2nd' => $_POST['tuesday_2nd'],
                '3rd' => $_POST['tuesday_3rd'],
                'break' => $_POST['tuesday_break'],
                '4th' => $_POST['tuesday_4th'],
                '5th' => $_POST['tuesday_5th'],
            ),
            'wednesday' => array(
                '1st' => $_POST['wednesday_1st'],
                '2nd' => $_POST['wednesday_2nd'],
                '3rd' => $_POST['wednesday_3rd'],
                'break' => $_POST['wednesday_break'],
                '4th' => $_POST['wednesday_4th'],
                '5th' => $_POST['wednesday_5th'],
            ),
            'thrusday' => array(
                '1st' => $_POST['thrusday_1st'],
                '2nd' => $_POST['thrusday_2nd'],
                '3rd' => $_POST['thrusday_3rd'],
                'break' => $_POST['thrusday_break'],
                '4th' => $_POST['thrusday_4th'],
                '5th' => $_POST['thrusday_5th'],
            ),
            'friday' => array(
                '1st' => $_POST['friday_1st'],
                '2nd' => $_POST['friday_2nd'],
                '3rd' => $_POST['friday_3rd'],
                'break' => $_POST['friday_break'],
                '4th' => $_POST['friday_4th'],
                '5th' => $_POST['friday_5th'],
            ),
        );
    
        include_once 'config.php';
        $data_json = json_encode($array_data);
    
        $sql = "UPDATE routines SET class = '{$class}', routine = '$data_json' WHERE id = $id";
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            edit_success_message();
        } else {
            edit_failed_message();
        }
    }

$sql = "SELECT * FROM routines WHERE id = $id ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $datas = $row['routine'];
        $decode_data = json_decode($datas, true);
?>
<div class="edit-routine">
    <div class="edit-routine-area p-3">
        <form action="" method="POST">
            <div class="py-3">
                <h5>Edit Routine <button onclick="goBack();" class="btn btn-info ml-5">Go Back</button></h5>
                <label for="">Enter class:</label>
                <input type="text" name="class_name" value="<?php echo $row['class']; ?>" required><br>
            </div>

            <div>
                <table border="1" cellspacing="0" cellpadding="9">
                    <tr class="bg-info">
                        <th>Days</th>
                        <th>1st period</th>
                        <th>2nd period</th>
                        <th>3rd period</th>
                        <th>Break</th>
                        <th>4th period</th>
                        <th>5th period</th>
                    </tr>
                    <?php foreach ($decode_data as $day => $schedule) { ?>
                    <tr>
                        <td><?php echo ucfirst($day); ?></td>
                        <td><input type="text" name="<?php echo $day; ?>_1st" value="<?php echo $schedule['1st'] ?? ''; ?>"></td>
                        <td><input type="text" name="<?php echo $day; ?>_2nd" value="<?php echo $schedule['2nd'] ?? ''; ?>"></td>
                        <td><input type="text" name="<?php echo $day; ?>_3rd" value="<?php echo $schedule['3rd'] ?? ''; ?>"></td>
                        <td><input type="text" name="<?php echo $day; ?>_break" value="<?php echo $schedule['break'] ?? ''; ?>"></td>
                        <td><input type="text" name="<?php echo $day; ?>_4th" value="<?php echo $schedule['4th'] ?? ''; ?>"></td>
                        <td><input type="text" name="<?php echo $day; ?>_5th" value="<?php echo $schedule['5th'] ?? ''; ?>"></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <button class="btn btn-primary my-3 px-5" name="update" type="submit">Update</button>
            <h3 class="text-primary text-center text-italic message"></h3>
        </form>
    </div>
</div>

<?php
    }
}
}  

?>

