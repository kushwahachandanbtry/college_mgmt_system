<?php
/**
 * This file includes all gallery related content
 *
 * @package school-management-system
 */

/**
 * Requiring header and menu file
 */
require '../includes/menu.php';

?>
<div class="gallery-overlay overlay">
    <h1>Gallery</h1>
</div>
<div class="gallery-body-section py-5">
    <div class="container ;y-5">
        <div class="row">
            <?php if (!empty($gallerys)): ?>
                <?php foreach ($gallerys as $gallery): ?>
                    <div class="col-lg-3 py-5">
                        <a href="javascript:void(0);"
                            onclick="showLargeImage('<?php echo '../../assets/images/gallery/' . $gallery['image_path']; ?>')">
                            <div class="image-items">
                                <i class="fa-solid fa-eye"></i>
                                <img src="../../assets/images/gallery/<?php echo urlencode( $gallery['image_path'] ); ?>"
                                    style="width: 100%; height: 280px;" class="img-fluid">
                                <h5 class="text-center py-3"><?php echo htmlspecialchars( $gallery['image_name'] ); ?></h5>
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

<!-- <div class="pegination">
    <div class="container text-center pb-4">
        <div class="d-grid gap-2 d-md-block">
            <button class="btn" type="button">Prev</button>
            <button class="btn" type="button">1</button>
            <button class="btn" type="button">2</button>
            <button class="btn" type="button">3</button>
            <button class="btn" type="button">Next</button>
        </div>
    </div>
</div> -->

<?php
require '../includes/footer.php';
?>

<!-- Modal for Large Image -->
<div id="imageModal" class="image-modal">
    <div class="modal-content">
        <span class="close" onclick="closeLargeImage()">&times;</span>
        <img id="modalImage" src="" alt="Large View" class="modal-image">
        <!-- Navigation buttons -->
        <button class="prev-button" onclick="showPrevImage()">&#10094;</button>
        <button class="next-button" onclick="showNextImage()"> &#10095;</button>
    </div>
</div>


<style>
    /* Modal Styling */
    .image-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(5px);
        /* Blurs the background */
    }

    .modal-content {
        position: relative;
        max-width: 80%;
        max-height: 80%;
    }

    .modal-image {
        width: 70%;
        height: 500px;
        margin: auto;
    }

    .close {
        position: absolute;
        top: 0px;
        right: 180px;
        font-size: 30px;
        color: red;
        cursor: pointer;
    }

    .prev-button,
    .next-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: #3B91BA;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 18px;
        cursor: pointer;
        z-index: 1100;
        border-radius: 5px;
    }

    .prev-button {
        left: 20px;
    }

    .next-button {
        right: 20px;
    }

    .prev-button:hover,
    .next-button:hover {
        background-color: blue;
    }

    .prev-button,
    .next-button {
        display: block;
        /* Default display value, will be toggled dynamically */
    }

    /* Animation classes */
    .slide-left {
        animation: slideLeft 0.5s ease-in-out;
    }

    .slide-right {
        animation: slideRight 0.5s ease-in-out;
    }

    /* Keyframes for animations */
    @keyframes slideLeft {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }

        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideRight {
        0% {
            transform: translateX(-100%);
            opacity: 0;
        }

        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>

<script>
    let images = []; // Array to store all image paths
    let currentIndex = 0; // To keep track of the current image index
    let isAnimating = false; // To prevent double clicks during animation

    // Function to open the modal and show the clicked image
    function showLargeImage(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        currentIndex = images.indexOf(imageSrc); // Find the index of the clicked image
        modal.style.display = 'flex';
        modalImage.src = imageSrc;
        updateNavigationButtons(); // Update button visibility
    }

    // Function to close the modal
    function closeLargeImage() {
        const modal = document.getElementById('imageModal');
        modal.style.display = 'none';
    }

    // Function to show the next image with animation
    function showNextImage() {
        if (isAnimating || currentIndex >= images.length - 1) return;
        isAnimating = true;
        const modalImage = document.getElementById('modalImage');
        modalImage.classList.add('slide-left'); // Add the animation class

        setTimeout(() => {
            currentIndex++;
            modalImage.src = images[currentIndex];
            modalImage.classList.remove('slide-left');
            updateNavigationButtons(); // Update button visibility
            isAnimating = false;
        }, 500); // Duration matches the CSS animation
    }

    // Function to show the previous image with animation
    function showPrevImage() {
        if (isAnimating || currentIndex <= 0) return;
        isAnimating = true;
        const modalImage = document.getElementById('modalImage');
        modalImage.classList.add('slide-right'); // Add the animation class

        setTimeout(() => {
            currentIndex--;
            modalImage.src = images[currentIndex];
            modalImage.classList.remove('slide-right');
            updateNavigationButtons(); // Update button visibility
            isAnimating = false;
        }, 500); // Duration matches the CSS animation
    }

    // Function to update the visibility of the navigation buttons
    function updateNavigationButtons() {
        const prevButton = document.querySelector('.prev-button');
        const nextButton = document.querySelector('.next-button');

        // Hide Prev button if on the first image
        prevButton.style.display = currentIndex === 0 ? 'none' : 'block';

        // Hide Next button if on the last image
        nextButton.style.display = currentIndex === images.length - 1 ? 'none' : 'block';
    }

    // Populate the images array on page load
    window.onload = function () {
        const imageElements = document.querySelectorAll('.image-items img'); // Select all image elements
        images = Array.from(imageElements).map(img => img.src); // Get their source paths
    };



</script>
