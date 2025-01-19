<!-- for search -->
<div class="search-box py-3">
    <input type="text" id="" onkeyup="searchByName()" class="p-2 searchName" placeholder="search by Name...">
</div>

<?php

// include "../helpers.php";
include dirname(__DIR__, 4). '/FetchDataController.php';
include dirname(__DIR__, 4). '/helpers.php';
include dirname(__DIR__, 4). '/constant.php';
delete_data_message();
?>
<!-- view data in table -->
 
<table id="smsTable" class="table table-striped table-hover">
    <tr>
        <th>S.N</th>
        <th>Name</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php
    if (!empty($gallerys ) && is_array($gallerys )) {
        $i = 1;
        foreach ($gallerys  as $gallery ) {
            ?>
            <tr class="fs-1">
                <td><?php echo $i++;; ?></td>
                <td><?php echo $gallery['image_name']; ?></td>
                <td><img style="width: 100px; height: 100px;" src="<?php echo APP_PATH . 'assets/images/gallery/' .$gallery['image_path']; ?>" alt="<?php echo $gallery['image_path']; ?>"></td>
                <td>
                    <div class="d-flex justify-content-around">
                        <a href="?content=college-website&&page=gallery&&content_web_edit=edit_gallery&&edit_id=<?php echo urlencode($gallery['id']); ?>" 
                        class="text-primary edit-button" >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <p class="text-danger" style="cursor: pointer;" onclick="confirmWebDataDelete(<?php echo $gallery['id']; ?>, 'delete_gallery')"><i class="fa-solid fa-delete-left"></i></p>
                    </div>
                </td>

            </tr>
        <?php }  ?>
        <!-- table end -->
        <?php } ?>
    </table>



