<?php
session_start(); // Start session at the very beginning

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GroceryWale Chatbot</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("../grocery_website/Ad_img/background_popup.png");
            background-size: contain;
            /* Zoom effect hatane ke liye */
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
            overflow: hidden;
        }

        /* Background dim effect (Popup effect) */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }

        .chat-container {
            width: 90%;
            max-width: 700px;
            height: 450px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1;
            animation: fadeIn 0.5s ease-in-out;
            background-color: rgb(241, 245, 235);
        }

        h3 {
            background: rgb(12, 175, 75);
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            margin: 0;
        }

        .chat-box {
            flex: 1;
            height: 300px;
            overflow-y: auto;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            display: flex;
            flex-direction: column;
        }

        .bot-message,
        .user-message {
            padding: 8px;
            margin: 5px 0;
            border-radius: 5px;
            max-width: 75%;
            word-wrap: break-word;
        }

        .user-message {
            background-color: rgb(219, 230, 201);
            /* color: white; */
            align-self: flex-end;
            text-align: right;
        }

        .bot-message {
            background-color: rgb(219, 230, 201);
            align-self: flex-start;
            text-align: left;
        }

        .input-container {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        button {
            padding: 10px 15px;
            border: none;
            background-color: rgb(12, 175, 75);
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .close-btn {
            position: absolute;
            top: -20px;
            right: -55px;
            background: green;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.3s ease-in-out;
        }

        .close-btn:hover {
            background: red;
            transform: scale(1.1);
        }


        .home-btn {
            display: block;
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            background-color: rgb(12, 175, 75); 
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
        }

        .home-btn:hover {
            background-color:rgb(13, 140, 62);
        }


        button:hover {
            background-color: rgb(13, 140, 62);
        }

        /* Animation effect */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media (max-width: 500px) {
            .chat-container {
                height: 400px;
            }

            .chat-box {
                height: 250px;
            }
        }
    </style>
</head>

<body>

    <div class="chat-container">
        <!-- <button class="close-btn" onclick="closeChat()">✖</button> -->
        <h3>Chatbot</h3>
        <div class="chat-box" id="chat-box">
            <p class="bot-message"><strong>Bot:</strong> Hello! Welcome to GroceryWale</p>
            <p class="bot-message"><strong>Bot:</strong> How can I assist you?</p>
        </div>
        <div class="input-container">
            <input type="text" id="user-input" placeholder="Type a message..." required>
            <button id="send-btn">Send</button>
        </div>
        <a class="home-btn" href="../grocery_website/index.php">Back to Cart</a>
    </div>

    <script>
        $(document).ready(function() {
            $("#send-btn").click(function() {
                sendMessage();
            });

            // Trigger send button on Enter key press
            $("#user-input").keypress(function(event) {
                if (event.which === 13) { // 13 is the Enter key code
                    event.preventDefault(); // Prevents new line in input field
                    $("#send-btn").click(); // Triggers button click
                }
            });

            function sendMessage() {
                var userMessage = $("#user-input").val().trim();
                if (userMessage === "") return;

                var chatBox = $("#chat-box");

                // Display user message
                chatBox.append("<p class='user-message'><strong>You:</strong> " + userMessage + "</p>");
                $("#user-input").val("");

                // AJAX request to message.php
                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: {
                        text: userMessage
                    },
                    success: function(response) {
                        chatBox.append("<p class='bot-message'><strong>Bot:</strong> " + response + "</p>");
                        chatBox.scrollTop(chatBox[0].scrollHeight);
                    }
                });
            }
        });
    </script>

</body>

</html>