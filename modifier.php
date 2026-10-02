<?php
session_start();
require 'config.php';
include 'header.php';

if (!isset($_GET["id"])) {
    header("Location: admin.php");
    exit;
}

$id = $_GET["id"];
$stmt = $pdo->prepare("SELECT * FROM livres WHERE id = ?");
$stmt->execute([$id]);
$livre = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = htmlspecialchars($_POST["titre"]);
    $auteur = htmlspecialchars($_POST["auteur"]);
    $categorie = htmlspecialchars($_POST["categorie"]);
    $annee = (int) $_POST["annee"];

    $sql = "UPDATE livres SET titre = ?, auteur = ?, categorie = ?, annee = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$titre, $auteur, $categorie, $annee, $id])) {
        header("Location: admin.php");
    } else {
        echo "Erreur lors de la modification.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Modifier un livre</h1>
    <div class="modif">
        <form method="POST">
            Titre : <input type="text" name="titre" value="<?= $livre['titre'] ?>" required><br>
            Auteur : <input type="text" name="auteur" value="<?= $livre['auteur'] ?>" required><br>
            Catégorie : <input type="text" name="categorie" value="<?= $livre['categorie'] ?>" required><br>
            Année : <input type="number" name="annee" value="<?= $livre['annee'] ?>" required><br>
            <button type="submit">Modifier</button>
        </form>
    </div>
    <div class="button-container">
        <a href="user_dashboard.php">Retour</a>
    </div>
    <script src="script.js"></script>
</body>

</html>