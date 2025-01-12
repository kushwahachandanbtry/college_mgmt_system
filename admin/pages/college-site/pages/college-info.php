<?php include dirname(__DIR__, 4). '/constant.php'; ?>

<h3><i>College Info</i></h3>

<form class="px-5" action="<?php echo APP_PATH . "admin/pages/college-site/pages/actions/college_info.php";?>" method="POST">
    <label for="clz-name">College Name: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="clz-name" name="college_name" placeholder="Enter College Name" required>
    </div>
    <label for="clz-address">College Address: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="clz-address" name="college_address" placeholder="Enter College Address" required>
    </div>
    
    <label for="country">Phone Number: </label>
    <div class="input-group flex-nowrap">
        <select id="country" name="country_code" class="form-control col-2" required>
            <option value="" disabled selected>Select your country</option>
            <option value="NP" data-code="+977" data-flag="🇳🇵">Nepal (+977)</option>
            <option value="US" data-code="+1" data-flag="🇺🇸">USA (+1)</option>
            <option value="CA" data-code="+1" data-flag="🇨🇦">Canada (+1)</option>
            <option value="GB" data-code="+44" data-flag="🇬🇧">UK (+44)</option>
            <option value="IN" data-code="+91" data-flag="🇮🇳">India (+91)</option>
            <!-- Add more countries as needed -->
        </select>
        <input type="text" class="form-control" id="clz-phone" name="college_phone" placeholder="Enter Phone Number" required>
    </div>

    <label for="clz-email">Email: </label>
    <div class="input-group flex-nowrap">
        <input type="email" class="form-control" id="clz-email" name="college_email" placeholder="Enter Email" required>
    </div>

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>

<script>
    document.getElementById('country').addEventListener('change', function() {
        var countryCode = this.options[this.selectedIndex].getAttribute('data-code');
        var phoneInput = document.getElementById('clz-phone');
        
        // Set the placeholder to show the country code
        phoneInput.placeholder = "Enter Phone Number (e.g., " + countryCode + "1234567890)";
        
        // Optionally, clear the input
        phoneInput.value = "";
    });
</script>
