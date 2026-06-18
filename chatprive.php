<?php

include("connexion.php");

// annonce
$car_id = 1;

// envoyer message
if(isset($_POST['envoyer'])){

    $content = $_POST['content'];

    $sql = "INSERT INTO messages
    (car_id, content)
    VALUES
    ('$car_id', '$content')";

    mysqli_query($conn,$sql);
}

// recuperer messages
$sql = "SELECT * FROM messages ORDER BY created_at ASC";
$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chat</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f5f5f5;
            padding:20px;
        }

        .chat-box{
            width:400px;
            margin:auto;
        }

        .messages{
            background:white;
            padding:10px;
            height:300px;
            overflow-y:auto;
            border:1px solid #ccc;
            margin-bottom:10px;
        }

        .message{
            padding:8px;
            margin-bottom:5px;
            background:#eee;
            border-radius:5px;
        }

        form{
            display:flex;
        }

        input[type="text"]{
            flex:1;
            padding:8px;
        }

        button{
            padding:8px 15px;
            background:black;
            color:white;
            border:none;
        }
    </style>
</head>
<body>

<div class="chat-box">

    <div class="messages">
        <?php while($message = mysqli_fetch_assoc($result)){ ?>
            <div class="message">
                <?php echo htmlspecialchars($message['content']); ?>
            </div>
        <?php } ?>
    </div>

    <form method="POST">
        <input type="text" name="content" placeholder="Écrire un message..." required>
        <button type="submit" name="envoyer">Envoyer</button>
    </form>

</div>

</body>
</html>