<?php

include("connexion.php");

// id annonce
$id = $_GET['id'];

// recuperer annonce
$sql = "SELECT * FROM cars WHERE id=$id";
$result = mysqli_query($conn,$sql);

$car = mysqli_fetch_assoc($result);

// modifier annonce
if(isset($_POST['modifier'])){

    $title = $_POST['title'];

    $sql = "UPDATE cars
            SET title='$title'
            WHERE id=$id";

    mysqli_query($conn,$sql);

    echo "Annonce modifiee";
}

?>

<form method="POST">

    <!-- titre -->
    <input
    type="text"
    name="title"
    value="<?php echo $car['title']; ?>">

    <button name="modifier">
        Modifier
    </button>

</form>