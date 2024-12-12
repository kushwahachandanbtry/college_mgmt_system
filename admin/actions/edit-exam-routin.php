<?php
include dirname(__DIR__, 2). '/config.php';
include "../helpers.php"; // Assuming this contains reusable functions like `go_back()`
go_back('item18');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $class = $_POST['class_name'];
        $exam_time = $_POST['exam_time'];

        $array_data = array(
            'date' => array(
                $_POST['date1'],
                $_POST['date2'],
                $_POST['date3'],
                $_POST['date4'],
                $_POST['date5'],
            ),
            'subject' => array(
                $_POST['sub1'],
                $_POST['sub2'],
                $_POST['sub3'],
                $_POST['sub4'],
                $_POST['sub5'],
            ),
        );

        $data_json = json_encode($array_data);

        $sql = "UPDATE exam_routine SET class = '{$class}', schedule = '$data_json', time = '{$exam_time}' WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            edit_success_message();
        } else {
            edit_failed_message();
        }
    }

    $sql = "SELECT * FROM exam_routine WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $datas = $row['schedule'];
        $decode_data = json_decode($datas, true);
?>

<div class="edit-exam-routine text-center">
    <form action="" method="POST">
        <h5>Edit Routine <button onclick="goBack();" class="btn btn-info ml-5">Go Back</button></h5>
        <label>Class:</label>
        <input type="text" name="class_name" value="<?php echo $row['class']; ?>" required><br>

        <label>Exam Time:</label>
        <input type="text" name="exam_time" value="<?php echo $row['time']; ?>" required><br>

        <table border="1" align="center" cellspacing="0" cellpadding="5">
            <tr>
                <th>Date</th>
                <th>Subject</th>
            </tr>
            <?php
            for ($i = 0; $i < count($decode_data['date']); $i++) {
                $date = $decode_data['date'][$i];
                $subject = $decode_data['subject'][$i];
            ?>
            <tr>
                <td><input type="text" name="date<?php echo $i + 1; ?>" value="<?php echo $date; ?>" required></td>
                <td><input type="text" name="sub<?php echo $i + 1; ?>" value="<?php echo $subject; ?>" required></td>
            </tr>
            <?php } ?>
        </table>

        <button class="btn btn-primary mt-3" name="update" type="submit">Update</button>
    </form>
</div>

<?php
    } else {
        echo 'No data found for the given ID.';
    }
} else {
    echo 'Invalid request. No ID provided.';
}
?>
