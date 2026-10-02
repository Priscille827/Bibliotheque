<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    require 'config.php';

    if (!isset($_SESSION["user_id"]) || !isset($_GET["id"])) {
        header("Location: emprunter.php");
        exit;
    }

    $utilisateur_id = $_SESSION["user_id"];
    $livre_id = $_GET["id"];
    $date_emprunt = date("Y-m-d");

    // Vérifier le nombre de livres déjà empruntés
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM emprunts WHERE utilisateur_id = ? AND date_retour IS NULL");
    $stmt->execute([$utilisateur_id]);
    $nombre_emprunts = $stmt->fetchColumn();

    if ($nombre_emprunts >= 3) {
        echo "Vous avez atteint la limite de 3 emprunts.";
        exit;
    }

    // Vérifier si le livre est déjà emprunté
    $stmt = $pdo->prepare("SELECT * FROM emprunts WHERE livre_id = ? AND date_retour IS NULL");
    $stmt->execute([$livre_id]);
    if ($stmt->rowCount() > 0) {
        echo "Ce livre est déjà emprunté.";
        exit;
    }

    // Enregistrer l'emprunt
    $stmt = $pdo->prepare("INSERT INTO emprunts (utilisateur_id, livre_id, date_emprunt) VALUES (?, ?, ?)");
    if ($stmt->execute([$utilisateur_id, $livre_id, $date_emprunt])) {
        header("Location: mes_livres.php");
    } else {
        echo "Erreur lors de l'emprunt.";
    }

    if ($stmt->execute([$utilisateur_id, $livre_id, $date_emprunt])) {
        echo "<script>showNotification('Livre emprunté avec succès !');</script>";
        header("refresh:1;url=mes_livres.php"); // Redirige après 1s
        exit;
    }

    ?>


    <?php
    session_start();
    require 'config.php';

    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }

    echo "<h2>Liste des livres disponibles</h2>";

    echo "<div class='livres-container'>";

    $stmt = $pdo->query("SELECT * FROM livres WHERE id NOT IN (SELECT livre_id FROM emprunts WHERE date_retour IS NULL)");
    while ($livre = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='livre-card'>
            <img src='{$livre['image']}' alt='Couverture du livre'>
            <h3>{$livre['titre']}</h3>
            <p>Auteur: {$livre['auteur']}</p>
            <p>Catégorie: {$livre['categorie']}</p>
            <a href='emprunter_action.php?id={$livre['id']}' class=' emprunter'>Emprunter</a>
          </div>";
    }

    echo "</div>";
    ?>
</body>

</html>