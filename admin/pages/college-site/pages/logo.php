<?php include dirname(__DIR__, 4) . '/constant.php'; ?>
<?php include dirname(__DIR__, 4) . '/FetchDataController.php'; ?>
<?php include dirname(__DIR__, 4) . '/helpers.php'; ?>

<h3><i>Logo</i></h3>

<form class="px-5" action="<?php echo APP_PATH . "admin/pages/college-site/pages/actions/logo.php";?>" method="POST" enctype="multipart/form-data">
    
    <div class="input-group mb-3">
        <div class="mr-3">
            <img id="" width="200px" height="200px"
                src="<?php echo APP_PATH . 'assets/images/logo/' . $logo; ?>" alt="Image">
            <br>
            
            <label for="inputGroupFile02s">Change Logo:</label><br>
            <input type="file" id="imageInput" name="image" accept="image/*" >
        </div>
    </div>
    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger" >Reset</button>
    </div>
</form>



