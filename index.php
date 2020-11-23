<?php 
    //Connexion à la database 
    try {
        $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
    } 
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    //Récupération des attractions
    $reqAllAttractions = $database->query('SELECT name_activity, description_activity FROM activity WHERE type_activity = "Attraction" ORDER BY Id_Activity DESC LIMIT 3');
    $attractions = $reqAllAttractions->fetchAll();
     
    $firstSlideAttraction = 1;

    //Récupération des activités
    $reqAllActivities = $database->query('SELECT name_activity, description_activity FROM activity WHERE type_activity = "Spectacle" OR type_activity = "Animation" ORDER BY Id_Activity DESC LIMIT 3');
    $activities = $reqAllActivities->fetchAll();
    
    $firstSlideActivity = 1;

    include 'index.phtml';

?>