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
}
?>


<!DOCTYPE html>
<html lang="en">



<head>

    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>

    <h1>Minecraft Cord</h1>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Estrutura</th>
                    <th>X</th>
                    <th>Y</th>
                    <th>Dimension</th>
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
</body>

</html>