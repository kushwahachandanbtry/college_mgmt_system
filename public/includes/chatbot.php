
    <style>
        #message-icon {
            position: fixed;
            background-color: #0054A6;
            /* box-shadow: 0 0 8px 3px red; */
            border-radius: 10px;
            padding: 10px;
            bottom: 20px;
            left: 20px;
            cursor: pointer;
            display: none;
            z-index: 999;
        }
        #message-icon i {
            color: #fff;
            font-size: 20px;
        }
        #message-icon span {
            color: #fff;
            padding-left: 10px;
            text-transform: uppercase;
        }
        #chatbox {
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 300px;
            z-index: 999;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
        }
        #chat-header {
            background: #007BFF;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        #chat-header #close-chat {
            float: right;
            cursor: pointer;
        }
        #chat-messages {
            padding: 10px;
            height: 300px;
            overflow-y: auto;
            flex-grow: 1;
            border-top: 1px solid #ccc;
        }
        #chat-input {
            flex-grow: 1;
            border: none;
            padding: 10px;
        }
        #send-button {
            background: #007BFF;
            color: #fff;
            border: none;
            padding: 10px;
        }
        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
            max-width: 100%;
        }
        .message.right {
            background-color: #007BFF;
            color: #fff;
            align-self: flex-end;
        }
        .message.left {
            background-color: #f1f1f1;
            color: #000;
            align-self: flex-start;
        }
    </style>

    <div id="message-icon">
        <i class="fas fa-comment"></i><span>Chat With Us</span>
    </div>

    <div id="chatbox">
        <div id="chat-header">
            Chat with us
            <span id="close-chat">&times;</span>
        </div>
        <div id="chat-messages"></div>
        <div style="display: flex; border-top: 1px solid #ccc;">
            <input type="text" id="chat-input" placeholder="Type your message here...">
            <button id="send-button">Send</button>
        </div>
    </div>

    <script>
        let chatStep = 0;
let chatHistory = [];
let courses = [];

document.getElementById('message-icon').addEventListener('click', showChat);
document.getElementById('close-chat').addEventListener('click', hideChat);
document.getElementById('send-button').addEventListener('click', sendMessage);
document.getElementById('chat-input').addEventListener('keypress', (e) => {
    if (e.key === 'Enter') sendMessage();
});

// Fetch courses dynamically
fetch('public/includes/get_courses.php')
    .then(res => res.json())
    .then(data => {
        courses = data;
    })
    .catch(err => {
        console.error('Error fetching courses:', err);
        courses = []; // Fallback to an empty array in case of an error
    });

setTimeout(() => {
    document.getElementById('message-icon').style.display = 'block';
    setTimeout(showChat, 2000);
}, 1000);

function showChat() {
    document.getElementById('chatbox').style.display = 'flex';
    document.getElementById('message-icon').style.display = 'none';
    if (chatStep === 0) startChat();
}

function hideChat() {
    document.getElementById('chatbox').style.display = 'none';
    document.getElementById('message-icon').style.display = 'block';
}

function startChat() {
    addMessage('left', 'Welcome to our college! what course are you looking for?');
    courses.forEach(course => {
        addMessage('left', `<button style="border:none;" onclick="selectCourse('${course}')">${course}</button>`, true);
    });
    chatStep = 1;
}

function selectCourse(course) {
    addMessage('right', course);
    chatHistory.push({ question: 'Which course?', answer: course });
    askForName();
}

function askForName() {
    addMessage('left', 'What is your name?');
    chatStep = 2;
}

function sendMessage() {
    const input = document.getElementById('chat-input');
    const message = input.value.trim();
    if (!message) return;

    addMessage('right', message);
    input.value = '';

    if (chatStep === 2) {
        chatHistory.push({ question: 'What is your name?', answer: message });
        askForPhone();
    } else if (chatStep === 3) {
        if (!/^[0-9]{10}$/.test(message)) {
            addMessage('left', 'Please provide a valid 10-digit phone number without any country code.');
        } else {
            chatHistory.push({ question: 'What is your phone number?', answer: message });
            askForEmail();
        }
    } else if (chatStep === 4) {
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(message)) {
            addMessage('left', 'Please provide a valid email address.');
        } else {
            chatHistory.push({ question: 'What is your email address?', answer: message });
            endChat();
        }
    }
}

function askForPhone() {
    addMessage('left', 'What is your phone number?');
    chatStep = 3;
}

function askForEmail() {
    addMessage('left', 'What is your email address?');
    chatStep = 4;
}

function endChat() {
    fetch('public/includes/save_chat.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ chatHistory })
    }).then(res => res.json()).then(data => {
        if (data.success) {
            addMessage('left', 'Thank you! We will contact you very soon...');
        } else {
            addMessage('left', 'An error occurred. Please refresh the page and try again later.');
        }
    });
    chatStep = 0;
}

function addMessage(side, text, isHtml = false) {
    const messagesDiv = document.getElementById('chat-messages');
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${side}`;
    messageDiv.innerHTML = isHtml ? text : document.createTextNode(text).data;
    messagesDiv.appendChild(messageDiv);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

    </script>

