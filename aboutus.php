<?php
// aboutus.php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Not logged in, redirect to the login page
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="template.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <nav>
            <ul class="left">
                <li><a href="homepage.php"><i class="fas fa-home"></i></a></li>
            </ul>
            <ul class="right">
                <li><a href="fumblemeter.php">Rocket League Meter</a></li>
                <li><a href="casino.php">Casino</a></li>
                <li><a href="#" id="about-us-link" class="active">About Us</a></li>
            </ul>
        </nav>
    </header>

    <h1>About Us</h1>

    <footer>
        <div class="footer-content">
            <h>Meme Orgy</h>
            <p>&copy; 2023 Meme Orgy. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>