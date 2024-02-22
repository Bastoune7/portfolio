<?php
// Inclusion du fichier de configuration de la base de données
include '../includes/fonctions.php';
include '../includes/config.php';

// Connexion à la base de données
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Requête SQL pour insérer les utilisateurs
$sql = "
INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe, email)
VALUES
    ('bernarddu28', '" . hacherMotDePasse('nanard_civic') . "', 'bernard.dragibus@gmail.com'),
    ('theolerigolo', '" . hacherMotDePasse('theolagrossebite') . "', 'theolerigolo@mescouilles.fr'),
    ('chiasse32', '" . hacherMotDePasse('groscaca320') . "', NULL);
";

// Exécuter la requête SQL
if ($conn->query($sql) === TRUE) {
    echo "Les utilisateurs ont été insérés avec succès.";
} else {
    echo "Erreur lors de l'insertion des utilisateurs : " . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();
?>
