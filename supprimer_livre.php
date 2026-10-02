<?php
session_start();
require 'config.php';




// Suppression d'un livre
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM vehicule WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les vehicules</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>📚 Listes des vehicules</h1>

        <!-- Tableau des livres -->
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Modele</th>
                    <th>Marque</th>
                    <th>Plaque d'immatriculation</th>
                    <th>Année d'Achat</th>
                    <th>Année de mise en service</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT id, nom, marque, modele, plaque_immatriculation, annee_achat, annee_mise_service, prix FROM vehicule");
                while ($livre = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$vehicule['id']}</td>
                            <td>{$vehicule['nom']}</td>
                            <td>{$vehicule['marque']}</td>
                            <td>{$vehicule['plaque_immatriculation']}</td>
                            <td>{$vehicule['annee_achat']}</td>
                            <td>{$vehicule['annee_mise_service']}</td>
                            <td>{$vehicule['prix']}</td>
                            <td><a href='?delete={$vehicule['id']}' onclick='return confirm(\"Voulez-vous vraiment supprimer ce livre ?\");' >❌ Supprimer</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Boutons Retour et Ajouter -->
        <div class="btn-container">
            <a href="admin_dashboard.php" class="btn">⬅️ Retour</a>
            <a href="ajouter_vehicule.php" class="btn">➕ Ajouter</a>
        </div>
    </div>

    
</body>

</html>