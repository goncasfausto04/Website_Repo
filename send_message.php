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

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO chat_messages (username, message) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $message);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
}
?>
