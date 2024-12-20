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

$sql = "SELECT * FROM parents LIMIT {$offsets}, {$limit}";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    delete_data_message();
    ?>

    <!-- view data in table -->
    <table id="smsTable" class="table table-striped table-hover">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Occupation</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Children's Name</th>
            <?php if( isset( $_SESSION['admin'] )) { ?>
                <th>Actions</th>
            <?php } ?>

        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr class="fs-1">
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['occupation']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['childrens_name']; ?></td>
                <?php if( isset( $_SESSION['admin'] )) { ?>
                    <td parent-id="<?php echo $row['id']; ?>" class="parent_actions"
                    style="font-family:bold; font-size: 30px; padding-left:25px; color: #0D6EFD; cursor:pointer;"
                    onclick="handleClick(event, this)">
                    ...
                        <div action_id="<?php echo $row['id']; ?>" class="actions" style="display:none;">
                            <ul>
                                <li data-id="<?php echo $row['id']; ?>"
                                    onclick="showParentDetails(<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>)">
                                    View</li>
                                <li><a href="?content=edit_parent&&id=<?php echo $row['id']; ?>">Edit</a></li>
                                <li style="color: red;" onclick="confirmDelete(<?php echo $row['id']; ?>, 'parent')">Delete</li>
                            </ul>
                        </div>
                    </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
        <!-- table end -->
<?php } ?>

<!-- view model -->
<div id="viewModal" class="view-modal" style="display:none;">
    <div class="view-popup">
        <h5>View Parent Details</h5>
        <form action="" class="px-1" method="POST" enctype="multipart/form-data">
            <div class="d-flex py-3">
                <div class="mr-5">
                    <label>Name:</label>
                    <input type="text" id="name" class="form-control py-2 px-4" readonly>
                </div>

                <div class="mx-1 col-5">
                    <label>Email:</label>
                    <input type="text" id="email" class="form-control py-2 px-4" readonly>
                </div>
            </div>
            <div class="d-flex py-3">
                <div class="">
                    <label>Gender:</label>
                    <input type="text" id="gender" class="form-control py-2 px-4" readonly>
                </div>
                <div class="px-2">
                    <label>Address:</label><br>
                    <textarea name="" readonly id="address" cols="50" rows="3"></textarea>
                </div>
            </div>
            <div class="d-flex py-3">
                <div class="">
                    <label>Occupation:</label>
                    <input type="text" id="occupation" class="form-control py-2 px-4" readonly>
                </div>
                <div class="px-2">
                    <label>Children's Name:</label>
                    <input type="text" id="childrens_name" class="form-control py-2 px-4" readonly>
                </div>
                <div class="px-2">
                    <label>Phone:</label>
                    <input type="text" id="phone" class="form-control py-2 px-4" readonly>
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
<?php get_pagination('parents',  $conn, $limit, $page, 'http://localhost/school_management_system/admin/dashboard.php?content=item7&&page=');?>

