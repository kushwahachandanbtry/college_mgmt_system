
<h3><i>Edit College Info</i></h3>
<?php

if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];

    if (isset($_POST['update'])) {
        include dirname(__DIR__, 4). '/helpers.php';
    
        // Retrieve form data
        $college_name = mysqli_real_escape_string($conn, $_POST['college_name']);
        $college_address = mysqli_real_escape_string($conn, $_POST['college_address']);
        $country_code = mysqli_real_escape_string($conn, $_POST['country_code']);
        $college_phone = mysqli_real_escape_string($conn, $_POST['college_phone']);
        $college_email = mysqli_real_escape_string($conn, $_POST['college_email']);
    
        // Prepare SQL query to insert data into college_info table
        $sql = "UPDATE college_info SET college_name = '$college_name', college_address = '$college_address',
                                        country_code = '$country_code', college_phone = '$college_phone',
                                        college_email = '$college_email' WHERE id = $id";
    
        // Execute the query
        if (mysqli_query($conn, $sql)) {
            edit_success_message();
        } else {
            edit_failed_message();
        }
    
    }


    $sql = "SELECT * FROM college_info WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <form class="px-5" action="" method="POST">
                <label for="clz-name">College Name: </label>
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" id="clz-name" name="college_name" placeholder="Enter College Name"
                        value="<?php echo htmlspecialchars( $row['college_name']); ?>">
                </div>
                <label for="clz-address">College Address: </label>
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" id="clz-address" name="college_address"
                        placeholder="Enter College Address" value="<?php echo htmlspecialchars( $row['college_address']); ?>">
                </div>

                <label for="country">Phone Number: </label>
                <div class="input-group flex-nowrap">
                    <select id="country" name="country_code" class="form-control col-2" required>
                        <option value="" disabled>Select your country</option>
                        <option <?php $row['country_code'] == 'NP' ? 'selected' : '' ; ?> value="NP" data-code="+977" data-flag="🇳🇵">Nepal (+977)</option>
                        <option <?php $row['country_code'] == 'US' ? 'selected' : '' ; ?> value="US" data-code="+1" data-flag="🇺🇸">USA (+1)</option>
                        <option <?php $row['country_code'] == 'CA' ? 'selected' : '' ; ?> value="CA" data-code="+1" data-flag="🇨🇦">Canada (+1)</option>
                        <option <?php $row['country_code'] == 'GB' ? 'selected' : '' ; ?> value="GB" data-code="+44" data-flag="🇬🇧">UK (+44)</option>
                        <option <?php $row['country_code'] == 'IN' ? 'selected' : '' ; ?> value="IN" data-code="+91" data-flag="🇮🇳">India (+91)</option>
                        <!-- Add more countries as needed -->
                    </select>
                    <input type="text" class="form-control" id="clz-phone" name="college_phone" placeholder="Enter Phone Number"
                    value="<?php echo htmlspecialchars( $row['college_phone']); ?>">
                </div>

                <label for="clz-email">Email: </label>
                <div class="input-group flex-nowrap">
                    <input type="email" class="form-control" id="clz-email" name="college_email" placeholder="Enter Email" value="<?php echo htmlspecialchars( $row['college_email']); ?>">
                </div>

                <div class="py-3">
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>

            <script>
                document.getElementById('country').addEventListener('change', function () {
                    var countryCode = this.options[this.selectedIndex].getAttribute('data-code');
                    var phoneInput = document.getElementById('clz-phone');

                    // Set the placeholder to show the country code
                    phoneInput.placeholder = "Enter Phone Number (e.g., " + countryCode + "1234567890)";

                    // Optionally, clear the input
                    phoneInput.value = "";
                });
            </script>
            <?php
        }
    }


}
