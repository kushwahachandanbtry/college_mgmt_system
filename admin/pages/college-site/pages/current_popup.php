<!-- for search -->
<div class="search-box py-3">
    <input type="text" id="" onkeyup="searchByName()" class="p-2 searchName" placeholder="search by Name...">
</div>

<?php

// include "../helpers.php";
include dirname(__DIR__, 4) . '/FetchDataController.php';
include dirname(__DIR__, 4) . '/helpers.php';
include dirname(__DIR__, 4) . '/constant.php';
delete_data_message();
?>
<!-- view data in table -->

<table id="smsTable" class="table table-striped table-hover">
    <tr>
        <th>S.N</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php
    if (!empty($popups) && is_array($popups)) {
        $i = 1;
        foreach ($popups as $popup ) {
            ?>
            <tr class="fs-1">
                <td><?php echo $i++;
                ; ?></td>
                <td><img style="width: 100px; height: 100px;"
                        src="<?php echo APP_PATH . 'assets/images/popup/' . $popup['image']; ?>"
                        alt="<?php echo $popup['image']; ?>"></td>
                <td>
                    <div class="d-flex justify-content-around">
                        <a href="?content=college-website&&page=home&&content_web_edit=edit_popups&&edit_id=<?php echo urlencode($popup['id']); ?>"
                            class="text-primary edit-button">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <p class="text-danger" style="cursor: pointer;" onclick="confirmWebDataDelete(<?php echo $popup['id']; ?>, 'delete_popups')"><i class="fa-solid fa-delete-left"></i></p>
                    </div>
                </td>

            </tr>
        <?php } ?>
        <!-- table end -->
    <?php } ?>
</table>
