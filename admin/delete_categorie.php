<?php
include '../dbConnect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer la catégorie de la base de données
    $query = "DELETE FROM categories WHERE id='$id'";
    mysqli_query($conn, $query);

    // Redirection vers la page des catégories après la suppression
    header("Location: categories.php");
    exit();
}

// Fermer la connexion
mysqli_close($conn);
?>
