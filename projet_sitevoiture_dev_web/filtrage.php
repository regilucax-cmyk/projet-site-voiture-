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

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recherche voitures</title>

    <!-- CSS simple étudiant -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .box {
            width: 400px;
            background: white;
            padding: 20px;
            border: 1px solid #ccc;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 15px;
        }

        input {
            padding: 8px;
            border: 1px solid #ccc;
        }

        button {
            padding: 8px;
            border: none;
            background: black;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #333;
        }

        .car {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .price {
            color: green;
            font-weight: bold;
        }
    </style>

</head>
<body>

<div class="box">

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

        echo "<div class='car'>";
        echo "<strong>".$car['title']."</strong><br>";
        echo "<span class='price'>".$car['price']." €</span>";
        echo "</div>";
    }

    ?>

</div>

</body>
</html>