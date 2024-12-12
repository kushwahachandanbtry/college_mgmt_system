<div id="chat-container">
    <div id="notch">
        <span id="time-display"></span>
    </div>
    <?php

    // Start the session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $sender = "";
    if (isset($_SESSION['email'])) {
        $sender = trim($_SESSION['email']);
    } elseif (isset($_SESSION['admin'])) {
        $sender = trim($_SESSION['admin']);
    }
    include "config.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql2 = "SELECT id, name, email, image FROM users WHERE id = '{$id}'";

        $result2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result2) > 0) {
            while ($row2 = mysqli_fetch_assoc($result2)) {
                ?>
                <input type="text" id="sendEmail" name="email" value="<?php echo $sender ?> " hidden>
                <input type="text" id="userEmail" name="useremail" value="<?php echo $row2['email']; ?> " hidden>
                <a style="background-color: #c8cbce; padding-bottom: 18px; box-shadow: 0 0 2px 2px gray;" href=""
                    class="d-flex pt-3">
                    <div class="px-3">
                        <img style="width: 60px; height: 60px; border-radius: 50%;"
                            src="../assets/images/users/<?php echo $row2['image']; ?>" alt="">
                    </div>
                    <div class="mt-4">
                        <h6><?php echo $row2['name']; ?></h6>
                    </div>
                </a>

                <div id="messagesReceived">
                    <?php
                    $fetch_msg = "SELECT * FROM message WHERE email  = '{$row2['email']}' || user_email  = '{$row2['email']}' ";
                    $msg_result = mysqli_query($conn, $fetch_msg);

                    if (mysqli_num_rows($msg_result) > 0) {
                        while ($msg_row = mysqli_fetch_assoc($msg_result)) {
                            $_SESSION['message'] = "+";
                            if ($sender === trim($msg_row['email'])) {
                                ?>
                                <div class="d-flex">
                                    <div class="message sent">
                                        <?php echo htmlspecialchars($msg_row['message']); ?>
                                    </div>
                                    <p class="message-time"><?php echo $msg_row['time']; ?></p>
                                    
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="d-flex">
                                    <div class="message received">
                                        <?php echo htmlspecialchars($msg_row['message']); ?>
                                    </div>
                                    <p class="message-time"><?php echo $msg_row['time']; ?></p>
                                </div>
                                <?php
                            }
                        }
                    } else {
                        echo "<p>No messages yet.</p>";
                    }
                    ?>
                </div>


                <?php
            }
        }
    }
    ?>



    <!-- Input field for sending messages -->
    <div id="message-input-container">
        <input type="text" id="message-input" placeholder="Type a message..." />
        <button id="send-button">Send</button>
    </div>
</div>

<script>
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const currentTime = `${hours}:${minutes}:${seconds}`;

        document.getElementById("time-display").textContent = currentTime;
    }

    // Update the time every second
    setInterval(updateTime, 1000);
    updateTime();

    function sendMessage() {
        const messageInput = document.getElementById('message-input');
        const messageText = messageInput.value.trim();
        const email = document.getElementById('sendEmail').value;
        const userEmail = document.getElementById('userEmail').value;
        const time = new Date().toLocaleTimeString(); // Get current time

        if (messageText) {
            // AJAX request to save the message
            fetch('actions/save_message.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    message: messageText,
                    email: email,
                    time: time,
                    userEmail : userEmail
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        // Create a container for the new message and time
                        const newMessageContainer = document.createElement('div');
                        newMessageContainer.classList.add('d-flex');

                        // Message content
                        const newMessage = document.createElement('div');
                        newMessage.classList.add('message', 'sent');
                        newMessage.textContent = messageText;

                        // Time content
                        const timeDisplay = document.createElement('p');
                        timeDisplay.classList.add('message-time');
                        timeDisplay.textContent = time;

                        // Append message and time to the container
                        newMessageContainer.appendChild(newMessage);
                        newMessageContainer.appendChild(timeDisplay);

                        document.getElementById('messagesReceived').appendChild(newMessageContainer);

                        // Clear the input field
                        messageInput.value = '';
                    } else {
                        console.error("Error saving message:", data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        }
    }

    // Send message on button click or Enter key press
    document.getElementById('send-button').addEventListener('click', sendMessage);
    document.getElementById('message-input').addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent the default action
            sendMessage(); // Call send message function
        }
    });

</script>




<style>
    #chat-container {
        width: 100%;
        max-width: 400px;
        margin: auto;
        height: 80vh;
        display: flex;
        flex-direction: column;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        background-color: white;
        position: relative;
        border: 1px solid #ddd;
    }

    #notch {
        width: 100%;
        height: 25px;
        background-color: #e0e0e0;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #555;
        font-size: 12px;
        font-weight: bold;
    }

    #messagesReceived {
        flex: 1;
        padding: 10px;
        background-color: #e9ecef;
        overflow-y: auto;
    }

    .message {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 15px;
        max-width: 100%;
        line-height: 1.4;
        word-wrap: break-word;
        overflow-wrap: break-word;
        font-size: 14px;
        font-family: cursive;
    }


    .sent {
        background-color: #007bff;
        margin-left: 80px;
        color: white;
        align-self: flex-end;
        width: 60%;
    }

    .received {
        background-color: #e0e0e0;
        color: black;
        align-self: flex-start;
    }

    .message-time{
        font-size: 9px;
        padding-top: 10px;
        padding-left: 10px;
    }

    #message-input-container {
        display: flex;
        padding: 10px;
        border-top: 1px solid #ccc;
        background-color: #ffffff;
    }

    #message-input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 20px;
        outline: none;
    }

    #send-button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 0 15px;
        margin-left: 10px;
        border-radius: 20px;
        cursor: pointer;
    }

    #send-button:hover {
        background-color: #0056b3;
    }
</style>
