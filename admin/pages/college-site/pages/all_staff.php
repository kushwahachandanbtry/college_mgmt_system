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
        <th>Phone</th>
        <th>Email</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php
    if (!empty($staffs ) && is_array($staffs )) {
        $i = 1;
        foreach ($staffs  as $staff ) {
            ?>
            <tr class="fs-1">
                <td><?php echo $i++;; ?></td>
                <td><img style="width: 100px; height: 100px;" src="<?php echo APP_PATH . 'assets/images/staff/' .$staff['staff_image']; ?>" alt="<?php echo $staff['staff_image']; ?>"><?php echo $staff['staff_name']; ?></td>
                <td><?php echo $staff['staff_phone']; ?></td>
                <td><?php echo $staff['staff_email']; ?></td>
                <td class="col-12 text-wrap"><?php echo $staff['about_staff']; ?></td>
                <td>
                    <div class="d-flex justify-content-around">
                        <a href="?content=college-website&&page=staff&&content_web_edit=edit_staff&&edit_id=<?php echo urlencode($staff['id']); ?>" 
                        class="text-primary edit-button" >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <p class="text-danger" style="cursor: pointer;" onclick="confirmWebDataDelete(<?php echo $staff['id']; ?>, 'delete_staff')"><i class="fa-solid fa-delete-left"></i></p>
                    </div>
                </td>

            </tr>
        <?php }  ?>
        <!-- table end -->
        <?php } ?>
    </table>



