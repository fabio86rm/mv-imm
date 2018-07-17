<?php
try {
    include 'util/functions.php';
    include("util/connDB.php");
    sec_session_start();
    
    $nomePagineGallery = $_POST['idPagineGallery'];
    
    $gestoreAnnuncio = new GestoreAnnuncio();
    $gestoreAnnuncio->cancellaAnnuncio($nomePagineGallery);
    
}catch(Exception $e) {
    echo "<script type='text/javascript'>alert('ERROR: Input data is fail: '".$e->getMessage().")</script>";
}

?> 