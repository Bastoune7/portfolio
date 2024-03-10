<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté, le rediriger vers la page d'administration s'il est connecté
if (isset($_SESSION['utilisateur_connecte'])) {
    header("Location: dashboard.php");
    exit;
}

// Inclusion du fichier de configuration de la base de données
include '../includes/config.php';

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_utilisateur = $_POST["nom_utilisateur"];
    $mot_de_passe = $_POST["mot_de_passe"];

    // Connexion à la base de données
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Préparer la requête SQL sécurisée pour récupérer le mot de passe de l'utilisateur
    $stmt = $conn->prepare("SELECT id, mot_de_passe FROM utilisateurs WHERE nom_utilisateur = ?");
    $stmt->bind_param("s", $nom_utilisateur);

    // Exécuter la requête
    $stmt->execute();
    if ($conn->error) {
        die("Erreur lors de l'exécution de la requête SQL : " . $conn->error);
    }

    // Récupérer le résultat de la requête
    $result = $stmt->get_result();

    // Vérifier si l'utilisateur existe
    if ($result->num_rows == 1) {
        // Récupérer la ligne de résultat
        $row = $result->fetch_assoc();

        // Vérifier si le mot de passe est correct
        if (password_verify($mot_de_passe, $row["mot_de_passe"])) {
            // Authentification réussie, enregistrer l'utilisateur dans la session
            $_SESSION['utilisateur_connecte'] = $nom_utilisateur;
            // Rediriger vers la page d'accueil ou une autre page sécurisée
            header("Location: dashboard.php");
            exit();
        } else {
            // Mot de passe incorrect
            $erreur = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        // Utilisateur non trouvé
        $erreur = "Nom d'utilisateur ou mot de passe incorrect.";
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
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<h2>Connexion</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nom_utilisateur">Nom d'utilisateur :</label><br>
    <input type="text" id="nom_utilisateur" name="nom_utilisateur" required><br>
    <label for="mot_de_passe">Mot de passe :</label><br>
    <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>
    <?php if(isset($erreur)) { ?>
        <p class="erreur"><?php echo $erreur; ?></p>
    <?php } ?>
    <input type="submit" value="Se connecter">
</form>
</body>
</html>
