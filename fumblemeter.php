<?php

include 'session.php';
include 'db_connection.php';

$sql = "SELECT name, fumbles, goals_stolen, good_plays FROM counters";
$result = $conn->query($sql);

$users = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['stat'])) {
    $name = $_POST["name"];
    $stat = $_POST["stat"];

    $stmt = $conn->prepare("UPDATE counters SET $stat = $stat + 1 WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->close();

    header("Location: fumblemeter.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_person'])) {
    $new_name = $_POST['new_person'];

    $stmt = $conn->prepare("INSERT INTO counters (name, fumbles, goals_stolen, good_plays) VALUES (?, 0, 0, 0)");
    $stmt->bind_param("s", $new_name);
    $stmt->execute();
    $stmt->close();

    header("Location: fumblemeter.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_name'])) {
    $remove_name = $_POST['remove_name'];

    // Using prepared statement to delete a person
    $stmt = $conn->prepare("DELETE FROM counters WHERE name = ?");
    $stmt->bind_param("s", $remove_name);
    $stmt->execute();
    $stmt->close();

    header("Location: fumblemeter.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fumblemeter</title>
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>


<body>

<?php
include 'header.php';
?>


    <h1>Fumblemeter</h1>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Fumbles</th>
                    <th>Goals Stolen</th>
                    <th>Good Plays</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['fumbles']); ?></td>
                        <td><?php echo htmlspecialchars($user['goals_stolen']); ?></td>
                        <td><?php echo htmlspecialchars($user['good_plays']); ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="name" value="<?php echo htmlspecialchars($user['name']); ?>">
                                <input type="hidden" name="stat" value="fumbles">
                                <button type="submit">Fumble</button>
                            </form>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="name" value="<?php echo htmlspecialchars($user['name']); ?>">
                                <input type="hidden" name="stat" value="goals_stolen">
                                <button type="submit">Goal Stolen</button>
                            </form>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="name" value="<?php echo htmlspecialchars($user['name']); ?>">
                                <input type="hidden" name="stat" value="good_plays">
                                <button type="submit">Good Play</button>
                            </form>
                            <form method="post" style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to remove this person?');">
                                <input type="hidden" name="remove_name"
                                    value="<?php echo htmlspecialchars($user['name']); ?>">
                                <button type="submit" id="removebtn">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="AddPersonForm">
        <h2>Add a New Person</h2>
        <form method="post">
            <label for="new_person" style="color: white;">Enter Name: </label>
            <input type="text" name="new_person" id="new_person" required>
            <button type="submit">Add Person</button>
        </form>
    </div>
</body>
<footer>
    <div class="footer-content">
        <h>Meme Orgy</h>
        <p>&copy; 2023 Meme Orgy. All rights reserved.</p>
    </div>
</footer>

</html>