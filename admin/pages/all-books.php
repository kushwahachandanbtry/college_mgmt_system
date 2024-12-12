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

$sql = "SELECT * FROM books LIMIT {$offsets}, {$limit}";
// echo $sql;

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    delete_data_message();
    ?>
    <!-- view data in table -->
    <table id="smsTable" class="table table-striped table-hover">
        <tr>
            <th>Book Id</th>
            <th>Book Name</th>
            <th>Writer Name</th>
            <th>Class</th>
            <th>Publication Data</th>
            <th>Upload Date</th>
            <?php if( isset( $_SESSION['admin'] ) ||  $_SESSION['role'] == 'teacher') { ?>
                <th>Actions</th>
            <?php } ?>

        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr class="fs-1">
                <td><?php echo $row['book_id']; ?></td>
                <td><?php echo $row['bname']; ?></td>
                <td><?php echo $row['wname']; ?></td>
                <td><?php echo $row['class']; ?></td>
                <td><?php echo $row['pubdate']; ?></td>
                <td><?php echo $row['uploade']; ?></td>
                <?php if( isset( $_SESSION['admin']) || $_SESSION['role'] == 'teacher') { ?>
                    <td parent-id="<?php echo $row['id']; ?>" class="parent_actions"
                        style="font-family:bold; font-size: 30px; padding-left:25px; color: #0D6EFD; cursor:pointer;"
                        onclick="handleClick(event, this)">
                        ...
                        <div action_id="<?php echo $row['id']; ?>" class="actions" style="display:none;">
                            <ul>
                                <li data-id="<?php echo $row['id']; ?>"
                                    onclick="showBooksDetails(<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>)">
                                    View</li>
                                    <li><a href="?content=edit_book&&id=<?php echo $row['id']; ?>">Edit</a></li>
                                <li style="color: red;" onclick="confirmDelete(<?php echo $row['id']; ?>, 'book')">Delete</li>
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
        <h5>View Book Details</h5>
        <form action="" class="px-5" method="POST" enctype="multipart/form-data">
            <div class="d-flex py-3">
                <div class="mr-5">
                    <label>Book Name:</label>
                    <input type="text" id="bName" name="name" class="form-control py-2 px-4" readonly>
                </div>

                <div class="mx-5 col-6">
                    <label>Writer Name:</label>
                    <input type="text" id="wName" name="email" class="form-control py-2 px-4" readonly>
                </div>
            </div>
            <div class="d-flex py-3">
                <div class="">
                    <label>Class:</label>
                    <input type="text" id="class" name="role" class="form-control py-2 px-4" readonly>
                </div>
                <div class="px-2">
                    <label>Publication Date:</label>
                    <input type="text" id="pDate" name="role" class="form-control py-2 px-4" readonly>
                </div>
                <div class="">
                    <label>Upload Date:</label>
                    <input type="text" id="uDate" name="role" class="form-control py-2 px-4" readonly>
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
<?php get_pagination('books',  $conn, $limit, $page, 'http://localhost/school_management_system/admin/dashboard.php?content=item10&&page='); ?>

