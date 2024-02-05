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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Traitement du formulaire de mise à jour d'annonce (à adapter)
    $adId = $_POST['id'];
    $title = $_POST['titre'];
    $description = $_POST['description'];
    // Ajouter d'autres champs et validation des données

    // Exemple de mise à jour SQL (non sécurisée)
    $sql = "UPDATE annonces SET title='$title', description='$description' WHERE id=$adId";
    $result = $conn->query($sql);

    if ($result) {
        // Annonce mise à jour avec succès
        header("Location: showAd.php?id=$adId");
    } else {
        // Échec de la mise à jour de l'annonce
        $error = "Erreur lors de la mise à jour de l'annonce.";
    }
} else {
    // Afficher le formulaire pré-rempli avec les détails actuels de l'annonce
    $adId = $_GET['id'];

    // Exemple de requête SQL pour récupérer les détails de l'annonce (non sécurisée)
    $sql = "SELECT * FROM annonces WHERE id=$adId";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row['titre'];
        $description = $row['description'];
        // Récupérer d'autres champs
    } else {
        // Annonce non trouvée
        $error = "Annonce non trouvée.";
    }
}

?>
<!-- Formulaire de mise à jour d'annonce -->
<form method="post" action="">
    <input type="hidden" name="id" value="<?php echo $adId; ?>">
    <label for="title">Nouveau titre de l'annonce:</label>
    <input type="text" name="titre" value="<?php echo $title; ?>" required><br>
    <label for="description">Nouvelle description de l'annonce:</label>
    <textarea name="description" required><?php echo $description; ?></textarea><br>
    <!-- Ajouter d'autres champs du formulaire -->
    <input type="submit" value="Mettre à jour l'annonce">
</form>
<?php
if (isset($error)) {
    echo "<p>$error</p>";
}
