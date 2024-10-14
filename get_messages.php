<?php
include 'db_connection.php';

// Fetch messages from the chat_messages table
$sql = "SELECT username, message FROM chat_messages ORDER BY timestamp ASC";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);
?>
