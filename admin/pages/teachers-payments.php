<div class="search-box py-3">
    <input type="text" id="" onkeyup="searchByName()" class="p-2 searchName" placeholder="search by Name...">
</div>


<?php
include './FetchAdminDataController.php';
include "../helpers.php";

?>

<table id="smsTable" class="table table-striped table-hover">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Religion</th>

    </tr>
    <?php
    if (!empty($teacher_payment_lists) && is_array($teacher_payment_lists)) {
        foreach ($teacher_payment_lists as $teacher_payment_list) {
            ?>
            <tr class="fs-1">
                <td><?php echo $teacher_payment_list['id']; ?></td>
                <td><?php echo $teacher_payment_list['fname'] . " " . $teacher_payment_list['lname']; ?></td>
                <td><?php echo $teacher_payment_list['gender']; ?></td>
                <td><?php echo $teacher_payment_list['email']; ?></td>
                <td><?php echo $teacher_payment_list['address']; ?></td>
                <td><?php echo $teacher_payment_list['Phone']; ?></td>
                <td><a target="_self" href="?content=checkout-khalti"><button class="btn btn-primary  ">Pay with
                            Khalti</button></a></td>
            </tr>
            <?php
        }
    }
    ?>
</table>

<?php
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offsets = ($page - 1) * $limit;
get_pagination('teachers', $conn, $limit, $page, APP_PATH . '/admin/dashboard.php?content=item5&&page=');
?>

