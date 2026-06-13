<?php
include 'connexion.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM annonces WHERE id=?");
$stmt->execute([$id]);
$annonce = $stmt->fetch();
if(!$annonce){
    die("Annonce introuvable");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Détail annonce</title>
</head>
<body>

<h1><?= $annonce['titre'] ?></h1>
<img src="images/<?= $annonce['image'] ?>" width="300">
<h3>Prix : <?= $annonce['prix'] ?> €</h3>
<p><?= $annonce['description'] ?></p>
<p>Catégorie : <?= $annonce['categorie'] ?></p>
<a href="supprimer annonce.php?id=<?= $annonce['id'] ?>">
    Supprimer
</a>
<a href="chat.php?car_id=<?php echo $car['id']; ?>">
    Contacter le vendeur
</a>
</body>
</html>