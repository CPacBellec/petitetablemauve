<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
session_start(); // Démarrez la session au début de votre fichier

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit(); // Assurez-vous de terminer le script après la redirection
}
include '../dbConnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('config.json');
    $data = json_decode($json, true);

    $newAd = array(
        'id' => uniqid(),
        'title' => $_POST['titre'],
        'description' => $_POST['description'],
        'price' => $_POST['prix'],
        'image' => $_FILES['image']['name']
    );

     // Utilisation de déclarations préparées pour éviter les attaques par injection SQL
     $stmt = $conn->prepare("INSERT INTO annonces (id, titre, description, prix, image) VALUES (?, ?, ?, ?, ?)");
     $stmt->bind_param("ssdss", $newAd['id'], $newAd['titre'], $newAd['description'], $newAd['prix'], $newAd['image']);
     $stmt->execute();
     $stmt->close();

    array_push($data['ads'], $newAd);
    file_put_contents('config.json', json_encode($data));

    // Upload image
    move_uploaded_file($_FILES['image']['tmp_name'], 'assets/photos/' . $_FILES['image']['name']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'annonce - La Petite Table Mauve</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<form method="post" enctype="multipart/form-data">
    Titre: <input type="text" name="title"><br>
    Description: <textarea name="description"></textarea><br>
    Price: <input type="number" name="price"><br>
    Image: <input type="file" name="image"><br>
    <input type="submit" value="Créer annonce">
</form>