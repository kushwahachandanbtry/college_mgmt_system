
<?php 
include "../helpers.php";
go_back('item6');
?>
<!-- routine area -->
<div class="">
    <div class="new-routine-area p-3">
        <h5>Add Routine <a href=""><button onclick="goBack();" class="btn btn-info ml-5">Go Back</button></a></h5>
        <form action="actions/routines.php" method="POST">
            <div class="py-3">
                <!-- <h5 class="text-center">Add Class Routine</h5> -->
                <label for="">Enter class:</label>
                <input type="text" name="class_name" placeholder="Enter class name here..." required><br>
            </div>
            <div>
                <table border="1" cellspacing="0" cellpadding="">
                    <tr class="bg-info">
                        <th>Days</th>
                        <th>1st period</th>
                        <th>2nd period</th>
                        <th>3rd period</th>
                        <th>Break</th>
                        <th>4th period</th>
                        <th>5th period</th>
                    </tr>
                    <tr>
                        <td>Sunday</td>
                        <td><input type="text" name="routine[sunday][1st]" placeholder="Write subject..."></td>
                        <td><input type="text" name="routine[sunday][2nd]" placeholder="Write subject..."></td>
                        <td><input type="text" name="routine[sunday][3rd]" placeholder="Write subject..."></td>
                        <td><input type="text" name="routine[sunday][break]" placeholder="Break time..."></td>
                        <td><input type="text" name="routine[sunday][4th]" placeholder="Write subject..."></td>
                        <td><input type="text" name="routine[sunday][5th]" placeholder="Write subject..."></td>
                    </tr>
                    <tr>
                        <td>Monday</td>
                        <td><input type="text" name="routine[monday][1st]" placeholder="Write subject..."></td>
                        <td><input type="text" name="routine[monday][2nd]" placeholder="Write subject..."></td>
                        <td><input type="text" name="routine[monday][3rd]" placeholder="Write subject..."></td>
                        <td><input type="text" name="routine[monday][break]" placeholder="Break time..."></td>
                        <td><input type="text" name="routine[monday][4th]" placeholder="Write subject..."></td>
                        <td><input type="text" name="routine[monday][5th]" placeholder="Write subject..."></td>
                    </tr>
                    <tr>
                        <td>Tuesday</td>
                        <td><input type="text" name="routine[tuesday][1st]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[tuesday][2nd]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[tuesday][3rd]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[tuesday][break]" placeholder="enter break time.."></td>
                        <td><input type="text" name="routine[tuesday][4th]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[tuesday][5th]" placeholder="write sub.. name"></td>
                    </tr>
                    <tr>
                        <td>Wednesday</td>
                        <td><input type="text" name="routine[wednesday][1st]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[wednesday][2nd]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[wednesday][3rd]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[wednesday][break]" placeholder="enter break time.."></td>
                        <td><input type="text" name="routine[wednesday][4th]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[wednesday][5th]" placeholder="write sub.. name"></td>
                    </tr>
                    <tr>
                        <td>Thrusday</td>
                        <td><input type="text" name="routine[thrusdady][1st]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[thrusdady][2nd]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[thrusdady][3rd]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[thrusdady][break]" placeholder="enter break time.."></td>
                        <td><input type="text" name="routine[thrusdady][4th]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[thrusdady][5th]" placeholder="write sub.. name"></td>
                    </tr>
                    <tr>
                        <td>Friday</td>
                        <td><input type="text" name="routine[friday][1st]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[friday][2nd]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[friday][3rd]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[friday][break]" placeholder="enter break time.."></td>
                        <td><input type="text" name="routine[friday][4th]" placeholder="write sub.. name"></td>
                        <td><input type="text" name="routine[friday][5th]" placeholder="write sub.. name"></td>
                    </tr>
                </table>
            </div>
            <button class="btn btn-primary my-3 px-5" type="submit">Save</button>
        </form>
    </div>
</div>
