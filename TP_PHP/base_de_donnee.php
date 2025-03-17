<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Echec de la connection: " . $conn->connect_error);
}
?>