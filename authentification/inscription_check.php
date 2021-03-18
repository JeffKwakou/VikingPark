<?php
    //Récupération des valeurs dans des variables
    $email = htmlspecialchars($_POST['email']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);
    $passwordConfirm = htmlspecialchars($_POST['passwordConfirm']);

    // Connexion à ma database
    try {
        $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
    } 
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    //Vérifier si les valeurs des champs existent
    if (isset($email) AND isset($email) AND isset($email)) {

        //Vérifier si les champs ne sont pas vides
        if ($email != '' AND $email != '' AND $password != '') {

            //Vérifier si les mots de passe tapés sont identiques
            if ($password == $passwordConfirm){

                //Vérifier que le pseudo n'existe pas dans la database
                $reqPseudo = $database->prepare('SELECT pseudo FROM userconnected WHERE pseudo = ?');
                $reqPseudo->execute(array($pseudo));
                $resultatPseudo = $reqPseudo->fetch();

                if ($resultatPseudo == false) {
                    $pass_hache = password_hash($password, PASSWORD_DEFAULT);

                    //Sauvegarde les infos complémentaires dans la database
                    $newUserComplement = $database->prepare("INSERT INTO userComplement (email, newsletter) VALUES (:email, :newsletter)");
                    $newUserComplement->execute(array(
                        'email' => $email,
                        'newsletter' => 0
                    ));

                    //Réucpère l'id du dernier insert 
                    $idComplement = $database->lastInsertId();

                    //Sauvegarde un utilisateur en insérant l'id des infos complémentaires
                    $newUser = $database->prepare("INSERT INTO userconnected (pseudo, pass, role_user, Id_userComplement) 
                    VALUES (:pseudo, :pass, 3, :Id_userComplement)");
                    $newUser->execute(array(
                        'pseudo' => $pseudo,
                        'pass' => $pass_hache,
                        'Id_userComplement' => $idComplement
                    ));

                    header('Location: ../index.php?inscription=valide');

                } else {
                    header('Location: ../inscription.phtml?pseudo=error');
                }
            } else {
                header('Location: ../inscription.phtml?password=error');
            }
        } else {
            header('Location: ../inscription.phtml?champs=error');
        }
    } else {
        header('Location: ../inscription.phtml?value=error');
    }


?>