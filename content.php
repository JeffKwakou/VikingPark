<?php
    //Connexion à la database
    try {
        $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
    } 
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    //Vérification si il y a un paramètre activity dans l'URL
    if (isset($_GET['activity'])) {
        //Sélection de l'activity en fonction de son id
        $activitySelected = $database->prepare("SELECT Id_activity ,name_activity, description_activity, type_activity, image_banner, imageA, imageB, imageC, imageD FROM activity WHERE Id_activity = ?");
        $activitySelected->execute(array($_GET['activity']));
        $activityContent = $activitySelected->fetch();

        //Include de la page content
        include 'content.phtml';
    } else { 
        //Reviens à la page précédente
        header("location:javascript://history.go(-1)");
    }
?>
