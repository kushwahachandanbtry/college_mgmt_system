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
 
<table id="smsTable" style="width: 100%;" class="table table-striped table-hover">
    <tr>
        <th>S.N</th>
        <th>Course Title</th>
        <th>Actions</th>
    </tr>
    <?php
    if (!empty($courses ) && is_array($courses )) {
        $i = 1;
        foreach ($courses  as $course ) {
            ?>
            <tr class="fs-1">
                <td><?php echo $i++;; ?></td>
                <td><?php echo $course['course_title']; ?></td>
                
                <td>
                    <div class="d-flex justify-content-around">
                        <a href="?content=college-website&&page=cources&&content_web_edit=edit_courses&&edit_id=<?php echo urlencode($course['id']); ?>" 
                        class="text-primary edit-button" >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="#" class="text-danger"><i class="fa-solid fa-delete-left"></i></a>
                    </div>
                </td>

            </tr>
        <?php }  ?>
        <!-- table end -->
        <?php } ?>
    </table>



