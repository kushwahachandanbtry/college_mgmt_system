<?php
if (!isset($_SESSION['admin'])) {
    exit();
}
include "../helpers.php";
if (isset($_GET['msg'])) {
    add_success_message($_GET['msg']);
}
?>

<div class="adminssion-form py-5 px-5" style="background:#FFFFFF;">
    <form action="actions/expenses.php" method="POST" enctype="multipart/form-data">
        <h5>Add New Teachers</h5>
        <div class="d-flex py-3">
            <div class="">
                <lable>First Name *</lable>
                <input type="text"  name="fname" aria-label="First name" class="form-control py-2 px-4" required>
            </div>
            <div class="mx-5">
                <lable>ID *</lable>
                <input type="text"  name="lname" aria-label="Last name" required class="form-control  py-2 px-4">
            </div>
            <div class="mx-5">
                <lable>Amount *</lable>
                <input type="number"  name="amount" aria-label="amount" required class="form-control  py-2 px-4">
            </div>
            <div class="mx-5">
                <lable>Phone *</lable>
                <input type="number"  name="number" aria-label="number" class="form-control py-2 px-4" required>
            </div>
        </div>
        <div class="d-flex py-3">
            <div class="">
                <lable>ID *</lable>
                <input type="text"  name="roll" aria-label="roll" class="form-control py-2 px-4" required>
            </div>
            <div class="mx-5">
            <lable class="mx-3">Expenses Type *</lable><br>
                <select name="expenses-type"  class="border border-light rounded py-2 px-3 mx-1" aria-label="Default select example" required>
                    <option class="text-light">Select Your Expenses Typ*</option>
                    <option value="salary">salary</option>
                    <option value="Transport">Transport</option>
                    <option value="Maintenance">Maintenance</option>
                </select>
            </div>
            <div class="">
                <lable>Status *</lable><br>
                <select name="status"  class="border border-light rounded py-2 px-3" aria-label="Default select example" required>
                    <option class="text-light">Select Your status*</option>
                    <option value="Paid">Paid</option>
                    <option value="Due">Due</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="mx-5">
                <lable>Date *</lable>
                <input type="date"  name="date" aria-label="date" class="form-control py-2 px-1" required>
        </div>
    </div>
    <div>
            <button type="submit" name="save">Save</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</div>
