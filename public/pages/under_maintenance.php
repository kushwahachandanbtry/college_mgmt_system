<?php 
/**
 * This file is used to showing under maintenance page
 *
 * @package college-management-system
 */

/**
 * Requiring header and menu page
 */

include dirname(__DIR__, 1) . '/includes/header.php'; 
include dirname(__DIR__, 2). '/constant.php';
include dirname(__DIR__, 2). '/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countdown Timer</title>
</head>
<style>
    body {
    margin: 0;
    padding: 100px;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: #FFC6C5;
    background-size: cover;
    font-family: 'Arial', sans-serif;
    color: #fff;
    text-align: center;
}

.countdown-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 30px;
}

.countdown-item {
    text-align: center;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    width: 120px;
    height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.5);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.7);
}

.countdown-value {
    font-size: 32px;
    font-weight: bold;
}

.countdown-label {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.7);
    text-transform: uppercase;
    margin-top: 5px;
}

</style>
<body>
<div>
        <img src="<?php echo APP_PATH . 'assets/images/logo/' . $logo; ?>" width="40%" alt="logo">
    </div>
    <div>
        <h1>UNDER MAINTENANCE</h1>
    </div>
    <div class="countdown-container">
        <div class="countdown-item">
            <span id="days" class="countdown-value">00</span>
            <span class="countdown-label">DAYS</span>
        </div>
        <div class="countdown-item">
            <span id="hours" class="countdown-value">00</span>
            <span class="countdown-label">HOURS</span>
        </div>
        <div class="countdown-item">
            <span id="minutes" class="countdown-value">00</span>
            <span class="countdown-label">MINUTES</span>
        </div>
        <div class="countdown-item">
            <span id="seconds" class="countdown-value">00</span>
            <span class="countdown-label">SECONDS</span>
        </div>
    </div>

    
    <script>
// Set the initial target date
let targetDate = new Date().getTime() + (35 * 24 * 60 * 60 * 1000); // 35 days from now

function startCountdown() {
    const countdown = setInterval(() => {
        const now = new Date().getTime();
        const distance = targetDate - now;

        // Calculate days, hours, minutes, and seconds
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result
        document.getElementById("days").innerText = days;
        document.getElementById("hours").innerText = hours;
        document.getElementById("minutes").innerText = minutes;
        document.getElementById("seconds").innerText = seconds;

        // If the countdown is over, reset it to start again
        if (distance < 0) {
            clearInterval(countdown);

            // Reset targetDate to 35 days from now
            targetDate = new Date().getTime() + (35 * 24 * 60 * 60 * 1000);
            startCountdown(); // Restart the countdown
        }
    }, 1000);
}

// Start the countdown
startCountdown();


    </script>
</body>
</html>

