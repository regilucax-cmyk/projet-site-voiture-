<?php
session_start();
include("connexion.php");

// si pas connecté
if (!isset($_SESSION['user_id'])) {
    die("Tu dois être connecté pour accéder au chat");
}

$user_id = $_SESSION['user_id'];

// test simple (tu peux remplacer après)
$receiver_id = 2;
$car_id = 1;

// envoyer message
if (isset($_POST['envoyer'])) {

    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $sql = "INSERT INTO messages (car_id, sender_id, receiver_id, content)
            VALUES ('$car_id', '$user_id', '$receiver_id', '$content')";

    mysqli_query($conn, $sql);
}

// récupérer messages (IMPORTANT: filtré)
$sql = "SELECT * FROM messages
        WHERE car_id = $car_id
        ORDER BY sent_at ASC";

$result = mysqli_query($conn, $sql);

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
            margin-bottom:10px;
        }

        .message {
            padding:5px;
            border-bottom:1px solid #eee;
        }

        form { display:flex; }

        input { flex:1; padding:8px; }

        button {
            padding:8px;
            background:black;
            color:white;
            border:none;
        }
    </style>
</head>

<body>

<div class="chat-box">

    <h3>Chat</h3>

    <div class="messages">

        <?php
        if ($result && mysqli_num_rows($result) > 0) {

            while ($m = mysqli_fetch_assoc($result)) {

                echo "<div class='message'>"
                    . htmlspecialchars($m['content']) .
                "</div>";
            }

        } else {
            echo "Aucun message";
        }
        ?>

    </div>

    <form method="POST">
        <input type="text" name="content" placeholder="Écrire..." required>
        <button name="envoyer">Envoyer</button>
    </form>

</div>

</body>
</html>