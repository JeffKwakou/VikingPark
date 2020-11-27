<?php 
    session_start();

    //Connexion à la database
    try {
        $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
    } 
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    //Vérification si le champs est bien rempli
    if (isset($_POST['newsletter']) != '') {
        //Vérification de la connexion de l'utilisateur et si le mail est le bon
        if (isset($_SESSION['email']) == $_POST['newsletter']) {
            //Je modifie le code newsletter de l'utilisateur
            $updateNewsletter = $database->prepare("UPDATE usercomplement SET newsletter = 1 WHERE email = ?");
            $updateNewsletter->execute(array($_SESSION['email']));
            //Je redirige vers la page d'accueil
            header('Location: ../index.php?newsletter=updated');
        } else if (!isset($_SESSION['email'])) {
            //J'ajoute un nouvelle email si il n'est pas co
            $newNewsletter = $datebase->prepare("INSERT INTO usercomplement (email, newsletter) VALUES (:email, 1)");
            $newNewsletter->execute(array(
                'email' => $_POST['newsletter']
            ));
            //Je redirige vers la page d'accueil
            header('Location: ../index.php?newsletter=updated');
        } else {
            //Je redirige vers la page d'accueil avec un message d'erreur
            header('Location: ../index.php?newsletter=error');
        }
    }
?>