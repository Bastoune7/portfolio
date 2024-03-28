<?php
// Informations de connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_USER', 'portfolio');
define('DB_PASSWORD', 'WjcT7WOi8qIkOJ.o');
define('DB_NAME', 'portfolio');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}
?>