<?php
// aboutus.php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="index.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Additional styles for the active link */
        .active-icon {
            color: red; /* Set the icon color to red */
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul class="left">
                <li><a href="index.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
                    <i class="fas fa-home <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active-icon' : ''; ?>"></i>
                </a></li>
            </ul>
            <ul class="right">
                <li><a href="fumblemeter.php">Rocket League Meter</a></li>
                <li><a href="casino.php">Casino</a></li>
                <li><a href="aboutus.php" id="about-us-link">About Us</a></li>
            </ul>
        </nav>
    </header>

    <h1>Welcome</h1>

    <footer>
        <div class="footer-content">
            <h3>Meme Orgy</h3>
            <p>&copy; 2023 Meme Orgy. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
