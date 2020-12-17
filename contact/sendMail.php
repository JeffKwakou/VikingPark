<?php 
if(isset($_POST['sujet']) OR isset($_POST['message']) OR isset($_POST['email'])) {
    if ($_POST['sujet'] == "" OR $_POST['message'] == "" OR $_POST['email'] == "") {
        header ('Location: ../contact.phtml?message=error');
    } else {
        mail('jeff.gbeho@gmail.com', $_POST['sujet'], $_POST['message'], 'From : ' . $_POST['email']);

        header ('Location: ../contact.phtml?message=valide');        
    }    
}
