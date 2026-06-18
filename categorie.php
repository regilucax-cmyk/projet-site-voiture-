<?php

    session_start();
    // ajouter categorie
    $id = mysqli_connect("localhost", "root", "root", "sitevoiture");
    if(isset($_POST['ajouter'])){

        $name = $_POST['name'];

        $sql = "INSERT INTO categories(name)
                VALUES('$name')";

        mysqli_query($id,$sql);
    }

    // recuperer categories
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($id,$sql);

?>

<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Categories</title>

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
                width: 350px;
                background: white;
                padding: 20px;
                border: 1px solid #ccc;
                margin-top: 40px;
            }

            h2 {
                text-align: center;
            }

            form {
                display: flex;
                gap: 5px;
                margin-bottom: 15px;
            }

            input[type="text"] {
                flex: 1;
                padding: 8px;
                border: 1px solid #ccc;
            }

            button {
                padding: 8px 12px;
                background: black;
                color: white;
                border: none;
                cursor: pointer;
            }

            button:hover {
                background: #333;
            }

            .cat {
                padding: 6px;
                border-bottom: 1px solid #eee;
            }
        </style>

    </head>
    <body>

    <div class="box">

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
            echo "<div class='cat'>".$cat['name']."</div>";
        }
        ?>

    </div>

    </body>
</html>