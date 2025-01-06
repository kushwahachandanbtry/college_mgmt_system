<?php
/**
 * This file includes all our single page related content
 *
 * @package college-management-system
 */

/**
 * Requiring header and menu file
 */
require '../includes/menu.php';
include dirname(__DIR__, 2) . '/config.php';

?>

<div class="single-image-item">
	<div class="container">
		<div class="row">
        <?php
        $id = $_GET['id'];
            $staff = "SELECT * FROM staff WHERE id = '$id'";
            $staff_result = mysqli_query($conn, $staff);
            if (mysqli_num_rows($staff_result) > 0) {
                while ($row = mysqli_fetch_assoc($staff_result)) {
                    ?>
			<div class="col-lg-12 py-5 text-center">
                <img src="../../assets/images/staff/<?php echo $row['staff_image']; ?>" alt="<?php echo $row['staff_name']; ?>" class="img-fluid">
				<h4 class="py-3"><?php echo $row['staff_name']; ?></h4>
                <div class="d-flex justify-content-around">
                    <h5 style="color: #0054A6;"><i class="fa-solid fa-envelope" style="padding-right: 10px; color: red;"></i><?php echo $row['staff_email']; ?></h5>
                    <h5 style="color: #0054A6;"><i class="fa-solid fa-phone" style="padding-right: 10px; color: red;"></i><?php echo $row['staff_phone']; ?></h5>
                </div>
				<p style="text-align: left;"><?php echo $row['about_staff']; ?></p>
			</div>
            <?php
                }
            }
            ?>
		</div>
	</div>
</div>


<?php
require '../includes/footer.php';
?>
