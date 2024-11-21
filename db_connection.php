<?php
$servername = "localhost"; // DB server name
$username = "root"; // DB username
$password = ""; // DB password
$dbname = "fumblemeterdb"; // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>