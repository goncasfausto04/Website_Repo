<?php
include "session.php";
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="template.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Import the Allison font from Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Allison&display=swap">
    <style>
        .memeorgy-title {
            font-family: 'Allison', cursive;
            color: white;
            font-size: 200px;
            margin-bottom: 40px;
            text-align: center;
            transition: all 0.6s ease;
            background: linear-gradient(135deg, #f06, #f79c42);
            width: fit-content;
            margin: auto;
            padding: 50px;
            border-radius: 50%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transform: rotate(-5deg);
        }

        .memeorgy-title .meme {
            color: white;
            text-shadow: 2px 4px 6px rgba(0, 0, 0, 0.3);
        }

        .memeorgy-title .orgy {
            color: #A02727;
            text-shadow: 2px 4px 6px rgba(0, 0, 0, 0.3);
        }

        /* Hover effect */
        .memeorgy-title:hover {
            font-size: 220px;
            transform: rotate(0);
            background: linear-gradient(135deg, #f79c42, #f06);
        }

        /* Media query for smaller screens */
        @media (max-width: 768px) {
            .memeorgy-title {
                font-size: 100px;
                padding: 30px;
            }

            .memeorgy-title:hover {
                font-size: 110px;
                transform: rotate(0);
                background: linear-gradient(135deg, #f79c42, #f06);
            }
        }

        @media (max-width: 480px) {
            .memeorgy-title {
                font-size: 80px;
                padding: 20px;
            }

            .memeorgy-title:hover {
                font-size: 90px;
                transform: rotate(0);
                background: linear-gradient(135deg, #f79c42, #f06);
            }
        }
    </style>

</head>

<body>

   <?php
include 'header.php';
?>

    <h1>About Us</h1>
    <h2> "Sabem que os dinossauros so foram extintos pq deus percebeu que eles nao podiam pagar o dizimo" - Mário Vicol,
        2024 </h2>
    <h2>"Esse toque que me deste foi a defesa que eu não fiz" - Mário Vicol, 2024</h2>
    <h1 class="memeorgy-title"><span class="meme">Meme</span><span class="orgy">Orgy</span></h1>

    <footer>
        <div class="footer-content">
            <h>Meme Orgy</h>
            <p>&copy; 2023 Meme Orgy. All rights reserved.</p>
        </div>
    </footer>
</body>