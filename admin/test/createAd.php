<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include '../dbConnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newAd = array(
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'image' => $_FILES['image']['name']
    );

    $stmt = $conn->prepare("INSERT INTO annonces (titre, description, prix, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $newAd['title'], $newAd['description'], $newAd['price'], $newAd['image']);
    $stmt->execute();
    $stmt->close();

    // Destination directory
    $destinationDirectory = '../assets/photos/';

    // Create the directory if it doesn't exist
    if (!is_dir($destinationDirectory)) {
        mkdir($destinationDirectory, 0755, true);
    }

    // Move the uploaded file
    $destinationPath = $destinationDirectory . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $destinationPath);
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

</body>
</html>
