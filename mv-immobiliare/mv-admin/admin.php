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
			<a href="javascript:;" data-toggle="collapse" data-target="#demo1"> Immagini <span class="glyphicon glyphicon-chevron-down"></span></a>
			<ul id="demo1" class="collapse">
				<li>
					<a href="#">Inserisci Immagini</a>
				</li>
				<li>
					<a href="adminModifica.php">Modifica Immagini</a>
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
					<a href="#">Inserisci Immagini</a>
				</li>
				<li>
					<a href="adminModifica.php">Modifica Immagini</a>
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
				  <strong>Ottimo!</strong> Inserimento riuscito!
				</div>
			<?php
					} else {
			?>
				<div class="alert alert-danger alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>Errore!</strong> Inserimento non riuscito!
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
        <form name="insert-image-form" method="post" action="../php/util/inserisciAnnunci.php" enctype="multipart/form-data">
			<div class="form-group">
			  <h4 for="selPagineGallery">Selezionare la categoria in cui inserire l'annuncio:</h4>
			  <select class="form-control" id="selPagineGallery" name="idPagineGallery" required>
				<option disabled selected value>-- Selezionare una categoria --</option>
			<?php
							$sqlCategorie= "SELECT * FROM categorie";
							
						try{
						    if($resultCategorie = $mysqli->query($sqlCategorie)){
								while($rowCategoria = $resultCategorie->fetch_array(MYSQLI_ASSOC)) {
									echo '
						<option>'.$rowCategoria['nomeCategoria'].'</option>';
								}
							}
						} catch(Exception $e) {
							echo "<script type='text/javascript'>alert('ERRORE: Se il problema si presenta nuovamente, contattare l\'amministratore '".$e->getMessage().")</script>";
						}
			?>
			  </select>
			</div>
			
			
			<div class="mx-auto">
			</div>

          <div class="form-group col-md-12">
            <h4 for="inputFile">Selezionare un file</h4>
            <input type="file" id="inputFile" name="fileInput" accept="image/*" required>
            <p class="help-block">Inserire un'immagine. Massima grandezza 5MB</p>
			
			<!---------- DIV per antemprima immagini caricate ---------->
				<div id="gallery"> </div>
				<script src="js/preview.js"></script>
			<!---------- fine DIV per antemprima immagini caricate ---------->
			
          </div>
          <div class="form-group">
			<div class="form-row">
            	<div class="form-group col-md-4">
                    <h4 for="inputTitle">Citt&agrave;</h4>
                    <input type="text" class="form-control" id="inputCitta" placeholder="Citt&agrave;" name="citta" required>
                </div>
            	<div class="form-group col-md-4">
                    <h4 for="inputTitle">Indirizzo</h4>
                    <input type="text" class="form-control" id="inputIndirizzo" placeholder="Indirizzo" name="indirizzo" required>
                </div>
            	<div class="form-group col-md-4">
                    <h4 for="inputTitle">Prezzo</h4>
                    <input type="number" class="form-control" id="inputPrezzo" placeholder="Prezzo" name="prezzo" step="1000" min="0" required>
                </div>
          	</div>
          </div>
          <div class="form-group col-md-12">
            <h4 for="comment">Descrizione dell'annuncio</h4>
            <textarea class="form-control" rows="5" id="comment" name="descrizioneAnnunci" required></textarea>
          </div>
          <button type="submit" class="btn btn-default">Invia</button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
