<?php
session_start(); // Démarrez la session au début de votre fichier

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit(); // Assurez-vous de terminer le script après la redirection
}
include("../dbConnect.php");

// Vérifier l'authentification (ajouter la logique appropriée)

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $adId = $_GET['id'];

    // Exemple de requête SQL pour récupérer les détails de l'annonce (non sécurisée)
    $sql = "SELECT * FROM annonces WHERE id=$adId";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
        // Récupérer d'autres champs

        
        ?>
        <!-- Afficher les détails de l'annonce -->
        <div>
            <h1><?php echo $title; ?></h1>
            <p><?php echo $description; ?></p>
            <!-- Afficher d'autres détails de l'annonce -->
        </div>
        <?php

    } else {
        // Annonce non trouvée
        $error = "Annonce non trouvée.";
        echo "<p>$error</p>";
    }
} else {
    // Redirection si la méthode HTTP n'est pas GET
    header("Location: ../index.php");
}
?>