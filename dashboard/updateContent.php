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

    //Vérifier que les champs existent 
    if(isset($_POST['titre']) AND isset($_POST['description'])) {

        //Vérifier que les champs sont remplis
        if ($titre != '' AND $description != '' AND $type != '') {

            //Mettre à jour le contenu 
            $updateContent = $database->prepare("UPDATE activity SET name_activity = ?, description_activity = ?, type_activity = ? WHERE Id_activity = ?");
            $updateContent->execute([$titre, $description, $type, $idContent]);

            header('Location: ../dashboard.php?update-content=success');
            
        } else {
            header('Location: ../dashboard.php?update-content=error');
        }
    } else {
        header('Location: ../dashboard.php?update-content=error');
    }
?>