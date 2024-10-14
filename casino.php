<?php
include "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casino</title>
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <style>
        #blackjack-game {
            background-color: #1f1f1f;
            padding: 20px;
            border-radius: 10px;
            color: white;
            text-align: center;
            width: fit-content;
            padding: 40px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        #player-hand,
        #dealer-hand {
            margin: 10px 0;
        }

        button {
            margin: 5px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #be3233;
            color: white;
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }

        button:hover {
            background-color: #666666;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul class="left">
                <li><a href="homepage.php"><i class="fas fa-home"></i></a></li>
            </ul>
            <ul class="right">
                <li><a href="fumblemeter.php">FumbleMeter</a></li>
                <li><a href="casino.php" class="active">Casino</a></li>
                <li><a href="aboutus.php" id="about-us-link">About Us</a></li>
            </ul>
        </nav>
    </header>

    <h1>Casino</h1>
    <div id="blackjack-game">
        <h2>Blackjack Game</h2>
        <div id="player-hand">
            <h3>Your Hand</h3>
            <div id="player-cards"></div>
            <p id="player-score">Score: 0</p>
        </div>
        <div id="dealer-hand">
            <h3>Dealer's Hand</h3>
            <div id="dealer-cards"></div>
            <p id="dealer-score">Score: 0</p>
        </div>
        <button id="hit-button">Hit</button>
        <button id="stand-button">Stand</button>
        <p id="game-message"></p>
    </div>


    <footer>
        <div class="footer-content">
            <h>Meme Orgy</h>
            <p>&copy; 2023 Meme Orgy. All rights reserved.</p>
        </div>
    </footer>

    <script>
        let playerHand = [];
        let dealerHand = [];
        let playerScore = 0;
        let dealerScore = 0;

        function getRandomCard() {
            return Math.floor(Math.random() * 11) + 1;
        }

        function updateScores() {
            playerScore = playerHand.reduce((acc, card) => acc + card, 0);
            dealerScore = dealerHand.reduce((acc, card) => acc + card, 0);
            document.getElementById('player-score').innerText = `Score: ${playerScore}`;
            document.getElementById('dealer-score').innerText = `Score: ${dealerScore}`;
        }

        function displayHands() {
            document.getElementById('player-cards').innerText = playerHand.join(', ');
            document.getElementById('dealer-cards').innerText = dealerHand.join(', ');
        }

        function checkGameOver() {
            if (playerScore > 21) {
                document.getElementById('game-message').innerText = "You bust! Dealer wins.";
                setTimeout(resetGame, 2000);
                return true;
            } else if (dealerScore > 21) {
                document.getElementById('game-message').innerText = "Dealer busts! You win!";
                setTimeout(resetGame, 2000);
                return true;
            }
            return false;
        }

        function resetGame() {
            playerHand = [];
            dealerHand = [];
            playerScore = 0;
            dealerScore = 0;
            document.getElementById('game-message').innerText = "";
            document.getElementById('player-cards').innerText = "";
            document.getElementById('dealer-cards').innerText = "";
            document.getElementById('player-score').innerText = "Score: 0";
            document.getElementById('dealer-score').innerText = "Score: 0";
            startNewGame();
        }

        function startNewGame() {
            playerHand.push(getRandomCard(), getRandomCard());
            dealerHand.push(getRandomCard());
            updateScores();
            displayHands();
        }

        document.getElementById('hit-button').addEventListener('click', () => {
            playerHand.push(getRandomCard());
            updateScores();
            displayHands();
            checkGameOver();
        });

        document.getElementById('stand-button').addEventListener('click', () => {
            while (dealerScore < 17) {
                dealerHand.push(getRandomCard());
                updateScores();
                displayHands();
            }
            if (!checkGameOver()) {
                if (playerScore > dealerScore) {
                    document.getElementById('game-message').innerText = "You win!";
                } else if (playerScore < dealerScore) {
                    document.getElementById('game-message').innerText = "Dealer wins!";
                } else {
                    document.getElementById('game-message').innerText = "It's a tie!";
                }
                setTimeout(resetGame, 2000);
            }
        });

        startNewGame();
    </script>

</body>

</html>