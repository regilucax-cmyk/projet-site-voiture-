<?php

    // Connexion à la base de données
    $conn = mysqli_connect("localhost", "root", "root", "sitevoiture");
    session_start();

    // Vérification : l'utilisateur doit être connecté
    if (!isset($_SESSION['username'])) {
        header("Location: connexion.php");
        exit;
    }

    // Récupérer les catégories pour le menu déroulant
    $sql_categories   = "SELECT * FROM categories";
    $result_categories = mysqli_query($conn, $sql_categories);

    // Traitement du formulaire de publication
    if (isset($_POST)) {

        $titre       = $_POST['titre'];
        $prix        = $_POST['prix'];
        $description = $_POST['description'];
        $categorie   = $_POST['categorie'];
        $iduser    = $_SESSION['user_id'];   // on lie l'annonce à l'utilisateur connecté

        // Gestion de l'image
        $image     = $_FILES['image']['name'];
        $tmp       = $_FILES['image']['tmp_name'];
        $extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $extensions_autorisees = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($extension, $extensions_autorisees)) {

            $erreur = "Format non autorisé. Utilisez jpg, jpeg, png ou gif.";

        } else {

            move_uploaded_file($tmp, "images/" . $image);

            $sql = "INSERT INTO annonces (titre, prix, description, image, categorie, idUtilisateur)
                    VALUES ('$titre', '$prix', '$description', '$image', '$categorie', '$iduser')";

            mysqli_query($conn, $sql);

            header("Location: liste annonce.php");

        }
    }

?>
<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Créer une annonce</title>
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
                margin-top: 40px;
            }

            h2 { text-align: center; }

            input, textarea, select {
                width: 100%;
                padding: 8px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }

            button {
                width: 100%;
                padding: 8px;
                background: black;
                color: white;
                border: none;
                cursor: pointer;
            }

            button:hover { background: #333; }

            .erreur { color: red; }
        </style>
    </head>
    <body>

    <div class="box">

        <h2>Nouvelle annonce</h2>

        <?php if (isset($erreur)) echo "<p class='erreur'>$erreur</p>"; ?>

        <form method="POST" action="" enctype="multipart/form-data">

            <input type="text"   name="titre"       placeholder="Titre"        required>
            <input type="number" name="prix"         placeholder="Prix (€)" step="0.01" required>
            <textarea            name="description"  placeholder="Description" rows="4"></textarea>

            <!-- Catégories récupérées depuis la base de données -->
            <select name="categorie">
                <option value="">-- Choisir une catégorie --</option>
                <?php while ($cat = mysqli_fetch_assoc($result_categories)) { ?>
                    <option value="<?php echo $cat['id']; ?>">
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </option>
                <?php } ?>
            </select>

            <input type="file" name="image" accept="image/*" required>

            <button type="submit" name="publier">Publier</button>

        </form>

    </div>

    </body>
</html>