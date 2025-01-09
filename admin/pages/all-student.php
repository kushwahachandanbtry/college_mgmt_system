<!-- for search -->
<div class="search-box py-3">
    <input type="text" onkeyup="searchByName()" class="p-2 searchName" placeholder="search by Name...">
</div>

<?php
include './FetchAdminDataController.php';
include "../helpers.php";
delete_data_message();
?>

<!-- view data in table -->
<table id="smsTable" class="table table-striped table-hover">
    <tr>
        <th> Roll</th>
        <th>Image</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Dob</th>
        <th>Blood</th>
        <th>Religion</th>
        <th>Email</th>
        <th>Section</th>
        <th>Shortbio</th>
        <th>Class</th>
        <th>Semester</th>
        <th>Phone</th>
        <?php if (isset($_SESSION['admin'])) { ?>
            <th>Actions</th>
        <?php } ?>

    </tr>
    <?php
    if (!empty($students) && is_array($students)) {
        foreach ($students as $student) {
            ?>
            <tr class="fs-1">
                <td><?php echo $student['admissionid']; ?></td>
                <td><img src="../assets/images/students/<?php echo $student['image']; ?>" alt="<?php echo $student['fname']; ?>"
                        style="width: 60px; height: 60px; border-radius: 50%;"></td>
                <td><?php echo $student['fname'] . " " . $student['lname']; ?></td>
                <td><?php echo $student['gender']; ?></td>
                <td><?php echo $student['dob']; ?></td>
                <td><?php echo $student['blood']; ?></td>
                <td><?php echo $student['religion']; ?></td>
                <td><?php echo $student['email']; ?></td>
                <td><?php echo $student['section']; ?></td>
                <td><?php echo $student['shortbio']; ?></td>
                <td><?php echo $student['class']; ?></td>
                <td><?php echo $student['semester']; ?></td>
                <td><?php echo $student['phone']; ?></td>
                <?php if (isset($_SESSION['admin'])) { ?>
                    <td parent-id="<?php echo $student['id']; ?>" class="parent_actions"
                        style="font-family:bold; font-size: 30px; padding-left:25px; color: #0D6EFD; cursor:pointer;"
                        onclick="handleClick(event, this)">
                        ...
                        <div action_id="<?php echo $student['id']; ?>" class="actions" style="display:none;">
                            <ul>
                                <li data-id="<?php echo $student['id']; ?>"
                                    onclick="showStudentDetails(<?php echo htmlspecialchars(json_encode($student), ENT_QUOTES, 'UTF-8'); ?>)">
                                    View</li>
                                <li><a href="?content=edit_student&&id=<?php echo $student['id']; ?>">Edit</a></li>
                                <li style="color: red;" onclick="confirmDelete(<?php echo $student['id']; ?>, 'student')">Delete
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
        <h5>View Student Details</h5>
        <form action="" class="px-1" method="POST" enctype="multipart/form-data">
            <div class="d-flex py-3">
                <!-- <div>
                    <img id="studentImage" src="" alt="Student" style="max-width: 100%; height: auto; border-radius: 8px;">
                </div> -->
                <div class="mr-5">
                    <label>Roll No::</label>
                    <input type="text" id="roll" class="form-control py-2 px-4" readonly>
                </div>
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
                <div class="">
                    <label>Section:</label>
                    <input type="text" id="section" class="form-control py-2 px-4" readonly>
                </div>
                <div class="px-2">
                    <label>Clases:</label>
                    <input type="text" id="class" class="form-control py-2 px-4" readonly>
                </div>
                <div class="px-2">
                    <label>Phone:</label>
                    <input type="text" id="phone" class="form-control py-2 px-4" readonly>
                </div>
            </div>
            <div class="d-flex py-3">
                <div class="">
                    <label>DOB:</label>
                    <input type="text" id="dob" class="form-control py-2 px-4" readonly>
                </div>
                <div class="px-2">
                    <label>Blood:</label>
                    <input type="text" id="blood" class="form-control py-2 px-4" readonly>
                </div>
                <div class="px-2">
                    <label>Religion:</label>
                    <input type="text" id="religion" class="form-control py-2 px-4" readonly>
                </div>
            </div>
            <div class="px-2">
                <label>Shortbio:</label><br>
                <textarea name="" id="shortbio" cols="50" rows="3" readonly></textarea>
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
get_pagination('students', $conn, $limit, $page, APP_PATH . '/admin/dashboard.php?content=item1&&page=');
?>

