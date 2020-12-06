<?php     
    //Connexion à la database
    try {
        $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
    } 
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    //Ouverture de la session pour les variables $_SESSION
    session_start();

    //Affichage des valeurs 
    echo $_POST['rating'];
    echo $_SESSION['id'];
    echo $_GET['content'];    

    //Déclaration des variables 
    $idActivity = $_GET['content'];
    $idUser = $_SESSION['id'];
    $note = $_POST['rating'];

    //Vérifie si l'utilisateur n'a pas déjà noté une note pour cette activité
    $noteAlreadyExist = $database->prepare("SELECT note FROM notations WHERE Id_User = ? AND Id_activity = ?");
    $noteAlreadyExist->execute(array($idUser, $idActivity));
    $resultNoteExist = $noteAlreadyExist->fetch();

    if($resultNoteExist != null) {
        //Retour à la page précédente et affiche un error
        header('Location: ../content.php?activity='.$idActivity.'&notation=error');
    } else {
        //Requête pour insérer une nouvelle note 
        $reqNotation = $database->prepare("INSERT INTO notations (note, Id_User, Id_activity) VALUES (:note, :Id_User, :Id_activity)");
        $reqNotation->execute(array(
            'note' => $note,
            'Id_User' => $idUser,
            'Id_activity' => $idActivity
        ));

        //Retour à la page précédente et affiche success
        header('Location: ../content.php?activity='.$idActivity.'&notation=success');
    }

?>