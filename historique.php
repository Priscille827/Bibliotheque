<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    session_start();
    require 'config.php';
    include 'header.php';

    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }

    $utilisateur_id = $_SESSION["user_id"];

    echo "<h1>Historique de mes emprunts</h1>";

    echo "<div class='livres-container'>";

    $stmt = $pdo->prepare("SELECT l.titre, l.auteur, e.date_emprunt, e.date_retour 
                       FROM emprunts e 
                       JOIN livres l ON e.livre_id = l.id
                       WHERE e.utilisateur_id = ?
                       ORDER BY e.date_emprunt DESC");
    $stmt->execute([$utilisateur_id]);

    while ($livre = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='livre-card'>
            
            <h3>📚{$livre['titre']}</h3>
            <p>Auteur: {$livre['auteur']}</p>
            <p>Emprunté le: {$livre['date_emprunt']}</p>";

        if ($livre['date_retour']) {
            echo "<p style='color: green;'>Retourné le: {$livre['date_retour']}</p>";
        } else {
            echo "<p style='color: red;'>Non retourné</p>";
        }

        echo "</div>";
    }

    echo "</div>";
    ?>
    <div class="button-container">
        <a href="user_dashboard.php">Retour</a>
    </div>

    <script src="script.js"></script>
</body>

</html>