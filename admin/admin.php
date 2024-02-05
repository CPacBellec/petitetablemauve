<?php
// admin.php
session_start(); // Démarrez la session au début de votre fichier

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit(); // Assurez-vous de terminer le script après la redirection
}
include '../dbConnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin - La Petite Table Mauve</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <a href="createAd.php">Créer une annonce</a>
    <?php
        foreach ($data['annonces'] as $ad) {
            echo "Title: " . $ad['titre'] . "<br>";
            echo "Description: " . $ad['description'] . "<br>";
            echo "Price: " . $ad['prix'] . "<br>";
            echo "<img src='" . $ad['image'] . "'><br>";
            echo "<a href='showAd.php?id=" . $ad['id'] . "'>Regarder</a>";
            echo "<a href='updateAd.php?id=" . $ad['id'] . "'>Modifier</a>";
            echo "<a href='deleteAd.php?id=" . $ad['id'] . "'>Supprimer</a>";
        }
    ?>
</body>
</html>

