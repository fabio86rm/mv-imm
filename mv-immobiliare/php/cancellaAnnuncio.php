<?php
try {
    include 'util/utility.php';
    include("util/connDB.php");
    include("classi/GestoreAnnuncio.php");
    sec_session_start();
    
    if(!isset($_POST['idAnnuncio'])){
//         echo "idAnnuncio non impostato";
        $nomeCategoria = $_POST['categoriaAnnuncio'];
        
        if($nomeCategoria!="Tutte"){
            $sqlSelectIdCategoria = "SELECT idCategoria as ID FROM categorie WHERE nomeCategoria='$nomeCategoria'";
            $resultIdCategoria = $mysqli->query($sqlSelectIdCategoria);
            $rowIdCategoria = $resultIdCategoria->fetch_array(MYSQLI_NUM);
        } else {
            $rowIdCategoria = array("0");
        }
        
        $idCategoria = $rowIdCategoria[0];
    } else {
//         echo "idAnnuncio impostato: ".$_POST['idAnnuncio'];
        $idCategoria = $_POST['idCategoria'];
        $gestoreAnnuncio = new GestoreAnnuncio();
        $gestoreAnnuncio->cancellaAnnuncio($mysqli);
    }
    
} catch(Exception $e) {
    echo "<script type='text/javascript'>alert('ERROR: Input data is fail: '".$e->getMessage().")</script>";
}

$conn = null;
header('Location: ../mv-admin/adminModifica.php?idCategoria='.$idCategoria);

?> 