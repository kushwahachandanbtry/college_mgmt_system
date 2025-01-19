<?php
include dirname(__DIR__, 4) . '/constant.php';
include dirname(__DIR__, 4) . '/FetchDataController.php';
?>

<h3><i>Meta Settings</i></h3>

<form class="px-5" action="<?php echo APP_PATH . "admin/pages/college-site/pages/actions/meta_setting.php";?>" method="POST" enctype="multipart/form-data">
    <div class="form-floating py-3">
        <label for="select_page">Select Page*: </label>
        <select id="select_page" name="pages" class="form-control col-12" required>
            <option value="" disabled>Select Pages</option>
            <option value="home">Home Page</option>
            <?php
            if (!empty($courses) && is_array($courses)) {
                foreach ($courses as $course) {
                    ?>
                    <option value="<?php echo htmlspecialchars($course['course_title']); ?>"
                        data-code="<?php echo htmlspecialchars($course['course_title']); ?>" data-flag="🇳🇵">
                        <?php echo htmlspecialchars($course['course_title']); ?></option>
                <?php
                }
            }
            ?>
        </select>
    </div>
    <h4 class="text-center text-info" for="meta_title">Meta Tags </h4>
    <hr>
    <label for="meta_title">Meta Title*: </label>
    <div class="form-floating">
        <textarea class="form-control" cols="20" rows="4"
            placeholder="Hint: For best - 6–12 words (approximately 50–60 characters)." id="meta_title"
            name="meta_title" required></textarea>
    </div>

    <label for="meta_description">Meta Description*: </label>
    <div class="form-floating">
        <textarea class="form-control" cols="20" rows="5"
            placeholder="Hint: For best - 20–30 words (approximately 120–160 characters)." id="meta_description"
            name="meta_description" required></textarea>
    </div>

    <label for="meta_keywords">Meta Keywords*: </label>
    <div class="form-floating">
        <textarea class="form-control" cols="20" rows="4" placeholder="Hint: For best - 10–15 words or phrases."
            id="meta_keywords" name="meta_keywords" required></textarea>
    </div>

    <label for="canonical_tag">Canonical Tags*: </label>
    <div class="form-floating">
        <textarea class="form-control" cols="20" rows="3" placeholder="https://www.yourcollege" id="canonical_tag"
            name="canonical_tag" required></textarea>
    </div>

    <br>
    <h4 class="text-center text-info" for="meta_title">Open Graph Tags </h4>
    <hr>
    <label for="og_title">og Title*: </label>
    <div class="form-floating">
        <textarea class="form-control" cols="20" rows="5"
            placeholder="hint: [Your College Name/Course Name] - Excellence in Education" id="og_title"
            name="og_title" required></textarea>
    </div>

    <label for="og_description">og Description*: </label>
    <div class="form-floating">
        <textarea class="form-control" palceholder="" cols="20" rows="6"
            placeholder="hint: it’s best to keep it short and concise—around 1–2 sentences or 50–160 characters"
            id="og_description" name="og_description" required></textarea>
    </div>

    <label for="og_url">og URL*: </label>
    <div class="form-floating">
        <textarea class="form-control" cols="20" rows="3"
            placeholder="hint: https://www.yourcollege.edu or https://www.yourcollege.edu/courses.php" id="og_url"
            name="og_url" required></textarea>
    </div>

    <label for="og_image">og Image*: </label>
    <p class="text-info">Hint: Use 1200 x 630 pixels as the standard size. Ensure the aspect ratio is 1.91:1. Keep the
        file size under 1 MB to ensure fast loading. JPEG: Best for photos with lots of colors.</p>
    <div class="input-group mb-3">
        <input required type="file" class="form-control" id="og_image" name="og_image" accept="image/*">
    </div>


    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>
