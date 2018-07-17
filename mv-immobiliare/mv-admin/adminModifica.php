<!------PANNELLO AMMINISTRAZIONE------>
<!--www.mvimmobiliare.it-->


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Amministrazione</title>
  <link rel="icon" href="/images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
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
	include '/php/util/utility.php';
	include("/php/util/connDB.php");
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
			<a href="javascript:;" data-toggle="collapse" data-target="#demo1"> Immagini <span class="glyphicon glyphicon-chevron-down"></span></a>
			<ul id="demo1" class="collapse">
				<li>
					<a href="admin.php">Inserisci Immagini</a>
				</li>
				<li>
					<a href="#">Modifica Immagini</a>
				</li>
			</ul>
		</li>
        <!--<li><a href="#">Age</a></li>
        <li><a href="#">Gender</a></li>-->
        <li><a href="/php/util/logout.php">Logout</a></li>
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
			<a href="javascript:;" data-toggle="collapse" data-target="#demo2" style="font-family:verdana; font-size:15px;">- Immagini</a>
			<ul id="demo2" class="collapse">
				<li>
					<a href="admin.php">Inserisci Immagini</a>
				</li>
				<li>
					<a href="#">Modifica Immagini</a>
				</li>
			</ul>
		</li>
        <!--<li><a href="#section2">Age</a></li>
        <li><a href="#section3">Gender</a></li>-->
        <li><a href="/php/util/logout.php" style="font-family:verdana; font-size:15px;">- Logout</a></li>
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
					} else {
			?>
				<div class="alert alert-warning" role="alert">
				  <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
				  <strong>Attenzione!</strong> Cancellare le immagini prima di cambiare pagina!
				</div>
			<?php
					}
			?>
			
			
			
        <form name="select-gallery-form" method="post" action="/php/util/cancellaAnnuncio.php" enctype="multipart/form-data">
			<div class="form-group">
			  <h4 for="selPagineGallery">Selezionare la pagina in cui sono presenti le immagini da modificare:</h4>
			  <select class="form-control" id="selPagineGallery" name="idPagineGallery" required>
			<?php
							$sqlPagineGallery = "SELECT * FROM paginegallerie";
							
						try{
							if(isset($_GET['idGallery'])){
								echo '
			  <option disabled>-- Selezionare una pagina --</option>';
								$idGallery = $_GET['idGallery'];
							} else{
								echo '
			  <option disabled selected value>-- Selezionare una pagina --</option>';
							}
							if($resultCategorie = $mysqli->query($sqlPagineGallery)){
								$idCategoria = 0;
								while($rowCategoria = $resultCategorie->fetch_array(MYSQLI_ASSOC)) {
									if($idCategoria!=$rowCategoria['idCategoria']){
										if($idCategoria>0){
											echo '</optgroup>';
										}
										$idCategoria = $rowCategoria['idCategoria'];
										$sqlCategorie = "SELECT * FROM categorie WHERE idCategoria=$idCategoria";
										if($resultCategorie = $mysqli->query($sqlCategorie)){
											$rowCategorie = $resultCategorie->fetch_array(MYSQLI_ASSOC);
											echo '
					<optgroup label="'.$rowCategorie['NomeCategoria'].'">';
										}
									}
									if(isset($_GET['idGallery']) && $rowCategoria['idGallery']==$idGallery){
										echo '
						<option selected value>'.$rowCategoria['NomeGallery'].'</option>';
									}else{
										echo '
						<option>'.$rowCategoria['NomeGallery'].'</option>';
									}
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
			if(isset($_GET['idGallery'])){
				$idGallery = $_GET['idGallery'];
		?>
		<form name="delete-image-form" method="post" action="/php/util/cancellaAnnuncio.php" enctype="multipart/form-data">
			
			<div class="container">    
			  <div class="row">

				<?php
									try{
										$idPage = isset($_GET['idPage']) ? $_GET['idPage'] : 1;
										$sqlImages = "SELECT * FROM immagini WHERE idImmagine IN
											(SELECT idImmagine FROM immagini_paginegallerie WHERE idGallery=$idGallery)";
										$sqlMetadata = "SELECT * FROM metadata_gallery WHERE modalitaVisualizzazione=1 LIMIT 1";
										
										$resultMetadata = $mysqli->query($sqlMetadata);
										$rowMetadata = $resultMetadata->fetch_array(MYSQLI_ASSOC);
										$numImgPerPagina = $rowMetadata['numImgPerPagina'];
										$numImgPerRiga = $rowMetadata['numImgPerRiga'];
										$numImgPerPagina = 16;
										$numImgPerRiga = 4;
										
										$col_div = 'col-sm-4';
										
										if ($numImgPerRiga==4){
											$col_div = 'col-sm-3';
										}
										
										if ($result = $mysqli->query($sqlImages)) {
											$x = 1;
											$imgIndex = $numImgPerPagina*($idPage-1)+1;
											$test = true;
											//if ($result->num_rows > 0) {
												// output data of each row
												while($row = $result->fetch_array(MYSQLI_ASSOC) and $imgIndex <= $numImgPerPagina*($idPage)) {
													if($imgIndex>$x and $test){
														$x++;
														continue;
													} else{
														$test = false;
													}
													
													if ($row["Visualizzabile"]){
														echo '
				<div class="'.$col_div.'">
					<div class="panel-heading">'.$row["NomeImmagine"].'</div>
					<div class="panel-body"><img src=/'.$row["Path"].' class="img-responsive" style="width:100%;" alt="Image"></div>
					<div align="center"><input type="checkbox" name="immagini[]" value="'.$row['idImmagine'].'"/></div>
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
		
		
		
		
		
		<div align="center" style="margin-top:5%">
		  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Cancella le immagini selezionate</button>
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
	$idGallery = $_GET['idGallery'];


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
		$linkPrev = 'href="adminModifica.php?idGallery='.$idGallery.'&idPage='.($idPage-1).'"';
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
		echo '<li'.$activeLinkPage.'><a href="adminModifica.php?idGallery='.$idGallery.'&idPage='.$y.'">'.$y.'</a></li>';
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
		$linkSucc = 'href="adminModifica.php?idGallery='.$idGallery.'&idPage='.($idPage+1).'"';
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
