<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
include '../dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM utilisateurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $username, $password_hash);

    if ($stmt->fetch() && password_verify($password, $password_hash)) {
        session_start();
        $_SESSION['username'] = $username;

        echo "Connexion réussie. Redirection vers la page d'admin...";
        header("Location: admin.php");
        exit(); // Assurez-vous qu'aucune sortie supplémentaire n'est envoyée après la redirection d'en-tête
    } else {
        echo "Email ou mot de passe incorrect.";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - La Petite Table Mauve</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<a class="p-5 text-blue-500 hover:text-blue-800" href="../index.php"><- Retour</a>

<h1 class="p-8 text-center text-xl font-bold">Page Connexion</h1>

<!-- Formulaire de connexion -->
<form class="p-5 container mx-auto max-w-md bg-white rounded-lg shadow-md" method="post" action="login.php">
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-600">Email:</label>
        <input type="email" name="email" id="email" class="mt-1 p-2 w-full border rounded-md">
    </div>

    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-600">Mot de passe:</label>
        <input type="password" name="password" id="password" class="mt-1 p-2 w-full border rounded-md">
    </div>

    <div class="mb-4">
        <input type="submit" value="Se connecter" class="bg-blue-500 text-white p-2 rounded-md cursor-pointer">
    </div>
</form>

<p class="text-center mt-4">Vous n'avez pas de compte? <a href="register.php" class="text-blue-500">Inscrivez-vous ici</a>.</p>
