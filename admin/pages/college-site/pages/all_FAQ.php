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
        <th>FAQ Title</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php
    if (!empty($faqs) && is_array($faqs)) {
        $i = 1;
        foreach ($faqs as $faq) {
            ?>
            <tr class="fs-1">
                <td><?php echo $i++;; ?></td>
                <td><?php echo $faq['FAQ_title']; ?></td>
                <td><?php echo $faq['FAQ_description']; ?></td>
                <td>
                    <div class="d-flex justify-content-around">
                        <a href="?content=college-website&&page=home&&content_web_edit=edit_faq&&edit_id=<?php echo urlencode($faq['id']); ?>" 
                        class="text-primary edit-button" >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <p class="text-danger" style="cursor: pointer;" onclick="confirmWebDataDelete(<?php echo $faq['id']; ?>, 'delete_FAQ')"><i class="fa-solid fa-delete-left"></i></p>
                    </div>
                </td>

            </tr>
        <?php }  ?>
        <!-- table end -->
        <?php } ?>
    </table>



