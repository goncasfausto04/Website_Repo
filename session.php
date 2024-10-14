<?php
// casino.php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Not logged in, redirect to the login page
    header("Location: index.html");
    exit();
}


// Retrieve the username from session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; // Fallback to 'User'
?>