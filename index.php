<?php 
include_once 'header.php';
include 'dbConnect.php';
?>
<div class="container mx-auto p-4">
    <h1 class="text-4xl font-bold mb-6 text-center">Annonces</h1>

    <?php
    // Exemple de requête SQL pour récupérer les annonces (non sécurisée)
    $sql = "SELECT * FROM annonces";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='mb-4 p-4 bg-gray-100 rounded text-center'>";
            echo "<h2 class='text-2xl font-bold mb-2'>" . $row['title'] . "</h2>";
            echo "<p class='text-gray-700'>" . $row['description'] . "</p>";
            // Afficher d'autres détails de l'annonce
            echo "</div>";
        }
    } else {
        echo "<p class='text-red-500 text-center'>Aucune annonce disponible.</p>";
    }
?>




<?php
include_once 'footer.php';
?>

