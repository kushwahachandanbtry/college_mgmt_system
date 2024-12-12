<!DOCTYPE html>
<html lang="en">
<?php include dirname(__DIR__, 3). '/fetchDataController.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo $collegeName; ?></title>
    <link rel="stylesheet" href="style.css">
    <!-- Favicons -->
    <link href="http://localhost/college_mgmt_system/assets/images/logo/svg.jpg" rel="icon">
    <link href="http://localhost/college_mgmt_system/assets/images/logo/svg.jpg" rel="apple-touch-icon">
    <style>

    </style>
</head>

<body>
    <div id="wrapper" style="margin: 60px 220px;">
        <form id="loginForm" class="login" style="padding: 0 30px;" action="">
            <div id="error"></div>
            <input type="text" name="email" placeholder="Email">
            
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit" id="login_button" value="Login"><br>
            <a style="display: block; text-align:center; text-decoration: none; padding-top: 10px;" href="signup.php">Don't have an account?? Signup here</a>
        </form>
    </div>
</body>

</html>


<script type="text/javascript">
    function __(element) {
        return document.getElementById(element);
    }

    var loginButton = __('login_button');
    loginButton.addEventListener('click', collectData);

    function collectData(e) {
        e.preventDefault();
        loginButton.disabled = true;
        loginButton.value = "Loading...Please Wait...";

        var loginForm = __('loginForm');
        var inputs = loginForm.getElementsByTagName('INPUT');
        var datas = {};
        for (var i = inputs.length - 1; i >= 0; i--) {
            var key = inputs[i].name;

            switch (key) {

                case "email":
                    datas.email = inputs[i].value;
                    break;

                case "password":
                    datas.password = inputs[i].value;
                    break;

            }
        }

        send_data(datas, "login");


    }

    function send_data(data, type) {
        var xml = new XMLHttpRequest();
        xml.onload = function () {
            if (xml.status == 200 || xml.readyState == 4) {
                handle_result(xml.responseText);
                loginButton.disabled = false;
                loginButton.value = "Login";
            }

        }
        data.data_type = type;
        var dataString = JSON.stringify(data);

        xml.open("POST", "api.php", true);
        xml.send(dataString);
    }

    function handle_result(result) {
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
