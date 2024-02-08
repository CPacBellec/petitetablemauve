<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une annonce</title>
</head>
<body>
    <h2>Ajouter une Annonce</h2>
    <form action="process_ad.php" method="post" enctype="multipart/form-data">
        <label for="nom">Nom de l'annonce:</label>
        <input type="text" name="nom" required><br>

        <label for="description">Description du produit:</label>
        <textarea name="description" required></textarea><br>

        <label for="prix">Prix de l'annonce:</label>
        <input type="number" name="prix" required><br>

        <label for="images">Images:</label>
        <input type="file" name="images[]" multiple accept="image/*"><br>

        <label for="categorie">Catégorie:</label>
        <select name="categorie" required>
            <!-- Options dynamiques depuis la base de données -->
            <?php
                // Inclure le fichier de configuration de la base de données
                include '../dbConnect.php';

                // Exécuter la requête pour récupérer les catégories depuis la base de données
                $result = mysqli_query($conn, "SELECT * FROM categories");

                // Boucler à travers les résultats et afficher les options
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='".$row['id']."'>".$row['nom']."</option>";
                }
            ?>
        </select><br>

        <label for="contact">Partie Contact Fixe:</label>
        <textarea name="contact" required>Coordonnées de contact fixes...</textarea><br>

        <input type="submit" value="Ajouter Annonce">
    </form>
</body>
</html>
