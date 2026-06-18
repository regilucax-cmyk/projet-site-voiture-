<?php

include("connexion.php");

// Vérification connexion
if (!$conn) {
    die("Erreur connexion base de données");
}

// user connecte
$sender_id = 1;

// annonce
$car_id = 1;

// vendeur
$receiver_id = 2;

// envoyer message
if (isset($_POST['envoyer'])) {

    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $sql = "INSERT INTO messages (car_id, sender_id, receiver_id, content)
            VALUES ('$car_id', '$sender_id', '$receiver_id', '$content')";

    mysqli_query($conn, $sql);
}

// recuperer messages
$sql = "SELECT * FROM messages";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chat</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            padding: 20px;
        }

        .chat-box {
            width: 400px;
            margin: auto;
        }

        .messages {
            background: white;
            padding: 10px;
            height: 300px;
            overflow-y: auto;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        .message {
            margin: 5px 0;
            padding: 5px;
            border-bottom: 1px solid #eee;
        }

        form {
            display: flex;
        }

        input[type="text"] {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
        }

        button {
            padding: 8px 12px;
            border: none;
            background: black;
            color: white;
            cursor: pointer;
        }
    </style>

</head>
<body>

<div class="chat-box">

    <div class="messages">

        <?php
        if ($result) {
            while ($message = mysqli_fetch_assoc($result)) {
                echo "<div class='message'>" . htmlspecialchars($message['content']) . "</div>";
            }
        }
        ?>

    </div>

    <form method="POST">
        <input type="text" name="content" placeholder="Écrire un message..." required>
        <button name="envoyer">Envoyer</button>
    </form>

</div>

</body>
</htm