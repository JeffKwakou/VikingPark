<?php
//Connexion à la database
try {
    $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

//Déclaration des variables
$id = $_GET['id'];
$index = 1;

//Récupére l'id de l'activité
$reqIdActivity = $database->prepare("SELECT Id_activity FROM activity WHERE name_activity = ?");
$reqIdActivity->execute(array($id));
$idActivity = $reqIdActivity->fetch();

//Récupérer les notes de l'activité en question
$reqNote = $database->prepare("SELECT note FROM notations WHERE Id_activity = ?");
$reqNote->execute(array($idActivity['Id_activity']));
$allNotes = $reqNote->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des notes</title>

    <!-- Intégration de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Intégration de mes scripts & styles -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="recap.css">
</head>

<body>
    <!-- HEADER -->
    <?php include 'include/header.phtml' ?>

    <div class="container" id="recapitulatif">
        <h2>Récapitulatif des notes de <?php echo "nom de l'activité";?></h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Index</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($allNotes as $note) {?>
                <tr>
                    <td><?php echo $index; ?></td>
                    <td><?php echo $note['note'] . " / 5"; ?></td>
                </tr>
                <?php $index++; } ?>
            </tbody>
        </table>
    </div>
</body>

</html>