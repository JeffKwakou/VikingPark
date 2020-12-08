<?php 
    //Connexion à la database
    try {
        $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
    } 
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    //Déclaration des variables
    $commentaire = $_POST['commentaire'];
    $pseudo = $_POST['pseudo'];
    $idActivity = $_GET['activity'];

    //Vérifier si le pseudo et le commentaire existent et qu'ils ne sont pas vides
    if (isset($commentaire) != '' AND isset($pseudo) != '') {
        //Insère le commentaire en database
        $reqCommentaire = $database->prepare("INSERT INTO commentaires (commentaire, pseudo, date_post, Id_activity) VALUES (:commentaire, :pseudo, :date_post, :Id_activity)");
        $reqCommentaire->execute(array(
            "commentaire" => $commentaire,
            "pseudo" => $pseudo,
            "date_post" => date('j/m/y h:i'),
            "Id_activity" => $idActivity
        ));

        //Redirection avec un message de succès
        header('Location: ../content.php?activity='.$idActivity.'&commentaire=success');
    } else {
        //Sinon on affiche une erreur
        header('Location: ../content.php?activity='.$idActivity.'&commentaire=error');
    }

?>
