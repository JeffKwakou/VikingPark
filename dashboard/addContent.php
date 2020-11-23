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
            $reqTitle = $database->prepare('SELECT name_activity from activity WHERE name_activity = ?');
            $reqTitle->execute(array($titre));
            $resultTitle = $reqTitle->fetch();

            if ($resultTitle == false) {

                //Ajouter le nouveau contenu à la database$
                $reqContent = $database->prepare('INSERT INTO activity (name_activity, description_activity, type_activity) VALUES (:name_activity, :description_activity, :type_activity)');
                if ($type != '') {
                    $reqContent->execute(array(
                        'name_activity' => $titre,
                        'description_activity' => $description,
                        'type_activity' => $type
                    ));

                    header('Location: ../dashboard.php?ajout-contenu=success');
                } else {
                    $reqContent->execute(array(
                        'name_activity' => $titre,
                        'description_activity' => $description,
                        'type_activity' => $typeSelect
                    ));

                    header('Location: ../dashboard.php?ajout-contenu=success');
                }
                
            } else {
                header('Location: ../dashboard.php?ajout-contenu=error');
            }
        } else {
            header('Location: ../dashboard.php?ajout-contenu=error');
        }
    } else {
        header('Location: ../dashboard.php?ajout-contenu=error');
    }
?>