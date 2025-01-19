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
        <th>Video Heading</th>
        <th>Video Description</th>
        <th>Video</th>
        <th>Actions</th>
    </tr>
    <?php
    if (!empty($videos_and_contents) && is_array($videos_and_contents)) {
        $i = 1;
        foreach ($videos_and_contents as $video_and_content) {
            function extractYouTubeId($url)
            {
                parse_str(parse_url($url, PHP_URL_QUERY), $query);
                return $query['v'] ?? ''; // Extract 'v' parameter from the URL
            }
            ?>
            <tr class="fs-1">
                <td><?php echo $i++; ?></td>
                <td><?php echo $video_and_content['video_heading']; ?></td>
                <td class="col-12 text-wrap"><?php echo $video_and_content['video_description']; ?></td>
                <td>
                    <iframe style="width: 200px; height: 150px;"
                        src="https://www.youtube.com/embed/<?php echo extractYouTubeId($video_and_content['video_file']); ?>"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </td>
                <td>
                    <div class="d-flex justify-content-around">
                        <a href="?content=college-website&&page=about&&content_web_edit=edit_videos&&edit_id=<?php echo urlencode($video_and_content['id']); ?>"
                            class="text-primary edit-button">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <p class="text-danger" style="cursor: pointer;" onclick="confirmWebDataDelete(<?php echo $video_and_content['id']; ?>, 'delete_video_and_content')"><i class="fa-solid fa-delete-left"></i></p>
                    </div>
                </td>
            </tr>


        <?php } ?>
        <!-- table end -->
    <?php } ?>
</table>
