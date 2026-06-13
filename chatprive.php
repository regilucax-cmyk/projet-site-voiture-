<?php

include("connexion.php");

// user connecte
$sender_id = 1;

// annonce
$car_id = 1;

// vendeur
$receiver_id = 2;

// envoyer message
if(isset($_POST['envoyer'])){

    $content = $_POST['content'];

    $sql = "INSERT INTO messages
    (car_id,sender_id,receiver_id,content)
    VALUES
    ('$car_id','$sender_id','$receiver_id','$content')";

    mysqli_query($conn,$sql);
}

// recuperer messages
$sql = "SELECT * FROM messages";
$result = mysqli_query($id,$sql);

?>

<?php

// afficher messages
while($message = mysqli_fetch_assoc($result)){

    echo $message['content']."<br>";
}

?>

<form method="POST">

    <!-- message -->
    <input type="text" name="content">

    <button name="envoyer">
        Envoyer
    </button>

</form>