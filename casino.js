// Blackjack game logic
let playerHand = [];
let dealerHand = [];
let playerScore = 0;
let dealerScore = 0;

function getRandomCard() {
  return Math.floor(Math.random() * 10) + 2;
}

function adjustForAces() {
  playerScore = playerHand.reduce((acc, card) => acc + card, 0);
  while (playerScore > 21 && playerHand.includes(11)) {
    playerHand[playerHand.indexOf(11)] = 1;
    playerScore = playerHand.reduce((acc, card) => acc + card, 0);
  }
}

function updateScores() {
  adjustForAces();
  dealerScore = dealerHand.reduce((acc, card) => acc + card, 0);
  document.getElementById("player-score").innerText = `Score: ${playerScore}`;
  document.getElementById("dealer-score").innerText = `Score: ${dealerScore}`;
}

function displayHands() {
  document.getElementById("player-cards").innerText = playerHand.join(", ");
  document.getElementById("dealer-cards").innerText = dealerHand.join(", ");
}

function checkGameOver() {
  if (playerScore > 21) {
    document.getElementById("game-message").innerText =
      "You bust! Dealer wins.";
    setTimeout(resetGame, 2000);
    return true;
  } else if (dealerScore > 21) {
    document.getElementById("game-message").innerText =
      "Dealer busts! You win!";
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
  document.getElementById("game-message").innerText = "";
  document.getElementById("player-cards").innerText = "";
  document.getElementById("dealer-cards").innerText = "";
  document.getElementById("player-score").innerText = "Score: 0";
  document.getElementById("dealer-score").innerText = "Score: 0";
  startNewGame();
}

function startNewGame() {
  playerHand.push(getRandomCard(), getRandomCard());
  dealerHand.push(getRandomCard());
  updateScores();
  displayHands();
}

document.getElementById("hit-button").addEventListener("click", () => {
  playerHand.push(getRandomCard());
  updateScores();
  displayHands();
  checkGameOver();
});

document.getElementById("stand-button").addEventListener("click", () => {
  while (dealerScore < 17) {
    dealerHand.push(getRandomCard());
    updateScores();
    displayHands();
  }
  if (!checkGameOver()) {
    if (playerScore > dealerScore) {
      document.getElementById("game-message").innerText = "You win!";
    } else if (playerScore < dealerScore) {
      document.getElementById("game-message").innerText = "Dealer wins!";
    } else {
      document.getElementById("game-message").innerText = "It's a tie!";
    }
    setTimeout(resetGame, 2000);
  }
});

startNewGame();
// Slot machine logic
const symbols = ["🍒", "🍋", "🍉", "🍇", "⭐", "7️⃣"];

function getRandomSymbol() {
  return symbols[Math.floor(Math.random() * symbols.length)];
}

function spinReels() {
  const reel1 = document.getElementById("reel1");
  const reel2 = document.getElementById("reel2");
  const reel3 = document.getElementById("reel3");
  const message = document.getElementById("slot-message");

  let spinCount = 20; // Number of spins before stopping
  let spinSpeed = 100; // Speed of each spin in milliseconds

  // Simulate the reels spinning
  const spinInterval = setInterval(() => {
    reel1.textContent = getRandomSymbol();
    reel2.textContent = getRandomSymbol();
    reel3.textContent = getRandomSymbol();
    spinCount--;

    if (spinCount === 0) {
      clearInterval(spinInterval);

      // Final spin result
      const result1 = getRandomSymbol();
      const result2 = getRandomSymbol();
      const result3 = getRandomSymbol();

      reel1.textContent = result1;
      reel2.textContent = result2;
      reel3.textContent = result3;

      // Check for jackpot
      if (result1 === result2 && result2 === result3) {
        message.textContent = "Jackpot! You win!";
      } else {
        message.textContent = "Try again!";
      }
    }
  }, spinSpeed);
}

document.getElementById("spin-button").addEventListener("click", spinReels);
