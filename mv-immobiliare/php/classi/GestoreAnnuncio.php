<?php
class GestoreAnnuncio{
    
    private $tbl_annunci = "annunci";
    private $tbl_categorie = "categorie";
    private $tbl_annunci_categorie = "annunci_categorie";
    
    public function inserisciAnnuncio($nomePagineGallery){
        
        $allowed =  array('gif','png' ,'jpg');
        $fileName = $_FILES['fileInput']['name'];
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        //controllo la dimensione del file
        if ($_FILES['fileInput']['size'] > 5242880){
            $_SESSION['inserito'] = 'NOK';
            $_SESSION['messaggio'] = 'Immagine non inserita: Superata la dimensione massima consentita per il caricamento dei file!';
            throw new RuntimeException('Superata la dimensione massima consentita per il caricamento dei file.');
            //        echo "Dimensione troppo grande";
        }
        
        if (isset($_FILES['fileInput']) && in_array($ext,$allowed)) {
            
            // TODO gestire l'inserimento di un'immagine dentro la cartella con ID dell'annuncio
            
            if(move_uploaded_file($_FILES['fileInput']['tmp_name'], "../../imgAnnunci/" . $_FILES['fileInput']['name'])){
                
                $fileDescriptionShort = $_POST['fileDescriptionShort'];
                $fileDescriptionLong = $_POST['fileDescriptionLong'];
                $filePreview = 1;
                if (!isset($_POST['filePreview'])){
                    $filePreview = 0;
                }
                $filePath = 'imgAnnunci/'.$fileName;
                
                $sqlInsertImage = "INSERT INTO $tbl_annunci (NomeImmagine, DescrizioneBreve, DescrizioneCompleta, Path, Visualizzabile) VALUES ('$fileName','$fileDescriptionShort', '$fileDescriptionLong', '$filePath', $filePreview)";
                //			echo $sqlInsertImage;
                $resultInsertImage = $mysqli->query($sqlInsertImage);
                if($resultInsertImage){
                    $sqlSelectIdImg = "SELECT MAX(idImmagine) as ID FROM $tbl_annunci WHERE NomeImmagine='$fileName'"; // metto il MAX(idImmagine) in quanto l'id incrementa a ogni inserimento e siccome che potrebbero esserci immagini con lo stesso nome in quanto il nome non è chiave, allora quella che ho appena inserito è sicuramente quella con ID più grande
                    $resultIdImage = $mysqli->query($sqlSelectIdImg);
                    $rowIdImg = $resultIdImage->fetch_array(MYSQLI_ASSOC);
                    $sqlSelectIdPage = "SELECT idGallery as ID FROM $tbl_categorie WHERE NomeGallery='$nomePagineGallery'";
                    $resultIdPage = $mysqli->query($sqlSelectIdPage);
                    $rowIdPage = $resultIdPage->fetch_array(MYSQLI_ASSOC);
                    $sqlInsertIdImgIdPage = "INSERT INTO $tbl_annunci_categorie (idImmagine, idGallery) VALUES ($rowIdImg[ID], $rowIdPage[ID])";
                    //				echo $sqlInsertIdImgIdPage;
                    $resultInsertIdImgIdPage = $mysqli->query($sqlInsertIdImgIdPage);
                    if($resultInsertIdImgIdPage){
                        $mysqli->commit();
                        $_SESSION['inserito'] = 'OK';
                        $_SESSION['messaggio'] = 'Immagine inserita con successo';
                        //echo $_SESSION['inserito'] . " " . $_SESSION['messaggio'];
                    } else{
                        $mysqli->rollback();
                        $_SESSION['inserito'] = 'NOK';
                        $_SESSION['messaggio'] = 'Immagine non inserita';
                        //                    echo "Morto secondo inserimento";
                    }
                } else{
                    $mysqli->rollback();
                    $_SESSION['inserito'] = 'NOK';
                    $_SESSION['messaggio'] = 'Immagine non inserita';
                    //                echo "Morto primo inserimento";
                }
                
            } else {
                $_SESSION['messaggio'] = 'Immagine non inserita';
                //            echo "Morto nello spostamento";
            }
        } else if (!in_array($ext,$allowed)){
            $_SESSION['messaggio'] = "Formato ".$ext." non accettato. I formati sopportati sono: gif, png, jpg";
            //        echo "Immagine non accettata";
        } else {
            $_SESSION['messaggio'] = "Non ci sono file da caricare...";
            //        echo "Non è stato selezionata un'immagine";
        }
    }
    
    public function cancellaAnnuncio($nomePagineGallery){
        
        $nomePagineGallery = $_POST['idPagineGallery'];
        
        if(!isset($_POST['immagini'])){
            $sqlSelectIdPage = "SELECT idGallery as ID FROM $tbl_categorie WHERE NomeGallery='$nomePagineGallery'";
            $resultIdPage = $mysqli->query($sqlSelectIdPage);
            $rowIdPage = $resultIdPage->fetch_array(MYSQLI_NUM);
            
            $conn = null;
            header('Location: ../adminModifica.php?idGallery='.$rowIdPage[0]);
        }
        else{
            $immagini = $_POST['immagini'];
            $nImmagini = count($immagini);
            $idImgToDelete = '';
            for($i=0; $i < $nImmagini; $i++){
                $idImgToDelete = $idImgToDelete.$immagini[$i].',';
            }
            $idImgToDelete = rtrim($idImgToDelete, ",");
            $sqlDeleteImg = "DELETE FROM $tbl_annunci WHERE idImmagine IN ($idImgToDelete)";
            if($resultDelete = $mysqli->query($sqlDeleteImg)){
                $mysqli->rollback();
                $_SESSION['inserito'] = 'OK';
                $_SESSION['messaggio'] = 'Immagini cancellate con successo';
            } else{
                $mysqli->rollback();
                $_SESSION['inserito'] = 'NOK';
                $_SESSION['messaggio'] = 'Le immagini non sono state cancellate. Si prega di riprovare';
            }
            
            $conn = null;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    
}
?>