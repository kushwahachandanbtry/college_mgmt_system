<?php
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
    if (isset($_SESSION['admin'])) {
        ?>
        <button class="add-exam-routine btn btn-primary">Add Exam Routine</button>
        <?php
    }
    $i = 1;
    delete_data_message();
    if (!empty($exam_schedules) && is_array($exam_schedules)) {
        foreach ($exam_schedules as $exam_schedule) {

            ?>
            <div class="routine-list my-5">
                <form action="">
                    <div class="py-3 d-flex">
                        <h2><?php echo $i++; ?></h2>
                        <h3 class="">Routine of <span
                                class="text-danger"><?php echo $exam_schedule['class'] . " " . $exam_schedule['running_sem_or_year'] . " " . $exam_schedule['year_or_semester']; ?></span>
                        </h3>
                    </div>
                    <img src="../assets/images/exam_routine/<?php echo $exam_schedule['images']; ?>"
                        alt="<?php echo $exam_schedule['images']; ?>" style="width: 100%; height: auto; ">

                    <?php
                    if (isset($_SESSION['admin'])) {
                        ?>
                        <div class="text-center py-3">
                            <a style="background: #0D6EFD; padding: 5px 15px; color: #fff; font-size: 18px; border-radius: 10px;"
                                href="?content=edit_exam_routine&&id=<?php echo $exam_schedule['id']; ?>">Edit</a>
                            <a style="background: red; cursor: pointer; padding: 5px 15px; color: #fff; font-size: 18px; border-radius: 10px;"
                                onclick="confirmDelete(<?php echo $exam_schedule['id']; ?>, 'examRoutine')">Delete</a>
                        </div>
                    <?php } ?>
                </form>
            </div>
            <?php
        }
    }
    ?>



    <!-- routine area -->
    <div class="exam-routine text-center">
        <div class="exam-routine-area p-3">
            <form action="actions/exam_schedule.php" method="POST" enctype="multipart/form-data">
                <div class="py-3">
                    <div class="d-flex justify-content-between">
                        <h5 class="text-center">Add Exam Routine</h5>
                        <h1 class="exam-routine-close"><span>X</span></h1>
                    </div>
                    <label for="">Enter Class:</label>
                    <input type="text" name="class_name" placeholder="example: BCA" required><br><br>

                    <label for="">Select Semester or Year </label>
                    <select name="year_or_semester" required id="">
                        <option value="" disabled>Choose One</option>
                        <option value="year">Year</option>
                        <option value="semester">Semester</option>
                    </select><br><br>
                    <label for="">Enter Semester or Year:</label>
                    <input type="number" name="running_sem_or_year" placeholder="example: 2,3,4 only in digits"
                        required><br><br>
                    <label for="">Insert image:</label>
                    <input type="file" name="exam_images" required><br>
                </div>

                <div>

                </div>
                <button class="btn btn-primary my-3 px-5" type="submit">Save</button>
            </form>
        </div>

    </div>
</div>
<!-- pagination -->
<?php
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offsets = ($page - 1) * $limit;
get_pagination('parents', $conn, $limit, $page, APP_PATH . '/admin/dashboard.php?content=item18&&page=');
?>

