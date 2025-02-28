<?php
include "session.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minecraft</title>
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="minecraft.css">
    <style>

#buttonsPlace {
    width: fit-content;
    height: auto; /* Ajusta a altura automaticamente ao conteúdo */
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute; /* Use 'absolute' para centralizar dentro do container */
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* Centraliza no meio da tela */
}


button {
    font-size: 18px;
    background-color: #008542;
    color: #fff;
    text-shadow: 0 2px 0 rgb(0 0 0 / 25%);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    position: relative;
    border: 0;
    z-index: 1;
    user-select: none;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 1px;
    white-space: unset;
    padding: 0.8rem 1.5rem;
    text-decoration: none;
    font-weight: 900;
    transition: all 0.7s cubic-bezier(0, 0.8, 0.26, 0.99);
    font-family: 'minecraft_font', sans-serif;
}

button:before {
    position: absolute;
    pointer-events: none;
    top: 0;
    left: 0;
    display: block;
    width: 100%;
    height: 100%;
    content: "";
    transition: 0.7s cubic-bezier(0, 0.8, 0.26, 0.99);
    z-index: -1;
    background-color: #008542 !important;
    box-shadow: 0 -4px rgb(21 108 0 / 50%) inset,
        0 4px rgb(100 253 31 / 99%) inset, -4px 0 rgb(100 253 31 / 50%) inset,
        4px 0 rgb(21 108 0 / 50%) inset;
}

button:after {
    position: absolute;
    pointer-events: none;
    top: 0;
    left: 0;
    display: block;
    width: 100%;
    height: 100%;
    content: "";
    box-shadow: 0 4px 0 0 rgb(0 0 0 / 15%);
    transition: 0.7s cubic-bezier(0, 0.8, 0.26, 0.99);
}

button:hover:before {
    box-shadow: 0 -4px rgb(0 0 0 / 50%) inset, 0 4px rgb(255 255 255 / 20%) inset,
        -4px 0 rgb(255 255 255 / 20%) inset, 4px 0 rgb(0 0 0 / 50%) inset;
}

button:hover:after {
    box-shadow: 0 4px 0 0 rgb(0 0 0 / 15%);
}

button:active {
    transform: translateY(4px);
}

button:active:after {
    box-shadow: 0 0px 0 0 rgb(0 0 0 / 15%);
}

.addNewStructure {
    padding: 15px;
    border: 1px solid #444;
    max-width: fit-content;
    margin: 20px auto;
    border-radius: 10px;
    background-color: #1f1f1f;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s, box-shadow 0.3s;
}

.addNewStructure:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
}

form {
    margin-top: 20px;
}

input[type="text"] {
    padding: 10px;
    font-size: 16px;
    width: 200px;
    margin-right: 10px;
    background-color: #333;
    color: #e0e0e0;
    border: 1px solid #444;
}
    </style>
</head>
<body>

<?php
include 'header.php';
?>



    <h1>Minecraft</h1>
    <div id="buttonsPlace">
        <div id="buttons">
            <button onclick="window.location.href = 'minecraft_cord'"> Cords
            </button>
            <button onclick="window.location.href = 'workinprogress'" style="margin-left: 20px;"> Tasks
            </button>
        </div>

    </div>
</body>
<?php
include 'footer.php';
?>

</html>