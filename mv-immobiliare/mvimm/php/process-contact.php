<?php
include 'functions.php';
sec_session_start();;

function chkEmail($email)
{
	// elimino spazi, "a capo" e altro alle estremità della stringa
	$email = trim($email);

	// se la stringa è vuota sicuramente non è una mail
	if(!$email) {
		return false;
	}

	// controllo che ci sia una sola @ nella stringa
	$num_at = count(explode( '@', $email )) - 1;
	if($num_at != 1) {
		return false;
	}

	// controllo la presenza di ulteriori caratteri "pericolosi":
	if(strpos($email,';') || strpos($email,',') || strpos($email,' ')) {
		return false;
	}

	// la stringa rispetta il formato classico di una mail?
	if(!preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $email)) {
		return false;
	}

	return true;
}

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