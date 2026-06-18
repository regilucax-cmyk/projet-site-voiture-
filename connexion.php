<?php
$host = "localhost";
$dbname = "sitevoiture";
$user = "root";
$pass = "root"; // <-- IMPORTANT SUR MAMP

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Erreur connexion DB : " . mysqli_connect_error());
}
?>