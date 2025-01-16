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
        <th>Book Id</th>
        <th>Book Name</th>
        <th>Writer Name</th>
        <th>Class</th>
        <th>Publication Data</th>
        <th>Upload Date</th>
        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher') { ?>
            <th>Actions</th>
        <?php } ?>

    </tr>
    <?php
    if (!empty($books) && is_array($books)) {
        foreach ($books as $book) {
            ?>
            <tr class="fs-1">
                <td><?php echo $book['book_id']; ?></td>
                <td><?php echo $book['bname']; ?></td>
                <td><?php echo $book['wname']; ?></td>
                <td><?php echo $book['class']; ?></td>
                <td><?php echo $book['pubdate']; ?></td>
                <td><?php echo $book['uploade']; ?></td>
                <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher') { ?>
                    <td parent-id="<?php echo $book['id']; ?>" class="parent_actions"
                        style="font-family:bold; font-size: 30px; padding-left:25px; color: #0D6EFD; cursor:pointer;"
                        onclick="handleClick(event, this)">
                        ...
                        <div action_id="<?php echo $book['id']; ?>" class="actions" style="display:none;">
                            <ul>
                                <li data-id="<?php echo $book['id']; ?>"
                                    onclick="showBooksDetails(<?php echo htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8'); ?>)">
                                    View</li>
                                <li><a href="?content=edit_book&&id=<?php echo $book['id']; ?>">Edit</a></li>
                                <li style="color: red;" onclick="confirmDelete(<?php echo $book['id']; ?>, 'book')">Delete</li>
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
<?php
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offsets = ($page - 1) * $limit;
get_pagination('books', $conn, $limit, $page, APP_PATH . '/admin/dashboard.php?content=item10&&page=');
?>

