<?php
//Connexion à la database
try {
    $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

//Déclaration de la variable
$activitySelected = $_GET['id'];

//Requete pour supprimer l'activité et les notes associées à la foreign key
//$reqDelete = $database->prepare('DELETE FROM activity, notations INNER JOIN notations ON activity.Id_activity = notations.Id_activity WHERE Id_activity = :Id_activity');
$reqDelete = $database->prepare('DELETE FROM reservationticket WHERE Id_reservationTicket = :Id_reservation');
$reqDelete->execute(array(
    ':Id_reservation' => $activitySelected
));

header('Location: ../dashboard.php?deleteTicket=success');
