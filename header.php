<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque Virtuelle</title>
    <link rel="stylesheet" href="styles.css">

</head>
<?php
require 'config.php';

?>


<body>
    <header>
        <h1>📚 Bibliothèque Virtuelle</h1>
        <nav>
            <a href="header.php">🏠 Accueil</a>
            <?php if (isset($_SESSION["user_id"])): ?>
                <a href="logout.php">🚪 Déconnexion</a>
            <?php else: ?>
                <a href="login.php">🔑 Connexion</a>
                <a href="register.php">📝 Inscription</a>
            <?php endif; ?>

        </nav>
    </header>
    <script src="script.js"></script>
</body>


</html>