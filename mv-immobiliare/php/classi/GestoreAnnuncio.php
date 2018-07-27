<?php

require_once 'classi/class.upload.php';
include_once 'util/constants.php';

class GestoreAnnuncio{
    
    private $tbl_annunci = "annunci";
    private $tbl_categorie = "categorie";
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
        
        $sqlIdCategoria = "SELECT idCategoria as ID FROM $this->tbl_categorie WHERE nomeCategoria='$categoriaAnnuncio'";
        echo $sqlIdCategoria."<br/>";
        $resultIdCategoria = $mysqli->query($sqlIdCategoria);
        $rowIdCategoria = $resultIdCategoria->fetch_array(MYSQLI_ASSOC);
        
        $citta = str_replace("'","\'",$citta);
        $indirizzo = str_replace("'","\'",$indirizzo);
        $descrizioneAnnuncio = str_replace("'","\'",$descrizioneAnnuncio);
        
        $sqlInsertAnnuncio = "INSERT INTO $this->tbl_annunci (idCategoria, citta, indirizzo, prezzo, descrizione, num_stanze) VALUES ($rowIdCategoria[ID], '$citta','$indirizzo',$prezzo,'$descrizioneAnnuncio', $numStanze)";
        echo $sqlInsertAnnuncio."<br/>";
        $resultInsertAnnuncio = $mysqli->query($sqlInsertAnnuncio);
        if(!$resultInsertAnnuncio){
            $mysqli->rollback();
            $_SESSION['inserito'] = "NOK";
            $_SESSION['messaggio'] = "Errore durante la creazione dell'annuncio";
            die("Errore durante l'inserimento dell'annuncio");
        }
        
        $idAnnuncio = $mysqli->insert_id;
        
