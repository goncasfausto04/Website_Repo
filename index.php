<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MemeOrgy</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Allison&family=Fredoka&display=swap"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
</head>

<body>
  <div class="background"></div>
  <div class="content">
    <h1 class="memeorgy-title">
      <span class="meme">Meme</span><span class="orgy">Orgy</span>
    </h1>
    <button class="entrar-button" id="blur-button">
      Entrar <i class="fas fa-arrow-right"></i>
    </button>

    <div class="rectangle" id="rectangle">
      <div class="question-wrapper">
        <div class="question-container">
          <p>Qual é a passe chavalo?</p>
        </div>
      </div>
      <form action="login.php" method="POST">
        <input type="password" class="userinput" name="password" required />
      </form>
    </div>
  </div>

  <script>
    const button = document.getElementById("blur-button");
    const rectangle = document.getElementById("rectangle");

    button.addEventListener("click", function() {
      document.querySelector(".background").classList.add("blurred");
      document.querySelector(".memeorgy-title").classList.add("shrinked");
      button.disabled = true;
      button.style.display = "none";
      rectangle.style.display = "block";
    });
  </script>
</body>

</html>