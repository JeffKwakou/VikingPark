<?php 
    //Connexion à la database
    try {
        $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
    } 
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    //Déclaration des variables
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $typeSelect = $_POST['typeSelect'];

    //Vérifier que les champs existent 
    if(isset($_POST['titre']) AND isset($_POST['description'])) {

        //Vérifier que les champs sont remplis
        if ($titre != '' AND $description != '') {

            //Vérifier que le titre est unique
            $reqTitle = $database->prepare('SELECT nameActivity from activity WHERE nameActivity = ?');
            $reqTitle->execute(array($titre));
            $resultTitle = $reqTitle->fetch();

            if ($resultTitle == false) {

                //Ajouter le nouveau contenu à la database$
                $reqContent = $database->prepare('INSERT INTO activity (nameActivity, descriptionActivity, typeActivity) VALUES (:nameActivity, :descriptionActivity, :typeActivity)');
                if ($type != '') {
                    $reqContent->execute(array(
                        'nameActivity' => $titre,
                        'descriptionActivity' => $description,
                        'typeActivity' => $type
                    ));

                    header('Location: ../dashboard.phtml?ajout-contenu=success');
                } else {
                    $reqContent->execute(array(
                        'nameActivity' => $titre,
                        'descriptionActivity' => $description,
                        'typeActivity' => $typeSelect
                    ));

                    header('Location: ../dashboard.phtml?ajout-contenu=success');
                }
                
            } else {
                header('Location: ../dashboard.phtml?ajout-contenu=error');
            }
        } else {
            header('Location: ../dashboard.phtml?ajout-contenu=error');
        }
    } else {
        header('Location: ../dashboard.phtml?ajout-contenu=error');
    }
?>