        $cartellaAnnuncio = "imgAnnunci/$idAnnuncio";
        if (!mkdir('../'.$cartellaAnnuncio, 0777, true)) {
            echo "Errore durante la creazione della cartella dell\'annuncio con ID $idAnnuncio";
        }
        
//         if(!$this->inserisciImmagini($mysqli, $idAnnuncio, $cartellaAnnuncio)){
        if(!$this->spostaRidimensionaImmagine($mysqli, $idAnnuncio, $cartellaAnnuncio)){
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
        
        $descrizioni = $_POST['descrizioneImmagine'];
        echo "Numero di immagini: ".sizeof($descrizioni)."<br/>";
        $i = 0;
        foreach($descrizioni as $index => $value){
            $target_path = '../'.$cartellaAnnuncio.'/'; // path delle immagini da caricare
            $descrizioneImmagine = $descrizioni[$index];
            $descrizioneImmagine = str_replace("'","\'",$descrizioneImmagine);
            $validextensions = array("jpeg","jpg","png","gif"); // estensioni delle immagini accettate.
            $ext = explode('.', basename($_FILES['file']['name'][$index])); // estensione
            $nomeImmagine = md5(uniqid(rand(), true)) . "." . $ext[count($ext) - 1];
            $nomeImmaginePiccola = substr($nomeImmagine,0,strrpos($nomeImmagine,'.')).'_800'.substr($nomeImmagine,strrpos($nomeImmagine,'.'));
            $file_extension = end($ext); // Store extensions in the variable.
            $this->spostaRidimensionaImmagine($cartellaAnnuncio, $nomeImmagine, $nomeImmaginePiccola);
            echo "Nome tmp dell'immagine: ".$_FILES['file']['tmp_name'][$index]."<br/>";
            echo "Nome dell'immagine: ".$_FILES['file']['name'][$index]."<br/>";
            echo "Nome creato dell'immagine: $nomeImmagine<br/>";
            echo "TargetPath: $target_path<br/>";
            echo "Estensione file: $file_extension<br/>";
            echo "Descrizione: $descrizioneImmagine<br/>";
            $target_path = $target_path . $nomeImmagine;     // imposta il path con un nuovo nome dell'immagine.
            echo "Nome creato dell'immagine piccola: $nomeImmaginePiccola<br/>";
//             if(strlen($_FILES['file']['name'][$i]) > 0){
//                 if (($_FILES["file"]["size"][$i] < 5000000)     // Approx. i file non devono avere una dimensione maggiore di 5Mb.
//                     && in_array(strtolower($file_extension), $validextensions)) {
//                         if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
//                             // Se il file è stato caricato nella cartella, faccio l'inserimento nel DB
//                             $sqlInsertIdImgIdAnn = "INSERT INTO $this->tbl_immagini_annuncio (idAnnuncio, path_immagine, descrizione_immagine) VALUES ($idAnnuncio, '$cartellaAnnuncio/$nomeImmagine', '$descrizioneImmagine')";
//                             echo $sqlInsertIdImgIdAnn."<br/>";
//                             $resultInsertIdImgIdAnn = $mysqli->query($sqlInsertIdImgIdAnn);
//                             if(!$resultInsertIdImgIdAnn){
//                                 // Se non è andato a buon fine l'inserimento nel DB
//                                 echo "Errore durante l'inserimento dell'immagine nel database";
//                                 $this->errorMsg = "Errore durante l'inserimento dell'immagine nel database";
//                                 return false;
//                             }
//                         } else {
//                             // Se il file non è stato caricato correttamente nella cartella
//                             echo "Errore durante il caricamento dell'immagine";
//                             $this->errorMsg = "Errore durante il caricamente dell'immagine";
//                             $imgInserite = false;
//                         }
//                 } else {
//                     // Se il file ha dimensione o tipo non corretti
//                     echo "Dimensione o tipo dell'immagine non validi";
//                     $this->errorMsg = "Dimensione o tipo dell'immagine non validi";
//                     $imgInserite = false;
//                 }
//             }
            $i++;
        }
        
        echo "Immagini inserite con successo!";
        
        return $imgInserite;
    }
    
    
//     public function spostaRidimensionaImmagine($cartellaAnnuncio, $nomeImmagine, $nomeImmaginePiccola){
    public function spostaRidimensionaImmagine($mysqli, $idAnnuncio, $cartellaAnnuncio){
        // esempio preso da https://www.verot.net/php_class_upload.htm
        $file_ary = $this->reArrayFiles($_FILES['file']);
        $descrizioni = $_POST['descrizioneImmagine'];
        $index = 0;
        foreach ($file_ary as $file) {
            
            $descrizioneImmagine = $descrizioni[$index];
            $descrizioneImmagine = str_replace("'","\'",$descrizioneImmagine);
            echo "Descrizione: $descrizioneImmagine<br/>";
            $index++;
            
            
            $ext = explode('.', basename($file['name'])); // estensione
//             $nomeImmagine = md5(uniqid(rand(), true)) . "." . $ext[count($ext) - 1];
            $nomeImmagine = md5(uniqid(rand(), true));
//             $nomeImmagineVetrina = $nomeImmagine.'_420';
//             $nomeImmagineInVendita = $nomeImmagine.'_300';
            
            $filename = $file['tmp_name'];
            list($width, $height) = getimagesize($filename);
            $dim_x_vetrina = 0;
            $dim_y_vetrina = 0;
            $dim_x_in_vendita = 0;
            $dim_y_in_vendita = 0;
//             if ($width > $height) {
//                 // Landscape
//                 $dim_x_vetrina = 420;
//                 $dim_y_vetrina = 316;
//                 $dim_x_in_vendita = 300;
//                 $dim_y_in_vendita = 225;
//             } else {
//                 // Portrait or Square
//                 $dim_x_vetrina = 316;
//                 $dim_y_vetrina = 420;
//                 $dim_x_in_vendita = 225;
//                 $dim_y_in_vendita = 300;
//             }
            
            $dim_x_vetrina = DIM_X_VETRINA;
            $dim_y_vetrina = DIM_Y_VETRINA;
            $dim_x_in_vendita = DIM_X_IN_VENDITA;
            $dim_y_in_vendita = DIM_Y_IN_VENDITA;
            
            $handle = new upload($file);
            if ($handle->uploaded) {
                $handle->file_new_name_body   = $nomeImmagine;
                $handle->Process('../'.$cartellaAnnuncio.'/');
                if ($handle->processed) {
                    echo 'original image copied';
                } else {
                    echo 'error : ' . $handle->error;
                }
                // creazione immagine per "in vetrina"
//                 $handle->file_new_name_body   = $nomeImmagineVetrina;
                $handle->image_resize         = true;
                $handle->image_x              = $dim_x_vetrina;
                $handle->image_y              = $dim_y_vetrina;
                //         $handle->image_ratio_y        = true;
                $handle->process('../'.$cartellaAnnuncio.'/'.$dim_x_vetrina.'x'.$dim_y_vetrina.'/');
                if ($handle->processed) {
                    echo 'image resized';
                } else {
                    echo 'error : ' . $handle->error;
                }
                // creazione immagine per "in vendita"
//                 $handle->file_new_name_body   = $nomeImmagineInVendita;
                $handle->image_resize         = true;
                $handle->image_x              = $dim_x_in_vendita;
                $handle->image_y              = $dim_y_in_vendita;
                //         $handle->image_ratio_y        = true;
                $handle->process('../'.$cartellaAnnuncio.'/'.$dim_x_in_vendita.'x'.$dim_y_in_vendita.'/');
                if ($handle->processed) {
                    echo 'image resized';
                    $handle->clean();
                } else {
                    echo 'error : ' . $handle->error;
                }
            }
            
            $sqlInsertIdImgIdAnn = "INSERT INTO $this->tbl_immagini_annuncio (idAnnuncio, path_immagine, descrizione_immagine) VALUES ($idAnnuncio, '$cartellaAnnuncio/$nomeImmagine".".".$ext[count($ext) - 1]."', '$descrizioneImmagine')";
            echo $sqlInsertIdImgIdAnn."<br/>";
            $resultInsertIdImgIdAnn = $mysqli->query($sqlInsertIdImgIdAnn);
//             $sqlInsertIdImgVetrinaIdAnn = "INSERT INTO $this->tbl_immagini_annuncio (idAnnuncio, path_immagine, descrizione_immagine) VALUES ($idAnnuncio, '$cartellaAnnuncio/$nomeImmagineVetrina".".".$ext[count($ext) - 1]."', '$descrizioneImmagine')";
//             echo $sqlInsertIdImgVetrinaIdAnn."<br/>";
//             $resultInsertIdImgVetrinaIdAnn = $mysqli->query($sqlInsertIdImgVetrinaIdAnn);
//             $sqlInsertIdImgInVenditaIdAnn = "INSERT INTO $this->tbl_immagini_annuncio (idAnnuncio, path_immagine, descrizione_immagine) VALUES ($idAnnuncio, '$cartellaAnnuncio/$nomeImmagineInVendita".".".$ext[count($ext) - 1]."', '$descrizioneImmagine')";
//             echo $sqlInsertIdImgInVenditaIdAnn."<br/>";
//             $resultInsertIdImgInVenditaIdAnn = $mysqli->query($sqlInsertIdImgInVenditaIdAnn);
            if(!$resultInsertIdImgIdAnn){
                // Se non è andato a buon fine l'inserimento nel DB
                echo "Errore durante l'inserimento dell'immagine nel database";
                $this->errorMsg = "Errore durante l'inserimento dell'immagine nel database";
                return false;
            }
        }
        
        return true;
    }
    
