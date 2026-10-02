<?php
session_start();
require 'config.php';
include 'header.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$utilisateur_id = $_SESSION["user_id"];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Livres Empruntés</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>📖 Mes Livres Empruntés</h1>

    <div class="livres-container">
        <?php
        $stmt = $pdo->prepare("SELECT e.id, l.titre, l.auteur, e.date_emprunt 
                               FROM emprunts e 
                               JOIN livres l ON e.livre_id = l.id
                               WHERE e.utilisateur_id = ? AND e.date_retour IS NULL");
        $stmt->execute([$utilisateur_id]);

        // Vérifie si des livres sont empruntés
        if ($stmt->rowCount() > 0) {
            while ($livre = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='livre-card'>
                        <h3>📚 {$livre['titre']}</h3>
                        <p>Auteur: {$livre['auteur']}</p>
                        <p>Emprunté le: {$livre['date_emprunt']}</p>
                        <a href='retourner.php?id={$livre['id']}' class='retourner'>Retourner</a>
                      </div>";
            }
        } else {
            echo "<p>Aucun livre emprunté pour le moment.</p>";
        }
        ?>


    </div>
    <div class="button-container">
        <a href="user_dashboard.php">Retour</a>
    </div>

    <script src="script.js"></script>
</body>

</html>