<?php
session_start();
require 'config.php'; // Connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Récupérer les infos de l'utilisateur connecté
$stmt = $pdo->prepare("SELECT nom, email FROM utilisateurs WHERE id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'header.php'; ?> <!-- Inclure le menu -->

    <main>
        <h2>Bienvenue, <?php echo htmlspecialchars($user['nom']); ?> !</h2>
        <p>Email : <?php echo htmlspecialchars($user['email']); ?></p>

        <a href="historique.php">📜 Voir mon historique d’emprunt</a>
        <a href="retourner.php">🔄 Retourner un livre</a>
        <a href="emprunter.php">📖 Emprunter un livre</a>
        <a href="logout.php">🚪 Déconnexion</a>
    </main>

</body>

</html>