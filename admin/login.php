<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
include '../dbConnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT username, password, FROM utilisateurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $username, $password_hash, $role);

    if ($stmt->fetch() && password_verify($password, $password_hash)) {
        session_start();
        $_SESSION['username'] = $username;

        echo "Connexion réussie. Redirection vers la page d'admin...";
        header("Location: admin.php");
    } else {
        echo "Email ou mot de passe incorrect.";
    }

    $stmt->close();
}

$conn->close();
?>

<!-- Formulaire de connexion -->
<form class="p-5 container mx-auto max-w-md bg-white rounded-lg shadow-md" method="post" action="connexion.php">
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
