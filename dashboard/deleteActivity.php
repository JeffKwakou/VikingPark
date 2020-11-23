<?php 
    //Connexion a la database
    try {
        $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
    } 
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    //Déclaration de la variable
    $activitySelected = $_GET['activity'];

    //Requete pour supprimer l'activité et les notes associées à la foreign key
    //$reqDelete = $database->prepare('DELETE FROM activity, notations INNER JOIN notations ON activity.Id_activity = notations.Id_activity WHERE Id_activity = :Id_activity');
    $reqDelete = $database->prepare('DELETE FROM activity WHERE Id_activity = :Id_activity');
    $reqDelete->execute(array(
        ':Id_activity' => $activitySelected
    ));

    header('Location: ../dashboard.php');
?>