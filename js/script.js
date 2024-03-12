// script.js

function Inactivite() {
    // Fonction pour rediriger l'utilisateur vers la page de déconnexion
    function deconnexion() {
        window.location.href = 'logout.php'; // Remplacez 'logout.php' par le chemin de votre page de déconnexion
    }

    // Fonction pour réinitialiser le minuteur d'inactivité
    function reinitialiserMinuteur() {
        clearTimeout(timeout);
        timeout = setTimeout(deconnexion, 20 * 60 * 1000); // Déclenche la déconnexion après 20 minutes d'inactivité
    }

    // Écouteurs d'événements pour détecter l'activité de l'utilisateur
    document.addEventListener('mousemove', reinitialiserMinuteur);
    document.addEventListener('keydown', reinitialiserMinuteur);
    document.addEventListener('click', reinitialiserMinuteur);

    // Initialisation du minuteur au chargement de la page
    let timeout = setTimeout(deconnexion, 20 * 60 * 1000); // Déclenche la déconnexion après 20 minutes d'inactivité
}