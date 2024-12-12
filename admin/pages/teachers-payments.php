<div class="search-box py-3">
    <input type="text" id="" onkeyup="searchByName()" class="p-2 searchName" placeholder="search by Name...">
</div>


<?php
include "../helpers.php";

$limit = 3;

if( isset( $_GET['page'] ) ) {
    $page = $_GET['page'];
} else {
    $page = 1;
}


$offsets = ( $page - 1 ) * $limit;

$sql = "SELECT * FROM teachers LIMIT {$offsets}, {$limit}";
// echo $sql;

$result = mysqli_query( $conn, $sql );

if( mysqli_num_rows( $result ) > 0 ) {



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
    while ( $row = mysqli_fetch_assoc($result ) ) {
    ?>
        <tr class="fs-1">
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['Phone']; ?></td>
            <td><a target="_self" href="?content=checkout-khalti"><button class="btn btn-primary  ">Pay with Khalti</button></a></td>
        </tr>
    <?php
    }
}
    ?>
</table>

<?php get_pagination('teachers',  $conn, $limit, $page, 'http://localhost/school_management_system/admin/dashboard.php?content=item5&&page='); ?>


