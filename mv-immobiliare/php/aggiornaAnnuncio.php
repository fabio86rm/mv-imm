<?php
try {
    include 'util/utility.php';
    include("util/connDB.php");
    include("classi/GestoreAnnuncio.php");
    sec_session_start();
    
    $gestoreAnnuncio = new GestoreAnnuncio();
    $gestoreAnnuncio->modificaAnnuncio($mysqli);
    
} catch(Exception $e) {
    echo "<script type='text/javascript'>alert('ERROR: Input data is fail: '".$e->getMessage().")</script>";
}

// $conn = null;
// header('Location: ' . $_SERVER['HTTP_REFERER']);

?> 