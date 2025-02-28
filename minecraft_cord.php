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
    $stmt->bind_param("ssss", $estrutura, $x, $y, $dimension);
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
    <title>Minecraft Coordinates</title>
    <link rel="stylesheet" href="template.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <style>
                .container {
  display: flex; /* Coloca os itens lado a lado */
  justify-content: space-around; /* Distribui o espaço de forma uniforme */
  flex-wrap: wrap; /* Permite que os itens quebrem linha em telas menores */
  margin: 20px 0;
}

.table-wrapper,
.addNewStructure {
  max-width: fit-content; /* Garante que os blocos tenham largura apenas suficiente para o conteúdo */
  border: 1px solid #444;
  border-radius: 10px;
  background-color: #1f1f1f;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
  padding: 20px;
  margin: 10px; /* Espaçamento entre os blocos */
  color: #e0e0e0;
  text-align: left; /* Alinha o conteúdo à esquerda */
}

.addNewStructure h2 {
  margin-top: 0;
  color: #e0e0e0;
}

.addNewStructure form label,
.addNewStructure form input,
.addNewStructure form button {
  display: block;
  margin: 10px 0;
  width: 100%;
}

.addNewStructure form input {
  padding: 10px;
  background-color: #333;
  color: #e0e0e0;
  border: 1px solid #444;
  border-radius: 5px;
  width: calc(100% - 22px); /* Controla a largura sem ultrapassar os limites do formulário */
  max-width: 250px; /* Define um limite máximo para a largura */
}


.addNewStructure form button {
  padding: 10px;
  background-color: #666666;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.addNewStructure form button:hover {
  background-color: #be3233;
}

                </style>
</head>

<body>

 <?php
include 'header.php';
?>


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
                <button type="submit" id="removebtn">Remove</button>
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
      <label for="new_x">X: </label>
      <input type="text" name="new_x" id="new_x" required>
      <label for="new_y">Y: </label>
      <input type="text" name="new_y" id="new_y" required>
      <label for="new_dimension">Dimension: </label>
      <input type="text" name="new_dimension" id="new_dimension" required>
      <button type="submit">Add Structure</button>
    </form>
  </div>
</div>

</body>
<?php
include 'footer.php';
?>

</html>