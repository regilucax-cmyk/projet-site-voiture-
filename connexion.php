<?php
session_start();
$id = mysqli_connect("localhost", "root", "root", "sitevoiture");
if (isset($_POST['connexion'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $requete = "SELECT * FROM users WHERE email='$email' and password='$password'";
   
    $resultat = mysqli_query($id, $requete);
    if (mysqli_num_rows($resultat) > 0) {
        $user = mysqli_fetch_assoc($resultat);
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['username'] = $user['username'];
        header("location: liste annonce.php");
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Mot de passe"  required><br><br>
    <button type="submit" name="connexion">Se connecter</button>
    <?php if (isset($erreur)) {
        echo $erreur;
        echo "<p style='color:red;'>$erreur</p>";
    } ?> <br>
</body>
</html>