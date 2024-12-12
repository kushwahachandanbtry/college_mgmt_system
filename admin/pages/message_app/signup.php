<!DOCTYPE html>
<html lang="en">
<?php include dirname(__DIR__, 3). '/fetchDataController.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - <?php echo $collegeName; ?> </title>
    <link rel="stylesheet" href="style.css">
    <!-- Favicons -->
    <link href="http://localhost/college_mgmt_system/assets/images/logo/svg.jpg" rel="icon">
    <link href="http://localhost/college_mgmt_system/assets/images/logo/svg.jpg" rel="apple-touch-icon">
    <style>

    </style>
</head>

<body>
    <div id="wrapper" style="margin: 60px 220px;">
        <form id="signupForm" style="padding: 0 30px;" class="signup" action="">
            <div id="error"></div>
            <input type="text" name="username" placeholder="Username">
            <input type="text" name="email" placeholder="Email">
            <div style="padding: 10px;">
                Gender: <br>
                <input type="radio" name="gender" id="male" value="Male"><label for="male">Male</label><br>
                <input type="radio" name="gender" id="female" value="Female"><label for="female">Female</label><br>
            </div>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="password" name="confirm_password" placeholder="Confirm password"><br><br>
            <select required name="role" id="">
                <option disabled value="">Select Role</option>
                <option value="teacher">Teachers</option>
                <option value="student">Students</option>
                <option value="parent">Parents</option>
            </select>
            <input type="submit" id="signup_button" value="Signup"><br>
            <a style="display: block; text-align:center; text-decoration: none; padding-top: 10px;"
                href="login.php">Already have an account?? Login here</a>
        </form>
    </div>
</body>

</html>


<script type="text/javascript">
    function __(element) {
        return document.getElementById(element);
    }

    var singupButton = __('signup_button');
    singupButton.addEventListener('click', collectData);

    function collectData(e) {
        e.preventDefault();
        singupButton.disabled = true;
        singupButton.value = "Loading...Please Wait...";

        var signupForm = __('signupForm');
        var inputs = signupForm.getElementsByTagName('INPUT');
        var datas = {};
        for (var i = inputs.length - 1; i >= 0; i--) {
            var key = inputs[i].name;

            switch (key) {
                case "username":
                    datas.username = inputs[i].value;
                    break;

                case "email":
                    datas.email = inputs[i].value;
                    break;

                case "gender":
                    if (inputs[i].checked) {
                        datas.gender = inputs[i].value;
                    }
                    break;

                case "password":
                    datas.password = inputs[i].value;
                    break;

                case "confirm_password":
                    datas.confirm_password = inputs[i].value;
                    break;
            }
        }

    // Handle the "role" field in the switch statement
    var roleSelect = signupForm.querySelector("select[name='role']");
    if (roleSelect) {
        switch (roleSelect.name) {
            case "role":
                if (roleSelect.value === "") {
                    // Ensure a role is selected
                    var error = __("error");
                    error.innerHTML = "Please select a role.";
                    error.style.display = 'block';
                    singupButton.disabled = false;
                    singupButton.value = "Signup";
                    return; // Stop further processing if no role is selected
                } else {
                    datas.role = roleSelect.value;
                }
                break;
        }
    }

        send_data(datas, "signup");
    }


    function send_data(data, type) {
        var xml = new XMLHttpRequest();
        xml.onload = function () {
            if (xml.status == 200 || xml.readyState == 4) {
                handle_result(xml.responseText);
                singupButton.disabled = false;
                singupButton.value = "Signup";
            }

        }
        data.data_type = type;
        var dataString = JSON.stringify(data);

        xml.open("POST", "api.php", true);
        xml.send(dataString);
    }

    function handle_result(result) {
        // alert(result);
        try {
            var data = JSON.parse(result);
            if (data.data_type == "info") {
                window.location = 'index.php';
            } else {
                var error = __("error");
                error.innerHTML = data.message;
                error.style.display = 'block';
            }
        } catch (e) {
            var error = __("error");
            error.innerHTML = "An error occurred. Please try again later.";
            error.style.display = 'block';
            console.error("Invalid JSON response: ", result);
        }
    }
</script>
