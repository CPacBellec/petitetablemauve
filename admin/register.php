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
    <body>
        <form method="post" action="register.php">
            <label>Nom: <input type="text" name="username" required></label><br>
            <label>Email: <input type="email" name="email" required></label><br>
            <label>Mot de passe: <input type="password" name="password" required></label><br>
            <input type="submit" value="S'inscrire">
        </form>
    </body>
</html>

<!-- Formulaire d'inscription -->
