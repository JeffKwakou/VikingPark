<?php
//Je lance la session
session_start();

//Connexion à la database
try {
    $database = new PDO('mysql:host=localhost;dbname=viking_park;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

//Récupérer la liste de tous les utilisateurs 
$reqAllUsers = $database->query("SELECT Id_User ,pseudo, role_user FROM userconnected ORDER BY role_user");
$allUsers = $reqAllUsers->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de tous les utilisateurs du Valhalla Park</title>

     <!-- Intégration de Bootstrap -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Intégration de mes scripts & styles -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="list-user.css">
</head>

<body>
    <!-- HEADER -->
    <?php include 'include/header.phtml' ?>

    <div class="container" id="list">
        <h2>Liste de tous les utilisateurs</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Pseudo</th>
                    <th>Role</th>
                    <th>Changer le rôle de l'utilisateur</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allUsers as $user) { ?>
                <tr>
                    <td><?php echo $user['pseudo']; ?> </td>
                    <td><?php if ($user['role_user'] == 1) { echo "admin"; }
                    else if ($user['role_user'] == 2) { echo "modérateur"; }
                    else { echo "visiteur"; } ?> </td>
                    <td><?php if ($user['role_user'] != 1) {
                        if ($user['role_user'] != 2) { ?>
                        <a href="dashboard/moderateur.php?id=<?php echo $user['Id_User']; ?>" class="btn btn-warning">Mettre modérateur</a>
                        <?php } else { ?>
                    <a href="dashboard/visiteur.php?id=<?php echo $user['Id_User']; ?>" class="btn btn-success">Mettre visiteur</a>
                    <?php } ?>
                <?php } ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

         <!-- SNACKBAR -->
    <div id="snackbar">
        <?php
        if (isset($_GET['moderator']) and $_GET['moderator'] == 'success') {
            echo 'Le changement a bien été effectué';
        }
        if (isset($_GET['visitor']) and $_GET['visitor'] == 'success') {
            echo 'Le changement a bien été effectué';
        }
        ?>
    </div>

    <!-- Script pour lancer le toast -->
    <script>
        function myFunction() {
            // Get the snackbar DIV
            var x = document.getElementById("snackbar");

            // Add the "show" class to DIV
            x.className = "show";

            // After 3 seconds, remove the show class from DIV
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }

        <?php if (isset($_GET['moderator']) and $_GET['moderator'] == 'success' or isset($_GET['visitor']) and $_GET['visitor'] == 'success') { ?>
            //Lance le snackbar au chargement de la page
            window.onload = myFunction;
        <?php } ?>
    </script>
    </div>
</body>

</html>