<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("connexion.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$sender_id = $_SESSION['user_id'];
$car_id = isset($_GET['car_id']) ? intval($_GET['car_id']) : 1;

// récupérer vendeur (exemple simple)
$receiver_id = 2;

// envoyer message
if (isset($_POST['envoyer'])) {

    $content = trim($_POST['content']);

    if (!empty($content)) {

        $sql = "INSERT INTO messages (car_id, sender_id, receiver_id, content)
                VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iiis", $car_id, $sender_id, $receiver_id, $content);
        mysqli_stmt_execute($stmt);
    }
}

// messages filtrés
$sql = "SELECT * FROM messages
        WHERE car_id = ?
        ORDER BY id ASC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $car_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chat</title>

    <style>
        body { font-family: Arial; background:#f5f5f5; padding:20px; }
        .chat-box { width:400px; margin:auto; }
        .messages {
            background:white;
            padding:10px;
            height:300px;
            overflow-y:auto;
            border:1px solid #ccc;
        }
        .message {
            margin:5px 0;
            padding:6px;
            background:#eee;
            border-radius:5px;
        }
        form { display:flex; margin-top:10px; }
        input { flex:1; padding:8px; }
        button {
            padding:8px 12px;
            background:black;
            color:white;
            border:none;
        }
    </style>
</head>

<body>

<div class="chat-box">

    <div class="messages">

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="message">
                <?= htmlspecialchars($row['content']) ?>
            </div>
        <?php } ?>

    </div>

    <form method="POST">
        <input type="text" name="content" placeholder="Écrire un message..." required>
        <button name="envoyer">Envoyer</button>
    </form>

</div>

</body>
</html>