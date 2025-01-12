<?php include dirname(__DIR__, 4). '/constant.php'; ?>

<h3><i>FAQ</i></h3>

<form class="px-5" action="<?php echo APP_PATH . "admin/pages/college-site/pages/actions/faq.php";?>" method="POST" enctype="multipart/form-data">
    
    <label for="card-title">FAQ Title: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="card-title" placeholder="FAQ Title" name="FAQ_title" required>
    </div>
    <label for="floatingTextareas">FAQ Description: </label>
    <div class="form-floating">
        <textarea cols="30" rows="8" class="form-control" placeholder="Leave a FAQ description here" id="floatingTextareas" name="FAQ_description" required></textarea>
    </div>

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>
