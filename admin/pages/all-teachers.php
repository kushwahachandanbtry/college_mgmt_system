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
        <th>Image</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Religion</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Shortbio</th>
        <?php if (isset($_SESSION['admin'])) { ?>
            <th>Actions</th>
        <?php } ?>

    </tr>
    <?php
    if (!empty($teachers) && is_array($teachers)) {
        foreach ($teachers as $teacher) {
            ?>
            <tr class="fs-1">
                <td><?php echo $teacher['id']; ?></td>
                <td><img src="../assets/images/teachers/<?php echo $teacher['image']; ?>" alt="teacher-img"
                        style="width: 60px; height: 60px; border-radius: 50%;"></td>
                <td><?php echo $teacher['fname'] . " " . $teacher['lname']; ?></td>
                <td><?php echo $teacher['gender']; ?></td>
                <td><?php echo $teacher['religions']; ?></td>
                <td><?php echo $teacher['email']; ?></td>
                <td><?php echo $teacher['address']; ?></td>
                <td><?php echo $teacher['Phone']; ?></td>
                <td><?php echo $teacher['shortbio']; ?></td>
                <?php if (isset($_SESSION['admin'])) { ?>
                    <td parent-id="<?php echo $teacher['id']; ?>" class="parent_actions"
                        style="font-family:bold; font-size: 30px; padding-left:25px; color: #0D6EFD; cursor:pointer;"
                        onclick="handleClick(event, this)">
                        ...
                        <div action_id="<?php echo $teacher['id']; ?>" class="actions" style="display:none;">
                            <ul>
                                <li data-id="<?php echo $teacher['id']; ?>"
                                    onclick="showTeacherDetails(<?php echo htmlspecialchars(json_encode($teacher), ENT_QUOTES, 'UTF-8'); ?>)">
                                    View</li>
                                <li><a href="?content=edit_teacher&&id=<?php echo $teacher['id']; ?>">Edit</a></li>
                                <li style="color: red;" onclick="confirmDelete(<?php echo $teacher['id']; ?>, 'teacher')">Delete
                                </li>
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
        <h5>View Teacher Details</h5>
        <form action="" class="px-1" method="POST" enctype="multipart/form-data">
            <div class="d-flex py-3">
                <!-- <div>
                    <img id="studentImage" src="" alt="Student" style="max-width: 100%; height: auto; border-radius: 8px;">
                </div> -->
                <div class="mr-5">
                    <label>First Name:</label>
                    <input type="text" id="fname" class="form-control py-2 px-4" readonly>
                </div>

                <div class="mr-5">
                    <label>Last Name:</label>
                    <input type="text" id="lname" class="form-control py-2 px-4" readonly>
                </div>


            </div>
            <div class="d-flex py-3">
                <div class="">
                    <label>Gender:</label>
                    <input type="text" id="gender" class="form-control py-2 px-4" readonly>
                </div>

                <div class="mx-1 col-5">
                    <label>Email:</label>
                    <input type="text" id="email" class="form-control py-2 px-4" readonly>
                </div>
            </div>
            <div class="d-flex py-3">
                <div class="px-2">
                    <label>Phone:</label>
                    <input type="text" id="Phone" class="form-control py-2 px-4" readonly>
                </div>
                <div class="px-2">
                    <label>Religion:</label>
                    <input type="text" id="religion" class="form-control py-2 px-4" readonly>
                </div>
            </div>
            <div class="px-2">
                <label>Shortbio:</label><br>
                <textarea name="" id="shortbio" readonly cols="50" rows="3"></textarea>
            </div>
            <div class="px-2">
                <label>address:</label><br>
                <textarea name="" id="address" readonly cols="50" rows="3"></textarea>
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
get_pagination('teachers', $conn, $limit, $page, APP_PATH . '/admin/dashboard.php?content=item3&&page=');
?>

