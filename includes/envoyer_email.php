<?php
// Récupérer les données du formulaire
$nom = $_POST['nom'];
$email = $_POST['email'];
$sujet = $_POST['sujet'];
$message = $_POST['message'];

// Adresse email de destination (votre adresse professionnelle)
$destinataire = "bastienkulmatiski2003@gmail.com";

// Préparer le contenu de l'email
$contenu = "Nom: $nom\n";
$contenu .= "Email: $email\n\n";
$contenu .= "Message:\n$message";

// En-têtes de l'email
$headers = "From: $nom <$email>";

// Envoyer l'email
$envoi = mail($destinataire, $sujet, $contenu, $headers);

// Rediriger l'utilisateur vers contact.php avec un paramètre GET pour indiquer le résultat de l'envoi
header("Location: contact.php?envoi=".($envoi ? "success" : "error"));
?>
