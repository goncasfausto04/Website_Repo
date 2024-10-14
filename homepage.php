<?php
include "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MemeOrgy</title>
    <link rel="stylesheet" href="template.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="homepage.css">
</head>

<body>
    <header>
        <nav>
            <ul class="left">
                <li>
                    <a href="homepage.php"
                        class="<?= (basename($_SERVER['PHP_SELF']) == 'homepage.php') ? 'active' : ''; ?>">
                        <i
                            class="fas fa-home <?= (basename($_SERVER['PHP_SELF']) == 'homepage.php') ? 'active-icon' : ''; ?>"></i>
                    </a>
                </li>
            </ul>
            <ul class="right">
                <li><a href="fumblemeter.php"
                        class="<?= (basename($_SERVER['PHP_SELF']) == 'fumblemeter.php') ? 'active' : ''; ?>">FumbleMeter</a>
                </li>
                <li><a href="casino.php"
                        class="<?= (basename($_SERVER['PHP_SELF']) == 'casino.php') ? 'active' : ''; ?>">Casino</a></li>
                <li><a href="aboutus.php" id="about-us-link"
                        class="<?= (basename($_SERVER['PHP_SELF']) == 'aboutus.php') ? 'active' : ''; ?>">About Us</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Bem-Vindo ao <span class="rainbow-text">Meme</span> <span class="rainbow-text">Orgy</span>,
            <?= htmlspecialchars($username); ?>!
        </h1>
    </main>

    <div class="container">
        <div id="carousel">
            <figure><img src="images/faustino.jpg" alt=""></figure>
            <figure><img src="images/correia.jpg" alt=""></figure>
            <figure><img src="images/tomas.jpg" alt=""></figure>
            <figure><img src="images/jesus.jpg" alt=""></figure>
            <figure><img src="images/renato.jpg" alt=""></figure>
            <figure><img src="images/mario.jpg" alt=""></figure>
            <figure><img src="images/silva.jpg" alt=""></figure>
            <figure><img src="images/govi.jpg" alt=""></figure>
            <figure><img src="images/salmoes.jpg" alt=""></figure>
        </div>
    </div>

    <form action="logout.php" method="post" onsubmit="return confirmLogout()">
        <button type="submit" class="logout-btn">Logout</button>
    </form>

    <footer>
        <div class="footer-content">
            <h>Meme Orgy</h>
            <p>&copy; 2023 Meme Orgy. All rights reserved.</p>
        </div>
    </footer>

    <div class="chatbox-container">
        <div class="chatbox-header">
            <h4>Chat</h4>
            <button class="close-chat">X</button>
        </div>
        <div class="chatbox-messages">
            <p class="message">Welcome to the chat!</p>
            <!-- Additional messages will appear here -->
        </div>
        <div class="chatbox-input">
            <input type="text" placeholder="Type your message...">
            <button class="send-btn">Send</button>
        </div>
    </div>
    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }

        document.querySelector(".send-btn").addEventListener("click", function () {
            const messageInput = document.querySelector(".chatbox-input input");
            const message = messageInput.value;

            if (message.trim() === "") {
                return; // Prevent sending empty messages
            }

            // Send the message using fetch
            fetch("send_message.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: new URLSearchParams({
                    message: message,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === "success") {
                        messageInput.value = ""; // Clear input after sending
                        loadMessages(); // Reload messages
                    } else {
                        console.error(data.message);
                    }
                })
                .catch((error) => {
                    console.error("Error sending message:", error);
                });
        });

        function loadMessages() {
            fetch("get_messages.php")
                .then((response) => response.json())
                .then((messages) => {
                    const messagesContainer = document.querySelector(".chatbox-messages");
                    messagesContainer.innerHTML = ""; // Clear existing messages

                    // Reverse the order to show the newest message at the bottom
                    messages.reverse().forEach((msg) => {
                        const messageElement = document.createElement("p");
                        messageElement.className = "message";
                        messageElement.innerHTML = `<strong>${msg.username}:</strong> ${msg.message}`;
                        messagesContainer.appendChild(messageElement); // Append new messages to the end
                    });

                    // Scroll to the bottom of the messages container
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                })
                .catch((error) => {
                    console.error("Error loading messages:", error);
                });
        }

        // Load messages when the page is ready
        document.addEventListener("DOMContentLoaded", loadMessages);

        // Optional: Load messages every 5 seconds
        setInterval(loadMessages, 1000);

    </script>
</body>

</html>