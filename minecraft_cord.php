<?php
include 'db_connection.php';

$sql = "SELECT * FROM minecraft_cords";
$result = $conn->query($sql);

$cords = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cords[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_estrutura'])) {
    $id = $_POST['remove_estrutura'];
    $sql = "DELETE FROM minecraft_cords WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: minecraft_cord.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_estrutura'])) {
    $estrutura = $_POST['new_estrutura'];
    $x = $_POST['new_x'];
    $y = $_POST['new_y'];
    $dimension = $_POST['new_dimension'];

    $sql = "INSERT INTO minecraft_cords (estrutura, x, y, dimension) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $estrutura, $x, $y, $dimension);
    $stmt->execute();
    $stmt->close();

    header("Location: minecraft_cord.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="minecraft.css">
    <link rel="stylesheet" href="template.css">
</head>

<body>
    <header>
        <nav>
            <ul class="left">
                <li><a href="homepage.php"><i class="fas fa-home"></i></a></li>
            </ul>
            <ul class="right">
                <li><a href="#" class="active" id="rocket-league-meter-link">FumbleMeter</a></li>
                <li><a href="casino.php" id="casino-link">Casino</a></li>
                <li><a href="minecraft.html" id="minecraft-link">Minecraft</a></li>
                <li><a href="aboutus.php" id="about-us-link">About Us</a></li>
            </ul>
        </nav>
    </header>
    <h1>Minecraft Cord</h1>
    <div class="container">
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Estrutura</th>
                        <th>X</th>
                        <th>Y</th>
                        <th>Dimension</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cords as $cord): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cord['estrutura']); ?></td>
                            <td><?php echo htmlspecialchars($cord['x']); ?></td>
                            <td><?php echo htmlspecialchars($cord['y']); ?></td>
                            <td><?php echo htmlspecialchars($cord['dimension']); ?></td>
                            <td>
                                <form method="post" style="display:inline;"
                                    onsubmit="return confirm('Are you sure you want to remove this cord?');">
                                    <input type="hidden" name="remove_estrutura"
                                        value="<?php echo htmlspecialchars($cord['id']); ?>">
                                    <button type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="addNewStructure">
            <h2>Add a New Structure</h2>
            <form method="post">
                <label for="new_estrutura">Estrutura: </label>
                <input type="text" name="new_estrutura" id="new_estrutura" required>
                <br>
                <label for="new_x">X: </label>
                <input type="text" name="new_x" id="new_x" required>
                <br>
                <label for="new_y">Y: </label>
                <input type="text" name="new_y" id="new_y" required>
                <br>
                <label for="new_dimension">Dimension: </label>
                <input type="text" name="new_dimension" id="new_dimension" required>
                <br>
                <button type="submit">Add Structure</button>
            </form>
        </div>
    </div>

</body>

</html>