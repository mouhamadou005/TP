<?php
session_start();
include 'base_de_donnee.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];
        if ($user['is_admin']) {
            header("Location: accueil.php");
        } else {
            header("Location: profile.php");
        }
    } else {
        echo "Nom d'utilisateur ou mot de passe invalide";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <form method="POST">
        <label>Nom d'utilisateur:</label>
        <input type="text" name="username" required>
        <br>
        <label>Mot de passe:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Connexion</button>
    </form>
</body>
</html>