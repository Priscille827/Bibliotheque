<?php
session_start();
require 'config.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $emprunt_id = $_GET['id'];

    // Mettre à jour la date_retour de l'emprunt avec la date actuelle
    $stmt = $pdo->prepare("UPDATE emprunts SET date_retour = NOW() WHERE id = ? AND utilisateur_id = ?");
    $stmt->execute([$emprunt_id, $_SESSION["user_id"]]);

    // Redirection vers la page "mes livres" après mise à jour
    header("Location: mes_livres.php");
    exit;
} else {
    // Redirection si l'ID de l'emprunt n'est pas défini
    header("Location: mes_livres.php?error=id_invalide");
    exit;
}
?>