<?php
// Début de la session PHP si elle n'est pas déjà démarrée
session_start();

// Supprimer la variable de session utilisateur_connecte
unset($_SESSION['utilisateur_connecte']);

// Message de confirmation de déconnexion
$message = "Suite à votre inactivité, vous avez été déconnecté par mesure de sécurité.";

// Redirection vers la page de connexion après 5 secondes
header("refresh:5;url=login.php");

// Affichage du message de confirmation de déconnexion
echo $message;
?>
