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
        <th>Service Title</th>
        <th>Service Description</th>
        <th>Actions</th>
    </tr>
    <?php
    if (!empty($services) && is_array($services)) {
        $i = 1;
        foreach ($services as $service) {
            ?>
            <tr id="row-<?php echo $service['id']; ?>">
                <td><?php echo $i++; ?></td>
                <td><?php echo $service['service_title']; ?></td>
                <td class="col-12 text-wrap"><?php echo $service['service_description']; ?></td>
                <td>
                    <div class="d-flex justify-content-around">
                        <a href="?content=college-website&&page=home&&content_web_edit=edit_services&&edit_id=<?php echo urlencode($service['id']); ?>"
                            class="text-primary edit-button">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        
                        <p class="text-danger" onclick="confirmDelete(<?php echo $service['id']; ?>, 'delete_service')"><i class="fa-solid fa-delete-left"></i></p>
                    </div>
                </td>
            </tr>
        <?php } ?>
    <?php } ?>
</table>


