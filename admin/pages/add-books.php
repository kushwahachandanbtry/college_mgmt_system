<?php
include "../helpers.php";

if (isset($_GET['msg'])) {
    add_success_message($_GET['msg']);
}
?>

<div class="adminssion-form py-5 px-5" style="background:#FFFFFF;">
    <form action="actions/books.php" method="POST">
        <h5>Add New Books</h5>
        <div class="d-flex py-3">
            <div class="">
                <lable>Book Name *</lable>
                <input type="text"  name="bname" aria-label="Book name" class="form-control py-2 px-4" required>
            </div>
            <div class="mx-5">
                <lable>Writer Name *</lable>
                <input type="text"  name="wname" aria-label="Writer name" required class="form-control  py-2 px-4">
            </div>
            <div class="">
                <lable>Class *</lable><br>
                <select name="class"  class="border border-light rounded py-2 px-4" aria-label="Default select example" required>
                    <option class="text-light">Select Your Class*</option>
                    <option value="BBA">BBA</option>
                    <option value="BCA">BCA</option>
                    <option value="BGM">BHM</option>
                    <option value="MBA">MBA</option>
                    <option value="Finance">Finance</option>
                </select>
            </div>
            <div class="mx-5">
                <lable>Published Date *</lable>
                <input type="pdate"  name="pubdate" aria-label="published date" class="form-control py-2 px-4" required>
            </div>
        </div>
        
        <div class="d-flex py-3">
            <div class="">
                <lable>ID NO *</lable>
                <input type="text"  name="book-id" aria-label="book id" class="form-control py-2 px-4" required>
            </div>
            <div class="mx-5">
            <lable class="mx-3">Upload Date</lable><br>
            <input type="text"  name="uploade" aria-label="upload date" class="form-control py-2 px-4" required>
                </select>
            </div>
</div>
        <div>
            <button type="submit" name="save">Save</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</div>
