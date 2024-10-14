<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username']; // Get the username from the session
    $message = $_POST['message'];

    // Check if message is not empty
    if (empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'Message cannot be empty.']);
        exit;
    }

    // Prepare and execute the SQL statement to insert the new message
    $sql = "INSERT INTO chat_messages (username, message) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $message);

    if ($stmt->execute()) {
        // Check the total number of messages
        $countQuery = "SELECT COUNT(*) FROM chat_messages";
        $result = $conn->query($countQuery);
        $messageCount = $result->fetch_row()[0];

        // If there are more than 200 messages, delete the oldest ones
        if ($messageCount > 200) {
            $deleteQuery = "DELETE FROM chat_messages ORDER BY created_at ASC LIMIT ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param("i", ($messageCount - 200));
            $deleteStmt->execute();
            $deleteStmt->close();
        }

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
}
?>
