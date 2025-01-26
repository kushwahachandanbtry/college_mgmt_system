<?php
include "../helpers.php";
if (isset($_GET['msg'])) {
    add_success_message($_GET['msg']);
}
if (isset($_GET['errors'])) {
    add_failled_message($_GET['errors']);
}
?>
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-lg-12 py-4" style="background-color: #FFF;">

            <form method="POST" action="actions/add_notice.php">
                <h5 class="pb-3">Create a Notice</h5>
                <div class="">
                    <lable>Title </lable>
                    <input style="background-color: #F0F1F3" type="text" name="title" aria-label="Subject name"
                        class="form-control py-2 px-4" required>
                </div>
                <div class="py-4">
                    <lable>Details</lable><br>
                    <textarea class="py-2 px-2" required name="details" id="" style="width: 100%;" rows="10"></textarea>
                </div>
                <div class="py-4">
                    <lable>Posted By</lable><br>
                    <input style="background-color: #F0F1F3" type="text" name="posted_by" required
                        aria-label="Posted by" class="form-control py-2 px-4">

                </div>
                <div class="py-4">
                    <lable>Date</lable><br>
                    <?php
                    date_default_timezone_set('Asia/Kathmandu');
                    ?>
                    <input style="background-color: #F0F1F3" value="<?php echo date("l jS \of F Y h:i:s A"); ?>"
                        type="text" readonly name="date" aria-label="Date" class="form-control py-2 px-4">


                </div>
                <div class="class-routine">
                    <button class="py-2 px-4"
                        style="background-color: #FFAE01; color: #fff; border:none; cursor:pointer;" type="submit"
                        name="post">Post</button>
                    <button class="py-2 px-4"
                        style="background-color: #042954; color: #fff; border:  none; cursor: pointer"
                        type="reset">Reset</button>
                </div>

            </form>
        </div>
    </div>
</div>
