<?php
    //Connexion à la database
    try {
        $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
    } 
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    //Récupération des titres et description des animations
    $allAnimations = $database->query("SELECT Id_activity, name_activity, description_activity, image_banner FROM activity WHERE type_activity = 'animation'");
    $resultAllAnimation = $allAnimations->fetchAll();

    //Récupération des titres et description des spectacles
    $allSpectacles = $database->query("SELECT Id_activity, name_activity, description_activity, image_banner FROM activity WHERE type_activity = 'spectacle'");
    $resultAllSpectacle = $allSpectacles->fetchAll();

    //Include de la page html activity
    include 'activite.phtml';
?>