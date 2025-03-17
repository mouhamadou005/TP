<?php
session_start();
include 'base_de_donnee.php';

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin']) {
    header("Location: connexion.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Profil</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <td><?php echo $user['id']; ?></td>
        </tr>
        <tr>
            <th>Prénom</th>
            <td><?php echo $user['first_name']; ?></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?php echo $user['last_name']; ?></td>
        </tr>
        <tr>
            <th>Titre</th>
            <td><?php echo $user['title']; ?></td>
        </tr>
        <tr>
            <th>Nom d'utilisateur</th>
            <td><?php echo $user['username']; ?></td>
        </tr>
        <tr>
            <th>Photo de profil</th>
            <td><?php echo $user['profile_photo']; ?></td>
        </tr>
    </table>
    <a href="deconnexion.php">Déconnexion</a>
</body>
</html>