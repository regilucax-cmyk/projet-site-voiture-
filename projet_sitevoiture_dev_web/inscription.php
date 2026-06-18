<?php
$id = mysqli_connect("localhost", "root", "root", "sitevoiture");
if (isset($_POST['inscrire'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $age = $_POST['age'];
    $requete = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $resultat = mysqli_query($id, $requete);
    if (mysqli_num_rows($resultat) > 0) {
        $erreur = "Email ou pseudo deja utilise.";
    } else if ($age < 18) {
        $erreur2 = "Vous devez etre majeur pour vous inscrire.";
    } else {
        $requete = "INSERT INTO users (email, password, nom, prenom, username, age) VALUES ('$email', '$password', '$nom', '$prenom', '$username', '$age')";
        mysqli_query($id, $requete);
        header("refresh:3; url=connexion.php");
        $message = "Inscription reussie. Vous allez etre redirige vers la connexion.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            color: #222;
        }
        .page {
            max-width: 420px;
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
    <h3>Inscris toi sur achète ta bagnole , Allez vas-y!!!</h3>
    <?php if (isset($message)) { echo '<p>' . htmlspecialchars($message) . '</p>'; } ?>
    <?php if (isset($erreur)) { echo '<p class="error">' . htmlspecialchars($erreur) . '</p>'; } ?>
    <?php if (isset($erreur2)) { echo '<p class="error">' . htmlspecialchars($erreur2) . '</p>'; } ?>
    <form method="post" action="inscription.php">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prenom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="number" name="age" placeholder="Age" required>
        <button type="submit" name="inscrire">S'inscrire</button>
    </form>
    <p class="note">Vous avez deja un compte ? <a href="connexion.php">Connexion</a></p>
</div>
</body>
</html>
