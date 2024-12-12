<?php
include "../helpers.php";
if (isset($_GET['msg'])) {
    add_success_message($_GET['msg']);
}

?>

<div class="container-fluid py-5">
    <div class="row">
        <div class="col-lg-3 py-4" style="background-color: #FFF;">
        
            <form method="POST" action="actions/add_notice.php">
                <h5 class="pb-3">Create a Notice</h5>
                <div class="">
                    <lable>Title </lable>
                    <input style="background-color: #F0F1F3" type="text" name="title" aria-label="Subject name" class="form-control py-2 px-4" required>
                </div>
                <div class="py-4">
                    <lable>Details</lable><br>
                    <textarea class="py-2 px-2" required name="details" id="" cols="25" rows="10"></textarea>
                </div>
                <div class="py-4">
                    <lable>Posted By</lable><br>
                    <input style="background-color: #F0F1F3" type="text" name="posted_by" required aria-label="Posted by" class="form-control py-2 px-4">
                    
                </div>
                <div class="py-4">
                    <lable>Date</lable><br>
                    <?php
                    date_default_timezone_set('Asia/Kathmandu');
                    ?>
                    <input style="background-color: #F0F1F3" value="<?php echo date("l jS \of F Y h:i:s A"); ?>" type="text" readonly name="date" aria-label="Date" class="form-control py-2 px-4">

                    
                </div>
                <div class="class-routine">
                    <button class="py-2 px-4"  style="background-color: #FFAE01; color: #fff; border:none; cursor:pointer;" type="submit" name="post">Post</button>
                    <button class="py-2 px-4"  style="background-color: #042954; color: #fff; border:  none; cursor: pointer" type="reset">Reset</button>
                </div>

            </form>
        </div>
        <div class="col-lg-8 ml-5" style="background: #FFFFFF;">
            <div class="search-box py-3">
                <form class="py-3 d-flex" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" target="_self">
                    <input type="text" value="" placeholder="Search by Date" name="date" class="px-5 py-1">
                    <input type="text" value="" placeholder="Search by Title" name="title" class="mx-2 px-5 py-1">
                    <button type="submit" name="save" class="btn btn-warning">Search</button>
                </form>
            </div>

            
            <div style="height:800px; overflow: scroll;">
        <?php
        $sql = "SELECT * FROM notice ORDER BY id DESC";
        $result = mysqli_query( $conn, $sql );
        if( mysqli_num_rows( $result ) >  0 ) {
            while( $row = mysqli_fetch_assoc( $result ) ) {

        
        ?>
            
            <div class="text-center">
                <p style="background: #40DFCD; width: 70%; border-radius: 30px; color: #FFFFFF; font-size: 16px; font-weight: 500" class="py-2"><?php echo $row['date']; ?></p>
            </div>
            <div>
                <a href="?content=notice&id=<?php echo $row['id']; ?>"><p style="font-weight: 500; font-size: 17px"><?php echo $row['title']; ?></p></a>
                <?php
                $limit_text = text_limit($row['details'], 50); ?>
                <p><?php echo $limit_text; ?></p>
                <div class="d-flex justify-content-between">
                    <p style="margin-top: -15px;"><span style=" color: #3888FF; ">Posted By: </span><?php echo $row['posted_by']; ?></p>
                    

                </div>
            </div>
            <hr>
            
            <?php } } ?>
            </div>
        </div>
    </div>
</div>

