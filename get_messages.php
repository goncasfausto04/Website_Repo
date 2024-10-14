<?php
session_start();
include 'db_connection.php';

$sql = "SELECT username, message, created_at FROM chat_messages ORDER BY created_at DESC LIMIT 50"; // Adjust the limit as needed
$result = $conn->query($sql);

$messages = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

echo json_encode($messages);
?>
