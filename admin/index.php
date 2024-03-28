<?php
session_start();

// Inclusion du fichier de fonctions PHP
include '../includes/fonctions.php';
// Inclure le fichier de connexion à la base de données
require_once '../includes/config.php';
// Vérifier si la connexion à la base de données est établie


// Initialiser les messages d'erreurs et de succès
$message_erreur = $message_succes = '';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['utilisateur_connecte'])) {
    // Enregistrer l'horodatage de cette action dans la session
    $_SESSION['derniere_action'] = time();
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit;
}

// Vérifier si un message d'erreur ou de succès est passé dans l'URL
if (isset($_GET['suppression'])) {
    if ($_GET['suppression'] == 'succes') {
        $message_succes = 'Projet supprimé avec succès.';
    } elseif ($_GET['suppression'] == 'erreur') {
        $message_erreur = 'Une erreur est survenue lors de la suppression du projet.';
    }
}

// Vérifier si un message d'erreur ou de succès est passé dans l'URL
if (isset($_GET['modification'])) {
    if ($_GET['modification'] == 'succes') {
        $message_succes = 'Projet supprimé avec succès.';
    } elseif ($_GET['suppression'] == 'erreur') {
        $message_erreur = 'Une erreur est survenue lors de la suppression du projet.';
    }
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
<p>Bienvenue, <?php echo $_SESSION['utilisateur_connecte'];?> !</p>

<!-- Affichage des messages d'erreurs et de succès -->
<?php
if ($message_erreur !== '') {
    echo "<div style='color: red;'>$message_erreur</div>";
}
if ($message_succes !== '') {
    echo "<div style='color: green;'>$message_succes</div>";
}
?>

<table border="1">
    <thead>
    <tr>
        <th>Nom du Projet</th>
        <th>Objectif</th>
        <th>Explications</th>
        <th>Langages Utilisés</th>
        <th>Ma Part du Projet</th>
        <th>Exemple de Code</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Récupérer les données des projets depuis la base de données
    $sql = "SELECT * FROM Projets";
    $result = $conn->query($sql);

    // Vérifier s'il y a des résultats
    if ($result->num_rows > 0) {
        // Afficher les projets dans la table
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Nom_Projet"] . "</td>";
            echo "<td>" . $row["Objectif_Projet"] . "</td>";
            echo "<td>" . $row["Explications_Fonctionnement"] . "</td>";
            echo "<td>" . $row["Langages_Utilises"] . "</td>";
            echo "<td>" . $row["Contribution_Personnelle"] . "</td>";
            echo "<td>" . $row["Exemple_Code"] . "</td>";
            echo "<td><img src='" . $row["Image_Principale"] . "' height='100'></td>";
            echo "<td><a href='crud_projet/modifier_projet.php?id=" . $row["ID_Projet"] . "'>Modifier</a> | <a href='crud_projet/supprimer_projet.php?id=" . $row["ID_Projet"] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce projet ?\")'>Supprimer</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Aucun projet trouvé.</td></tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>
