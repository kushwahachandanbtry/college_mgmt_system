<?php include dirname(__DIR__, 4). '/constant.php'; ?>

<h3><i>What People Say's</i></h3>

<form class="px-5" action="<?php echo APP_PATH . "admin/pages/college-site/pages/actions/what_people_say.php";?>" method="POST" enctype="multipart/form-data">
    <label for="floatingTextarea">Overview: </label>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave Overview here" id="floatingTextarea" name="overview" required></textarea>
    </div>
    <label for="card-title">Name: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="card-title" placeholder="Name" name="name" required>
    </div>
    <label for="batch">Batch: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="batch" placeholder="Batch" name="batch" required>
    </div>
    <label for="inputGroupFile02">Image: </label>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputGroupFile02" name="image" accept="image/*" required>
    </div>

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>
