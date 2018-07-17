<?php
class GestoreAnnuncio{
    
    private $tbl_annunci = "annunci";
    private $tbl_categorie = "categorie";
    private $tbl_annunci_categorie = "annunci_categorie";
    private $tbl_immagini_annuncio = "immagini_annuncio";
    
    private $errorMsg = "";
    
    public function inserisciAnnuncio($mysqli){
        
        $numMaxImmagini = 100;
        
        $categoriaAnnuncio = $_POST['categoriaAnnuncio'];
        
        $citta = $_POST['citta'];
        $indirizzo = $_POST['indirizzo'];
        $prezzo = $_POST['prezzo'];
        $descrizioneAnnuncio = $_POST['descrizioneAnnuncio'];
        $numStanze = $_POST['stanze'];
        
//         $descrizioneImmagine = $_POST['descrizioneImmagine'];
        
        extract($_POST);
        $error=array();
        $extension=array("jpeg","jpg","png","gif");
        
            
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
            //        echo "Dimensione troppo grande";
        } else {
            $mysqli->commit();
            $_SESSION['inserito'] = 'OK';
            $_SESSION['messaggio'] = 'Annuncio inserito con successo';
            echo $_SESSION['inserito'] . " " . $_SESSION['messaggio'];
        }
//         for($i = 0; $i <= $numMaxImmagini; $i++){
//             if (isset($_FILES["immagine".$i]['tmp_name']) && is_uploaded_file($_FILES["immagine".$i]['tmp_name'])){
//                 //controllo la dimensione del file
//                 if ($_FILES["immagine".$i]['size'] > 5242880){
//                     $mysqli->rollback();
//                     $_SESSION['inserito'] = 'NOK';
//                     $_SESSION['messaggio'] = 'Immagine non inserita: Superata la dimensione massima consentita per il caricamento dei file!';
//                     throw new RuntimeException('Superata la dimensione massima consentita per il caricamento dei file.');
//                     //        echo "Dimensione troppo grande";
//                 }
//                 foreach($_FILES["immagine".$i]["tmp_name"] as $key=>$tmp_name)
//                 {
                
//                     $nomeFileImmagine = $_FILES["immagine".$i]['name'][$key];
//                     $file_tmp = $_FILES["immagine".$i]["tmp_name"][$key];
//                     $ext = pathinfo($nomeFileImmagine,PATHINFO_EXTENSION);
                    
//                     if(in_array($ext,$extension))
//                     {
//                         if(!file_exists("../$cartellaAnnuncio/".$nomeFileImmagine))
//                         {
//                             move_uploaded_file($_FILES["immagine".$i]['tmp_name'][$key], "../$cartellaAnnuncio/" . $nomeFileImmagine);
//                         }
//                         else
//                         {
//                             $tmpfilename=basename($nomeFileImmagine,$ext);
//                             $nomeFileImmagine=$tmpfilename.time().".".$ext;
//                             move_uploaded_file($_FILES["immagine".$i]['tmp_name'][$key], "../$cartellaAnnuncio/" . $nomeFileImmagine);
//                         }
                        
//                         $sqlInsertIdImgIdAnn = "INSERT INTO $this->tbl_immagini_annuncio (idAnnuncio, path_immagine, descrizione_immagine) VALUES ($idAnnuncio, '$cartellaAnnuncio/$nomeFileImmagine', '$descrizioneImmagine')";
//                         echo $sqlInsertIdImgIdAnn;
//                         $resultInsertIdImgIdAnn = $mysqli->query($sqlInsertIdImgIdAnn);
                        
//                         if($resultInsertIdImgIdAnn){
//                             $mysqli->commit();
//                             $_SESSION['inserito'] = 'OK';
//                             $_SESSION['messaggio'] = 'Immagine inserita con successo';
//                             echo $_SESSION['inserito'] . " " . $_SESSION['messaggio'];
//                         } else{
//                             $mysqli->rollback();
//                             $_SESSION['inserito'] = 'NOK';
//                             $_SESSION['messaggio'] = 'Immagine non inserita';
//                             echo "Morto secondo inserimento";
//                         }
//                     }
//                     else
//                     {
//                         array_push($error,"$nomeFileImmagine, ");
//                         $_SESSION['messaggio'] = "Formato ".$ext." non accettato. I formati sopportati sono: gif, png, jpg";
//                         echo "Immagine non accettata";
//                     }
//                 }
//             }
//         }
            
    }
    
    public function inserisciImmagini($mysqli, $idAnnuncio, $cartellaAnnuncio){
        $imgInserite = true;
        
        $j = 0;     // Variable for indexing uploaded image.
        $target_path = '../'.$cartellaAnnuncio.'/';     // Declaring Path for uploaded images.
        $descrizioni = $_POST['descrizioneImmagine'];
        $i = 0;
//         for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
        foreach($descrizioni as $index => $value){
            $descrizioneImmagine = $descrizioni[$index];
            // Loop to get individual element from the array
            $validextensions = array("jpeg","jpg","png","gif");      // Extensions which are allowed.
            $ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
            $nomeImmagine = md5(uniqid()) . "." . $ext[count($ext) - 1];
            echo "Nome dell'immagine: ".$nomeImmagine."<br/>";
            echo "TargetPath: ".$target_path."<br/>";
            $file_extension = end($ext); // Store extensions in the variable.
            $target_path = $target_path . $nomeImmagine;     // Set the target path with a new name of image.
            $j = $j + 1;      // Increment the number of uploaded images according to the files in array.
            if (($_FILES["file"]["size"][$i] < 1000000)     // Approx. 100kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
                        // If file moved to uploads folder.
                        echo $j. ').<span id="noerror">Immagine caricata con successo! '.$descrizioneImmagine.'</span><br/><br/>';
                        $sqlInsertIdImgIdAnn = "INSERT INTO $this->tbl_immagini_annuncio (idAnnuncio, path_immagine, descrizione_immagine) VALUES ($idAnnuncio, '$cartellaAnnuncio/$nomeImmagine', '$descrizioneImmagine')";
                        echo $sqlInsertIdImgIdAnn;
                        $resultInsertIdImgIdAnn = $mysqli->query($sqlInsertIdImgIdAnn);
                        if(!$resultInsertIdImgIdAnn){
                            $this->errorMsg = "Errore durante l'inserimento dell'immagine nel database";
                            return false;
                        }
                    } else {     //  If File Was Not Moved.
                        echo $j. ').<span id="error">Errore nel caricare l\'immagine!. '.$descrizioneImmagine.'</span><br/><br/>';
                        $this->errorMsg = "Errore durante il caricamente dell'immagine";
                        $imgInserite = false;
                    }
            } else {     //   If File Size And File Type Was Incorrect.
                echo $j. ').<span id="error">***Dimensione o tipo dell\'immagine non validi***</span><br/><br/>';
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
    
    
    public function inserisci($mysqli){
        
        extract($_POST);
        $error=array();
        $extension=array("jpeg","jpg","png","gif");
        $txtGalleryName = "imgAnnunci";
        foreach($_FILES["immagine"]["tmp_name"] as $key=>$tmp_name)
        {
            $file_name=$_FILES["immagine"]["name"][$key];
            $file_tmp=$_FILES["immagine"]["tmp_name"][$key];
            $ext=pathinfo($file_name,PATHINFO_EXTENSION);
            if(in_array($ext,$extension))
            {
//                 if(move_uploaded_file($_FILES['immagine']['tmp_name'][$key], "../$txtGalleryName/" . $_FILES['immagine']['name'][$key])){
                if(!file_exists("../".$txtGalleryName."/".$file_name))
                {
                    echo "immagine inserita<br/>";
                    move_uploaded_file($file_tmp=$_FILES["immagine"]["tmp_name"][$key],"../".$txtGalleryName."/".$file_name);
                    echo "$file_name, $txtGalleryName, $file_tmp<br/>";
                }
                else
                {
                    echo "else: immagine non inserita<br/>";
                    $tmpfilename=basename($file_name,$ext);
                    $file_name=$tmpfilename.time().".".$ext;
                    move_uploaded_file($file_tmp=$_FILES["immagine"]["tmp_name"][$key],"../".$txtGalleryName."/".$file_name);
                    echo "$file_name, $txtGalleryName, $file_tmp, $file_name<br/>";
                }
            }
            else
            {
                array_push($error,"$file_name, ");
            }
        }
        
    }
    
}
?>