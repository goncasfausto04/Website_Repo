<?php
session_start();

include 'db_connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password_input = $_POST['password'];

    $sql = "SELECT * FROM accounts WHERE password = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Statement preparation failed: " . $conn->error);
    }

    $stmt->bind_param("s", $password_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['user'];
        header("Location: homepage.php");
        exit();
    } else {
        header("Location: index.html?error=invalid");
        exit();
    }
}
?>