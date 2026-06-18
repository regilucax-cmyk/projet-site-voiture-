<?php
// Étape 1 : on démarre la session pour savoir si quelqu'un est connecté
session_start();

// Étape 2 : connexion à la base de données
$conn = mysqli_connect("localhost", "root", "root", "sitevoiture");


$sql = "SELECT a.*, c.name AS categorie_name
        FROM annonces a
        LEFT JOIN categories c ON a.categorie = c.id
        ORDER BY a.created_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car HUB</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #222;
        }

        .container {
            max-width: 1080px;
            margin: 0 auto;
            padding: 20px;
        }

        
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
        }

        .brand {
            font-size: 24px;
            font-weight: bold;
            color : red;
            border : 1px solid #cfd8e3;
            border-radius: 8px;
            background: #f8fafc;
            padding: 8px 12px;
        }

        .user-box {
            display: flex;
            gap: 10px;
            align-items: center;
            padding: 10px 16px;
            border: 1px solid #cfd8e3;
            border-radius: 10px;
            background: #ffffff;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .user-box:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
            border-color: #a3b8d3;
        }

        .user-box span {
            font-weight: 600;
            color: #1e3a5f;
            white-space: nowrap;
        }

        .user-box a {
            text-decoration: none;
            color: #334155;
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background: #f8fafc;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .user-box a:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

       
        .nav-links {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .nav-links a {
            color: #333;
            text-decoration: none;
            font-size: 14px;
            padding: 10px 14px; 
            border: 1px solid #ccc;
            border-radius: 3px;
            background: #fff;
        }

        .nav-links a:hover {
            background: #eee;
        }

        
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 18px;
        }

        .card {
            background: #fff;
            border: 1px solid #ccc;
            display: flex;
            flex-direction: column;
        }

        .card-image {
            height: 180px;
            background: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-body {
            padding: 16px;
        }

        .card-body h2 {
            margin: 0 0 8px;
            font-size: 18px;
        }

        .price {
            color: green;
            font-weight: bold;
            margin: 0 0 8px;
        }

        .meta {
            color: #555;
            font-size: 14px;
            margin: 0 0 10px;
        }

        .card-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .card-actions a {
            text-decoration: none;
            padding: 8px 12px;
            color: #fff;
            background: #333;
            border-radius: 3px;
            font-size: 14px;
        }

        .card-actions a:hover {
            background: #555;
        }
        .user-name {
            color: #1e3a5f;
            font-size: 14px;
            margin-right: 10px;
            padding: 8px 12px;
            border: 1px solid #cfd8e3;
            border-radius: 8px;
            background: #f8fafc;
            display: inline-flex;
            align-items: center;
        }
        .user-name strong {
            color: #334155;
            margin-left: 4px;
        }
    </style>
</head>
<body>

<div class="container">

     
    <div class="topbar">

        <div class="brand">LE CAR HUB</div>

        <div class="user-box">

            <?php if (isset($_SESSION['username'])) { ?>

                <div class="user-name">Est connecté en tant que <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></div>
                <a href="chatprive.php">Messages</a>
                <a href="deconnexion.php">Déconnexion</a>

            <?php } else { ?>

                <a href="connexion.php">Connexion</a>
                <a href="inscription.php">Inscription</a>

            <?php } ?>

        </div>

    </div>

    
    <div class="nav-links">

        <a href="liste annonce.php">Accueil</a>
        <a href="categorie.php">Catégories</a>
        <a href="favoris.php">Favoris</a>
        <a href="filtrage.php">Filtrer</a>

        <?php if (isset($_SESSION['user_id'])) { ?>
            <a href="creer annonce.php">Déposer une annonce</a>
        <?php } else { ?>
            <a href="connexion.php">Déposer une annonce</a>
        <?php } ?>

    </div>

    <!-- Affichage de toutes les annonces -->
    <div class="cards">

        <?php while ($annonce = mysqli_fetch_assoc($result)) { ?>

            <div class="card">

                <div class="card-image">
                    <?php if (!empty($annonce['image'])) { ?>
                        <img src="images/<?php echo htmlspecialchars($annonce['image']); ?>">
                    <?php } else { ?>
                        <span>Pas de photo</span>
                    <?php } ?>
                </div>

                <div class="card-body">

                    <h2><?php echo htmlspecialchars($annonce['titre']); ?></h2>

                    <p class="price"><?php echo $annonce['prix']; ?> €</p>

                    <?php
                        
                        $nom_categorie = $annonce['categorie_name'];
                        if (!$nom_categorie) {
                            $nom_categorie = "Non classée";
                        }
                    ?>
                    <p class="meta">Catégorie : <?php echo htmlspecialchars($nom_categorie); ?></p>

                    <p><?php echo htmlspecialchars($annonce['description']); ?></p>

                    <div class="card-actions">

                        <a href="detail annonce.php?id=<?php echo $annonce['annonce_id']; ?>">Voir</a>

                        <?php
                            
                            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $annonce['idUtilisateur']) {
                        ?>
                            <a href="modifier annonce.php?id=<?php echo $annonce['annonce_id']; ?>">Modifier</a>
                            <a href="supprimer annonce.php?id=<?php echo $annonce['annonce_id']; ?>">Supprimer</a>
                        <?php } ?>

                    </div>

                </div>

            </div>

        <?php } ?>

    </div>

</div>

</body>
</html>