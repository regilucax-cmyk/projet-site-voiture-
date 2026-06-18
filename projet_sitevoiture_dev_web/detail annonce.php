<?php

    session_start();
    $conn = mysqli_connect("localhost", "root", "root", "sitevoiture");
    $id = $_GET['id'];

    $sql = "SELECT * FROM annonces WHERE annonce_id='$id'";
    $data = mysqli_query($conn, $sql);
    $annonce = mysqli_fetch_assoc($data);
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Détail annonce</title>
</head>
<body>

<h1><?= $annonce['titre'] ?></h1>
<img src="images/<?= $annonce['image'] ?>" width="300">
<h3>Prix : <?= $annonce['prix'] ?> €</h3>
<p><?= $annonce['description'] ?></p>
<p>Catégorie : <?= $annonce['categorie'] ?></p>
<a href="supprimer annonce.php?id=<?= $annonce['annonce_id'] ?>">
    Supprimer
</a>
<br>
<a href="chat.php?car_id=<?php echo $annonce['annonce_id']; ?>">
    Contacter le vendeur
</a>
</body>
</html>