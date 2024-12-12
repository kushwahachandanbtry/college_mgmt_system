<?php include_once "config.php";
include "../helpers.php";
if (isset($_GET['msg'])) {
    add_success_message($_GET['msg']);
}
?>
<div class="attendance">
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content">
                <div class="row filter-row">
                    <!-- Faculty Dropdown -->
                    <div class="col-sm-6 col-md-3 col-3">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Select Faculty</label>
                            <?php
                            $sql = "SELECT classes FROM classes";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                ?>
                                <select name="classes" id="classSelect" class="select floating">
                                    <option value="">Select Class</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <option value="<?php echo $row['classes']; ?>"><?php echo $row['classes']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <!-- Semester Dropdown -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Select Semester</label>
                            <select name="semester" id="semesterSelect" class="select floating">
                                <option value="">Select Semester</option>
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

                    <!-- Month and Year Dropdowns -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Select Month</label>
                            <select name="months" id="monthSelect" class="select floating">
                                <option value="jan">Jan</option>
                                <option value="feb">Feb</option>
                                <option value="mar">Mar</option>
                                <option value="apr">Apr</option>
                                <option value="may">May</option>
                                <option value="jun">Jun</option>
                                <option value="jul">Jul</option>
                                <option value="aug">Aug</option>
                                <option value="sep">Sep</option>
                                <option value="oct">Oct</option>
                                <option value="nov">Nov</option>
                                <option value="dec">Dec</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Select Year</label>
                            <select name="years" id="yearSelect" class="select floating">
                                <script>
                                    const currentYear = new Date().getFullYear();
                                    const yearSelect = document.getElementById("yearSelect");

                                    for (let i = 0; i < 5; i++) {
                                        const option = document.createElement("option");
                                        option.value = currentYear - i;
                                        option.textContent = currentYear - i;
                                        yearSelect.appendChild(option);
                                    }
                                </script>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Attendance Table -->
                <div>
                    <p class="text-success">(HINT: Click for present and double click for absent!)</p>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Students</th>
                                        <?php for ($i = 1; $i <= 31; $i++) { ?>
                                            <th><?php echo $i; ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $sql2 = "SELECT fname, lname, class, semester FROM students";
                                    $result2 = mysqli_query($conn, $sql2);
                                    if (mysqli_num_rows($result2) > 0) {
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            ?>
                                            <tr data-class="<?php echo $row2['class']; ?>" data-semester="<?php echo $row2['semester']; ?>" class="pre_abs">
                                                <td style="border: 1px solid gray; cursor: pointer;"><?php echo $row2['fname'] . " " . $row2['lname']; ?></td>
                                                <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                    <td style="border: 1px solid gray; cursor: pointer;"></td>
                                                <?php } ?>
                                            </tr>
                                        <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="btn btn-primary my-3">Submit</div>
</div>

<script>
    const tds = document.querySelectorAll('td');

    tds.forEach(function (td) {
        td.addEventListener("click", function () {
            // Check if it already contains the check icon
            if (td.innerHTML.includes('fa-check')) {
                // Toggle to the close icon
                td.innerHTML = '<i class="fa fa-close text-danger"></i>';
            } else {
                // Toggle to the check icon
                td.innerHTML = '<i class="fa fa-check text-success"></i>';
            }
        });

        td.addEventListener("dblclick", function () {
            // Check if it already contains the close icon
            if (td.innerHTML.includes('fa-close')) {
                // Toggle to the check icon
                td.innerHTML = '<i class="fa fa-check text-success"></i>';
            } else {
                // Toggle to the close icon
                td.innerHTML = '<i class="fa fa-close text-danger"></i>';
            }
        });
    });


    document.addEventListener("DOMContentLoaded", function () {
        const classSelect = document.getElementById("classSelect");
        const semesterSelect = document.getElementById("semesterSelect");
        const studentRows = document.querySelectorAll("tbody tr");

        function filterStudents() {
            const selectedClass = classSelect.value;
            const selectedSemester = semesterSelect.value;

            studentRows.forEach(row => {
                const rowClass = row.getAttribute("data-class");
                const rowSemester = row.getAttribute("data-semester");

                // Show row only if both class and semester match the selected values
                if ((rowClass === selectedClass || selectedClass === "") &&
                    (rowSemester === selectedSemester || selectedSemester === "")) {
                    row.style.display = "";  // Show row
                } else {
                    row.style.display = "none";  // Hide row
                }
            });
        }

        // Add event listeners to the dropdowns
        classSelect.addEventListener("change", filterStudents);
        semesterSelect.addEventListener("change", filterStudents);
    });


    //send data in table
    const attendance = [];  // Array to store attendance data

    document.querySelector('.btn-primary').addEventListener('click', function () {
        attendance.length = 0;  // Clear the attendance array before collecting new data

        // Get selected values
        const selectedClass = document.getElementById('classSelect').value;
        const selectedSemester = document.getElementById('semesterSelect').value;
        const selectedMonth = document.querySelector('[name="months"]').value;
        const selectedYear = document.getElementById('yearSelect').value;

        // Loop through each student row to get marked attendance status
        document.querySelectorAll('tbody tr').forEach(row => {
            const studentName = row.querySelector('td').textContent.trim(); // Student's name
            const dailyStatus = {};  // Object to store marked attendance with day as key

            row.querySelectorAll('td').forEach((td, index) => {
                if (index > 0 && td.innerHTML.trim()) {  // Skip the first cell (student name) and empty cells
                    const day = index;  // Day of the month (1, 2, 3, ...)
                    const isPresent = td.innerHTML.includes('fa-check');
                    dailyStatus[day] = isPresent ? 'present' : 'absent';  // Store only marked days
                }
            });

            // Only add the student if there are marked days
            if (Object.keys(dailyStatus).length > 0) {
                attendance.push({
                    name: studentName,
                    class: selectedClass,
                    semester: selectedSemester,
                    month: selectedMonth,
                    year: selectedYear,
                    status: JSON.stringify(dailyStatus)  // Convert status object to JSON string
                });
            }
        });

        // Send attendance data to the backend
        sendAttendanceData(attendance);
    });

    document.addEventListener("DOMContentLoaded", function () {
        const classSelect = document.getElementById("classSelect");
        const semesterSelect = document.getElementById("semesterSelect");
        const monthSelect = document.getElementById("monthSelect");
        const yearSelect = document.getElementById("yearSelect");

        function fetchAttendance() {
    const selectedClass = classSelect.value;
    const selectedSemester = semesterSelect.value;
    const selectedMonth = monthSelect.value;
    const selectedYear = yearSelect.value;

    if (selectedClass && selectedSemester && selectedMonth && selectedYear) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "actions/fetch_attendance.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const attendanceData = JSON.parse(xhr.responseText);

                // Clear previous attendance data
                document.querySelectorAll("tbody tr").forEach(row => {
                    row.querySelectorAll("td").forEach((td, index) => {
                        if (index > 0) {
                            td.innerHTML = "";  // Clear icons
                        }
                    });
                });

                // Populate table with fetched attendance data
                document.querySelectorAll("tbody tr").forEach(row => {
                    const studentName = row.querySelector("td").textContent.trim();
                    if (attendanceData[studentName]) {
                        const dailyStatus = attendanceData[studentName];
                        row.querySelectorAll("td").forEach((td, index) => {
                            if (index > 0) {
                                const day = index;
                                if (dailyStatus[day] === "present") {
                                    td.innerHTML = '<i class="fa fa-check text-success"></i>';
                                } else if (dailyStatus[day] === "absent") {
                                    td.innerHTML = '<i class="fa fa-close text-danger"></i>';
                                }
                            }
                        });
                    }
                });
            }
        };
        xhr.send(`class=${selectedClass}&semester=${selectedSemester}&month=${selectedMonth}&year=${selectedYear}`);
    }
}

        function sendAttendanceData() {
            const attendance = [];
            const selectedClass = classSelect.value;
            const selectedSemester = semesterSelect.value;
            const selectedMonth = monthSelect.value;
            const selectedYear = yearSelect.value;

            document.querySelectorAll('tbody tr').forEach(row => {
                const studentName = row.querySelector('td').textContent.trim();
                const dailyStatus = {};
                row.querySelectorAll('td').forEach((td, index) => {
                    if (index > 0 && td.innerHTML.trim()) {
                        dailyStatus[index] = td.innerHTML.includes('fa-check') ? 'present' : 'absent';
                    }
                });

                if (Object.keys(dailyStatus).length > 0) {
                    attendance.push({
                        name: studentName,
                        class: selectedClass,
                        semester: selectedSemester,
                        month: selectedMonth,
                        year: selectedYear,
                        status: JSON.stringify(dailyStatus)
                    });
                }
            });

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'actions/submit_attendance.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert("Attendance submitted successfully!");
                }
            };
            xhr.send(JSON.stringify(attendance));
        }

        classSelect.addEventListener("change", fetchAttendance);
        semesterSelect.addEventListener("change", fetchAttendance);
        monthSelect.addEventListener("change", fetchAttendance);
        yearSelect.addEventListener("change", fetchAttendance);

        // Submit Button Logic
        document.querySelector('.btn-primary').addEventListener('click', sendAttendanceData);
    });


</script>
