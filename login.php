<?php
session_start();

require 'config.php';
include 'header.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["mot_de_passe"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["role"] = $user["role"];

        if ($user["role"] == "admin") {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit;
    } else {
        echo "Identifiants incorrects.";
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
    <form method="POST" autocomplete="off">
        Email : <input type="email" name="email" required autocomplete="off"><br>
        Mot de passe : <input type="password" name="password" required autocomplete="off"><br>
        <button type="submit">Se connecter</button>
    </form>
    <script>
        window.onload = function () {
            document.querySelector('[name="Email"]').value = '';
            document.querySelector('[name="Mot de passe"]').value = '';
        }
    </script>

</body>

</html>