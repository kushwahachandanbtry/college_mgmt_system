<?php
if (isset($_POST['save'])) {
    include dirname(__DIR__, 5). '/constant.php';
    include dirname(__DIR__, 5). '/config.php';

    // Retrieve form data
    $college_name = mysqli_real_escape_string($conn, $_POST['college_name']);
    $college_address = mysqli_real_escape_string($conn, $_POST['college_address']);
    $country_code = mysqli_real_escape_string($conn, $_POST['country_code']);
    $college_phone = mysqli_real_escape_string($conn, $_POST['college_phone']);
    $college_email = mysqli_real_escape_string($conn, $_POST['college_email']);

    // Prepare SQL query to insert data into college_info table
    $sql = "INSERT INTO college_info (college_name, college_address, country_code, college_phone, college_email) 
            VALUES ('$college_name', '$college_address', '$country_code', '$college_phone', '$college_email')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Success message and redirect
        $msg = "College information saved successfully!";
        header("Location: ".APP_PATH."admin/dashboard.php?content=college-website&page=contact&msg=" . urlencode($msg));
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
