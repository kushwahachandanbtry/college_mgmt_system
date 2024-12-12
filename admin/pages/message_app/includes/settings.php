<?php

$query = "SELECT * FROM users WHERE userid = :userid LIMIT 1";
$id = $_SESSION['userid'];
$data = $DB->read($query, ['userid' => $id ] );

$settings_datas = "";

if( is_array( $data ) ) {
    $data = $data[0];

    //check if image exits
    $image = ($data->gender == "Male") ? "ui/icons/male.png" : "ui/icons/female_users.webp";
    if( file_exists( $data-> image ) ) {
        $image = $data->image;
    }
    $settings_datas = '

    <style>
    .signup{
        color: gray;
        margin: auto;
        padding: 10px;
        width: 100%;
        max-width: 400px;
    }

    .signup input[type="text"], input[type="password"], input[type="submit"]{
        padding: 10px;
        margin: 10px;
        width: 200px;
        border-radius: 5px;
        border: solid 1px gray;
    }
    .signup input[type="submit"]{
        width: 220px;
        cursor: pointer;
        background-color:blue;
        color: #fff;
    }
    .signup input[type="radio"], label{
        transform: scale(1.2s);
        cursor: pointer;
    }
    .dragging{
        border: dashed 1px #aaa;
    }
    select {
        width: 55%; 
    }


    </style>
            <div style="display: flex; text-align:center;">
            <div>
            <span style="font-size: 11px; color: #fff;">Drag and drop an image to change.</span>
            <img ondragover="handle_drag_and_drop(event)" ondrop="handle_drag_and_drop(event)" ondragleave="handle_drag_and_drop(event)" src="'.$image.'" alt="user img" style="height: 200px; width: 200px; margin: 10px;" />
            <label for="change_image_input" id="change_image_button" style="background-color: green; cursor: pointer; display: inline-block; padding: 10px; font-size: 15px; border-radius: 10px;">Change Image
            </label>
            <input type="file"  value="" onchange="upload_profile_image(this.files)" id="change_image_input" hidden >
            </div>
            <form id="signupForm" class="signup" style="text-align: left;" action="">
                <div id="error"></div>
                <input type="text" value="'.$data->username.'" name="username" placeholder="Username">
                <input type="text" value="'.$data->email.'" name="email" placeholder="Email">
                <div style="padding: 10px; ">
                    Gender: <br>
                    <input type="radio" '.($data->gender == "Male" ? "checked" : "").' name="gender" id="male" value="Male"><label for="male">Male</label><br>
                    <input type="radio" '.($data->gender == "Female" ? "checked" : "").' name="gender" id="female" value="Female"><label for="female">Female</label><br>
                </div>
                <input type="password" value="'.$data->password.'" name="password" placeholder="Password"><br>
                <input type="password" value="'.$data->password.'" name="confirm_password" placeholder="Confirm password"><br>
                <select name="role" id="">
                    <option disabled >Select Role</option>
                    <option '.($data->role == "teacher" ? "selected" : "").' value="teacher">Teachers</option>
                    <option '.($data->role == "student" ? "selected" : "").' value="student">Students</option>
                    <option '.($data->role == "parent" ? "selected" : "").' value="parent">Parents</option>
                </select>
                <input type="submit" id="save_settings_button" onclick="collectData(event)" value="Save Settings"><br>
                
            </form>
            </div>
    ';


    // $result = $result[0];
    $info->message = $settings_datas;
    $info->data_type = "settings";
    echo json_encode($info);
} else {
    $info->message = "No data were found.";
    $info->data_type = "error";
    echo json_encode($info);

}
        

?>


