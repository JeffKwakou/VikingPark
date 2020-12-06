<?php 
    //Je lance la session
    session_start();

    //Connexion à la database
    try {
        $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
    } 
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    //Récupérer le titre et la description de tous les articles
    $reqAllActivity = $database->query('SELECT Id_activity, name_activity, description_activity FROM activity');
    $activities = $reqAllActivity->fetchAll();

    //Récupérer le titre et le nombres de likes par attraction
    $reqLikeActivity = $database ->query('SELECT name_activity, SUM(note) AS total_note FROM activity INNER JOIN notations ON activity.Id_activity = notations.Id_activity GROUP BY name_activity');
    $likeActivities = $reqLikeActivity->fetchAll();

    //Vérifier que l'utilisateur est un admin
    if ($_SESSION['type'] == 1) {
        //Include de la view dashboard.phtml
        include 'dashboard.phtml';
    }
    
?>