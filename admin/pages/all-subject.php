<!-- for search -->
<div class="search-box py-3">
    <input type="text" id="" onkeyup="searchByName()" class="p-2 searchName" placeholder="search by Name...">
</div>

<?php
include './FetchAdminDataController.php';
include "../helpers.php";

delete_data_message();
?>

<!-- view data in table -->
<table id="smsTable" class="table table-striped table-hover">
    <tr>
        <th>S.N</th>
        <th>Class</th>
        <th>Semester</th>
        <th>Teacher</th>
        <th>Subject</th>
        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher') { ?>
            <th>Actions</th>
        <?php } ?>

    </tr>
    <?php
    $i = 1;
    if (!empty($subjects) && is_array($subjects)) {
        foreach ($subjects as $subject) {
            ?>
            <tr class="fs-1">
                <td><?php echo $i++; ?></td>
                <td><?php echo strtoupper($subject['class']); ?></td>
                <td><?php echo strtoupper($subject['semester']); ?></td>
                <td><?php echo strtoupper($subject['teacher']); ?></td>
                <td><?php echo strtoupper($subject['s_name']); ?></td>
                <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher') { ?>
                    <td parent-id="<?php echo $subject['id']; ?>" class="parent_actions"
                        style="font-family:bold; font-size: 30px; padding-left:25px; color: #0D6EFD; cursor:pointer;"
                        onclick="handleClick(event, this)">
                        ...
                        <div action_id="<?php echo $subject['id']; ?>" class="actions" style="display:none;">
                            <ul>
                                <li><a href="?content=edit_subject&&id=<?php echo $subject['id']; ?>">Edit</a></li>
                                <li style="color: red;" onclick="confirmDelete(<?php echo $subject['id']; ?>, 'subjects')">Delete</li>
                            </ul>
                        </div>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
    <!-- table end -->
<?php } ?>


<!-- pagination -->
<?php
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offsets = ($page - 1) * $limit;
get_pagination('subjects', $conn, $limit, $page, APP_PATH.'/admin/dashboard.php?content=all_subject&&page=');
?>

