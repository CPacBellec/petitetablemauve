<?php
include '../dbConnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nom = $_POST['nom'];
    $description = $_POST['description'];

    if (isset($id)) {
        // Mettre à jour la catégorie dans la base de données
        $query = "UPDATE categories SET nom='$nom', description='$description' WHERE id='$id'";
    } else {
        // Ajouter une nouvelle catégorie dans la base de données
        $query = "INSERT INTO categories (nom, description) VALUES ('$nom', '$description')";
    }

    mysqli_query($conn, $query);

    // Redirection vers la page des catégories après l'ajout/modification
    header("Location: categories.php");
    exit();
}

// Fermer la connexion
mysqli_close($conn);
?>
