<?php
/**
 * This file is used to display notice
 *
 * @package college-management-system
 */

/**
 * Requiring header and menu page
 */
require '../includes/menu.php';
?>
<style>
    .bell-icon {
        position: absolute;
        transform: rotate(-20deg);
        font-size: 100px;
        color: #C43D3D;
        margin-top: -40px;
        animation: ringBell 1s infinite, glow 1.5s infinite;
        /* Add ringing animation */
    }

    /* Keyframes for the bell ringing effect */
    @keyframes ringBell {
        0% {
            transform: rotate(-20deg);
            /* Initial tilted position */
        }

        25% {
            transform: rotate(-10deg);
            /* Slightly move to the right */
        }

        50% {
            transform: rotate(-20deg);
            /* Back to the initial position */
        }

        75% {
            transform: rotate(-30deg);
            /* Slightly move to the left */
        }

        100% {
            transform: rotate(-20deg);
            /* Back to the initial position */
        }
    }

    @keyframes glow {

        0%,
        100% {
            text-shadow: 0 0 5px #C43D3D, 0 0 15px #C43D3D;
        }

        50% {
            text-shadow: 0 0 10px #FF6F6F, 0 0 30px #FF6F6F;
        }
    }

    .horn {
        position: absolute;
        transform: rotateY(210deg);
        font-size: 100px;
        color: #C43D3D;
        right: 0;
        bottom: 0;
    }

    /* Sound waves coming out from the front of the horn */
    .horn .sound-waves {
        position: absolute;
        width: 20px;
        height: 20px;
        border: 3px solid #C43D3D;
        border-radius: 50%;
        top: 43%;
        /* Position at the horn's front */
        left: 85%;
        /* Push to the front of the horn */
        animation: soundWaves 1.5s infinite, hornPulse 1.5s infinite;
        transform-origin: center;
    }

    /* Keyframes for sound waves radiating */
    @keyframes soundWaves {
        0% {
            opacity: 1;
            transform: scale(1);
        }

        100% {
            opacity: 0;
            transform: scale(5);
            /* Increase the size of the wave */
        }
    }

    .horn .sound-waves::before,
    .horn .sound-waves::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border: 3px solid #C43D3D;
        border-radius: 50%;
        top: 0;
        left: 0;
        animation: soundWaves 1.5s infinite;
    }

    .horn .sound-waves::before {
        animation-delay: 0.5s;
        /* Slight delay for the second wave */
    }

    .horn .sound-waves::after {
        animation-delay: 1s;
        /* Delay for the third wave */
    }

    @keyframes hornPulse {

        0%,
        100% {
            transform: rotateY(210deg) scale(1);
        }

        50% {
            transform: rotateY(210deg) scale(1.05);
        }
    }
</style>

<div style="background: #FFC6C5;" class="thankyou-text py-5 text-center">
    <!-- Section Title -->
    <div class="container section-title" style="margin-bottom: -40px;" data-aos="fade-up">
        <h2>Notice Board</h2>
    </div><!-- End Section Title -->
    <?php

    if (!empty($notices) && is_array($notices)) {
        foreach ($notices as $notice) {
            ?>

            <div class="container" data-aos="fade-up"
                style="background: #fff; border-radius: 70px; width: 70%; margin-bottom: 40px; height: 100%; position: relative;">
                <div class="bell-icon">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <div class="notice-content py-5" style="margin: 0 100px 0px 100px;">
                    <div class="text-center">
                        <h6 class="text-dark"><?php echo $notice['date']; ?></h6>
                        <h4><?php echo $notice['title']; ?></h4>
                        <p class="text-italic"><?php echo $notice['details']; ?></p>
                        <h5 class="text-dark">
                            <?php echo "Posted By: " . "<span class='text-primary'>" . $notice['posted_by'] . "</span>"; ?>
                        </h5>
                    </div>
                </div>
                <div class="horn">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span class="sound-waves"></span>
                </div>
                <div class="arrow"></div>
            </div>
        <?php }
    } ?>
</div>

<?php
require '../includes/footer.php';
?>

