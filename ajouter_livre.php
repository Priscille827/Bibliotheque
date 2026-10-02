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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titre = htmlspecialchars($_POST["titre"]);
        $auteur = htmlspecialchars($_POST["auteur"]);
        $categorie = htmlspecialchars($_POST["categorie"]);
        $annee = (int) $_POST["annee"];

        $sql = "INSERT INTO livres (titre, auteur, categorie, annee) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$titre, $auteur, $categorie, $annee])) {
            header("Location: admin.php");
        } else {
            echo "Erreur lors de l'ajout.";
        }
    }
    ?>

    <h1>Ajouter un livre</h1>
    <div class="coco">
        <form method="POST">
            Titre : <input type="text" name="titre" required><br>
            Auteur : <input type="text" name="auteur" required><br>
            Catégorie : <input type="text" name="categorie" required><br>
            Année : <input type="number" name="annee" required><br>
            <button type="submit">Ajouter</button>
        </form>
    </div>
    <div class="button-container">
        <a href="admin_dashboard.php">Retour</a>
    </div>

    <script src="script.js"></script>
</body>

</html>