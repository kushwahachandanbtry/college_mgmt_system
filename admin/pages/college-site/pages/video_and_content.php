<?php include dirname(__DIR__, 4). '/constant.php'; ?>

<h3><i>Video & Content</i></h3>

<form class="px-5" action=<?php echo APP_PATH . "admin/pages/college-site/pages/actions/video_and_content.php";?> method="POST">
    <label for="inputGroupFile02">Insert Video Link: </label>
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="inputGroupFile02" name="video_file" required>
    </div>
    <label for="card-title">Heading of Video: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="card-title" placeholder="Heading of Video" name="video_heading" required>
    </div>
    <label for="floatingTextarea">Video Description: </label>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Video Description" id="floatingTextarea" name="video_description" required></textarea>
    </div>

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>
