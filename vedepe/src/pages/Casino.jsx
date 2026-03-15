import { useEffect, useState } from "react";
import "../styles/casino.css";

const symbols = ["🍒", "🍋", "🍉", "🍇", "⭐", "7️⃣"];

function getRandomCard() {
  return Math.floor(Math.random() * 10) + 2;
}

function getRandomSymbol() {
  return symbols[Math.floor(Math.random() * symbols.length)];
}

function Casino() {
  const [playerHand, setPlayerHand] = useState([]);
  const [dealerHand, setDealerHand] = useState([]);
  const [playerScore, setPlayerScore] = useState(0);
  const [dealerScore, setDealerScore] = useState(0);
  const [gameMessage, setGameMessage] = useState("");
  const [reels, setReels] = useState(["🍒", "🍒", "🍒"]);
  const [slotMessage, setSlotMessage] = useState("");
  const [spinning, setSpinning] = useState(false);

  const updateScores = (newPlayerHand, newDealerHand) => {
    const adjustedPlayer = [...newPlayerHand];
    let score = adjustedPlayer.reduce((acc, card) => acc + card, 0);
    while (score > 21 && adjustedPlayer.includes(11)) {
      adjustedPlayer[adjustedPlayer.indexOf(11)] = 1;
      score = adjustedPlayer.reduce((acc, card) => acc + card, 0);
    }

    setPlayerScore(score);
    setDealerScore(newDealerHand.reduce((acc, card) => acc + card, 0));
  };

  const resetGame = () => {
    const newPlayerHand = [getRandomCard(), getRandomCard()];
    const newDealerHand = [getRandomCard()];
    setPlayerHand(newPlayerHand);
    setDealerHand(newDealerHand);
    setGameMessage("");
    updateScores(newPlayerHand, newDealerHand);
  };

  useEffect(() => {
    resetGame();
  }, []);

  const checkGameOver = (currentPlayerScore, currentDealerScore) => {
    if (currentPlayerScore > 21) {
      setGameMessage("You bust! Dealer wins.");
      setTimeout(resetGame, 2000);
      return true;
    }

    if (currentDealerScore > 21) {
      setGameMessage("Dealer busts! You win!");
      setTimeout(resetGame, 2000);
      return true;
    }

    return false;
  };

  const handleHit = () => {
    const newPlayerHand = [...playerHand, getRandomCard()];
    setPlayerHand(newPlayerHand);
    const newPlayerScore = newPlayerHand.reduce((acc, card) => acc + card, 0);
    const newDealerScore = dealerHand.reduce((acc, card) => acc + card, 0);
    updateScores(newPlayerHand, dealerHand);
    checkGameOver(newPlayerScore, newDealerScore);
  };

  const handleStand = () => {
    let newDealerHand = [...dealerHand];
    let newDealerScore = newDealerHand.reduce((acc, card) => acc + card, 0);

    while (newDealerScore < 17) {
      newDealerHand = [...newDealerHand, getRandomCard()];
      newDealerScore = newDealerHand.reduce((acc, card) => acc + card, 0);
    }

    setDealerHand(newDealerHand);
    updateScores(playerHand, newDealerHand);

    if (!checkGameOver(playerScore, newDealerScore)) {
      if (playerScore > newDealerScore) {
        setGameMessage("You win!");
      } else if (playerScore < newDealerScore) {
        setGameMessage("Dealer wins!");
      } else {
        setGameMessage("It's a tie!");
      }
      setTimeout(resetGame, 2000);
    }
  };

  const spinReels = () => {
    if (spinning) {
      return;
    }

    setSpinning(true);
    setSlotMessage("");

    let spinCount = 20;
    const spinInterval = setInterval(() => {
      setReels([getRandomSymbol(), getRandomSymbol(), getRandomSymbol()]);
      spinCount -= 1;

      if (spinCount === 0) {
        clearInterval(spinInterval);
        const result = [
          getRandomSymbol(),
          getRandomSymbol(),
          getRandomSymbol(),
        ];
        setReels(result);
        if (result[0] === result[1] && result[1] === result[2]) {
          setSlotMessage("Jackpot! You win!");
        } else {
          setSlotMessage("Try again!");
        }
        setSpinning(false);
      }
    }, 100);
  };

  return (
    <div className="casino-page">
      <h1>Casino</h1>

      <div className="game-container">
        <div id="blackjack-game">
          <h2>Blackjack Game</h2>
          <div id="player-hand">
            <h3>Your Hand</h3>
            <div id="player-cards">{playerHand.join(", ")}</div>
            <p id="player-score">Score: {playerScore}</p>
          </div>
          <div id="dealer-hand">
            <h3>Dealer's Hand</h3>
            <div id="dealer-cards">{dealerHand.join(", ")}</div>
            <p id="dealer-score">Score: {dealerScore}</p>
          </div>
          <button type="button" id="hit-button" onClick={handleHit}>
            Hit
          </button>
          <button type="button" id="stand-button" onClick={handleStand}>
            Stand
          </button>
          <p id="game-message">{gameMessage}</p>
        </div>

        <div id="slot-machine">
          <h2>Slot Machine</h2>
          <div id="slot-reels">
            <div className="reel" id="reel1">
              {reels[0]}
            </div>
            <div className="reel" id="reel2">
              {reels[1]}
            </div>
            <div className="reel" id="reel3">
              {reels[2]}
            </div>
          </div>
          <button type="button" id="spin-button" onClick={spinReels}>
            Spin
          </button>
          <p id="slot-message">{slotMessage}</p>
        </div>
      </div>
    </div>
  );
}

export default Casino;
