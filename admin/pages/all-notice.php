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
        <th>Title</th>
        <th>Details</th>
        <th>Posted By</th>
        <th>Date</th>
        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher') { ?>
            <th>Actions</th>
        <?php } ?>

    </tr>
    <?php
    $i = 1;
    if (!empty($notices) && is_array($notices)) {
        foreach ($notices as $notice) {
            ?>
            <tr class="fs-1">
                <td><?php echo $i++; ?></td>
                <td><?php echo strtoupper($notice['title']); ?></td>
                <td><?php echo strtoupper($notice['details']); ?></td>
                <td><?php echo strtoupper($notice['posted_by']); ?></td>
                <td><?php echo strtoupper($notice['date']); ?></td>
                <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher') { ?>
                    <td parent-id="<?php echo $notice['id']; ?>" class="parent_actions"
                        style="font-family:bold; font-size: 30px; padding-left:25px; color: #0D6EFD; cursor:pointer;"
                        onclick="handleClick(event, this)">
                        ...
                        <div action_id="<?php echo $notice['id']; ?>" class="actions" style="display:none;">
                            <ul>
                                <li><a href="?content=edit_notice&&id=<?php echo $notice['id']; ?>">Edit</a></li>
                                <li style="color: red;" onclick="confirmDelete(<?php echo $notice['id']; ?>, 'delete_notice')">Delete</li>
                            </ul>
                        </div>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
    <!-- table end -->
<?php }
?>


<!-- pagination -->
<?php
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offsets = ($page - 1) * $limit;
get_pagination('notice', $conn, $limit, $page, APP_PATH.'/admin/dashboard.php?content=all_notice&&page=');
