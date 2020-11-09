<?php
    session_start();

    //Suppression de la session et des variables de la session
    $_SESSION = array();
    session_destroy();

    //Redirection de la page vers l'index
    header('Location: ../index.phtml');
?>