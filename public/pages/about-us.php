<?php
/**
 * This page contains about-us page
 *
 * @package college-management-system
 */

/**
 * Requiring header and menu file
 */
include dirname(__DIR__, 1) . '/includes/menu.php';
include dirname(__DIR__, 2) . '/config.php';

?>

<div class="about-overlay overlay">
    <h1>About Us</h1>
</div>


<?php
require 'services.php';
?>
<?php 

$video_sql = "SELECT * FROM video_and_content";
$video_result = mysqli_query( $conn, $video_sql );
if( mysqli_num_rows( $video_result ) > 0 ) {
    while( $row = mysqli_fetch_assoc( $video_result ) ) {
        // Assuming $row['video_file'] contains the YouTube URL
        $video_url = $row['video_file'];
        
        // Extract the video ID from the URL
        parse_str(parse_url($video_url, PHP_URL_QUERY), $query_params);
        $video_id = $query_params['v'] ?? ''; // Extract the 'v' parameter (video ID)
        
        // Construct the embed URL
        $embed_url = "https://www.youtube.com/embed/" . $video_id;
        


?>
<div class="about-video-section py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6">
            <div class="about-video">
                <iframe width="100%" height="300px" src="<?php echo $embed_url; ?>" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>

            </div>
            <div class="col-lg-6">
                <h4 style="margin-left: 20px;"><?php echo htmlspecialchars( $row['video_heading'] ); ?></h4>
                <p style="color: #000;"><?php echo htmlspecialchars( $row['video_description'] ); ?></p>
            </div>
        </div>
    </div>
</div>

<?php     
}
}
?>

<?php


include "contact-form.php";

require dirname(__DIR__, 1) . '/includes/footer.php';
?>

