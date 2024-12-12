<?php include dirname(__DIR__, 4). '/constant.php'; ?>

<h3><i>Slider</i></h3>

<form class="px-5" action=<?php echo APP_PATH . "admin/pages/college-site/pages/actions/upload_slider.php";?> method="POST" enctype="multipart/form-data">
    <label for="inputGrsoupFile02s">Insert image 1:</label><br>
    <div class="input-group mb-3">
        <input type="file" class="form-control" name="images[]" id="inputGrsoupFile02s">
    </div>
    <label for="idsnputGrsoupFile02s">Insert image 2:</label><br>
    <div class="input-group mb-3">
        <input type="file" class="form-control" name="images[]" id="idsnputGrsoupFile02s">
    </div>
    <label for="insdputGrsoupFile02s">Insert image 3:</label><br>
    <div class="input-group mb-3">
        <input type="file" class="form-control" name="images[]" id="insdputGrsoupFile02s">
    </div>
    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>
