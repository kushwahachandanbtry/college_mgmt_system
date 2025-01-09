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
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php
            ?>
            <tr class="fs-1">
                <td><?php echo htmlspecialchars($collegeName); ?></td>
                <td><?php echo htmlspecialchars($collegeAddress); ?></td>
                <td><?php echo htmlspecialchars($collegePhone); ?></td>
                <td><?php echo htmlspecialchars($collegeEmail); ?></td>
                <td>
                    <div class="d-flex justify-content-around">
                        <a href="?content=college-website&&page=contact&&content_web_edit=edit_contact&&edit_id=3" 
                        class="text-primary edit-button" >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="#" class="text-danger"><i class="fa-solid fa-delete-left"></i></a>
                    </div>
                </td>

            </tr>
    </table>



