<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
include '../dbConnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $categorie_id = $_POST['categorie'];
    $contact = $_POST['contact'];

        // Gestion du téléchargement de l'image
        $image_path = "../uploads/";
        $image_filename = $_FILES['images']['name'];
        $image_tmp_name = $_FILES['images']['tmp_name'];
        $image_target = $image_path . basename($image_filename[0]);
        move_uploaded_file($image_tmp_name[0], $image_target);
    
        // Vérifiez si le fichier est une image
        if (getimagesize($image_target) === false) {
            echo "Le fichier n'est pas une image.";
            exit();
    }
    
        // Vérifier s'il y a des erreurs lors du téléchargement
    if ($_FILES['images']['error'] !== UPLOAD_ERR_OK) {
        echo "Erreur lors du téléchargement du fichier";
        // Afficher le code d'erreur : $_FILES['image']['error']
    } else {
        // Déplacer le fichier téléchargé vers le répertoire de destination
        if (move_uploaded_file($image_tmp_name, $image_target)) {
            echo "Fichier déplacé avec succès vers " . $image_target;
        } else {
            echo "Échec du déplacement du fichier";
        }
    }

    // Insertion des données dans la base de données
    $query = "INSERT INTO annonces (nom, description, prix, images, categorie_id, contact) VALUES ('$nom', '$description', '$prix', '$image_target', '$categorie_id', '$contact')";
    mysqli_query($conn, $query);

    // Redirection vers la page d'accueil ou une autre page après l'ajout
    header("Location: admin.php");
    exit();
}
?>
