<?php include dirname(__DIR__, 4). '/constant.php'; ?>

<h3><i>Map</i></h3>

<form class="px-5" method="POST" action="<?php echo APP_PATH . "admin/pages/college-site/pages/actions/map.php";?>">
    
    <label for="floatingifrme">Insert iframe tag for Map: </label>
    <div class="form-floating">
        <textarea class="form-control" name="map" required placeholder="Leave here iframe tag for show your map location" id="floatingifrme"></textarea>
    </div>
    

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>
