<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index");
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; // Fallback to 'User'

?>