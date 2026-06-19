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

    echo "Annonce modifiée";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier annonce</title>

   
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
            width: 350px;
            background: white;
            padding: 20px;
            border: 1px solid #ccc;
            margin-top: 50px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 8px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #333;
        }
    </style>

</head>
<body>

<div class="box">

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

</div>

</body>
</html>