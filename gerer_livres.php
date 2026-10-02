<?php
session_start();
require 'config.php';
include 'header.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit;
}

// Suppression d'un livre
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM livres WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: gerer_livres.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les livres</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>📚 Gérer les livres</h1>

        <!-- Tableau des livres -->
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Catégorie</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT id, titre, auteur, categorie FROM livres");
                while ($livre = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$livre['id']}</td>
                            <td>{$livre['titre']}</td>
                            <td>{$livre['auteur']}</td>
                            <td>{$livre['categorie']}</td>
                            <td><a href='?delete={$livre['id']}' onclick='return confirm(\"Voulez-vous vraiment supprimer ce livre ?\");' class='delete-btn'>❌ Supprimer</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Boutons Retour et Ajouter -->
        <div class="btn-container">
            <a href="admin_dashboard.php" class="btn">⬅️ Retour</a>
            <a href="ajouter_livre.php" class="btn">➕ Ajouter</a>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>