<?php
include 'utility.php';
sec_session_start();

//$email = 'c.ranieri7@gmail.com';
	$_SESSION['inviato'] = 'ERROR';
 
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $oggetto = $_POST['subject'];
    $testo= $_POST['message'];

//echo 'Nome: '.$nome.'<br/>Email: '.$mail.'<br/>Oggetto: '.$oggetto.'<br/>Messaggio: '.$testo;

//if(!$risultato = ereg("^[^@ ]+@[^@ ]+\.[^@ \.]+$", $email)){
if(!chkEmail($email)){
    //echo "$email non è un un indirizzo mail valido";
	$_SESSION['inviato'] = ' Indirizzo mail non valido';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else{
 
    $messaggio="";
    $messaggio .= "Un utente ha richiesto informazioni dal modulo contatti di MV Servizi Immobiliari.it.\nSeguono i dati inviati\n\nNome: ";
    $messaggio .= "$nome";
    $messaggio .= "\nMail: ";
    $messaggio .= "$email";
    $messaggio .= "\nTesto messaggio: ";
    $messaggio .= "$testo";
 
    $dest = "c.ranieri7@gmail.com";
 
    //invio la mail
    mail($dest, $oggetto, $messaggio);
	$_SESSION['inviato'] = 'OK';
 
    //con questo faccio il redirect alla pagina "contatti.html" dopo aver inviato la mail
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>