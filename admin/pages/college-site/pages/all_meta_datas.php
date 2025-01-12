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
        <th>Pages</th>
        <th>Actions</th>
    </tr>
    <?php
    if (!empty($meta_setting_datas ) && is_array($meta_setting_datas )) {
        $i = 1;
        foreach ($meta_setting_datas  as $meta_setting_data ) {
            ?>
            <tr class="fs-1">
                <td><?php echo $i++;; ?></td>
                <td>
                    <?php 
                    $selected_id = $meta_setting_data['pages'];
                    $sql = "SELECT course_title FROM courses WHERE id = $selected_id";
                    $result = mysqli_query($conn, $sql);
                    if( mysqli_num_rows( $result ) > 0 ) {
                        while( $row = mysqli_fetch_assoc( $result )) {

                            echo $row['course_title']; 
                        }
                    }
                    ?>
                </td>
                
                <td>
                    <div class="d-flex justify-content-around">
                        <a href="?content=college-website&&page=cources&&content_web_edit=edit_meta_data&&edit_id=<?php echo urlencode($meta_setting_data['id']); ?>" 
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



