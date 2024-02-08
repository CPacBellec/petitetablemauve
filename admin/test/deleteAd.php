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

    // Exemple de requête SQL pour supprimer l'annonce (non sécurisée)
    $sql = "DELETE FROM annonces WHERE id=$adId";
    $result = $conn->query($sql);

    if ($result) {
        // Annonce supprimée avec succès
        header("Location: admin/admin.php");
    } else {
        // Échec de la suppression de l'annonce
        $error = "Erreur lors de la suppression de l'annonce.";
    }
} else {
    // Redirection si la méthode HTTP n'est pas GET
    header("Location: admin/admin.php");
}

?>
<!-- Afficher un message de confirmation de suppression -->
<p>Voulez-vous vraiment supprimer cette annonce?</p>
<a href="deleteAd.php?id=<?php echo $adId; ?>">Oui</a>
<a href="admin/admin.php">Non</a>
<?php
if (isset($error)) {
    echo "<p>$error</p>";
}

