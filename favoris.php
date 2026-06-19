<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "sitevoiture");

if (!isset($_SESSION['user_id'])) {
    header("location: connexion.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Gestion des actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $car_id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($action == 'ajouter' && $car_id) {
        $check = "SELECT * FROM favorites WHERE user_id='$user_id' AND car_id='$car_id'";
        if (mysqli_num_rows(mysqli_query($conn, $check)) == 0) {
            mysqli_query($conn, "INSERT INTO favorites (user_id, car_id) VALUES ('$user_id', '$car_id')");
        }
        header("location: detail annonce.php?id=$car_id");
        exit;
    } elseif ($action == 'retirer' && $car_id) {
        mysqli_query($conn, "DELETE FROM favorites WHERE user_id='$user_id' AND car_id='$car_id'");
        header("location: favoris.php");
        exit;
    }
}

// Récupérer les favoris
$sql = "SELECT a.*, c.name AS categorie_name
        FROM annonces a
        LEFT JOIN categories c ON a.categorie = c.id
        LEFT JOIN favorites f ON a.annonce_id = f.car_id
        WHERE f.user_id = '$user_id'
        ORDER BY a.created_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Favoris</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .container { max-width: 1080px; margin: 0 auto; padding: 20px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; padding: 16px 0; }
        .brand { font-size: 24px; font-weight: bold; color: red; border: 1px solid #cfd8e3; border-radius: 8px; background: #f8fafc; padding: 8px 12px; }
        .user-box { display: flex; gap: 10px; align-items: center; padding: 10px 16px; border: 1px solid #cfd8e3; border-radius: 10px; background: #fff; }
        .user-box a { text-decoration: none; color: #334155; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc; cursor: pointer; }
        .user-box a:hover { background: #e2e8f0; }
        .nav-links { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 20px; }
        .nav-links a { color: #333; text-decoration: none; font-size: 14px; padding: 10px 14px; border: 1px solid #ccc; border-radius: 3px; background: #fff; cursor: pointer; }
        .nav-links a:hover { background: #eee; }
        .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 18px; }
        .card { background: #fff; border: 1px solid #ccc; }
        .card-image { height: 180px; background: #eee; display: flex; justify-content: center; align-items: center; overflow: hidden; }
        .card-image img { width: 100%; height: 100%; object-fit: cover; }
        .card-body { padding: 16px; }
        .card-body h2 { margin: 0 0 8px; font-size: 18px; }
        .price { color: green; font-weight: bold; margin: 0 0 8px; }
        .meta { color: #555; font-size: 14px; margin: 0 0 10px; }
        .card-actions { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 10px; }
        .card-actions a { text-decoration: none; padding: 8px 12px; color: #fff; background: #333; border-radius: 3px; font-size: 14px; cursor: pointer; }
        .card-actions a:hover { background: #555; }
        .card-actions a.remove { background: #dc3545; }
        .card-actions a.remove:hover { background: #c82333; }
        .user-name { color: #1e3a5f; font-size: 14px; padding: 8px 12px; border: 1px solid #cfd8e3; border-radius: 8px; background: #f8fafc; }
        .page-title { margin: 20px 0; font-size: 28px; }
        .no-favorites { text-align: center; padding: 40px 20px; }
        .no-favorites a { color: #333; text-decoration: none; padding: 10px 14px; border: 1px solid #ccc; border-radius: 3px; background: #fff; display: inline-block; margin-top: 10px; cursor: pointer; }
        .no-favorites a:hover { background: #eee; }
    </style>
</head>
<body>

<div class="container">
    <div class="topbar">
        <div class="brand">LE CAR HUB</div>
        <div class="user-box">
            <?php if (isset($_SESSION['username'])) { ?>
                <div class="user-name">Connecté : <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></div>
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

    <h1 class="page-title">Mes Favoris</h1>

    <?php if (mysqli_num_rows($result) > 0) { ?>
    <div class="cards">
        <?php while ($annonce = mysqli_fetch_assoc($result)) { ?>
        <div class="card">
            <div class="card-image">
                <?php if (!empty($annonce['image'])) { ?>
                    <img src="images/<?php echo htmlspecialchars($annonce['image']); ?>" alt="Annonce">
                <?php } else { ?>
                    <span>Pas de photo</span>
                <?php } ?>
            </div>
            <div class="card-body">
                <h2><?php echo htmlspecialchars($annonce['titre']); ?></h2>
                <p class="price"><?php echo $annonce['prix']; ?> €</p>
                <p class="meta">Catégorie : <?php echo htmlspecialchars($annonce['categorie_name'] ?? 'Non classée'); ?></p>
                <p><?php echo htmlspecialchars($annonce['description']); ?></p>
                <div class="card-actions">
                    <a href="detail annonce.php?id=<?php echo $annonce['annonce_id']; ?>">Voir</a>
                    <a href="favoris.php?action=retirer&id=<?php echo $annonce['annonce_id']; ?>" class="remove">Retirer</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } else { ?>
    <div class="no-favorites">
        <p>Vous n'avez pas encore d'annonces en favoris.</p>
        <a href="liste annonce.php">Voir les annonces</a>
    </div>
    <?php } ?>
</div>

</body>
</html>
