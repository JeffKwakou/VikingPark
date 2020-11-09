<?php
    //Récupération des valeurs dans des variables
    $email = $_POST['email'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

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

            //Vérifier que le pseudo n'existe pas dans la database
            $reqPseudo = $database->prepare('SELECT pseudo FROM userconnected WHERE pseudo = ?');
            $reqPseudo->execute(array($pseudo));
            $resultatPseudo = $reqPseudo->fetch();

            if ($resultatPseudo == false) {
                $pass_hache = password_hash($password, PASSWORD_DEFAULT);

                $newUser = $database->prepare('INSERT INTO userconnected (pseudo, pass, email, typevisitor, newsletter) VALUES (:pseudo, :pass, :email, :typevisitor, :newsletter)');
                $newUser->execute(array(
                    'pseudo' => $pseudo,
                    'pass' => $pass_hache,
                    'email' => $email,
                    'typevisitor' => '2',
                    'newsletter' => '0'
                ));

                header('Location: ../index.phtml?inscription=valide');

            } else {
                header('Location: inscription.phtml?pseudo=error');
            }
        } else {
            header('Location: inscription.phtml?champs=error');
        }
    } else {
        header('Location: inscription.phtml?value=error');
    }


?>