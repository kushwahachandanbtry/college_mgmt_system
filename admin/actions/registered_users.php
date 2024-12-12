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

$sql = "SELECT * FROM registered_users LIMIT {$offsets}, {$limit}";
// echo $sql;

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    delete_data_message();
    ?>
    <!-- view data in table -->
    <table id="smsTable" class="table table-striped table-hover">
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Father Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Gender</th>
            <th>Address</th>
            

        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr class="fs-1">
                <td><?php echo $row['fname'] . " " . $row['mname'] . " " . $row['lname']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['fathername']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['address']; ?></td>
                
            </tr>
            <?php } ?>
        </table>
        <!-- table end -->
<?php } ?>



<!-- pagination -->
<?php get_pagination('books',  $conn, $limit, $page, 'http://localhost/school_management_system/admin/dashboard.php?content=item10&&page='); ?>

