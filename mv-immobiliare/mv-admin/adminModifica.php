<!------PANNELLO AMMINISTRAZIONE------>
<!--www.mvimmobiliare.it-->


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Amministrazione</title>
  <link rel="icon" href="/images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
	

	#gallery .thumbnail{
		width:20%;
		height: 20%;
		float:left;
		margin-bottom:10%;
	}
	#gallery .thumbnail img{
		width:100%;
		height: 100%;
	}
	
  </style>
</head>



<?php
// Version
define('VERSION', '1.0');

// Configuration
//require_once('phpFunctions/connDB.php');
try {
    include '../php/util/utility.php';
    include("../php/util/connDB.php");
	sec_session_start();
	
}catch(Exception $e) {
	echo "<script type='text/javascript'>alert('ERROR: Input data is fail: '".$e->getMessage().")</script>";
}

if (!isset($_SESSION['entrato'])){
	header('Location: login.php');
}

?>



<body>

<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <p class="navbar-brand" href="#">Amministrazione</p>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
		<li>
			<a href="javascript:;" data-toggle="collapse" data-target="#demo1"> Annunci <span class="glyphicon glyphicon-chevron-down"></span></a>
			<ul id="demo1" class="collapse">
				<li>
					<a href="admin.php">Inserisci un annuncio</a>
				</li>
				<li>
					<a href="#">Modifica gli annunci</a>
				</li>
			</ul>
		</li>
        <!--<li><a href="#">Age</a></li>
        <li><a href="#">Gender</a></li>-->
        <li><a href="../php/util/logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 hidden-xs">
	  <div>
		<!--<div><a class="navbar-brand" href="#"><img src="/images/logo.png"></a></div>-->
		<h2 align="right">Amministrazione</h2>
	  </div>
	  <br><br>
      <ul class="nav nav-pills nav-stacked">
		<li>
			<a href="javascript:;" data-toggle="collapse" data-target="#demo2" style="font-family:verdana; font-size:15px;">- Annunci</a>
			<ul id="demo2" class="collapse">
				<li>
					<a href="admin.php">Inserisci un annuncio</a>
				</li>
				<li>
					<a href="#">Modifica gli annunci</a>
				</li>
			</ul>
		</li>
        <!--<li><a href="#section2">Age</a></li>
        <li><a href="#section3">Gender</a></li>-->
        <li><a href="../php/util/logout.php" style="font-family:verdana; font-size:15px;">- Logout</a></li>
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9">
      <div class="well">
		
		
		
			<?php
				if (isset($_SESSION['inserito']) && isset($_SESSION['messaggio'])){
					if ($_SESSION['inserito']=='OK'){
			?>
				<div class="alert alert-success alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>Ottimo!</strong> <?php echo $_SESSION['messaggio']?>
				</div>
			<?php
					} else {
			?>
				<div class="alert alert-danger alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>Errore!</strong> <?php echo $_SESSION['messaggio']?>
				</div>
			<?php
					}
					unset($_SESSION['inserito']);
					unset($_SESSION['messaggio']);
				} else if (!isset($_SESSION['inserito']) && isset($_SESSION['messaggio'])){
			?>
				<div class="alert alert-warning alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>Attenzione!</strong> Alcune informazioni potrebbero non essere state salvate!
				</div>
			<?php
						unset($_SESSION['messaggio']);
					}
			?>
			
			
			
        <form name="select-gallery-form" method="post" action="../php/cancellaAnnuncio.php" enctype="multipart/form-data">
			
			<div class="form-group">
			  <h4 for="selCategoriaAnnuncio">Selezionare la categoria dell'annuncio da modificare:</h4>
			  <select class="form-control" id="selCategoriaAnnuncio" name="categoriaAnnuncio" required>
