<?php
session_start();


// Vérifier si le formulaire de création de compte a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_utilisateur = $_POST["nom_utilisateur"];
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];

    // Hasher le mot de passe
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    // Connexion à la base de données
    include '../includes/config.php';

    // Vérifier la connexion
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Préparer la requête SQL pour insérer les données dans la table de demandes de compte
    $stmt = $conn->prepare("INSERT INTO demande_compte (nom_utilisateur, email, mot_de_passe) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nom_utilisateur, $email, $mot_de_passe_hash);

    // Exécuter la requête
    if ($stmt->execute()) {
        // La demande de compte a été enregistrée avec succès
        $message = "Votre demande de compte a été enregistrée avec succès. Un administrateur traitera votre demande dans les plus brefs délais.";
    } else {
        // Erreur lors de l'enregistrement de la demande de compte
        $erreur = "Une erreur est survenue lors de l'enregistrement de votre demande de compte. Veuillez réessayer.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<h2>Créer un compte</h2>

<?php if (isset($message)) { ?>
    <p class="success"><?php echo $message; ?></p>
<?php } ?>

<?php if (isset($erreur)) { ?>
    <p class="erreur"><?php echo $erreur; ?></p>
<?php } ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nom_utilisateur">Nom d'utilisateur :</label><br>
    <input type="text" id="nom_utilisateur" name="nom_utilisateur" required><br>
    <label for="email">Adresse e-mail :</label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="mot_de_passe">Mot de passe :</label><br>
    <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>
    <input type="submit" value="Créer un compte">
</form>

<!-- Script de déconnexion en cas d'inactivité -->
<script src="../js/inactivite.js"></script>
</body>
</html>