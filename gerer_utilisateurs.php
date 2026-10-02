<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les utilisateurs</title>
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

    // Suppression d'un utilisateur
    if (isset($_GET['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
        $stmt->execute([$_GET['delete']]);
        header("Location: gerer_utilisateurs.php");
        exit;
    }
    echo " <h1>👥 Gérer les utilisateurs</h1>";
    ?>

    <div class="users-container">

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT id, nom, email FROM utilisateurs");
                while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$user['id']}</td>
                            <td>{$user['nom']}</td>
                            <td>{$user['email']}</td>
                            <td><a href='?delete={$user['id']}' onclick='return confirm(\"Voulez-vous vraiment supprimer cet utilisateur ?\");' class='delete-btn'>❌ Supprimer</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="button-container">
        <a href="admin_dashboard.php">Retour</a>
    </div>


    <script src="script.js"></script>
</body>

</html>