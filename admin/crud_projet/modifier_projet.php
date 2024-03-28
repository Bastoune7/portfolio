<?php
session_start();

// Inclusion du fichier de fonctions PHP
include '../../includes/fonctions.php';
// Inclure le fichier de connexion à la base de données
require_once '../../includes/config.php';

// Vérifier si la connexion à la base de données est établie
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_connecte'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit;
}

// Définir des variables pour stocker les messages d'erreur et de succès
$message_erreur = $message_succes = '';

// Vérifier si l'identifiant du projet à modifier est passé dans l'URL
if (isset($_GET['id'])) {
    $projet_id = $_GET['id'];

    // Vérifier si le formulaire de modification a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier si toutes les données nécessaires ont été reçues
        if (isset($_POST['nom_projet'], $_POST['objectif_projet'], $_POST['explications_fonctionnement'], $_POST['langages_utilises'], $_POST['contribution_personnelle'], $_POST['exemple_code'], $_POST['image_principale'])) {
            // Récupérer les données du formulaire
            $nom_projet = $_POST['nom_projet'];
            $objectif_projet = $_POST['objectif_projet'];
            $explications_fonctionnement = $_POST['explications_fonctionnement'];
            $langages_utilises = $_POST['langages_utilises'];
            $contribution_personnelle = $_POST['contribution_personnelle'];
            $exemple_code = $_POST['exemple_code'];
            $image_principale = $_POST['image_principale'];

            // Préparer et exécuter la requête SQL pour mettre à jour le projet
            $sql = "UPDATE Projets SET Nom_Projet='$nom_projet', Objectif_Projet='$objectif_projet', Explications_Fonctionnement='$explications_fonctionnement', Langages_Utilises='$langages_utilises', Contribution_Personnelle='$contribution_personnelle', Exemple_Code='$exemple_code', Image_Principale='$image_principale' WHERE ID_Projet=$projet_id";

            if ($conn->query($sql) === TRUE) {
                $message_succes = "Projet modifié avec succès.";
                // Rediriger vers l'index du dashboard après la modification
                header("Location: ../index.php?modification=succes");
                exit;
            } else {
                $message_erreur = "Erreur lors de la modification du projet : " . $conn->error;
            }
        } else {
            $message_erreur = "Tous les champs doivent être remplis.";
        }
    }

    // Récupérer les données du projet à modifier depuis la base de données
    $sql = "SELECT * FROM Projets WHERE ID_Projet = $projet_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Récupérer les données du projet
        $row = $result->fetch_assoc();
        $nom_projet = $row["Nom_Projet"];
        $objectif_projet = $row["Objectif_Projet"];
        $explications_fonctionnement = $row["Explications_Fonctionnement"];
        $langages_utilises = $row["Langages_Utilises"];
        $contribution_personnelle = $row["Contribution_Personnelle"];
        $exemple_code = $row["Exemple_Code"];
        $image_principale = $row["Image_Principale"];
    } else {
        // Projet non trouvé, afficher un message d'erreur
        $message_erreur = "Projet non trouvé.";
    }
} else {
    // L'identifiant du projet n'est pas fourni dans l'URL, afficher un message d'erreur
    $message_erreur = "Identifiant du projet non spécifié.";
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Projet</title>
</head>
    <body>
    <!-- Afficher les messages d'erreur et de succès -->
    <?php
    if (!empty($message_erreur)) {
        echo "<p style='color: red;'>$message_erreur</p>";
    }
    if (!empty($message_succes)) {
        echo "<p style='color: green;'>$message_succes</p>";
    }
    ?>

    <h1>Modifier Projet</h1>

    <!-- Formulaire de modification du projet -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $projet_id; ?>" method="post">
        <label for="nom_projet">Nom du Projet:</label><br>
        <input type="text" id="nom_projet" name="nom_projet" value="<?php echo $nom_projet; ?>"><br><br>

        <label for="objectif_projet">Objectif:</label><br>
        <input type="text" id="objectif_projet" name="objectif_projet" value="<?php echo $objectif_projet; ?>"><br><br>

        <label for="explications_fonctionnement">Explications:</label><br>
        <textarea id="explications_fonctionnement" name="explications_fonctionnement"><?php echo $explications_fonctionnement; ?></textarea><br><br>

        <label for="langages_utilises">Langages Utilisés:</label><br>
        <input type="text" id="langages_utilises" name="langages_utilises" value="<?php echo $langages_utilises; ?>"><br><br>

        <label for="contribution_personnelle">Ma Part du Projet:</label><br>
        <input type="text" id="contribution_personnelle" name="contribution_personnelle" value="<?php echo $contribution_personnelle; ?>"><br><br>

        <label for="exemple_code">Exemple de Code:</label><br>
        <textarea id="exemple_code" name="exemple_code"><?php echo $exemple_code; ?></textarea><br><br>

        <label for="image_principale">Image Principale (URL):</label><br>
        <input type="text" id="image_principale" name="image_principale" value="<?php echo $image_principale; ?>"><br><br>

        <input type="submit" value="Modifier Projet">
    </form>
</body>
</html>
