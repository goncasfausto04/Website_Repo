<?php
include "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MemeOrgy</title>
    <link rel="stylesheet" href="template.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="homepage.css">
</head>

<body>

    <?php
include 'header.php';
?>

    <main>
        <h1>Bem-Vindo ao <span class="rainbow-text">Meme</span> <span class="rainbow-text">Orgy</span>,
            <?= htmlspecialchars($username); ?>!
        </h1>
    </main>

    <div class="container">
        <div id="carousel">
            <figure><img src="images/faustino.jpg" alt=""></figure>
            <figure><img src="images/correia.jpg" alt=""></figure>
            <figure><img src="images/tomas.jpg" alt=""></figure>
            <figure><img src="images/jesus.jpg" alt=""></figure>
            <figure><img src="images/renato.jpg" alt=""></figure>
            <figure><img src="images/mario.jpg" alt=""></figure>
            <figure><img src="images/silva.jpg" alt=""></figure>
            <figure><img src="images/govi.jpg" alt=""></figure>
            <figure><img src="images/salmoes.jpg" alt=""></figure>
        </div>
    </div>

    <form action="logout.php" method="post" onsubmit="return confirmLogout()">
        <button type="submit" class="logout-btn">Logout</button>
    </form>

    <footer>
        <div class="footer-content">
            <h>Meme Orgy</h>
            <p>&copy; 2024 Meme Orgy. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }
    </script>
</body>

</html>