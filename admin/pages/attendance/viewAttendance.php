<?php
include dirname(__DIR__, 3). '/config.php';

//retrieving attendance data
$query = "SELECT attendance FROM attendance";
$result = mysqli_query($conn, $query);
$atten_data_array = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Decode the JSON data
        $atten_data = json_decode($row['attendance'], true);
        $atten_data_array[] = $atten_data;

    }
} else {
    echo "Error retrieving data: " . mysqli_error($conn);
}


// Fetch all classes for the dropdown
$classes = [];
$sql2 = "SELECT DISTINCT classes FROM classes";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $classes[] = $row;
    }
}
?>


<div class="row">
    <div class="col-lg-12">
        <!-- Form Basic -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">View Class Attendance</h6>
                <?php // echo $statusMsg; ?>
            </div>
            <div class="card-body ">
                <form method="post">
                    <div class="form-group row mb-3">
                        <div class="col-4">
                            <label class="form-control-label">Search By Date<span class="text-danger ml-2">*</span></label>
                            <input type="date" class="form-control" name="dateTaken" id="exampleInputFirstName"
                                placeholder="Date">
                        </div>
                        <div class="col-4">
                            <label class="form-control-label">Search By Semester<span class="text-danger ml-2">*</span></label>
                            <select name="semesterToken" class="border border-light rounded py-2 px-3" aria-label="Default select example" required>
                                <option class="text-light">Select Your semester*</option>
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                                <option value="4th">4th</option>
                                <option value="5th">5th</option>
                                <option value="6th">6th</option>
                                <option value="7th">7th</option>
                                <option value="8th">8th</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="view" class="btn btn-primary">View Attendance</button>
                </form>
                
            </div>
        </div>

        <!-- Input Group -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Class Attendance</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Admission ID</th>
                                    <th>Class</th>
                                    <th>Semester</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <?php $i = 1;
                            foreach ($atten_data_array as $data) { 
                                $msg = '';
                                ?>
                                <tbody>
                                    <tr>
                                        <?php 
                                        if( isset( $_POST['view'] ) ) {
                                            $dateTaken = isset($_POST['dateTaken']) ? $_POST['dateTaken'] : $_POST['dateTaken'];
                                            $semesterToken = isset($_POST['semesterToken']) ? $_POST['semesterToken'] : "";
                                            $classToken = isset($_POST['classToken']) ? $_POST['classToken'] : "";
                                            if( $dateTaken == $data['date'] || $semesterToken == $data['semester'] || $classToken == $data['class'] ) {
                                            ?>
                                            <td><?php echo htmlspecialchars($i++); ?></td>
                                            <td><?php echo htmlspecialchars($data['name']); ?></td>
                                            <td><?php echo htmlspecialchars($data['admission_id']); ?></td>
                                            <td><?php echo htmlspecialchars($data['class']); ?></td>
                                            <td><?php echo htmlspecialchars($data['semester']); ?></td>
                                            <td><?php echo htmlspecialchars($data['date']); ?></td>
                                            <td
                                                style="color: #fff; background-color: <?php echo $data['status'] == "1" ? "blue" : "red"; ?>;"><?php
                                                        $status = $data['status'] == "1" ? "Present" : "Absent";
                                                        echo $status;
                                                        ?></td>
                                            <?php 
                                            } else {
                                                $msg = "No data found!!";
                                            }
                                        } else {
                                            ?>
                                            <td><?php echo htmlspecialchars($i++); ?></td>
                                            <td><?php echo htmlspecialchars($data['name']); ?></td>
                                            <td><?php echo htmlspecialchars($data['admission_id']); ?></td>
                                            <td><?php echo htmlspecialchars($data['class']); ?></td>
                                            <td><?php echo htmlspecialchars($data['semester']); ?></td>
                                            <td><?php echo htmlspecialchars($data['date']); ?></td>
                                            <td
                                                style="color: #fff; background-color: <?php echo $data['status'] == "1" ? "blue" : "red"; ?>;"><?php
                                                        $status = $data['status'] == "1" ? "Present" : "Absent";
                                                        echo $status;
                                                        ?></td>
                                            <?php 

                                        }
                                        
                                        ?>
                                        
                                    </tr>
                                </tbody>
                            <?php }  ?>
                        </table>
                        <?php echo $msg;  ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->


</div>


<!-- Page level custom scripts -->
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable(); // ID From dataTable 
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
</script>
