<?php

function hacherMotDePasse($mot_de_passe)
{
    return password_hash($mot_de_passe, PASSWORD_DEFAULT);
}

// Fonction pour déconnecter l'utilisateur
function deconnexionUtilisateur()
{
    // Début de la session PHP si elle n'est pas déjà démarrée
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Supprimer les informations de session
    $_SESSION = array(); // Supprime toutes les variables de session
    session_destroy(); // Détruit la session actuelle

    // Redirection vers la page de connexion
    header("Location: login.php");
    exit;
}

// Appeler la fonction de déconnexion si nécessaire (par exemple, si une certaine condition est remplie)
// deconnexionUtilisateur();

?>
?>
