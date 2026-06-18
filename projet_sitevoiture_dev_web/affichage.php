<?php
require 'config.php';

$sql = "SELECT * FROM cars WHERE status='active' ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des voitures</title>
</head>
<body>

<h1>Voitures disponibles</h1>

<?php while($car = mysqli_fetch_assoc($result)) { ?>

<div style="border:1px solid #ccc; padding:10px; margin:10px;">

    <h2><?php echo $car['title']; ?></h2>

    <p>Marque : <?php echo $car['brand']; ?></p>

    <p>Modèle : <?php echo $car['model']; ?></p>

    <p>Année : <?php echo $car['year']; ?></p>

    <p>Kilométrage : <?php echo $car['kilometers']; ?> km</p>

    <p>Prix : <?php echo $car['price']; ?> €</p>

    <a href="detail.php?id=<?php echo $car['id']; ?>">
        Voir détails
    </a>

</div>

<?php } ?>

</body>
</html>