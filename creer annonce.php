<?php
session_start();
include "connexion.php";
if(isset($_POST['publier'])){
    $titre = $_POST['titre'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    $categorie = $_POST['categorie'];
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "images/".$image);
    $sql = "INSERT INTO annonces(titre, prix, description, image, categorie)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $prix, $description, $image, $categorie]);
    echo "Annonce publiee avec succes";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Créer une annonce</title>
</head>
<body>
<h2>Nouvelle annonce</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="titre" placeholder="Titre" required><br><br>
    <input type="number" step="0.01" name="prix" placeholder="Prix" required><br><br>
    <textarea name="description" placeholder="Description"></textarea><br><br>
    <input type="text" name="categorie" placeholder="Catégorie"><br><br>
    <input type="file" name="image" required><br><br>
    <button type="submit" name="publier">Publier</button>
</form>
</body>
</html>