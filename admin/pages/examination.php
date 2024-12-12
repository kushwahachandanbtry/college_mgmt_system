<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 py-3" style="background-color: #FFF">
            <form>
                <h4 class="py-4">Add New Exam</h4>
                <div class="">
                    <lable>Grade Name</lable>
                    <input style="background-color: #F0F1F3" type="text" name="grade_name" aria-label="Subject name" class="form-control py-2 px-4">
                </div>
                <div class="py-4">
                    <lable>Grade Point</lable><br>
                    <select style="background-color: #F0F1F3" class="border border-light rounded py-2 px-4" aria-label="Default select example">
                        <option selected class="text-light">Select Your GradePoint *</option>
                        <option value="A+">A+</option>
                        <option value="A">A</option>
                        <option value="B+">B+</option>
                    </select>
                </div>
                <div class="">
                    <lable>Percentage Form</lable>
                    <input style="background-color: #F0F1F3" type="text" name="percentage_form" aria-label="percentge form" class="form-control py-2 px-4">
                </div>
                <div class="py-3">
                    <lable>Percentage Upto</lable>
                    <input style="background-color: #F0F1F3" type="text" name="percenteage_upto" aria-label="percentage upto" class="form-control py-2 px-4">
                </div>
                <div class="py-3">
                    <lable>Comments</lable>
                    <textarea name="comment" id="" cols="30" rows="10"></textarea>
                </div>
               
                <div class="class-routine">
                    <button class="py-2 px-4"  style="background-color: #FFAE01; color: #fff; border:none; cursor:pointer;" type="submit" name="save">Save</button>
                    <button class="py-2 px-4"  style="background-color: #042954; color: #fff; border:  none; cursor: pointer" type="reset">Reset</button>
        </div>

            </form>
        </div>
        <div class="col-lg-8 ml-5 py-3" style="background-color: #FFFFFF;">
            <h4 class="py-4">All Exam Schedule</h4>
            <div class="search-box">
                <form class="py-3 d-flex" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" target="_self">
                    <input type="text" value="" placeholder="Search by Grade" name="grade" class="px-5 py-1">
                    <input type="text" value="" placeholder="Search by Point" name="point" class="mx-5 px-5 py-1">
                    <button type="submit" name="save" class="btn btn-warning">Search</button>
                </form>
            </div>

            <?php

            if (isset($_POST['save'])) {
                $day = $_POST['exam'];
                $class = $_POST['date'];

            }
            ?>

            <table class="table table-striped table-hover">
                <tr>

                    <th><input type="checkbox"> Grade Name</th>
                    <th>Grade Point</th>
                    <th>Percentage From</th>
                    <th>Percentage Upto</th>
                    <th>Comment</th>
                </tr>
                <tr>
                    <td><input type="checkbox">111</td>
                    <td>DSA</td>
                    <td>albert</td>
                    <td>1900</td>
                    <td>12.04.2023</td>
                </tr>
                <tr>
                    <td><input type="checkbox">111</td>
                    <td>DSA</td>
                    <td>albert</td>
                    <td>1900</td>
                    <td>12.04.2023</td>
                </tr>
            </table>

            <div class="pegination py-5">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
