<?php
include '../dbConnect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les données de l'annonce à modifier depuis la base de données
    $result = mysqli_query($conn, "SELECT * FROM annonces WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);

    // Afficher le formulaire pré-rempli avec les données actuelles
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier une Annonce</title>
    </head>
    <body>
        <h2>Modifier une Annonce</h2>
        <form action="update_annonce.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <label for="nom">Nom de l'annonce:</label>
            <input type="text" name="nom" value="<?php echo $row['nom']; ?>" required><br>

            <label for="description">Description du produit:</label>
            <textarea name="description" required><?php echo $row['description']; ?></textarea><br>

            <label for="prix">Prix de l'annonce:</label>
            <input type="number" name="prix" value="<?php echo $row['prix']; ?>" required><br>

            <label for="images">Images actuelles:</label>
            <img src="<?php echo $row['images']; ?>" alt="Annonce Image" style="max-width: 200px;"><br>
            <label for="new_images">Nouvelles Images:</label>
            <input type="file" name="new_images[]" multiple accept="image/*"><br>

            <label for="categorie">Catégorie:</label>
            <select name="categorie" required>
                <?php
                    // Afficher les options des catégories
                    while ($catRow = mysqli_fetch_assoc($categoriesResult)) {
                        $selected = ($catRow['id'] == $row['categorie_id']) ? "selected" : "";
                        echo "<option value='".$catRow['id']."' $selected>".$catRow['nom']."</option>";
                    }
                ?>
            </select><br>

            <label for="contact">Partie Contact :</label>
            <textarea name="contact" required><?php echo $row['contact']; ?></textarea><br>

            <input type="submit" value="Enregistrer les Modifications">
        </form>
    </body>
    </html>
    <?php
}

// Fermer la connexion
mysqli_close($conn);
?>
