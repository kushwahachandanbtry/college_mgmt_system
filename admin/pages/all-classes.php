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
        <th>Id</th>
        <th>Classes</th>
        <?php if (isset($_SESSION['admin']) || $_SESSION['role'] == 'teacher') { ?>
            <th>Actions</th>
        <?php } ?>

    </tr>
    <?php
    $i = 1;
    if (!empty($classes) && is_array($classes)) {
        foreach ($classes as $class) {
            ?>
            <tr class="fs-1">
                <td><?php echo $i++; ?></td>
                <td><?php echo strtoupper($class['classes']); ?></td>
                <?php if (isset($_SESSION['admin']) || $_SESSION['role'] == 'teacher') { ?>
                    <td parent-id="<?php echo $class['id']; ?>" class="parent_actions"
                        style="font-family:bold; font-size: 30px; padding-left:25px; color: #0D6EFD; cursor:pointer;"
                        onclick="handleClick(event, this)">
                        ...
                        <div action_id="<?php echo $class['id']; ?>" class="actions" style="display:none;">
                            <ul>
                                <li><a href="?content=edit_class&&id=<?php echo $class['id']; ?>">Edit</a></li>
                                <li style="color: red;" onclick="confirmDelete(<?php echo $class['id']; ?>, 'class')">Delete</li>
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
get_pagination('users', $conn, $limit, $page, APP_PATH.'/admin/dashboard.php?content=item3&&page=');
?>

