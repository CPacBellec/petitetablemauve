<?php
// admin.php
include 'dbConnect.php';
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
            echo "<a href='updateAd.php?id=" . $ad['id'] . "'>Modifier</a>";
            echo "<a href='deleteAd.php?id=" . $ad['id'] . "'>Supprimer</a>";
        }
    ?>
</body>
</html>

