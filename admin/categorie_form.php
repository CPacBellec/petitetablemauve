<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Catégorie</title>
</head>
<body>
    <h2>Ajouter/Modifier une Catégorie</h2>

    <?php
    include '../dbConnect.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Récupérer les données de la catégorie à modifier depuis la base de données
        $result = mysqli_query($conn, "SELECT * FROM categories WHERE id='$id'");
        $row = mysqli_fetch_assoc($result);
    }
    ?>

    <form action="process_categorie.php" method="post">
        <?php if (isset($id)): ?>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <?php endif; ?>

        <label for="nom">Nom de la Catégorie:</label>
        <input type="text" name="nom" value="<?php echo isset($row['nom']) ? $row['nom'] : ''; ?>" required><br>

        <label for="description">Description de la Catégorie:</label>
        <textarea name="description"><?php echo isset($row['description']) ? $row['description'] : ''; ?></textarea><br>

        <input type="submit" value="<?php echo isset($id) ? 'Modifier' : 'Ajouter'; ?> la Catégorie">
    </form>
</body>
</html>
