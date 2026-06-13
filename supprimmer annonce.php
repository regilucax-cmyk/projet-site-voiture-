<?php
include 'connexion.php';
$id = $_GET['id'];
if(isset($_POST['oui'])){
    $stmt = $pdo->prepare("DELETE FROM annonces WHERE id=?");
    $stmt->execute([$id]);
    header("Location: categorie.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Suppression annonce</title>
</head>
<body>
<h2>Voulez-vous vraiment supprimer cette annonce ?</h2>
<form method="POST">
    <button type="submit" name="oui">Oui</button>
    <a href="categorie.php">Non</a>
</form>
</body>
</html>