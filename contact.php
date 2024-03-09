<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="css/contact.css">
</head>
    <body>
    <h2>Contactez-nous</h2>

    <form action="includes/envoyer_email.php" method="post">
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom" required><br>
        <label for="email">Adresse e-mail :</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="sujet">Sujet :</label><br>
        <input type="text" id="sujet" name="sujet" required><br>
        <label for="message">Message :</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br><br>
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>