<?php
include 'connDB.php';
include 'functions.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura

if(isset($_POST['username'], $_POST['password'])) {
    
    $_SESSION['esito'] = 'OK';
    
    $myusername=$_POST['username'];
    $mypassword=$_POST['password'];
    // per il login di Porfido:
    // username = porfidoAdmin
    // password = admin123456
    // per inserire un nuovo utente:
    // INSERT INTO `utenti` VALUES(1,'profidoAdmin',AES_ENCRYPT('admin123456','MariaLara88'))
    if(login($myusername, $mypassword, $mysqli, false) == true) {
        // Login eseguito
        header('Location: ../admin.php');
        $_SESSION['entrato'] = 'OK';
        //echo 'Entrato';
    } else {
        // Login fallito
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        //echo 'Non entrato';
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}
?>
?>