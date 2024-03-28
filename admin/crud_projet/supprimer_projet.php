<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_connecte'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit;
}

// Vérifier si l'identifiant du projet à supprimer est défini dans l'URL
if (isset($_GET['id'])) {
    // Inclure le fichier de connexion à la base de données
    require_once '../../includes/config.php';

    // Échapper les données pour éviter les injections SQL
    $id_projet = mysqli_real_escape_string($conn, $_GET['id']);

    // Préparer la requête SQL pour supprimer le projet
    $sql = "DELETE FROM Projets WHERE ID_Projet = '$id_projet'";

    // Exécuter la requête SQL
    if ($conn->query($sql) === TRUE) {
        // Rediriger vers le tableau de bord avec un message de succès
        header("Location: ../index.php?suppression=succes");
        exit;
    } else {
        // Rediriger vers le tableau de bord avec un message d'erreur
        header("Location: ../index.php?suppression=erreur");
        exit;
    }

    // Fermer la connexion à la base de données
    $conn->close();
} else {
    // Rediriger vers le tableau de bord si l'identifiant du projet n'est pas défini
    header("Location: ../index.php");
    exit;
}
?>