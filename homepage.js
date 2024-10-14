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
  