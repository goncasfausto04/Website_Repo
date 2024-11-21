<?php
$servername = "sql108.infinityfree.com"; // DB server name
$username = "if0_37474718"; // DB username
$password = "DEro0dVpnqik3"; // DB password
$dbname = "if0_37474718_fumblemeterdb"; // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>