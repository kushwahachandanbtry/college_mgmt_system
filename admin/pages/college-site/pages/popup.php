<?php include dirname(__DIR__, 4). '/constant.php'; ?>

<h3><i>Add Popup</i></h3>

<form class="px-5" action="<?php echo APP_PATH . "admin/pages/college-site/pages/actions/popup.php";?>" method="POST" enctype="multipart/form-data">
    
    <label for="popupImage">Popup Image: </label>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="popupImage" name="image" accept="image/*" required>
    </div>

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Add New</button>
        <button type="reset" class="btn btn-danger" name="reset">Reset</button>
    </div>
</form>



