<?php 
    // Connexion à ma database
    try {
        $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
    } 
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    // Je récupère l'utilisateur dans ma database
    $request = $database->prepare('SELECT Id_User, pseudo, pass FROM userconnected WHERE pseudo = :pseudo');
    $request->execute(array(
        'pseudo' => $_POST['pseudo']
    ));
    $resultat = $request->fetch();
    

    //Vérification si le pseudo est valide
    if ($resultat == false) {
        header('Location: ../connexion.phtml?connexion=error');
    } else {
        //Comparaison du password envoyé haché avec celui de la database
        $passwordCorrect = password_verify($_POST['password'], $resultat['pass']);

        //Vérification si le password est correct
        if ($passwordCorrect == true) {
            //Création de la session et connexion
            session_start();
            $_SESSION['id'] = $resultat['Id_User'];
            $_SESSION['pseudo'] = $_POST['pseudo'];
            header('Location: ../index.phtml');
        } else {
            header('Location: ../connexion.phtml?connexion=error');
        }
    }
?>