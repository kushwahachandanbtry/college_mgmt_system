<!-- for search -->
<div class="search-box py-3">
    <input type="text" id="" onkeyup="searchByName()" class="p-2 searchName" placeholder="search by Name...">
</div>

<?php
include dirname(__DIR__, 2). '/config.php';
include "../helpers.php";

$limit = 10;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}


$offsets = ($page - 1) * $limit;

$sql = "SELECT * FROM classes LIMIT {$offsets}, {$limit}";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    delete_data_message();
    ?>

    <!-- view data in table -->
    <table id="smsTable" class="table table-striped table-hover">
        <tr>
            <th>Id</th>
            <th>Classes</th>
            <?php if( isset( $_SESSION['admin'] ) ||  $_SESSION['role'] == 'teacher') { ?>
                <th>Actions</th>
            <?php } ?>

        </tr>
        <?php
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr class="fs-1">
                <td><?php echo $i++; ?></td>
                <td><?php echo strtoupper($row['classes']); ?></td>
                <?php if( isset( $_SESSION['admin'] ) ||  $_SESSION['role'] == 'teacher') { ?>
                    <td parent-id="<?php echo $row['id']; ?>" class="parent_actions"
                    style="font-family:bold; font-size: 30px; padding-left:25px; color: #0D6EFD; cursor:pointer;"
                    onclick="handleClick(event, this)">
                    ...
                        <div action_id="<?php echo $row['id']; ?>" class="actions" style="display:none;">
                            <ul>
                                <li><a href="?content=edit_class&&id=<?php echo $row['id']; ?>">Edit</a></li>
                                <li style="color: red;" onclick="confirmDelete(<?php echo $row['id']; ?>, 'class')">Delete</li>
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
<?php get_pagination('users',  $conn, $limit, $page, 'http://localhost/school_management_system/admin/dashboard.php?content=item3&&page='); ?>
