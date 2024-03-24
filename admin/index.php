<?php
session_start();

// Inclusion du fichier de fonctions PHP
include '../includes/fonctions.php';
// Inclure le fichier de connexion à la base de données
include '../includes/config.php';
// Vérifier si la connexion à la base de données est établie
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
} else {
    echo "Connexion réussie à la base de données.";
}


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
        // Inclure le fichier de connexion à la base de données
        include '../includes/config.php';

        // Récupérer les données des projets depuis la base de données
        $sql = "SELECT * FROM Projets";
        $result = $conn->query($sql);

        // Vérifier s'il y a des résultats
        if ($result->num_rows > 0) {
            // Afficher les projets dans la table
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["NomProjet"] . "</td>";
                echo "<td>" . $row["Objectif"] . "</td>";
                echo "<td>" . $row["Explications"] . "</td>";
                echo "<td>" . $row["LangagesUtilises"] . "</td>";
                echo "<td>" . $row["MaPartDuProjet"] . "</td>";
                echo "<td>" . $row["ExempleDeCode"] . "</td>";
                echo "<td><img src='" . $row["ImagePrincipale"] . "' height='100'></td>";
                echo "<td><a href='modifier_projet.php?id=" . $row["id"] . "'>Modifier</a> | <a href='supprimer_projet.php?id=" . $row["id"] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce projet ?\")'>Supprimer</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Aucun projet trouvé.</td></tr>";
        }
        // Fermer la connexion à la base de données
        $conn->close();
        ?>
            </tbody>
        </table>
</body>
</html>
