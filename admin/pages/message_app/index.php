<!DOCTYPE html>
<html lang="en">
<?php include dirname(__DIR__, 3). '/fetchDataController.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - <?php echo $collegeName; ?></title>
    <link rel="stylesheet" href="style.css">
    <!-- Favicons -->
    <link href="http://localhost/college_mgmt_system/assets/images/logo/svg.jpg" rel="icon">
    <link href="http://localhost/college_mgmt_system/assets/images/logo/svg.jpg" rel="apple-touch-icon">
</head>
<body>
    <div class="main_chat">
    <div id="wrapper">
        <div id="left_pannel">
            <div id="user_info" style="padding: 10px;">
                <img id="profile_image" src="ui/icons/fenale_users.webp" alt="">
                <br>
                <span id="username">Username</span>
                <br>
                <span id="userEmail" style="font-size: 12px; opacity: 0.5;">email@gmail.com</span>
                <br>
                <br>
                <br>
                <div>
                    <label id="label_chat" for="radio_chats">Chats <img src="ui/icons/chat.png" alt=""></label>
                    <label id="label_contacts" for="radio_contacts">contacts <img src="ui/icons/contacts.png" alt=""></label>
                    <label id="label_setting" for="radio_settings">setting <img src="ui/icons/settings.png" alt=""></label>
                    <label id="logout" for="logout">Logout <img src="ui/icons/logout.png" alt=""></label>
                </div>
            </div>
        </div>
        <div id="right_pannel" style="text-align: center;">
            <div id="header">
                <div id="loader_holder" class="loader_off"><img src="ui/icons/giphy.gif" alt=""></div>
                Welcome to chat section
            </div>

            <div id="image_viewer" class="image_off" onclick="image_close(event)">

            </div>
            <div id="container" style="display: flex;">
                <div id="inner_left_pannel">
                    
                </div>

                <input type="radio" name="myradio" id="radio_chats" style="display: none;">
                <input type="radio" name="myradio" id="radio_contacts" style="display: none;">
                <input type="radio" name="myradio" id="radio_settings" style="display: none;">

                <div id="inner_right_pannel"></div>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript">
        var CURRENT_CHAT_USER = "";
        var SEEN_STATUS = false;
        // var sent_audio = new Audio("ui/sounds/message_sent.mp3");
        // var received_audio = new Audio("ui/sounds/message_received.mp3");
        function __(element) {
            return document.getElementById(element);
        }

        var label_chat = __("label_chat");
        label_chat.addEventListener("click", get_chats);

        var label_contacts = __("label_contacts");
        label_contacts.addEventListener("click", get_contacts);

        var label_setting = __("label_setting");
        label_setting.addEventListener("click", get_settings);

        var logout = __("logout");
        logout.addEventListener("click", logout_user);

        function get_data(find, type ) {
            var xml = new XMLHttpRequest();
            var loader_holder = __("loader_holder");
            loader_holder.className = "loader_on";
            xml.onload = function() {

                if( xml.readyState == 4 || xml.status == 200 ) {
                    loader_holder.className = "loader_off";
                    handle_result(xml.responseText, type);
                }

            }
            var data = {};
            data.find = find;
            data.data_type = type;
            var data = JSON.stringify(data);

            xml.open("POST", "api.php", true);
            xml.send(data);
        }

        function handle_result(result, type ) {
            // alert(result);
            if( result.trim() != "") {
                var inner_right_pannel = __("inner_right_pannel");
                inner_right_pannel.style.overflow = 'visible';
                try{
                    var obj = JSON.parse(result);
                    if( typeof(obj.logged_in) != "undefined" && !obj.logged_in) {
                        window.location = "login.php";
                    } else {
                        switch(obj.data_type) {
                            case "user_info":
                                var username = __("username");
                                var email = __("userEmail");
                                var profile_image = __("profile_image");

                                username.innerHTML = obj.username;
                                email.innerHTML = obj.email;
                                profile_image.src = obj.image;
                                break;

                            case "chat_refresh":
                                SEEN_STATUS = false;
                                var messages_holder = __("messages_holder");
                                messages_holder.innerHTML = obj.messages;
                                if( typeof obj.new_message != 'undefined' ) {
                                    if( obj.new_message ) {
                                        // received_audio.play();
                                        messages_holder.scrollTo(0, messages_holder.scrollHeight);
                                        
                                    }
                                }
                                break;

                            case "send_message":
                                // sent_audio.play();

                            case "chats":
                                SEEN_STATUS = false;
                                var inner_left_pannel = __("inner_left_pannel");
                                var inner_right_pannel = __("inner_right_pannel");
                                
                                inner_left_pannel.innerHTML = obj.user;
                                inner_right_pannel.innerHTML = obj.messages;
                                var messages_holder = __("messages_holder");

                                // received_audio.play();
                                messages_holder.scrollTo(0, messages_holder.scrollHeight);
                                var message_text = __('message_text');
                                message_text.focus();
                                if( typeof obj.new_message != 'undefined' ) {
                                    if( obj.new_message ) {
                                        // received_audio.play();
                                    }
                                }
                                break;

                            case "contacts":
                                
                                var inner_left_pannel = __("inner_left_pannel");
                                
                                inner_right_pannel.style.overflow = 'hidden';

                                inner_left_pannel.innerHTML = obj.message;
                                break;

                            case "settings":
                                var inner_left_pannel = __("inner_left_pannel");

                                inner_right_pannel.style.overflow = 'hidden';
                                inner_left_pannel.innerHTML = obj.message;
                            break;

                            case "save_setting":
                                alert(obj.message);
                                get_data({}, "user_info");
                                get_settings(true);
                                break;

                            case "send_image":
                                alert(obj.message);
                            break;
                        }
                    }
                }catch(e) {
                    console.error("Invalid JSON response: ", result);
                }
            }
        }

        function logout_user() {
            var answer = confirm("Are you sure want to logout??");
            if( answer ) {
                get_data({}, "logout");
            }
        }

        get_data({}, "user_info");
        get_data({}, "contacts");
        var radio_contacts = __("radio_contacts");
        radio_contacts.checked = true;

        function get_chats(e) {
            get_data({}, "chats");
        }

        function get_contacts(e) {
            get_data({}, "contacts");
        }

        function get_settings(e) {
            get_data({}, "settings");
        }

        function send_message(e) {
            var message_text = __('message_text');

            if( message_text.value.trim() == "" ) {
                alert("Please enter something to send.");
                return;
            }
            // alert(message_text.value.trim())
            get_data({
                message : message_text.value.trim(),
                userid : CURRENT_CHAT_USER
            }, "send_message");
        }

        function enter_pressed(e) {
            if( e.keyCode == 13 ) {
                send_message(e);
            }
            SEEN_STATUS = true;
        }

        setInterval(function() {
            var radio_chats = __("radio_chats");
            var radio_contacts = __("radio_contacts");
            if( CURRENT_CHAT_USER != "" && radio_chats.checked) {
                get_data({
                    userid:CURRENT_CHAT_USER,
                    seen: SEEN_STATUS
                }, "chat_refresh");
            }

            if( radio_contacts.checked) {
                get_data({}, "contacts");
            }
        }, 3000);

        function set_seen(e) {
            SEEN_STATUS = true;
        }

        function message_delete(e) {
            if( confirm("Are you sure want to delete?" ) ) {
                var msgid = e.target.getAttribute('msgid');
                get_data({
                    rowid:msgid,
                }, "delete_message");
                get_data({
                    userid:CURRENT_CHAT_USER,
                    seen: SEEN_STATUS
                }, "chat_refresh");
            }
        }

        function delete_thread(e) {
            if( confirm("Are you sure want to delete whole?" ) ) {
                get_data({
                    userid:CURRENT_CHAT_USER,
                }, "delete_thread");
                get_data({
                    userid:CURRENT_CHAT_USER,
                    seen: SEEN_STATUS
                }, "chat_refresh");
            }
        }

    </script>

