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


?>


<div class="row">
    <div class="col-lg-12">
        <!-- Form Basic -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">View Class Attendance</h6>
                <?php // echo $statusMsg; ?>
            </div>
            <div class="card-body d-flex justify-content-between">
                <form method="post">
                    <div class="form-group row mb-3">
                        <div class="col-xl-12">
                            <label class="form-control-label">Search By Student Name<span class="text-danger ml-2">*</span></label>
                            <input type="text" class="form-control" name="student_name" id="exampleInputFirstName"
                                placeholder="Name">
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
                                            $student = $_POST['student_name'];
                                            if( $student == $data['name'] ) {
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
