<?php 
    session_start();

    //Connexion à la database
    try {
        $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
    } 
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    //Déclaration des variables
    $prixEnfant = $_POST['billetEnfant'];
    $prixAdulte = $_POST['billetAdulte'];
    $prixFamille = $_POST['billetFamille'];

    $nbEnfant = $_POST['nbEnfant'];
    $nbAdulte = $_POST['nbAdulte'];
    $nbFamille = $_POST['nbFamille'];

    $date = date("d/m/Y", strtotime($_POST['date']));
    $currentDate = date("d/m/Y");

    //Vérifier que l'utilisateur est connecté
    if (isset($_SESSION['id'])) {
        //Retour à la page si les trois prix sont à 0
        if ($prixEnfant * $nbEnfant == 0 AND $prixAdulte * $nbAdulte == 0 AND $prixFamille * $nbFamille == 0) {
            header('Location: reservation.phtml?prix=error');
        } else {
            if ( $currentDate <= $date) {
                //Calculer le prix total de chaque catégorie
                $resultEnfant = $prixEnfant * $nbEnfant;
                $resultAdulte = $prixAdulte * $nbAdulte;
                $resultFamille = $prixFamille * $nbFamille;
                $total = $resultAdulte + $resultEnfant + $resultFamille;

                include 'confirmReservation.phtml';
            } else {
                //Retour à la page précédente
                header('Location: reservation.phtml?date=error');
            }            
        }
    } else {
        //Retour à la page précédente
        header('Location: reservation.phtml?connexion=error');
    }
?>