<script type="text/javascript">


    
    function collectData(e) {
        e.preventDefault();
        var save_settings_button = __("save_settings_button");
            save_settings_button.disabled = true;
            save_settings_button.value = "Loading...Please Wait...";

            var signupForm = __("signupForm");
            var inputs = signupForm.getElementsByTagName("INPUT");
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

            send_data(datas, "save_setting");


        }

        function send_data(data, type) {
            var xml = new XMLHttpRequest();
            xml.onload = function () {
                if (xml.status == 200 || xml.readyState == 4) {
                    handle_result(xml.responseText);
                    var save_settings_button = __("save_settings_button");
                    save_settings_button.disabled = false;
                    save_settings_button.value = "Save Setting";
                }

            }
            data.data_type = type;
            var dataString = JSON.stringify(data);

            xml.open("POST", "api.php", true);
            xml.send(dataString);
        }

        function upload_profile_image(files) {
            var filename = files[0].name;
            var ext_start = filename.lastIndexOf(".");
            var ext = filename.substr(ext_start + 1, 3 );
            if( ! (ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG") ) {
                alert("This file type not allowed. Image must be jpg or png");
                return;
            }

            var change_image_input = __("change_image_input");

            change_image_input.disabled = false;
            change_image_input.innerHTML = "Uploading Image...";

            var myForm = new FormData();

            var xml = new XMLHttpRequest();
            xml.onload = function () {
                if (xml.status == 200 || xml.readyState == 4) {
                    get_data({}, "user_info");
                    get_settings(true);
                    change_image_input.disabled = true;
                    change_image_input.innerHTML = "Change Image";
                }

            }
            myForm.append('file', files[0]);
            myForm.append('data_type', "change_profile_image");

            xml.open("POST", "uploader.php", true);
            xml.send(myForm);
        }

        function handle_drag_and_drop(e) {
            if( e.type == 'dragover' ) {
                e.preventDefault();
                e.target.className = "dragging";
            } else if(e.type == 'dragleave'){
                e.target.className = "";
            } 
            else if( e.type == 'drop' ) {
                e.preventDefault();
                e.target.className = "";
                upload_profile_image(e.dataTransfer.files)
            }
            else {
                e.target.className = "";
            }
        }

        function start_chat(e) {
            var userid = e.target.getAttribute('userid');
            if( e.target.id = "" ) {
                userid = e.target.parentNode.getAttribute('userid');
            }
            CURRENT_CHAT_USER = userid;
            var radio_chats = __("radio_chats");
            radio_chats.checked = true;
            get_data({userid:CURRENT_CHAT_USER}, "chats");
        }

        function send_image(files) {

            var filename = files[0].name;
            var ext_start = filename.lastIndexOf(".");
            var ext = filename.substr(ext_start + 1, 3 );
            if( ! (ext == "jpg" || ext == "JPG" || ext == "png" || ext == "PNG") ) {
                alert("This file type not allowed. Image must be jpg or png");
                return;
            }
            var myForm = new FormData();

            var xml = new XMLHttpRequest();
            xml.onload = function () {
                if (xml.status == 200 || xml.readyState == 4) {
                    handle_result(xml.responseText, "send_image");
                    get_data({
                        userid:CURRENT_CHAT_USER,
                        seen: SEEN_STATUS
                    }, "chat_refresh");
                }

            }
            myForm.append('file', files[0]);
            myForm.append('data_type', "send_image");
            myForm.append('userid', CURRENT_CHAT_USER);

            xml.open("POST", "uploader.php", true);
            xml.send(myForm);
        }

        function image_close(e) {
            e.target.className = "image_off";
        }

        function image_open(e) {
            var image = e.target.src;
            var image_viewer = __("image_viewer");
            image_viewer.innerHTML = "<img src='" +image+" ' style='width: 100%;' />";
            image_viewer.className = "image_on";
        }
    </script>
</body>
</html>