    function reArrayFiles(&$file_post) {
        
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);
        
        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        
        return $file_ary;
    }
    
    
    public function cancellaAnnuncio($mysqli){
        
        $idAnnuncio = $_POST['idAnnuncio'];
        $cartellaAnnuncio = "imgAnnunci/$idAnnuncio";
        
        $sqlCancellaAnnuncio = "DELETE FROM $this->tbl_annunci WHERE idAnnuncio=$idAnnuncio";
        $sqlCancellaImmagini = "DELETE FROM $this->tbl_immagini_annuncio WHERE idAnnuncio=$idAnnuncio";
        echo "Query per cancellare annuncio: ".$sqlCancellaAnnuncio."<br/>";
        echo "Query per cancellare immagini: ".$sqlCancellaImmagini."<br/>";
        echo "Cartella da cui cancellare immagini: ".$cartellaAnnuncio."<br/>";
        $this->cancellaCartella($cartellaAnnuncio);
        $resultcancellaAnnuncio = $mysqli->query($sqlCancellaAnnuncio);
        $resultCancellaImmagini = $mysqli->query($sqlCancellaImmagini);
        if($resultcancellaAnnuncio && $resultCancellaImmagini){
            $mysqli->commit();
            $_SESSION['inserito'] = 'OK';
            $_SESSION['messaggio'] = 'Immagini cancellate con successo';
        } else{
            $mysqli->rollback();
            $_SESSION['inserito'] = 'NOK';
            $_SESSION['messaggio'] = 'Le immagini non sono state cancellate. Si prega di riprovare';
        }
        
    }
    
    public static function cancellaCartella($cartellaAnnuncio) {
        $dir = '../'.$cartellaAnnuncio;
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
            RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
                echo "cartella cancellata<br/>";
            } else {
                unlink($file->getRealPath());
                echo "file cancellati<br/>";
            }
        }
        rmdir($dir);
    }
    
    public function modificaAnnuncio($mysqli){
        $idAnnuncio = $_POST['idAnnuncio'];
        $cartellaAnnuncio = "imgAnnunci/$idAnnuncio";
        
        $categoriaAnnuncio = $_POST['categoriaAnnuncio'];
        
        $citta = $_POST['citta'];
        $indirizzo = $_POST['indirizzo'];
        $prezzo = $_POST['prezzo'];
        $descrizioneAnnuncio = $_POST['descrizioneAnnuncio'];
        $numStanze = $_POST['stanze'];
        
        $citta = str_replace("'","\'",$citta);
        $indirizzo = str_replace("'","\'",$indirizzo);
        $descrizioneAnnuncio = str_replace("'","\'",$descrizioneAnnuncio);
        
        $sqlAggiornaAnnuncio = "UPDATE $this->tbl_annunci SET idCategoria=(SELECT idCategoria FROM categorie WHERE nomeCategoria='$categoriaAnnuncio'), citta='$citta', ".
                                " indirizzo='$indirizzo', prezzo=$prezzo, descrizione='$descrizioneAnnuncio', num_stanze=$numStanze WHERE idAnnuncio=$idAnnuncio";
        $sqlCancellaImmagini = "DELETE FROM $this->tbl_immagini_annuncio WHERE idAnnuncio=$idAnnuncio";
        echo "Query per aggiornare l'annuncio: ".$sqlAggiornaAnnuncio."<br/>";
        echo "Query per cancellare immagini: ".$sqlCancellaImmagini."<br/>";
        echo "Cartella da cui cancellare immagini: ".$cartellaAnnuncio."<br/>";
        $this->cancellaCartella($cartellaAnnuncio);
        echo "cartella cancellata<br/>";
        $resultcancellaAnnuncio = $mysqli->query($sqlAggiornaAnnuncio);
        echo "query di cancellazione annuncio eseguita<br/>";
        $resultCancellaImmagini = $mysqli->query($sqlCancellaImmagini);
        echo "query di cancellazione immagini eseguita<br/>";
        
        if (!mkdir('../'.$cartellaAnnuncio, 0777, true)) {
            echo "Errore durante la creazione della cartella dell\'annuncio con ID $idAnnuncio<br/>";
            $_SESSION['inserito'] = 'NOK';
            $_SESSION['messaggio'] = 'Errore durante la creazione della cartella delle immagini';
            throw new RuntimeException('Errore durante la creazione della cartella delle immagini.');
        } else {
            echo "Cartella creata con successo!<br/>";
        }
        
        if(!$this->inserisciImmagini($mysqli, $idAnnuncio, $cartellaAnnuncio) && $resultcancellaAnnuncio && $resultCancellaImmagini){
            $mysqli->rollback();
            $_SESSION['inserito'] = 'NOK';
            $_SESSION['messaggio'] = 'Errore durante l\'aggiornamento dell\'annuncio: '.$this->errorMsg;
            throw new RuntimeException('Errore durante l\'aggiornamento dell\'annuncio.');
            //             echo "Dimensione troppo grande";
        } else {
            $mysqli->commit();
            $_SESSION['inserito'] = 'OK';
            $_SESSION['messaggio'] = 'Annuncio aggiornato con successo';
            echo $_SESSION['inserito'] . " " . $_SESSION['messaggio'];
        }
        
    }
    
}
?>