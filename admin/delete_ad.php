<?php
include '../dbConnect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer l'annonce de la base de données
    $query = "DELETE FROM annonces WHERE id='$id'";
    mysqli_query($conn, $query);

    // Redirection vers la page d'accueil ou une autre page après la suppression
    header("Location: admin.php");
    exit();
}

// Fermer la connexion
mysqli_close($conn);
?>
