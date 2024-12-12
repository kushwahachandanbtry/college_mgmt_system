<?php include dirname(__DIR__, 4). '/constant.php'; ?>

<h3><i>Gallery</i></h3>

<form class="px-5" action=<?php echo APP_PATH . "admin/pages/college-site/pages/actions/gallery.php";?> method="POST" enctype="multipart/form-data">
    <label for="img-name">Image Name: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="img-name" name="image_name" placeholder="Enter Image Name" required>
    </div>

    <label for="gallery-img">Image: </label>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="gallery-img" name="gallery_image" accept="image/*" required>
    </div>

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>
