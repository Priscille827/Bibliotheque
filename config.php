<?php
$host = "localhost";
$dbname = "biblio_virtuelle";
$username = "root";  // À modifier si nécessaire
$password = "";      // Ajoute un mot de passe si ton MySQL en a un

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
