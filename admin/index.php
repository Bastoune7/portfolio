<?php
session_start();


/************************** Gestion des déconnexions **************************/
include '../includes/fonctions.php';
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['utilisateur_connecte'])) {
    // Vérifier si un horodatage de dernière action est enregistré dans la session
    if (isset($_SESSION['derniere_action'])) {
        // Calculer le temps écoulé depuis la dernière action
        $temps_actuel = time();
        $temps_inactivite = $temps_actuel - $_SESSION['derniere_action'];

        // Si le temps d'inactivité dépasse 20 minutes (20 * 60 secondes)
        if ($temps_inactivite > (20 * 60)) {
            // Déconnecter l'utilisateur en utilisant la fonction définie dans fonctions.php
            deconnexionUtilisateur();
        }
    }

    // Enregistrer l'horodatage de cette action dans la session
    $_SESSION['derniere_action'] = time();
}

/************************** Fin gestion des déconnexions **************************/

// Le reste du contenu de votre tableau de bord va ici...

// Vous pouvez accéder aux informations de l'utilisateur connecté via $_SESSION['utilisateur_connecte']
// Par exemple, pour afficher le nom de l'utilisateur connecté :
$utilisateur_connecte = $_SESSION['utilisateur_connecte'];
echo "Bienvenue, $utilisateur_connecte !";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Inclure le script JavaScript via la fonction -->
    <script src="chemin/vers/script.js"></script>
    <script>
        // Appeler la fonction pour inclure le script d'inactivité
        Inactivite();
    </script>
</head>
<body>
<!-- Contenu de votre tableau de bord -->
<h1>Dashboard</h1>
<p>Contenu de votre tableau de bord...</p>
</body>
</html>