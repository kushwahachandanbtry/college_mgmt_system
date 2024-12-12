<?php include dirname(__DIR__, 4). '/constant.php'; ?>

<h3><i>Features</i></h3>

<form class="px-5" action=<?php echo APP_PATH . "admin/pages/college-site/pages/actions/features.php";?> method="POST" enctype="multipart/form-data">
    
    <label for="card-title">Features Title: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="card-title" placeholder="Features Title" name="features_title" required>
    </div>
    <label for="card-s">Features Heading: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="card-s" placeholder="Features Title" name="features_heading" required>
    </div>
    <label for="floatingTextareas">Features Description: </label>
    <div class="form-floating">
        <textarea cols="30" rows="8" class="form-control" placeholder="Leave a features description here" id="floatingTextareas" name="features_description" required></textarea>
    </div>
    <label for="inputGroupFile02">Features Image: </label>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputGroupFile02" name="features_image" accept="image/*" required>
    </div>

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>
