<div class="container-fluid py-5">
    <div class="row">
        <div class="col-lg-8 py-4" style="background-color: #FFF;">
            <form>
                <h5 class="pb-3">Write New Message</h5>
                <div class="">
                    <lable>Title </lable>
                    <input style="background-color: #F0F1F3" type="text" name="subject_name" aria-label="Subject name" class="form-control py-2 px-4">
                </div>
                <div class="py-4">
                    <lable>Receipt</lable><br>
                    <input style="background-color: #F0F1F3" type="text" name="receipt" aria-label="Message" class="form-control py-2 px-4">
                    
                </div>
                <div class="py-4">
                    <lable>Message</lable><br>
                    <textarea class="py-2 px-2" name="message" id="" cols="80" rows="10"></textarea>
                </div>
                <div class="class-routine">
                    <button class="py-2 px-4"  style="background-color: #FFAE01; color: #fff; border:none; cursor:pointer;" type="submit" name="save">Save</button>
                    <button class="py-2 px-4"  style="background-color: #042954; color: #fff; border:  none; cursor: pointer" type="reset">Reset</button>
                </div>

            </form>
        </div>
        <div class="col-lg-3" style="margin-left:50px">
        <div  class="py-5 text-center" style="background-color: #FFFFFF; height: 200px; border-radius: 10px;">
            <div>
                <h5 style="font-style: italic; font-weight: 600;">Successfull Message</h5>
            </div>
            <div class="py-2">
                <i  style="border: 15px solid #B2D888; color: #FFFFFF; background-color: #92C755; padding: 20px 20px; border-radius: 50%; font-size: 20px;" class="fa-solid fa-check"></i>
            </div>
        </div>

        <div  class="my-4 py-5 text-center" style="background-color: #FFFFFF; height: 200px; border-radius: 10px;">
            <div>
                <h5 style="font-style: italic; font-weight: 600;">Failed Message</h5>
            </div>
            <div class="py-2">
                <i  style="border: 15px solid #F68686; color: #FFFFFF; background-color: #EE0D0D; padding: 20px 20px; border-radius: 50%; font-size: 20px;" class="fa-solid fa-circle-exclamation"></i>
            </div>
        </div>
        </div>
    </div>
</div>
