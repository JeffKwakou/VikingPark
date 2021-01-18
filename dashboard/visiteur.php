<?php 
//Je lance la session
session_start();

//Connexion à la database
try {
    $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

//Changer le role de l'utilisateur en 3
$reqModerateur = $database->prepare("UPDATE userconnected SET role_user = 3 WHERE Id_User = ?");
$reqModerateur->execute(array($_GET['id']));

header('Location: ../list-users.php?visitor=success');
?>