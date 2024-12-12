<?php include dirname(__DIR__, 4). '/constant.php'; ?>

<h3><i>Services</i></h3>

<form class="px-5" action=<?php echo APP_PATH . "admin/pages/college-site/pages/actions/services.php";?> method="POST" enctype="multipart/form-data">
    
    <label for="card-title">Service Title: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="card-title" placeholder="Service Title" name="service_title" required>
    </div>
    <label for="floatingTextareas">Service Description: </label>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a service Description here" id="floatingTextareas" name="service_description" required></textarea>
    </div>

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>
