<?php
    //Connexion à la database
    try {
        $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
    } 
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    //Récupération des titres et description des attractions
    $allAttraction = $database->query("SELECT Id_activity, name_activity, description_activity, image_banner FROM activity WHERE type_activity = 'attraction'");
    $resultAllAttraction = $allAttraction->fetchAll();

    //Include de la page html attraction
    include 'attraction.phtml';
?>