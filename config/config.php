<?php
// config.php

define('DB_HOST','localhost');
define('DB_NAME','portfolio');
define('DB-USER', 'nom_utilisateur');
define('DB_PASSWORD', 'mot_de_passe');

try{
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_log("Connexion à la base de donnée réussie.");
}   catch (PDOException $e) {
    error_log("Erreur de connexion à la base de donnée : ".$e->getMessage());
    die("Erreur de connexion à la base de données : ".$e->getMessage());
}