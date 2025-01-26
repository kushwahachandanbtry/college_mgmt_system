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
        <th>Heading</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php
    if (!empty($blogs ) && is_array($blogs )) {
        $i = 1;
        foreach ($blogs  as $blog ) {
            ?>
            <tr class="fs-1">
                <td><?php echo $i++;; ?></td>
                <td><?php echo $blog['heading']; ?></td>
                <td><img style="width: 100px; height: 100px;" src="<?php echo APP_PATH . 'assets/images/blogs/' .$blog['image']; ?>" alt="<?php echo $blog['image']; ?>"></td>
                <td>
                    <div class="d-flex justify-content-around">
                        <a href="?content=college-website&&page=blogs&&content_web_edit=edit_blogs&&edit_id=<?php echo urlencode($blog['id']); ?>" 
                        class="text-primary edit-button" >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <p class="text-danger" style="cursor: pointer;" onclick="confirmWebDataDelete(<?php echo $blog['id']; ?>, 'delete_blogs')"><i class="fa-solid fa-delete-left"></i></p>
                    </div>
                </td>

            </tr>
        <?php }  ?>
        <!-- table end -->
        <?php } ?>
    </table>



