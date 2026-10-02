<?php
require 'config.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $role = "utilisateur"; // Par défaut, l’utilisateur n'est pas admin

    $sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nom, $email, $password, $role])) {
        echo "Inscription réussie ! <a href='index.php'>Se connecter</a>";
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form method="POST">
        Nom : <input type="text" name="nom" required><br>
        Email : <input type="email" name="email" required><br>
        Mot de passe : <input type="password" name="password" required><br>
        <button type="submit">S'inscrire</button>
    </form>
    <script src="script.js"></script>
</body>

</html>