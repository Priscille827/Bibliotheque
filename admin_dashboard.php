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

    // Vérification si l'utilisateur est bien un administrateur
    if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
        header("Location: login.php");
        exit;
    }

    echo "<h1>Panneau d'administration</h1>";
    ?>
    <div class="admin-container">
        <a href="admin.php">📜 Historique Administrateur</a>
        <a href="gerer_utilisateurs.php" class="btn">👥 Gérer les utilisateurs</a>
        <a href="gerer_livres.php" class="btn">📚 Gérer les livres</a>
        <a href="logout.php" class="btn">🚪 Se déconnecter</a>
        <script src="script.js"></script>
    </div>

</body>

</html>