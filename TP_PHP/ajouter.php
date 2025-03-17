<?php
session_start();
include 'base_de_donnee.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: connexion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $title = $_POST['title'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $profile_photo = 'uploads/default.jpg';
    if (!empty($_FILES["profile_photo"]["name"])) {
        $profile_photo = 'uploads/' . basename($_FILES["profile_photo"]["name"]);
        move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $profile_photo);
    }

    $sql = "INSERT INTO users (first_name, last_name, title, username, password, profile_photo) VALUES ('$first_name', '$last_name', '$title', '$username', '$password', '$profile_photo')";
    if ($conn->query($sql) === TRUE) {
        header("Location: accueil.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Ajouter un utilisateur</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Prénom:</label>
        <input type="text" name="first_name" required>
        <br>
        <label>Nom:</label>
        <input type="text" name="last_name" required>
        <br>
        <label>Titre:</label>
        <input type="text" name="title" required>
        <br>
        <label>Nom d'utilisateur:</label>
        <input type="text" name="username" required>
        <br>
        <label>Mot de passe:</label>
        <input type="password" name="password" required>
        <br>
        <label>Photo de profil:</label>
        <input type="file" name="profile_photo">
        <br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>