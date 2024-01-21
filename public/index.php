<?php
// public/index.php

require_once('../config/config.php');
require_once('../app/controllers/MainController.php');

// Gestion des routes
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', trim($url, '/'));
$action = isset($segments[i]) ? $segments[i] : 'index';

$controller = new MainController();

if (method_exists($controller, $action)) {
    $controller->{$action}();
} else {
    // Gère l'erreur (page non trouvée par exemple)
}