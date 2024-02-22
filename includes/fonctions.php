<?php

function hacherMotDePasse($mot_de_passe) {
    return password_hash($mot_de_passe, PASSWORD_DEFAULT);
}

?>
