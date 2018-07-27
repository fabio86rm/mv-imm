<?php
define("HOST", "localhost"); // E' il server a cui ti vuoi connettere.
define("USER", "root"); // E' l'utente con cui ti collegherai al DB.
define("PASSWORD", ""); // Password di accesso al DB.
define("DATABASE", "mv_immobiliare"); // Nome del database.

// $configs = include("../../config/configDB.php");

// $host = $configs['host'];
// $username = $configs['username'];
// $password = $configs['password'];
// $database = $configs['database'];

// $mysqli = new mysqli($host, $username, $password, $database);

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
// Se ti stai connettendo usando il protocollo TCP/IP, invece di usare un socket UNIX, ricordati di aggiungere il parametro corrispondente al numero di porta.

/* disattiva autocommit */
$mysqli->autocommit(FALSE);

/* verifica la connessione */
if (mysqli_connect_errno()) {
    printf("Connessione fallita: %s\n", mysqli_connect_error());
    exit();
}

?>