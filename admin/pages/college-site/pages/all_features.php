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
        <th>Features Title</th>
        <th>Features Heading</th>
        <th>Features Description</th>
        <th>Featured Image</th>
        <th>Actions</th>
    </tr>
    <?php
    if (!empty($features ) && is_array($features )) {
        $i = 1;
        foreach ($features  as $feature ) {
            ?>
            <tr class="fs-1">
                <td><?php echo $i++;; ?></td>
                <td><?php echo $feature['features_title']; ?></td>
                <td><?php echo $feature['features_heading']; ?></td>
                <td class="col-12 text-wrap"><?php echo $feature['features_description']; ?></td>
                <td><img style="width: 100px; height: 100px;" src="<?php echo APP_PATH . 'assets/images/features/' .$feature['features_image']; ?>" alt="<?php echo $feature['features_image']; ?>"></td>
                <td>
                    <div class="d-flex justify-content-around">
                        <a href="?content=college-website&&page=home&&content_web_edit=edit_features&&edit_id=<?php echo urlencode($feature['id']); ?>" 
                        class="text-primary edit-button" >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <p class="text-danger" style="cursor: pointer;" onclick="confirmWebDataDelete(<?php echo $feature['id']; ?>, 'delete_feature')"><i class="fa-solid fa-delete-left"></i></p>
                    </div>
                </td>

            </tr>
        <?php }  ?>
        <!-- table end -->
        <?php } ?>
    </table>



