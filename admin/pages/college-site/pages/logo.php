<?php include dirname(__DIR__, 4). '/constant.php'; ?>

<h3><i>Logo</i></h3>

<form class="px-5" action=<?php echo APP_PATH . "admin/pages/college-site/pages/actions/logo.php";?> method="POST" enctype="multipart/form-data">
    <label for="inputGroupFile02s">Insert Logo:</label><br>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputGroupFile02s" name="img">
    </div>
    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>

