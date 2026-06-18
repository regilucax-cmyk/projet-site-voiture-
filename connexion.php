<?php
$host = "localhost";
$dbname = "projet_sitevoiture";
$user = "root";
$pass = "";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Erreur connexion DB : " . mysqli_connect_error());
}
?>