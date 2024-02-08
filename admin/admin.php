<?php
// admin.php
error_reporting(E_ALL);
ini_set('display_errors', true);
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
    <a href="ad_form.php">Créer une annonce</a>
    <a href="categories.php">Mes catégories</a>
    <?php
        // Sélectionner toutes les annonces depuis la base de données
    $result = mysqli_query($conn, "SELECT * FROM annonces");

    // Afficher les annonces
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<h3>".$row['nom']."</h3>";
        echo "<p>".$row['description']."</p>";
        echo "<p>Prix: ".$row['prix']." €</p>";
        echo "<p>Catégorie: ".$row['categorie_id']."</p>";
        echo "<p>Contact: ".$row['contact']."</p>";
        echo "<img src='".$row['images']."' alt='Annonce Image'>";
        echo "<a href='edit_ad.php?id=".$row['id']."'>Modifier</a>";
        echo "<a href='delete_ad.php?id=".$row['id']."'>Supprimer</a>";
        echo "</div>";
    }

    // Fermer la connexion
    mysqli_close($conn);
    ?>
</body>
</html>

