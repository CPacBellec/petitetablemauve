<?php
$servername = "localhost";
$username = "wolfpac";
$password = "devilhel76";
$dbname = "petites_annonces";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
?>
