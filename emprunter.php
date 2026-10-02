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

    echo "<h1>Liste des livres disponibles</h1>";

    echo "<div class='livres-container'>";

    $stmt = $pdo->query("SELECT * FROM livres WHERE id NOT IN (SELECT livre_id FROM emprunts WHERE date_retour IS NULL)");
    while ($livre = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='livre-card'>
           
            <h3>📚{$livre['titre']}</h3>
            <p>Auteur: {$livre['auteur']}</p>
            <p>Catégorie: {$livre['categorie']}</p>
            <a href='emprunter_action.php?id={$livre['id']}' class=' emprunter'>Emprunter</a>
          </div>";
    }

    echo "</div>";
    ?>

    <div class="button-container">
        <a href="user_dashboard.php">Retour</a>
    </div>
    <script src="script.js"></script>
</body>

</html>