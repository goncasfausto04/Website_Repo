<?php
include "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MemeOrgy</title>
    <link rel="stylesheet" href="template.css"> <!-- Link to your CSS file -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Additional styles for the active link */
        .active-icon {
            color: red; /* Set the icon color to red */
        }

        @import url(https://fonts.googleapis.com/css?family=Anaheim);


        .container {
    margin: 4% auto;
    width: 210px; /* Adjust width to fit your design */
    height: 140px; /* Adjust height to fit your design */
    position: relative;
    perspective: 1000px;
}

#carousel {
    width: 100%;
    height: 100%;
    position: absolute;
    transform-style: preserve-3d;
    animation: rotation 20s infinite linear;
}

#carousel:active {
    animation-play-state: paused;
}

#carousel figure {
    display: block;
    position: absolute;
    width: 186px;
    height: 116px;
    left: 10px;
    top: 10px;
    overflow: hidden;
    border: solid 5px black;
}

#carousel figure:nth-child(1) { transform: rotateY(0deg) translateZ(288px); }
#carousel figure:nth-child(2) { transform: rotateY(40deg) translateZ(288px); }
#carousel figure:nth-child(3) { transform: rotateY(80deg) translateZ(288px); }
#carousel figure:nth-child(4) { transform: rotateY(120deg) translateZ(288px); }
#carousel figure:nth-child(5) { transform: rotateY(160deg) translateZ(288px); }
#carousel figure:nth-child(6) { transform: rotateY(200deg) translateZ(288px); }
#carousel figure:nth-child(7) { transform: rotateY(240deg) translateZ(288px); }
#carousel figure:nth-child(8) { transform: rotateY(280deg) translateZ(288px); }
#carousel figure:nth-child(9) { transform: rotateY(320deg) translateZ(288px); }

img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures the image fills the container without distortion */
    cursor: pointer;
    transition: all .5s ease;
}

img:hover {
    transform: scale(1.2, 1.2);
}

@keyframes rotation {
    from {
        transform: rotateY(0deg);
    }
    to {
        transform: rotateY(360deg);
    }
}


/* Style for the logout button */
.logout-btn {
    display: block;
    margin: 20px auto;
    padding: 10px 20px;
    background-color: #ff4b4b;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.logout-btn:hover {
    background-color: #ff1f1f;
}


        /* Style for the logout button */
        .logout-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #ff4b4b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #ff1f1f;
        }


/* Import the Allison font from Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Allison&display=swap');

.rainbow-text {
    font-family: 'Allison', cursive; /* Funky font */
    background: linear-gradient(90deg, red, orange, yellow, lime, cyan);
    -webkit-background-clip: text;
    color: transparent;
    font-weight: bold;
}


    </style>
</head>

<body>
    <header>
        <nav>
            <ul class="left">
                <li>
                    <a href="homepage.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'homepage.php') ? 'active' : ''; ?>">
                        <i class="fas fa-home <?= (basename($_SERVER['PHP_SELF']) == 'homepage.php') ? 'active-icon' : ''; ?>"></i>
                    </a>
                </li>
            </ul>
            <ul class="right">
                <li><a href="fumblemeter.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'fumblemeter.php') ? 'active' : ''; ?>">FumbleMeter</a></li>
                <li><a href="casino.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'casino.php') ? 'active' : ''; ?>">Casino</a></li>
                <li><a href="aboutus.php" id="about-us-link" class="<?= (basename($_SERVER['PHP_SELF']) == 'aboutus.php') ? 'active' : ''; ?>">About Us</a></li>
            </ul>
        </nav>
    </header>

    <main>
    <h1>Bem-Vindo ao <span class="rainbow-text">Meme</span> <span class="rainbow-text">Orgy</span>, <?= htmlspecialchars($username); ?>!</h1>
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
            <p>&copy; 2023 Meme Orgy. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }

        
    </script>
</body>

</html>
