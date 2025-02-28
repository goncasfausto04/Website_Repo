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
        .game-container {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            margin-top: 20px;
        }

        #blackjack-game,
        #slot-machine {
            background-color: #1f1f1f;
            padding: 15px;
            border-radius: 10px;
            color: white;
            text-align: center;
            width: 250px;
            /* Set fixed width */
            margin: 0 10px;
            /* Reduce margin for compactness */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        #player-hand,
        #dealer-hand,
        #slot-reels {
            margin: 5px 0;
            /* Reduced margin */
        }

        button {
            margin: 5px;
            padding: 8px;
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

        /* Slots displayed horizontally */
        #slot-reels {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .reel {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            font-size: 2em;
            border: 2px solid #fff;
            margin: 0 5px;
            background-color: #333;
            color: white;
        }


        #slot-message {
            margin-top: 10px;
        }
    </style>
</head>

<body>
<?php
include 'header.php';
?>


    <h1>Casino</h1>

    <div class="game-container">
        <!-- Blackjack Game -->
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

        <!-- Slot Machine Game -->
        <div id="slot-machine">
            <h2>Slot Machine</h2>
            <div id="slot-reels">
                <div class="reel" id="reel1">🍒</div>
                <div class="reel" id="reel2">🍒</div>
                <div class="reel" id="reel3">🍒</div>
            </div>
            <button id="spin-button">Spin</button>
            <p id="slot-message"></p>
        </div>
    </div>

    <?php
include 'footer.php';
?>
    <script src="casino.js"></script>
</body>

</html>