<?php

$conn = mysqli_connect("localhost", "root", "root", "sitevoiture");
session_start();

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $sql = "DELETE FROM annonces WHERE annonce_id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: liste annonce.php");
        exit;
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }
}