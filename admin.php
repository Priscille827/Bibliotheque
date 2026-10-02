<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    session_start();
    require 'config.php';
    include 'header.php';

    // Vérifier si l'utilisateur est connecté et est admin
    if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
        header("Location: header.php");
        exit;
    }
    ?>

    <div class="dash-container">
        <div class="blue-container">
            <a href="admin_dashboard.php">Retour</a>
        </div>

        <h1>Gestion des livres</h1>

        <div class="dashtable-container">
            <!-- Tableau des livres -->
            <table class="books-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Catégorie</th>
                        <th>Année</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM livres");
                    while ($livre = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                            <td>{$livre['id']}</td>
                            <td>{$livre['titre']}</td>
                            <td>{$livre['auteur']}</td>
                            <td>{$livre['categorie']}</td>
                            <td>{$livre['annee']}</td>
                            <td>
                                <a href='modifier.php?id={$livre['id']}'>Modifier</a> | 
                                <a href='supprimer_livre.php?id={$livre['id']}'>Supprimer</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="action-btn-container">
            <a href="ajouter_livre.php" class="add-book-btn">➕ Ajouter un livre</a>
        </div>

        <h1>Gestion des utilisateurs</h1>

        <div class="dashtable-container">
            <!-- Tableau des utilisateurs -->
            <table class="dashusers-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM utilisateurs");
                    while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                            <td>{$user['id']}</td>
                            <td>{$user['nom']}</td>
                            <td>{$user['email']}</td>
                            <td>{$user['role']}</td>
                            <td>
                                <a href='supprimer_utilisateur.php?id={$user['id']}'>Supprimer</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>