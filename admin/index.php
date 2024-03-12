<?php
session_start();

// Inclusion du fichier de fonctions PHP
include '../includes/fonctions.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['utilisateur_connecte'])) {
    // Enregistrer l'horodatage de cette action dans la session
    $_SESSION['derniere_action'] = time();
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Inclure le script JavaScript -->
    <script src="../js/script.js"></script>
    <script>
    // Appeler la fonction pour inclure le script d'inactivité
    Inactivite();
    </script>

    </head>
    <body>
<!-- Contenu de votre tableau de bord -->
    <h1>Dashboard</h1>
    <p>Bienvenue, <?php echo $_SESSION['utilisateur_connecte']; ?> !</p>
</body>
</html>
