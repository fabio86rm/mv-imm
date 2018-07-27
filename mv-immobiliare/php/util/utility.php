<?php
//Dovrai richiamare questa funzione all'inizio di ogni pagina che abbia la necessità di accedere ad una variabile di sessione
function sec_session_start() {
        $session_name = 'sec_session_id'; // Imposta un nome di sessione
        $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
        $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
        ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
        $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
        session_start(); // Avvia la sessione php.
        session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
}

function login($username, $password, $mysqli, $effettuaCheckBrute) {
    // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
	$stmt = $mysqli->prepare("SELECT idUtente FROM utenti WHERE username = ?  and password=AES_ENCRYPT(?,'MariaLara88') LIMIT 1");
	$stmt->bind_param("ss", $username, $password); // esegue il bind dei parametri '$username' e '$password'.
    $stmt->execute(); // esegue la query appena creata.
    $stmt->store_result();
	$stmt->bind_result($idUtente); // recupera il risultato della query e lo memorizza nelle relative variabili.
    $stmt->fetch();
	$stmt->close();
	
	if ($idUtente != null){
		// se idUtente non è vuoto, allora vuol dire che l'utente è giusto
        // verifichiamo che non sia disabilitato in seguito all'esecuzione di troppi tentativi di accesso errati.
        if(checkbrute($idUtente, $mysqli) == true) { 
		  // Account disabilitato
		  // Invia un e-mail all'utente avvisandolo che il suo account è stato disabilitato.
		  $_SESSION['esito'] = 'WARN';
		  $_SESSION['messaggioLogin'] = "L'account è stato momentaneamente disabilitato!";
		  return false;
        } else {
			// Password corretta!
			$user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.
			
			$idUtente = preg_replace("/[^0-9]+/", "", $idUtente); // ci proteggiamo da un attacco XSS
			$_SESSION['id'] = $idUtente; 
			$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
			$_SESSION['nome'] = $username;
			$_SESSION['login_string'] = hash('sha512', $password.$user_browser);
			// Login eseguito con successo.
			return true;
	    }
    } else {
		// Password incorretta.
		// Registriamo il tentativo fallito nel database.
		$idUtente = null;
		$stmt = $mysqli->prepare("SELECT idUtente FROM utenti WHERE username=? LIMIT 1");
        $stmt->bind_param('s', $username); // esegue il bind dei parametri '$username' e '$password'.
        $stmt->execute(); // esegue la query appena creata.
        $stmt->store_result();
	    $stmt->bind_result($idUtente); // recupera il risultato della query e lo memorizza nelle relative variabili.
		$stmt->fetch();
		$stmt->close();
		if ($idUtente != null && $effettuaCheckBrute){
			$now = time();
			$mysqli->query("INSERT INTO login_attempts (idUtente, time) VALUES ('$idUtente', '$now')");
			$mysqli->commit();
			$_SESSION['esito'] = 'NOK';
			$_SESSION['messaggioLogin'] = "Nome Utente e/o Password errati!";
			//header('Location: ' . $_SERVER['HTTP_REFERER']);
			return false;
		} else { 
			// L'utente inserito non esiste
			$_SESSION['esito'] = 'NOK';
			$_SESSION['messaggioLogin'] = "Utente non esistente!";
			//header('Location: ' . $_SERVER['HTTP_REFERER']);
			return false;
		}
	}
}

//se un utente esegue 5 tentativi di login errati consecutivi, il suo account viene disabilitato. Anche tramite CAPTCHA può essere evitato
function checkbrute($idUtente, $mysqli) {
   // Recupero il timestamp
   $now = time();
   // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
   $valid_attempts = $now - (2 * 60 * 60);
   if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE idUtente = ? AND time > '$valid_attempts'")) { 
      $stmt->bind_param('i', $idUtente); 
      // Eseguo la query creata.
      $stmt->execute();
      $stmt->store_result();
      // Verifico l'esistenza di più di 5 tentativi di login falliti.
      if($stmt->num_rows > 5) {
         return true;
      } else {
         return false;
      }
   }
}

//Verifica lo stato del login
function login_check($mysqli) {
   // Verifica che tutte le variabili di sessione siano impostate correttamente
   if(isset($_SESSION['id'], $_SESSION['nome'], $_SESSION['login_string'])) {
     $idUtente = $_SESSION['id'];
     $login_string = $_SESSION['login_string'];
     $username = $_SESSION['nome'];     
     $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
     if ($stmt = $mysqli->prepare("SELECT AES_DECRYPT(Password,'MariaLara88') as password FROM utenti WHERE idUtente = ? LIMIT 1")) { 
        $stmt->bind_param('i', $idUtente); // esegue il bind del parametro '$idUtente'.
        $stmt->execute(); // Esegue la query creata.
        $stmt->store_result();
 
        if($stmt->num_rows == 1) { // se l'utente esiste
           $stmt->bind_result($password); // recupera le variabili dal risultato ottenuto.
		   echo "$password";
           $stmt->fetch();
           $login_check = hash('sha512', $password.$user_browser);
           if($login_check == $login_string) {
              // Login eseguito!!!!
              return true;
           } else {
              //  Login non eseguito
			  return false;
           }
        } else {
            // Login non eseguito
			return false;
        }
     } else {
        // Login non eseguito
		return false;
     }
   } else {
     // Login non eseguito
	 return false;
   }
}

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

// metodo che permettei determinare la root
function determineRootFolder() {
    $rootPath = getenv('ROOT_PATH');
    if ($rootPath == null) {
        $root = $_SERVER['DOCUMENT_ROOT'] . '/';
    }
    else
    {
        $path = explode('?', $_SERVER['REQUEST_URI']);
        $pathArray = explode('/', $path[0]);
        unset($pathArray[0], $pathArray[1]);
        $howDeep = null;
        foreach ($pathArray as $pathCount) {
            $howDeep .= '../';
        }
        $root = dirname(__FILE__) . $howDeep;
        if ($howDeep == "../") {
            $root = null;
        }
    }
    
    return $root;
}

?>