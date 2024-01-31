<?php
// Charger la configuration depuis le fichier JSON
$config = json_decode(file_get_contents('config.json'), true);

// Informations de connexion à la base de données
$db_host = $config['db_host'];
$db_user = $config['db_user'];
$db_password = $config['db_password'];
$db_name = $config['db_name'];

// Connexion à la base de données
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}