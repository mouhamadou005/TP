<?php
session_start();
include 'base_de_donnee.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: connexion.php");
    exit();
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <a href="ajouter.php">Ajouter un utilisateur</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Titre</th>
            <th>Nom d'utilisateur</th>
            <th>Photo de profil</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['profile_photo']; ?></td>
                <td class="actions">
                    <a class="btn" href="voir.php?id=<?php echo $row['id']; ?>">Voir</a>
                    <a class="btn" href="modifier.php?id=<?php echo $row['id']; ?>">Modifier</a>
                    <a class="btn" href="supprimer.php?id=<?php echo $row['id']; ?>">Supprimer</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="deconnexion.php">Déconnexion</a>
</body>
</html>