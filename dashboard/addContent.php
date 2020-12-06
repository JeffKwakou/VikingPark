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
    $image = null;
    $imageA = null;
    $imageB = null;
    $imageC = null;
    $imageD = null;

    //Vérifier que les champs existent 
    if(isset($_POST['titre']) AND isset($_POST['description'])) {

        //Vérifier que les champs sont remplis
        if ($titre != '' AND $description != '') {

            //Vérifier que le titre est unique
            $reqTitle = $database->prepare('SELECT name_activity from activity WHERE name_activity = ?');
            $reqTitle->execute(array($titre));
            $resultTitle = $reqTitle->fetch();

            if ($resultTitle == false) {                
                //Chemin du dossier où upload l'image
                $target = $_SERVER['DOCUMENT_ROOT']."/assets/images/";

                //IMAGE BANNIERE
                if (move_uploaded_file($_FILES["imageBanner"]["tmp_name"], $target.$_FILES['imageBanner']['name'])) {
                    //Récupère le nom de l'image
                    $image = $_FILES['imageBanner']['name'];
                }

                //IMAGE A
                if (move_uploaded_file($_FILES["imageA"]["tmp_name"], $target.$_FILES['imageA']['name'])) {
                    //Récupère le nom de l'image
                    $imageA = $_FILES['imageA']['name'];
                }

                //IMAGE B
                if (move_uploaded_file($_FILES["imageB"]["tmp_name"], $target.$_FILES['imageB']['name'])) {
                    //Récupère le nom de l'image
                    $imageB = $_FILES['imageB']['name'];
                }

                //IMAGE C
                if (move_uploaded_file($_FILES["imageC"]["tmp_name"], $target.$_FILES['imageC']['name'])) {
                    //Récupère le nom de l'image
                    $imageC = $_FILES['imageC']['name'];
                }

                //IMAGE D
                if (move_uploaded_file($_FILES["imageD"]["tmp_name"], $target.$_FILES['imageD']['name'])) {
                    //Récupère le nom de l'image
                    $imageD = $_FILES['imageD']['name'];
                }
                

                //Ajouter le nouveau contenu à la database$
                $reqContent = $database->prepare('INSERT INTO activity (name_activity, description_activity, type_activity, image_banner, imageA, imageB, imageC, imageD) 
                VALUES (:name_activity, :description_activity, :type_activity, :image_banner, :imageA, :imageB, :imageC, :imageD)');
                if ($type != '') {
                    $reqContent->execute(array(
                        'name_activity' => $titre,
                        'description_activity' => $description,
                        'type_activity' => $type,
                        'image_banner' => $image,
                        'imageA' => $imageA,
                        'imageB' => $imageB,
                        'imageC' => $imageC,
                        'imageD' => $imageD
                    ));

                    header('Location: ../dashboard.php?ajout-contenu=success');
                } else {
                    $reqContent->execute(array(
                        'name_activity' => $titre,
                        'description_activity' => $description,
                        'type_activity' => $typeSelect,
                        'image_banner' => $image,
                        'imageA' => $imageA,
                        'imageB' => $imageB,
                        'imageC' => $imageC,
                        'imageD' => $imageD
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