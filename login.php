<?php
session_start(); // Start a session

include 'db_connection.php';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password_input = $_POST['password'];

    // Query to check if password exists along with username
    $sql = "SELECT * FROM accounts WHERE password = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Statement preparation failed: " . $conn->error);
    }

    $stmt->bind_param("s", $password_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Valid login, set session
        $user = $result->fetch_assoc(); // Fetch the user data
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['user']; // Store the 'user' column in session
        header("Location: homepage.php"); // Redirect to homepage
        exit();
    } else {
        // Invalid login, redirect back
        header("Location: index.html?error=invalid");
        exit();
    }
}
?>