<!-- 				<option disabled selected value>-- Selezionare una categoria --</option> -->
				<option>Tutte</option>
			<?php
							$sqlAnnunciRecenti= "SELECT * FROM categorie ORDER BY idCategoria";
							
						try{
						    if($resultAnnunciRecenti = $mysqli->query($sqlAnnunciRecenti)){
						        $categoriaSelezionata = "";
								while($rowAnnuncio = $resultAnnunciRecenti->fetch_array(MYSQLI_ASSOC)) {
								    if(isset($_GET['idCategoria']) && $rowAnnuncio['idCategoria']==$_GET['idCategoria']){
								        $categoriaSelezionata = "selected";
								    } else {
								        $categoriaSelezionata = "";
								    }
									echo '
						<option '.$categoriaSelezionata.'>'.$rowAnnuncio['nomeCategoria'].'</option>';
								}
							}
						} catch(Exception $e) {
							echo "<script type='text/javascript'>alert('ERRORE: Se il problema si presenta nuovamente, contattare l\'amministratore '".$e->getMessage().")</script>";
						}
			?>
			  </select>
			</div>
          <button type="submit" class="btn btn-default">Invia</button>
        </form>
		
		
		
		
		
		<?php
			if(isset($_GET['idCategoria'])){
				$idCategoria = $_GET['idCategoria'];
		?>
		<form name="delete-image-form" method="post" action="../php/cancellaAnnuncio.php" enctype="multipart/form-data">
			
			<div class="container">    
			  <div class="row">

				<?php
									try{
										$idPage = isset($_GET['idPage']) ? $_GET['idPage'] : 1;
										$whereCondition = "";
										if($idCategoria!="0"){
										    $whereCondition = " WHERE idCategoria=$idCategoria";
										}
										$sqlAnnunciRecenti = "SELECT A.*, I.path_immagine, I.descrizione_immagine ".
                                                            " FROM annunci A LEFT JOIN ( ".
                                                            "   SELECT idAnnuncio, path_immagine, descrizione_immagine ".
                                                            "       FROM immagini_annuncio ".
                                                            "       WHERE idImmagine IN ( ".
                                                            "           SELECT MIN(idImmagine) AS id ".
                                                            "               FROM immagini_annuncio ".
                                                            "           GROUP BY idAnnuncio)) I ".
                                                            "   ON A.idAnnuncio=I.idAnnuncio ".$whereCondition.
										                    " ORDER BY data_inserimento DESC";
										$numImgPerPagina = 16;
										$numImgPerRiga = 4;
										
										$col_div = 'col-sm-3';
										
										if ($resultAnnunciRecenti = $mysqli->query($sqlAnnunciRecenti)) {
											$x = 1;
											$imgIndex = $numImgPerPagina*($idPage-1)+1;
											$test = true;
											//if ($resultAnnuncio->num_rows > 0) {
												// output data of each row
											    while($annuncio = $resultAnnunciRecenti->fetch_array(MYSQLI_ASSOC) and $imgIndex <= $numImgPerPagina*($idPage)) {
													if($imgIndex>$x and $test){
														$x++;
														continue;
													} else{
														$test = false;
													}
													
													if ($annuncio["annuncio_attivo"]){
						/*								echo '
				<div class="'.$col_div.'">
					<div class="panel-heading">'.$row["descrizione_immagine"].'</div>
					<div class="panel-body"><img src=../'.$row["path_immagine"].' class="img-responsive" style="width:100%;" alt="Image"></div>
				</div>';*/
													    echo '
                <table style="width:90%; margin-top: 2%; margin-left: 5%;">
                	<tbody>
                		<tr>
                			<td rowspan="3" width="100" style="border-right: 1px solid #ddd;"><img src=../'.$annuncio["path_immagine"].' class="img-responsive" style="width:100%; padding-right:10%" alt="Image"></td>
                			<td style="border-right: 1px solid #ddd; width:15%;"><p align="center"><i class="fa fa-eur"></i> '.$annuncio["prezzo"].'</p></td>
                			<td style="border-right: 1px solid #ddd; width:40%;"><p align="center"><i class="fa fa-map-marker"></i> '.$annuncio["citta"].', '.$annuncio["indirizzo"].'</p></td>
                			<td style="border-right: 1px solid #ddd; width:15%;"><p align="center"><i class="fa fa-home"></i> '.$annuncio["num_stanze"].' stanze</p></td>
                			<td>
                                <a href="adminModificaAnnuncio.php?idAnnuncio='.$annuncio['idAnnuncio'].'">
                                    <button type="button" class="btn btn-primary" style="margin-left:5%">Modifica</button>
                                </a>
                            </td>
                		</tr>
                		<tr>
                			<td style="border-right: 1px solid #ddd;" colspan="3" rowspan="2"><p style="margin-left:2%; margin-top:40px">'.substr($annuncio["descrizione"],0,300).'</p></td>
                		</tr>
                		<tr>
                			<td><button type="button" class="btn btn-danger" style="margin-left:5%" data-toggle="modal" data-target="#modalCancellaAnnuncio'.$annuncio['idAnnuncio'].'">Cancella</button></td>
                		</tr>
                	</tbody>
                </table>
                <hr style="width:80%; margin-left:5%">';
													    echo '
                <div class="modal fade" id="modalCancellaAnnuncio'.$annuncio['idAnnuncio'].'" role="dialog">
				<div class="modal-dialog">
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Cancella annuncio</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<div class="col-sm-10 col-sm-offset-1 col-xs-12">
								<span class="wpcf7-form-control-wrap surname">
									<h3 style="text-align:center">Sei sicuoro di voler cancellare l\'annuncio?</h3>
								</span>
							</div>
						</div>
					</div>
					<div class="modal-footer" style="border-top: 0;">
						<div class="form-group">
							<div class="col-sm-5 col-sm-offset-1 col-xs-12 mt-50">
								<form action="../php/cancellaAnnuncio.php" method="post" class="wpcf7-form" enctype="multipart/form-data">
									<input type="hidden" name="idAnnuncio" value="'.$annuncio['idAnnuncio'].'">
									<input type="hidden" name="idCategoria" value="'.$idCategoria.'">
									<input value="Yes" class="wpcf7-form-control wpcf7-submit cta-invia" id="delete-event" type="submit"><span class="ajax-loader"></span>
								</form>
							</div>
							<div class="col-sm-5 col-sm-offset-1 col-xs-12 mt-50">
								<input value="No" class="wpcf7-form-control wpcf7-submit cta-invia" data-dismiss="modal" type="submit"><span class="ajax-loader"></span>
							</div>
						</div>
					</div>
				  </div>
				  
				</div>
			</div>';
														$imgIndex++;
													}
													
													if (($imgIndex-1)%$numImgPerRiga==0){
														echo '
			  </div>
			</div><br><br>';
														if (($imgIndex-1)<$numImgPerPagina){
															echo '
			<div class="container">    
			  <div class="row">';
														}
													}
												}
										}
						} catch(Exception $e) {
							echo "<script type='text/javascript'>alert('ERROR: Input data is fail: '".$e->getMessage().")</script>";
						}
			?>

			  </div>
			</div>
		
		
		
		
		
		</form>
			
			
		<?php
			}
		?>
		
		
		
      </div>
      <!--<div class="row">
        <div class="col-sm-3">
          <div class="well">
            <h4>Users</h4>
            <p>1 Million</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Pages</h4>
            <p>100 Million</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Sessions</h4>
            <p>10 Million</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Bounce</h4>
            <p>30%</p> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
            <p>Text</p> 
            <p>Text</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
            <p>Text</p> 
            <p>Text</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
            <p>Text</p> 
            <p>Text</p> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="well">
            <p>Text</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p> 
          </div>
        </div>
      </div>-->	
	
	
	






