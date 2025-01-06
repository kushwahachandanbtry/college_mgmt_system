<?php
/**
 * This file includes all our staff related content
 *
 * @package college-management-system
 */

/**
 * Requiring header and menu file
 */
require '../includes/menu.php';

?>

<div class="our-staff-overlay overlay">
    <h1>Our staff</h1>
</div>

<div class="all-staff">
	<div class="container py-5">
		<h1 class="text-center">We All Are Family</h1>
		<h2 class="text-center">LOVE each other</h2>
		<div class="row py-5">

        <?php if( !empty( $staffs ) ) : ?>
		<?php foreach( $staffs as $staff ) : ?>

    <div class="col-lg-3 py-5">
                    <a href="single_staff.php?id=<?php echo $staff['id']; ?>">
                    <div class="card-group">
                        <div class="card mx-4 col-lg-3">
                            <img src="../../assets/images/staff/<?php echo urlencode( $staff['staff_image'] ); ?>" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 style="color: #B21237;" class="card-title"><?php echo htmlspecialchars( $staff['staff_name'] ); ?></h5>
                                <p class="card-text">
                                    <?php echo text_limit(htmlspecialchars( $staff['about_staff'] ), 120); ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="rating-icon ">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
                <?php endforeach; ?>
                    <?php else: ?>
                        <h4>Coming soon...</h4>
                    <?php endif; ?>

	</div>
</div>
</div>
<?php
require '../includes/footer.php';
?>
