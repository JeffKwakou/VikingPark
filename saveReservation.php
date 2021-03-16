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
    $date = $_GET['date'];
    $quantity = $_GET['quantity'];

    //Vérifier le paramètre de l'url et si l'utilisateur est bien connecté
    if (isset($_GET['quantity']) != 0 AND isset($_SESSION['id'])) {
        //Vérifier qu'il y a pas 500 tickets vendus à la date de réservation 
        $reqQuantityTickets = $database->prepare("SELECT SUM(quantity) AS totalTicket FROM reservationticket WHERE date_reservation = ?");
        $reqQuantityTickets->execute(array($date));
        $quantityTickets = $reqQuantityTickets->fetch();
        if ($quantityTickets['totalTicket'] + (int)$quantity <= 500 OR $quantityTickets == null) {
            //Générer un code de billet
            $code = "";
            for($i = 0; $i < 10; $i++) {
                $random = strval(random_int(0,9));
                $code = $random;
            }

            //Insérer le ticket dans la database
            $reqSaveTicket = $database->prepare("INSERT INTO reservationticket (code, quantity, date_reservation, Id_User) VALUES (:code, :quantity, :date_reservation, :Id_User)");
            $reqSaveTicket->execute(array(
                'code' => $code,
                'quantity' => intval($quantity),
                'date_reservation' => $date,
                'Id_User' => $_SESSION['id']
            ));

            //Retour à la page précédente
            header('Location: reservation.phtml?reservation=success');
            
        } else {
            //Retour à la page précédente
            header('Location: reservation.phtml?quantityticket=error');
        }
    } else {
        //Retour à la page précédente
        header('Location: reservation.phtml?confirm-reservation=error');
    }
?>