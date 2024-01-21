<?php

// Redirection vers /public

if (strpos($_SERVER['REQUEST_URI'], '/portfolio/public') === false) {
    header('Location: /portfolio/public');
    exit();
}