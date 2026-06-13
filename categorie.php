<?php

include("connexion.php");

// ajouter categorie
if(isset($_POST['ajouter'])){

    $name = $_POST['name'];

    $sql = "INSERT INTO categories(name)
            VALUES('$name')";

    mysqli_query($conn,$sql);
}

// recuperer categories
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn,$sql);

?>

<h2>Categories</h2>

<form method="POST">

    <!-- nom categorie -->
    <input
    type="text"
    name="name"
    placeholder="Categorie">

    <button name="ajouter">
        Ajouter
    </button>

</form>

<hr>

<?php

// afficher categories
while($cat = mysqli_fetch_assoc($result)){

    echo $cat['name']."<br>";
}
?>