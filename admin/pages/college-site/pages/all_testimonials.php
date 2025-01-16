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
        <th>Name</th>
        <th>Overview</th>
        <th>Batch</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php
    if (!empty($testimonials) && is_array($testimonials)) {
        $i = 1;
        foreach ($testimonials as $testimonial) {
            ?>
            <tr class="fs-1">
                <td><?php echo $i++;
                ; ?></td>
                <td><?php echo $testimonial['name']; ?></td>
                <td class="col-12 text-wrap"><?php echo $testimonial['overview']; ?></td>
                <td><?php echo $testimonial['batch']; ?></td>
                <td><img style="width: 100px; height: 100px;"
                        src="<?php echo APP_PATH . 'assets/images/what_people_say/' . $testimonial['image']; ?>"
                        alt="<?php echo $testimonial['image']; ?>"></td>
                <td>
                    <div class="d-flex justify-content-around">
                        <a href="?content=college-website&&page=home&&content_web_edit=edit_testimonials&&edit_id=<?php echo urlencode($testimonial['id']); ?>"
                            class="text-primary edit-button">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="#" class="text-danger"><i class="fa-solid fa-delete-left"></i></a>
                    </div>
                </td>

            </tr>
        <?php } ?>
        <!-- table end -->
    <?php } ?>
</table>
