<?php
require 'config.php'; // Assure-toi que ton fichier de connexion est bien inclus

$nom = "Yissegnon";
$email = "yissegnon@gmail.com";
$mot_de_passe = password_hash("31122003", PASSWORD_DEFAULT); // Hachage sécurisé
$role = "admin";

// Insertion dans la base de données
$stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?)");
$stmt->execute([$nom, $email, $mot_de_passe, $role]);

echo "Compte administrateur créé avec succès !";
?>