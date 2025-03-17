<?php
session_start();
include 'base_de_donnee.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: connexion.php");
    exit();
}

$user_id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $title = $_POST['title'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $profile_photo = $user['profile_photo'];
    if (!empty($_FILES["profile_photo"]["name"])) {
        $profile_photo = 'uploads/' . basename($_FILES["profile_photo"]["name"]);
        move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $profile_photo);
    }

    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', title='$title', username='$username', password='$password', profile_photo='$profile_photo' WHERE id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: accueil.php");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Modifier un utilisateur</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Prénom:</label>
        <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required>
        <br>
        <label>Nom:</label>
        <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required>
        <br>
        <label>Titre:</label>
        <input type="text" name="title" value="<?php echo $user['title']; ?>" required>
        <br>
        <label>Nom d'utilisateur:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
        <br>
        <label>Mot de passe:</label>
        <input type="password" name="password" required>
        <br>
        <label>Photo de profil:</label>
        <input type="file" name="profile_photo">
        <br>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>