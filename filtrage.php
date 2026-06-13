<?php

include("connexion.php");

// requete de base
$sql = "SELECT * FROM cars WHERE 1=1";

// filtre marque
if(isset($_GET['brand']) && $_GET['brand'] != ""){
    $sql .= " AND brand='" . $_GET['brand'] . "'";
}

// filtre prix
if(isset($_GET['price']) && $_GET['price'] != ""){
    $sql .= " AND price<='" . $_GET['price'] . "'";
}

$result = mysqli_query($conn,$sql);

?>

<form method="GET">

    <!-- marque -->
    <input type="text" name="brand" placeholder="Marque">

    <!-- prix -->
    <input type="number" name="price" placeholder="Prix max">

    <button type="submit">Rechercher</button>

</form>

<hr>

<?php

// afficher les annonces
while($car = mysqli_fetch_assoc($result)){

    echo $car['title']."<br>";
    echo $car['price']." €<br>";
    echo "<hr>";
}
?>