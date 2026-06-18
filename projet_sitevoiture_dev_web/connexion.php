<?php
session_start();
$id = mysqli_connect("localhost", "root", "root", "sitevoiture");
if (isset($_POST['connexion'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $requete = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $resultat = mysqli_query($id, $requete);
    if (mysqli_num_rows($resultat) > 0) {
        $user = mysqli_fetch_assoc($resultat);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['username'] = $user['username'];
        header("location: liste annonce.php");
        exit;
    } else {
        trigger_error("Erreur de connexion : " . $erreur);
        $erreur = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            color: #222;
        }
        .page {
            max-width: 380px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
        }
        h3 {
            margin-top: 0;
            font-size: 22px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        input {
            padding: 10px;
            border: 1px solid #bbb;
            border-radius: 3px;
            font-size: 14px;
        }
        button {
            padding: 10px;
            border: none;
            background: #333;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background: #555;
        }
        .error {
            color: #a00;
        }
        .note {
            font-size: 14px;
        }
        a {
            color: #333;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="page">
    <h3>Connexion</h3>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit" name="connexion">Se connecter</button>
    </form>
    <?php if (isset($erreur)) { echo '<p class="error">' . htmlspecialchars($erreur) . '</p>'; } ?>
    <p class="note">Vous n'avez pas de compte ? <a href="inscription.php">Inscription</a></p>
</div>
</body>
</html>
