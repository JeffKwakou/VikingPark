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
    $idContent = $_GET['update'];
    // $image;
    // $imageA;
    // $imageB;
    // $imageC;
    // $imageD;

    //Vérifier que les champs existent 
    if(isset($_POST['titre']) AND isset($_POST['description'])) {

        //Vérifier que les champs sont remplis
        if ($titre != '' AND $description != '' AND $type != '') {     
            
            //Je récupère la valeur des images dans la database
            $imageDatabase = $database->prepare("SELECT image_banner, imageA, imageB, imageC, imageD FROM activity WHERE Id_activity = ?");
            $imageDatabase->execute(array($_GET['update']));
            $imageDbb = $imageDatabase->fetch();

            //Chemin du dossier où upload l'image
            $target = $_SERVER['DOCUMENT_ROOT']."/assets/images/";

            //IMAGE BANNIERE
            if (move_uploaded_file($_FILES["imageBanner"]["tmp_name"], $target.$_FILES['imageBanner']['name'])) {
                //Récupère le nom de l'image
                $image = $_FILES['imageBanner']['name'];
            } else {
                $image = $imageDbb['image_banner'];
            }

            //IMAGE A
            if (move_uploaded_file($_FILES["imageA"]["tmp_name"], $target.$_FILES['imageA']['name'])) {
                //Récupère le nom de l'image
                $imageA = $_FILES['imageA']['name'];
            } else {
                $imageA = $imageDbb['imageA'];
            }

            //IMAGE B
            if (move_uploaded_file($_FILES["imageB"]["tmp_name"], $target.$_FILES['imageB']['name'])) {
                //Récupère le nom de l'image
                $imageB = $_FILES['imageB']['name'];
            } else {
                $imageB = $imageDbb['imageB'];
            }

            //IMAGE C
            if (move_uploaded_file($_FILES["imageC"]["tmp_name"], $target.$_FILES['imageC']['name'])) {
                //Récupère le nom de l'image
                $imageC = $_FILES['imageC']['name'];
            } else {
                $imageC = $imageDbb['imageC'];
            }

            //IMAGE D
            if (move_uploaded_file($_FILES["imageD"]["tmp_name"], $target.$_FILES['imageD']['name'])) {
                //Récupère le nom de l'image
                $imageD = $_FILES['imageD']['name'];
            } else {
                $imageD = $imageDbb['imageD'];
            }

            //Mettre à jour le contenu 
            $updateContent = $database->prepare("UPDATE activity SET name_activity = :name_activity, description_activity = :description_activity,
             type_activity = :type_activity, image_banner = :image_banner, imageA = :imageA, imageB = :imageB, imageC = :imageC, imageD = :imageD WHERE Id_activity = :Id_activity");
            $updateContent->execute(array(
                'name_activity' => $titre,
                'description_activity' => $description,
                'type_activity' => $type,
                'image_banner' => $image,
                'imageA' => $imageA,
                'imageB' => $imageB,
                'imageC' => $imageC,
                'imageD' => $imageD,
                'Id_activity' => $idContent
            ));

            header('Location: ../dashboard.php?update-content=success');
            
        } else {
            header('Location: ../dashboard.php?update-content=error');
        }
    } else {
        header('Location: ../dashboard.php?update-content=error');
    }
?>