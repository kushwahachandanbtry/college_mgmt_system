<?php
/**
 * This page contains about-us page
 *
 * @package college-management-system
 */

/**
 * Requiring header and menu file
 */
include dirname(__DIR__, 2) . '/config.php';

// Sanitize and escape output to prevent XSS
?>

<div class="about-overlay overlay">
    <h1>About Us</h1>
</div>

<?php
require 'services.php';
?>

<?php 

// Sanitize and validate the videos_and_contents array if necessary
if( !empty( $videos_and_contents ) && is_array( $videos_and_contents ) ) {
    foreach( $videos_and_contents as $video_and_content) {
        
        // Ensure the YouTube URL is safe and valid
        $video_url = filter_var($video_and_content['video_file'], FILTER_VALIDATE_URL);

        // Check if it's a valid YouTube URL
        if ($video_url && strpos($video_url, 'youtube.com') !== false) {
            // Extract the video ID from the YouTube URL
            parse_str(parse_url($video_url, PHP_URL_QUERY), $query_params);
            $video_id = $query_params['v'] ?? ''; // Extract the 'v' parameter (video ID)

            // Check if we successfully extracted the video ID
            if ($video_id) {
                // Construct the embed URL
                $embed_url = "https://www.youtube.com/embed/" . htmlspecialchars($video_id);

                // Sanitize and escape the content
                $video_heading = htmlspecialchars($video_and_content['video_heading']);
                $video_description = htmlspecialchars($video_and_content['video_description']);
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
                <h4 style="margin-left: 20px;"><?php echo $video_heading; ?></h4>
                <p style="color: #000;"><?php echo $video_description; ?></p>
            </div>
        </div>
    </div>
</div>

<?php     
            }
        }
    }
}
?>

<?php
include "contact-form.php";
