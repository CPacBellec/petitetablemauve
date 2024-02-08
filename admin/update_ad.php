<?php
include '../dbConnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $categorie_id = $_POST['categorie'];
    $contact = $_POST['contact'];

    // Traitement des nouvelles images
    $newImages = array();
    $uploadDir = "uploads/";

    if(isset($_FILES['new_images'])){
        foreach ($_FILES['new_images']['tmp_name'] as $key => $tmp_name) {
            $uploadFile = $uploadDir . basename($_FILES['new_images']['name'][$key]);
            move_uploaded_file($tmp_name, $uploadFile);
            $newImages[] = $uploadFile;
        }
    }

    // Mettre à jour les données dans la base de données
    $updateQuery = "UPDATE annonces SET nom='$nom', description='$description', prix='$prix', categorie_id='$categorie_id', contact='$contact'";

    // Mettre à jour les images si de nouvelles images sont fournies
    if (!empty($newImages)) {
        $updateQuery .= ", images='" . implode(",", $newImages) . "'";
    }

    $updateQuery .= " WHERE id='$id'";
    
    mysqli_query($conn, $updateQuery);

    // Redirection vers la page d'accueil ou une autre page après la mise à jour
    header("Location: admin.php");
    exit();
}

// Fermer la connexion
mysqli_close($conn);
?>
