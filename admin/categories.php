<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Catégories</title>
</head>
<body>
    <h2>Liste des Catégories</h2>
    <a href="categorie_form.php">Ajouter une Catégorie</a>

    <?php
    include '../dbConnect.php';

    // Sélectionner toutes les catégories depuis la base de données
    $result = mysqli_query($conn, "SELECT * FROM categories");

    // Afficher les catégories
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<h3>".$row['nom']."</h3>";
        echo "<p>Description: ".$row['description']."</p>";
        echo "<a href='edit_categorie.php?id=".$row['id']."'>Modifier</a>";
        echo "<a href='delete_categorie.php?id=".$row['id']."'>Supprimer</a>";
        echo "</div>";
    }

    // Fermer la connexion
    mysqli_close($conn);
    ?>
</body>
</html>
