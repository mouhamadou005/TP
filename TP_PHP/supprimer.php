<?php
session_start();
include 'base_de_donnee.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: connexion.php");
    exit();
}

$user_id = $_GET['id'];
$sql = "DELETE FROM users WHERE id='$user_id'";
if ($conn->query($sql) === TRUE) {
    header("Location: accueil.php");
} else {
    echo "Erreur de suppression: " . $conn->error;
}
?>