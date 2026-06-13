<?php {
$id = mysqli_connect("localhost", "root", "root", "sitevoiture");
if (isset($_POST['inscrire'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $age = $_POST['age'];
    $requete = "SELECT * FROM users WHERE email='$email'";
    $resultat = mysqli_query($id, $requete);
    if (mysqli_num_rows($resultat) > 0) {
        $erreur = "email ou mot de passe incorrect";
    } else if ($age < 18) {
        $erreur2 = "vous devez etre majeur pour vous inscrire";
        trigger_error($erreur2);
    } else {
        $requete = "INSERT INTO users (email, password, nom, prenom, username, age) VALUES ('$email', '$password', '$nom', '$prenom', '$username', '$age')";
        mysqli_query($id, $requete);
        header("refresh:3; url=connexion.php");
        echo "Inscription réussie, vous allez être redirigé vers la page de connexion.";
    }
    
    }
    
}   
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<H3>Inscrivez vous sur achète ta bagnole</H3> 
<br>
<hr>
<body>
<form method="post" action="inscription.php">
    <input type="text" name="nom" placeholder="Nom" required><br><br>
    <input type="text" name="prenom" placeholder="Prénom" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br><br>
    <input type ="username" name="username" placeholder="Username" required><br><br>
    <input type="number" name="age" placeholder="Age" required><br><br>
    <?php if (isset($erreur2)) {
        echo "<p style='color:red;'>$erreur2</p>";
    } ?> <br>
    <button type="submit" name="inscrire">S'inscrire</button>
</body>
</html>