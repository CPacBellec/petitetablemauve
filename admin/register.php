<?php 
error_reporting(E_ALL);
ini_set('display_errors', true);
include '../dbConnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO utilisateurs (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email ,$password);

    if ($stmt->execute()) {
        echo "Inscription réussie.";
    } else {
        echo "Erreur lors de l'inscription: " . $stmt->error;
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
        <title>Inscription</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-200 p-8">
        <div class="max-w-md mx-auto bg-white rounded p-6 shadow-md">
            <h1 class="text-2xl font-bold mb-4">Inscription</h1>
            <form method="post" action="register.php">
                <label class="block mb-2">Nom: <input type="text" name="username" class="border rounded w-full py-2 px-3" required></label>
                <label class="block mb-2">Email: <input type="email" name="email" class="border rounded w-full py-2 px-3" required></label>
                <label class="block mb-2">Mot de passe: <input type="password" name="password" class="border rounded w-full py-2 px-3" required></label>
                <input type="submit" value="S'inscrire" class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer hover:bg-blue-700">
            </form>
    </body>
</html>

<!-- Formulaire d'inscription -->
