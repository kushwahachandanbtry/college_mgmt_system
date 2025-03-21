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
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <?php if ($_SESSION['role'] == 'admin') { ?>
            <th>Actions</th>
        <?php } ?>
    </tr>
    <?php
    if (!empty($users) && is_array($users)) {
        foreach ($users as $user) {
            ?>
            <tr class="fs-1">
                <td><?php echo $user['id']; ?></td>
                <td><img src="../assets/images/users/<?php echo $user['image']; ?>" alt="student-img"
                        style="width: 60px; height: 60px; border-radius: 50%;"></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <?php if ($_SESSION['role'] == 'admin') { ?>
                    <td parent-id="<?php echo $user['id']; ?>" class="parent_actions"
                        style="font-family:bold; font-size: 30px; padding-left:25px; color: #0D6EFD; cursor:pointer;"
                        onclick="handleClick(event, this)">
                        ...
                        <div action_id="<?php echo $user['id']; ?>" class="actions" style="display:none;">
                            <ul>
                                <li data-id="<?php echo $user['id']; ?>"
                                    onclick="showUserDetails(<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8'); ?>)">
                                    View</li>
                                <li><a href="?content=edit_user&&id=<?php echo $user['id']; ?>">Edit</a></li>
                                <li style="color: red;" onclick="confirmDelete(<?php echo $user['id']; ?>, 'user')">Delete</li>
                            </ul>
                        </div>
                    </td>
                <?php } ?>
            </tr>
            <?php
        }
        ?>
    </table>
    <!-- table end -->
<?php } ?>

<!-- view model -->
<div id="viewModal" class="view-modal" style="display:none;">
    <div class="view-popup">
        <h5>View User Details</h5>
        <form action="" class="px-5" method="POST" enctype="multipart/form-data">
            <div class="d-flex py-3">
                <div class="mr-5">
                    <label>Name:</label>
                    <input type="text" id="modalName" name="name" class="form-control py-2 px-4" readonly>
                </div>

                <div class="mx-5 col-6">
                    <label>Email:</label>
                    <input type="text" id="modalEmail" name="email" class="form-control py-2 px-4" readonly>
                </div>
            </div>
            <div class="d-flex py-3">
                <div class="">
                    <label>Role:</label>
                    <input type="text" id="modalRole" name="role" class="form-control py-2 px-4" readonly>
                </div>
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-warning px-5 my-3" onclick="closeModal()">CLOSE</button>
            </div>
        </form>
    </div>
</div>
<!-- end view model -->

<!-- pagination -->
<?php
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offsets = ($page - 1) * $limit;
get_pagination('users', $conn, $limit, $page, APP_PATH . '/admin/dashboard.php?content=allusers&&page=');
?>

