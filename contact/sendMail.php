<?php 
    mail('jeff.gbeho@gmail.com', $_POST['sujet'], $_POST['message'], 'From : ' + $_POST['email']);

    header ('Location: ../contact.phtml?envoi=valide');
?>