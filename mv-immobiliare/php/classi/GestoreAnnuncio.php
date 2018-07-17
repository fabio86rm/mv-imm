<?php
class GestoreAnnuncio{
    
    private $tbl_annunci = "annunci";
    private $tbl_categorie = "categorie";
    private $tbl_annunci_categorie = "annunci_categorie";
    private $tbl_immagini_annuncio = "immagini_annuncio";
    
    private $errorMsg = "";
    
    public function inserisciAnnuncio($mysqli){
        
        $categoriaAnnuncio = $_POST['categoriaAnnuncio'];
        
        $citta = $_POST['citta'];
        $indirizzo = $_POST['indirizzo'];
        $prezzo = $_POST['prezzo'];
        $descrizioneAnnuncio = $_POST['descrizioneAnnuncio'];
        $numStanze = $_POST['stanze'];
        
        extract($_POST);
        
            
        $sqlInsertAnnuncio = "INSERT INTO $this->tbl_annunci (citta, indirizzo, prezzo, descrizione, num_stanze) VALUES ('$citta','$indirizzo',$prezzo,'$descrizioneAnnuncio', $numStanze)";
        echo $sqlInsertAnnuncio;
        $resultInsertAnnuncio = $mysqli->query($sqlInsertAnnuncio);
        if(!$resultInsertAnnuncio){
            $mysqli->rollback();
            $_SESSION['inserito'] = "NOK";
            $_SESSION['messaggio'] = "Errore durante la creazione dell'annuncio";
            die("Errore durante l'inserimento dell'annuncio");
        }
        
        $idAnnuncio = $mysqli->insert_id;
        
        $sqlIdCategoria = "SELECT idCategoria as ID FROM $this->tbl_categorie WHERE nomeCategoria='$categoriaAnnuncio'";
        echo $sqlIdCategoria;
        $resultIdCategoria = $mysqli->query($sqlIdCategoria);
        $rowIdCategoria = $resultIdCategoria->fetch_array(MYSQLI_ASSOC);
        
        $sqlInsertIdAnnIdCtg = "INSERT INTO $this->tbl_annunci_categorie (idAnnuncio, idCategoria) VALUES ($idAnnuncio, $rowIdCategoria[ID])";
        echo $sqlInsertIdAnnIdCtg;
        $resultInsertIdAnnIdCtg = $mysqli->query($sqlInsertIdAnnIdCtg);
        if(!$resultInsertIdAnnIdCtg){
            $mysqli->rollback();
            $_SESSION['inserito'] = "NOK";
            $_SESSION['messaggio'] = "Errore durante la creazione dell'annuncio";
            die("Errore durante l'inserimento della categoria dell'annuncio");
        }
        
        $cartellaAnnuncio = "imgAnnunci/$idAnnuncio";
        if (!mkdir('../'.$cartellaAnnuncio, 0777, true)) {
            echo "Errore durante la creazione della cartella dell\'annuncio con ID $idAnnuncio";
        }
        
        if(!$this->inserisciImmagini($mysqli, $idAnnuncio, $cartellaAnnuncio)){
            $mysqli->rollback();
            $_SESSION['inserito'] = 'NOK';
            $_SESSION['messaggio'] = 'Errore durante l\'inserimento dell\'annuncio: '.$this->errorMsg;
            throw new RuntimeException('Superata la dimensione massima consentita per il caricamento dei file.');
//             echo "Dimensione troppo grande";
        } else {
            $mysqli->commit();
            $_SESSION['inserito'] = 'OK';
            $_SESSION['messaggio'] = 'Annuncio inserito con successo';
            echo $_SESSION['inserito'] . " " . $_SESSION['messaggio'];
        }
            
    }
    
    public function inserisciImmagini($mysqli, $idAnnuncio, $cartellaAnnuncio){
        
        $imgInserite = true; // se un'immagine non dovesse essere inserita correttamente, è false
        
        $target_path = '../'.$cartellaAnnuncio.'/'; // path delle immagini da caricare
        $descrizioni = $_POST['descrizioneImmagine'];
        $i = 0;
        foreach($descrizioni as $index => $value){
            $descrizioneImmagine = $descrizioni[$index];
            $validextensions = array("jpeg","jpg","png","gif"); // estensioni delle immagini accettate.
            $ext = explode('.', basename($_FILES['file']['name'][$i])); // estensione
            $nomeImmagine = md5(uniqid()) . "." . $ext[count($ext) - 1];
//             echo "Nome dell'immagine: ".$nomeImmagine."<br/>";
//             echo "TargetPath: ".$target_path."<br/>";
            $file_extension = end($ext); // Store extensions in the variable.
            $target_path = $target_path . $nomeImmagine;     // imposta il path con un nuovo nome dell'immagine.
            if (($_FILES["file"]["size"][$i] < 5000000)     // Approx. i file non devono avere una dimensione maggiore di 5Mb.
                && in_array($file_extension, $validextensions)) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
                        // Se il file è stato caricato nella cartella, faccio l'inserimento nel DB
                        $sqlInsertIdImgIdAnn = "INSERT INTO $this->tbl_immagini_annuncio (idAnnuncio, path_immagine, descrizione_immagine) VALUES ($idAnnuncio, '$cartellaAnnuncio/$nomeImmagine', '$descrizioneImmagine')";
//                         echo $sqlInsertIdImgIdAnn;
                        $resultInsertIdImgIdAnn = $mysqli->query($sqlInsertIdImgIdAnn);
                        if(!$resultInsertIdImgIdAnn){
                            // Se non è andato a buon fine l'inserimento nel DB
                            $this->errorMsg = "Errore durante l'inserimento dell'immagine nel database";
                            return false;
                        }
                    } else {
                        // Se il file non è stato caricato correttamente nella cartella
                        $this->errorMsg = "Errore durante il caricamente dell'immagine";
                        $imgInserite = false;
                    }
            } else {
                // Se il file ha dimensione o tipo non corretti
                $this->errorMsg = "Dimensione o tipo dell'immagine non validi";
                $imgInserite = false;
            }
            $i++;
        }
        
        return $imgInserite;
    }
    
    
    public function cancellaAnnuncio($mysqli){
        
        $nomePagineGallery = $_POST['idPagineGallery'];
        
        if(!isset($_POST['immagini'])){
            $sqlSelectIdPage = "SELECT idGallery as ID FROM $this->tbl_categorie WHERE NomeGallery='$nomePagineGallery'";
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
            $sqlDeleteImg = "DELETE FROM $this->tbl_annunci WHERE idImmagine IN ($idImgToDelete)";
            if($resultDelete = $mysqli->query($sqlDeleteImg)){
                $mysqli->rollback();
                $_SESSION['inserito'] = 'OK';
                $_SESSION['messaggio'] = 'Immagini cancellate con successo';
            } else{
                $mysqli->rollback();
                $_SESSION['inserito'] = 'NOK';
                $_SESSION['messaggio'] = 'Le immagini non sono state cancellate. Si prega di riprovare';
            }
        }
    }
    
}
?>