<?php
if(isset($_GET['idGallery'])){
	$idCategoria = $_GET['idGallery'];


	$const = 0; // nel caso in cui il resto fra il numero totale di immagini caricate e il numero di immagini da voler visualizzare (di default a 6) fosse > 0,
				// allora ci deve essere una pagina in più che contiene le immagini in più;
				// esempio:
				// 		caso 1
				// numero tot di immagini T = 18
				// numero di immagini da visualizzare V = 6
				// 18/6 = 3		=>	il resto è 0 e verranno quindi mostrate 3 pagine
				// 		caso 2
				// numero tot di immagini T = 20
				// numero di immagini da visualizzare V = 6
				// 20/6 = 3		=>	il resto è 2 e verranno quindi mostrate 4 pagine, di cui la quarta avrà 2 immagini
	if ($result->num_rows%$numImgPerPagina > 0){
		$const = 1;
	}
	$numPagine = intval($result->num_rows/$numImgPerPagina)+$const;

	// questo "li" contiene la freccetta per la pagina precedente
	echo '
	<nav style="text-align:center">
	  <ul class="pagination">';

	$ableArrowPrev =  ' class="disabled"';
	$linkPrev = '';
	if ($idPage>1){
		$ableArrowPrev =  '';
		$linkPrev = 'href="adminModifica.php?idGallery='.$idCategoria.'&idPage='.($idPage-1).'"';
	}
	echo '
		<li'.$ableArrowPrev.'>
		  <a '.$linkPrev.' aria-label="Previous">
			<span aria-hidden="true">&laquo;</span>
		  </a>
		</li>';

	// questo "li" contiene gli indici/numerazione delle pagine
	$y = 1;
	while($y<=$numPagine) {
		$activeLinkPage = ($y==$idPage) ? ' class="active"' : '';
		echo '<li'.$activeLinkPage.'><a href="adminModifica.php?idGallery='.$idCategoria.'&idPage='.$y.'">'.$y.'</a></li>';
		$y++;
	}
	/*if($numPagine>5 and ($numPagine-$idPage)>1){
		$activeLinkPage = ($y==$idPage) ? ' class="active"' : '';
		echo '<li><a href="#" style="pointer-events: none;">...</a></li>';
		echo '<li'.$activeLinkPage.'><a href="gallery.php?idPage='.$numPagine.'">'.$numPagine.'</a></li>';
	}
	// può solo essere pari a 5
	else{
		$activeLinkPage = ($y==$idPage) ? ' class="active"' : '';
		echo '<li'.$activeLinkPage.'><a href="gallery.php?idPage='.$numPagine.'">'.$numPagine.'</a></li>';
	}*/

	// questo "li" contiene la freccetta per la pagina successiva
	$ableArrowSucc = ' class="disabled"';
	$linkSucc = '';
	if ($idPage<$numPagine){
		$ableArrowSucc = '';
		$linkSucc = 'href="adminModifica.php?idGallery='.$idCategoria.'&idPage='.($idPage+1).'"';
	}
	echo '
		<li'.$ableArrowSucc.'>
		  <a '.$linkSucc.' aria-label="Next">
			<span aria-hidden="true">&raquo;</span>
		  </a>
		</li>
	  </ul>
	</nav>';

}
?>
	
	
	
	
	
    </div>
  </div>
</div>

</body>
</html>
