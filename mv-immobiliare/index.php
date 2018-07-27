<!--
Author: MV Immobiliare
Author URL: MV Immobiliare
License: Creative Commons Attribution 3.0 Unported
License URL: http://mvimmobiliare.it/privacy.html
-->
<!DOCTYPE html>
<html>
<head>
<title>MV Servizi Immobiliari</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="#" />
<meta name="description" content="#" />
<meta name="author" content="mvservizimmobiliari" />

<!-- css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/styles.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">

<!-- js -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>

<!-- favicons -->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

<!-- Mobile Specific Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Slider home -->
<script src="js/responsiveslides.min.js"></script>
   <script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>
  
</head>



<?php
// Version
define('VERSION', '1.0');

try {
    include 'php/util/utility.php';
    include("php/util/connDB.php");
    include_once 'config/constants.php';
// 	sec_session_start();
	
}catch(Exception $e) {
	echo "<script type='text/javascript'>alert('ERROR: Input data is fail: '".$e->getMessage().")</script>";
}

?>

<body>

	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
	<script src="js/smooth.js"></script>
	
<!--header-->
	<div class="navigation">
			<div class="container-fluid">
				<nav class="pull">
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="history.html">Storia</a></li>
						<li><a href="#serv">Servizi</a></li>
						<li><a href="#imm">Immobili e Locazioni</a></li>
						<li><a href="#mutui">Mutui / Consulenza del Credito</a></li>
						<li><a href="#aste">Aste Immobiliari</a></li>
						<li><a href="#job">Lavora con Noi</a></li>
						<li><a href="#test">Testimonial</a></li>
						<li><a href="contact.html">Contatti</a></li>
					</ul>
				</nav>			
			</div>
		</div>

<div class="header">
	<div class="container">
		<!--logo-->
			<div class="logo">
					<a href="index.html"><img src="images/logo/logoTop.png" alt="mvImmobiliare " /></a>
				<!--<h1><a href="index.html">MV IMMOBILIARE</a></h1>-->
			</div>
		<!--//logo-->
		<div class="top-nav">
			<ul class="right-icons">
				<li><span><a href="https://www.facebook.com/mvserviziimmobiliari/" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></span></li>
				<li><span><a href="https://www.instagram.com/mvserviziimmobiliari/?hl=it" target="_blank"><i class="fab fa-instagram fa-2x"></i></a></span></li>
				<li><span><a href="#"><i class="fab fa-twitter fa-2x"></i></a></span></li>
				<li><span><a href="#"><i class="fab fa-google-plus-g fa-2x"></i></a></span></li>
				<li><span><i class="glyphicon glyphicon-phone"> </i>+39 0687560995</span></li>
				<li><a  href="login.html"><i class="glyphicon glyphicon-user"> </i>Login</a></li>
				<li><a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon glyphicon-search"></i></a></li>
				
			</ul>
			<div class="nav-icon">
				<div class="nav_slide_button" id="hero">
					<a href="#"><i class="glyphicon glyphicon-menu-hamburger"></i> </a>
				</div>	
			</div>
			<div class="clearfix"> </div>
		
			<!---pop-up-box ---->
				    
				<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
				<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
			<!---//pop-up-box---->
				<div id="small-dialog" class="mfp-hide">
					    <!----- tabs-box ---->
				<div class="sap_tabs">	
				     <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
						  <ul class="resp-tabs-list">
						  	  <li class="resp-tab-item " aria-controls="tab_item-0" role="tab"><span>Tutte</span></li>
							  <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>In Vendita</span></li>
							  <li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>Locazioni</span></li>
							  <div class="clearfix"></div>
						  </ul>				  	 
						  <div class="resp-tabs-container">
						  		<h2 class="resp-accordion resp-tab-active" role="tab" aria-controls="tab_item-0"><span class="resp-arrow"></span>Tutte</h2><div class="tab-1 resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
								 	<div class="facts">
									  	<div class="login">
											<input type="text" value="Cerca per indirizzo, citta' o cap" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Cerca per indirizzo, citta' o cap';}">		
									 		<input type="submit" value="">
									 	</div>        
							        </div>
						  		</div>
							     <h2 class="resp-accordion" role="tab" aria-controls="tab_item-1"><span class="resp-arrow"></span>In Vendita</h2><div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
									<div class="facts">									
										<div class="login">
											<input type="text" value="Cerca per indirizzo, citta' o cap" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Cerca per indirizzo, citta' o cap';}">		
									 		<input type="submit" value="">
									 	</div> 
							        </div>	
								 </div>									
							      <h2 class="resp-accordion" role="tab" aria-controls="tab_item-2"><span class="resp-arrow"></span>Locazioni</h2><div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
									 <div class="facts">
										<div class="login">
											<input type="text" value="Cerca per indirizzo, citta' o cap" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Cerca per indirizzo, citta' o cap';}">		
									 		<input type="submit" value="">
									 	</div> 
							         </div>	
							    </div>
					      </div>
					 </div>
					 <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
				    	<script type="text/javascript">
						    $(document).ready(function () {
						        $('#horizontalTab').easyResponsiveTabs({
						            type: 'default', //Types: default, vertical, accordion           
						            width: 'auto', //auto or any width like 600px
						            fit: true   // 100% fit in a container
						        });
						    });
			  			 </script>	
				</div>
				</div>
				 <script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
				</script>
					
	
		</div>
		<div class="clearfix"> </div>
		</div>	
</div>
<!--/banner/-->	
	<div class=" header-right">
		<div class=" banner">
			 <div class="slider">
			    <div class="callbacks_container">
			      <ul class="rslides" id="slider">		       
					 <li>
			          	 <div class="banner1">
			           		<div class="caption">
					          	<h3>La <span>VITA</span> ti porta in luoghi inaspettati,</h3>
			          		</div>
			          	</div>
			         </li>
					 <li>
			          	 <div class="banner2">
			           		<div class="caption">
								<h3>L' <span>AMORE</span> ti porta a <span>CASA</span> !</h3>
			          		</div>
			          	</div>
			         </li>
			         <li>
			          	 <div class="banner3">
			           		<div class="caption">
					          	<!--<h3>L' <span>AMORE</span> ti porta a <span>CASA</span> !</h3>-->
			          		</div>
			          	</div>
			         </li>		
			      </ul>
			  </div>
			</div>
		</div>
	</div>
	
<!--banner end-->	
	 
	<!--header-bottom-->
	<div class="banner-bottom-top">
		<div class="container">
			<div class="bottom-header">
				<div class="header-bottom">
				
					<div class=" bottom-head">
						<a href="#imm">
							<div class="buy-media">
								<!--<i class="buy"></i> -->
								<i class="fa fa-eur fa-2x" aria-hidden="true"></i>
								<h6>IMMOBILI</h6>
							</div>
						</a>
					</div>
				
					<div class=" bottom-head">
						<a href="#imm">
							<div class="buy-media">
							<i class="fa fa-users fa-2x" aria-hidden="true"></i>
							<!--<i class="apart"> </i>-->
							<h6>LOCAZIONI</h6>
							</div>
						</a>
					</div>
					
					<div class=" bottom-head">
						<a href="#mutui">
							<div class="buy-media">
							<i class="fa fa-tachometer fa-2x" aria-hidden="true"></i>
							<!--<i class="loan"> </i>-->
							<h6>MUTUO</h6>
							</div>
						</a>
					</div>
					
					<div class=" bottom-head">
						<a href="#aste">
							<div class="buy-media">
							<i class="fa fa-usd fa-2x" aria-hidden="true"></i>
							<!--<i class="deal"> </i>-->
							<h6>ASTE IMM.</h6>
							</div>
						</a>
					</div>
					
					<div class=" bottom-head">
						<a href="#serv">
							<div class="buy-media">
							<i class="fa fa-eye fa-2x" aria-hidden="true"></i>
							<!--<i class="deal"> </i>-->
							<h6>VALUTAZIONI</h6>
							</div>
						</a>
					</div>
					
					<div class=" bottom-head">
						<a href="#serv">
							<div class="buy-media">
							<i class="fa fa-clipboard fa-2x" aria-hidden="true"></i>
							<!--<i class="deal"> </i>-->
							<h6>CONSULENZE</h6>
							</div>
						</a>
					</div>
					
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
	<!--//header-bottom-->
	
	
<!--//header-->

<!--content-->
<div class="content">
	<div class="content-grid">
		<div class="container">
			<h3>Novit&agrave</h3>
			
			<?php
			    $dim_x_vetrina = DIM_X_VETRINA;
			    $dim_y_vetrina = DIM_Y_VETRINA;
			
				$sqlAnnunciRecenti= "SELECT A.citta, A.indirizzo, A.prezzo, C.nomeCategoria, I.path_immagine ".
                                    " FROM annunci A LEFT JOIN ( ".
                                    "  SELECT idAnnuncio, path_immagine, descrizione_immagine ".
                                    "      FROM immagini_annuncio ".
                                    "      WHERE idImmagine IN ( ".
                                    "          SELECT MIN(idImmagine) AS id ". 
                                    "              FROM immagini_annuncio ".
                                    "          GROUP BY idAnnuncio)) I ".
                                    "  ON A.idAnnuncio=I.idAnnuncio ".
                                    "  JOIN categorie C ".
                                    "  ON A.idCategoria = C.idCategoria ".
                                    "ORDER BY data_inserimento DESC ";
				
				try{
				    if($resultAnnunciRecenti = $mysqli->query($sqlAnnunciRecenti)){
				        $i = 0;
						while($rowAnnunciRecenti = $resultAnnunciRecenti->fetch_array(MYSQLI_ASSOC)) {
						    $pathImmagine = $rowAnnunciRecenti['path_immagine'];
						    $pathImmagine = substr($pathImmagine,0,strrpos($pathImmagine,'/')).'/'.$dim_x_vetrina.'x'.$dim_y_vetrina.substr($pathImmagine,strrpos($pathImmagine,'/'));
						    $i++;
							echo '
				<div class="col-md-4 box_2">
			     	 <a href="single.html" class="mask">
			     	   	<img class="img-responsive zoom-img" src="'.$pathImmagine.'" style="width: 100%" alt="">
			     	   	<span class="four">&#8364; '.number_format($rowAnnunciRecenti['prezzo'],2,",",".").'</span>
			     	 </a>
			     	   <div class="most-1">
			     	   	 <h5><a href="single.html">'.$rowAnnunciRecenti['nomeCategoria'].'</a></h5>
			     	    	<p>'.$rowAnnunciRecenti['citta'].', '.$rowAnnunciRecenti['indirizzo'].'</p>
			     	   </div>
			 </div>';
							if($i>2){
							    break;
							}
						}
					}
				} catch(Exception $e) {
					echo "<script type='text/javascript'>alert('ERRORE: Se il problema si presenta nuovamente, contattare l\'amministratore '".$e->getMessage().")</script>";
				}
			?>
			
		 	<div class="clearfix"> </div>
		</div>
	</div>
	
<!--service-->
	<div id="serv" class="services">
		<div class="container">
			<div class="service-top">
				<h3>Servizi</h3>
			</div>
			<div class="services-grid">
		   		<div class="col-md-6 service-top1">
		   			<div class="ser-grid">	
		   				<!-- <a href="#" class="hi-icon hi-icon-archive glyphicon glyphicon-user"> </a>-->
						<a href="#comunicazione" data-toggle="modal">
							<div class="hi-icon hi-icon-archive"><i class="fas fa-volume-up fa-2x"></i></div>
						</a>
		   			</div>					
		   			<div class="ser-top">
		   				<h4 >COMUNICAZIONE PERIODICA</h4>
		   				<p>Tramite i più aggiornati metodi MV Servizi immobiliari mette a disposizione </p>
		   		    </div>
					<div class="clearfix"> </div>
		   	   </div>
			   
				<div class="col-md-6 service-top1">
		   			<div class=" ser-grid">	
						<a href="#mutuocredito" data-toggle="modal">
							<div class="hi-icon hi-icon-archive"><i class="fas fa-euro-sign fa-2x"></i></div>
						</a>
					</div>
		   			<div  class="ser-top">
		   				<h4>MUTUI E CREDITO</h4>
		   				<p>Consulente interno per pratiche di mutuo </p>
		   		    </div>
					<div class="clearfix"> </div>
		   		</div>
				<div class="clearfix"> </div>
			</div>
			
			<div class="services-grid">
			   	<div class="col-md-6 service-top1">
			   		<div class=" ser-grid">	
			   			<a href="#valutazioni" data-toggle="modal">
							<div class="hi-icon hi-icon-archive"><i class="fas fa-hands-helping fa-2x"></i></div>
						</a>
			   		</div>
			   		<div  class="ser-top">
			   			<h4>VALUTAZIONI E CONSULENZE</h4>
			   				<p>Valutazioni gratuite</p>
			   		</div>
					<div class="clearfix"> </div>
			   	</div>
				<div class="col-md-6 service-top1">
			   		<div class=" ser-grid">	
			   			<a href="#serviziall" data-toggle="modal">
							<div class="hi-icon hi-icon-archive"><i class="fas fa-server fa-2x"></i></div>
						</a>
			   		</div>
			   		<div  class="ser-top">
			   			<h4>VEDI TUTTI I SERVIZI..</h4>
			   			<p>Scopri tutte le prestazioni offerte da MV SERVIZI IMMOBILIARI. Siamo sempre ...</p>
			   		</div>
					<div class="clearfix"> </div>
			   	</div>
		   	  <div class="clearfix"> </div>
			</div>
		</div>
		<h3 align="center"><a href="contact.html" class="hvr-sweep-to-right more">contattaci</a></h3>
	</div>
<!--//services-->

<!--immobili-->
		<div id="imm" class="content-middle">
			<div class="container">
				<div class="mid-content">
					<h3>IMMOBILI e<br/> LOCAZIONI</h3>
					<p></p>
					<a class="hvr-sweep-to-right more-in" href="imm_loc_all.html">accedi a immobili</a>
				</div>
			</div>
		</div>
<!--immobili end-->

</br></br>

<!--mutui-->
		<div id="mutui" class="content-middle">
			<div class="container">
				<div class="mid-content-mutui">
					<h3>MUTUI e<br/> CREDITO</h3>
					<p></p>
					<a class="hvr-sweep-to-right more-in" href="mutuo_cred.html">accedi a mutui</a>
				</div>
			</div>
		</div>
<!--mutui end-->

</br></br>

<!--aste-->
		<div id="aste" class="content-middle">
			<div class="container">
				<div class="mid-content">
					<h3>ASTE </br> IMMOBILI</h3>
					<p></p>
					<a class="hvr-sweep-to-right more-in" href="aste.html">accedi aste</a>
				</div>
			</div>
		</div>
<!--aste end-->

</br></br>

<!--job-->
		<div id="job" class="content-middle">
			<div class="container">
				<div class="mid-content-job">
					<h3>LAVORA </br> CON NOI</h3>
					<p></p>
					<a class="hvr-sweep-to-right more-in" href="work_with_us.html">scopri di piu'</a>
				</div>
			</div>
		</div>
<!--job end-->

<!--project--->
	<div class="project">
		<div class="container">
			<h3>IN VENDITA</h3>
				<div class="project-top">
				
				<?php 
				$dim_x_in_vendita = DIM_X_IN_VENDITA;
				$dim_y_in_vendita = DIM_Y_IN_VENDITA;
				
				try{
			        $i = 0;
			        while($rowAnnunciRecenti = $resultAnnunciRecenti->fetch_array(MYSQLI_ASSOC)) {
			            $pathImmagine = $rowAnnunciRecenti['path_immagine'];
			            $pathImmagine = substr($pathImmagine,0,strrpos($pathImmagine,'/')).'/'.$dim_x_in_vendita.'x'.$dim_y_in_vendita.substr($pathImmagine,strrpos($pathImmagine,'/'));
					    $i++;
						echo '
			         <div class="col-md-3 project-grid">
						<div class="project-grid-top">
							 <a href="single.html" class="mask"><img src="'.$pathImmagine.'" class="img-responsive zoom-img" style="width:100%" alt=""/></a>
							 <div class="col-md1">
								 <div class="col-md2">
									 <div class="col-md4">
									 	<strong>'.$rowAnnunciRecenti['citta'].'</strong>
									 	<small>'.$rowAnnunciRecenti['nomeCategoria'].'</small>
									 </div>
									 <div class="clearfix"> </div>
								 </div>
								 <p>Situato in '.$rowAnnunciRecenti['indirizzo'].'</p>
								 <p class="cost">&#8364; '.number_format($rowAnnunciRecenti['prezzo'],2,",",".").'</p>
								 <a href="single.html" class="hvr-sweep-to-right more">vedi</a>
							 </div>
						</div>
					</div>';
						if($i>3){
						    break;
						}
					}
				} catch(Exception $e) {
					echo "<script type='text/javascript'>alert('ERRORE: Se il problema si presenta nuovamente, contattare l\'amministratore '".$e->getMessage().")</script>";
				}
				?>
					<div class="clearfix"> </div>
				</div>	
		</div>
		<div align="center">
			<br/>
			<a href="imm_loc_all.html" class="hvr-sweep-to-right more">VEDI TUTTI GLI IMMOBILI IN VENDITA</a>
		</div>
	</div>
<!--//project-->

<!--phone
	<div class="phone">
		<div class="container">
			<div class="col-md-6">
				<img src="images/iphone.png" class="img-responsive" alt=""/>
			</div>
			<div class="col-md-6 phone-text">
				<h4>Lavora con NOI</h4>
					<div class="text-1">
						<p>Lavora con NOI</p>
					</div>
				<a href="mobile_app.html" class="hvr-sweep-to-right more">invia curriculum</a>
			</div>
		</div>
	</div>
<!--//phone-->

<!--Testimonial-->
		<div id="test" class="content-bottom">
			<div class="container">
				<h3>TESTIMONIAL</h3>
					<div class="col-md-6 name-in">
						<div class=" bottom-in">
							<p class="para-in">Prova.</p>
						    <i class="dolor"> </i>
							<div class="men-grid">
								<a href="#" class="men-top"><img class="img-responsive men-top" src="images/te.jpg" alt=""></a>
								<div class="men">
								<span>Cristian</span>
								<!--<p>Ut enim ad minim</p>-->
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
						<div class=" bottom-in">
							<p class="para-in">Prova.</p>
							<i class="dolor"> </i>
							<div class="men-grid">
								<a href="#" class="men-top"><img class="img-responsive " src="images/te2.jpg" alt=""></a>
								<div class="men">
									<span>Cristian</span>
								</div>
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
					<div class="col-md-6  name-on">
						<div class="bottom-in ">
							<p class="para-in">Prova.</p>
							<i class="dolor"> </i>
							<div class="men-grid">
								<a href="#" class="men-top"><img class="img-responsive" src="images/te1.jpg" alt=""></a>
								<div class="men">
									<span>Cristian</span>
								</div>
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
					<div class="clearfix"> </div>
			</div>
		</div>		
<!--testimonial end-->
	
<!--partners-->
	<div class="content-bottom1">
		<h3>PARTNERS</h3>
	 		<div class="container">
				<ul>
					<li><a href="http://www.casa.it/vendita-residenziale/da-615718/lista-1?gclid=EAIaIQobChMI35WT66zN1wIVTTobCh22TwfrEAAYAiAAEgK56PD_BwE" target="_blank"><img class="img-responsive" src="images/partner/casa.png" alt="casa.it"></a></li>
					<li><a href="https://www.idealista.it/pro/mv-servizi-immobiliari-mentana/" target="_blank"><img class="img-responsive" src="images/partner/idealista.png" alt=""></a></li>
					<li><a href="https://www.immobiliare.it/agenzie_immobiliari/MV_servizi_immobiliari.html" target="_blank"><img class="img-responsive" src="images/partner/immobiliare.png" alt=""></a></li>
					<li><a href="https://www.kijiji.it/altri-annunci-utente/21602989" target="_blank"><img class="img-responsive" src="images/partner/kijiji.png" alt=""></a></li>
					<li><a href="https://replat3old.replat.com/index.php?ac=view&gg=1&og=1&o=1&o_id=1547425&caller_id=42974&b=7&print=3" target="_blank"><img class="img-responsive" src="images/partner/replat.png" alt=""></a></li>
				<div class="clearfix"> </div>
				</ul>
			</div>
	</div>	
<!--//partners-->	

</div>
	
<!--footer-->
<div class="footer">
	<div class="container">
		<div class="footer-top-at">
			<div class="col-md-3 amet-sed">
				<img src="images/logo/logoFooter.png" width="50%" alt="Centro Salute Perondi" class="footer-logo" />
				<br/>
				<p style="font-size:18px; color:#fff; font-family:Montserrat-Regular;">mvimmobiliare.it</p>
				<ul class="social">
						<li><a href="https://www.facebook.com/mvserviziimmobiliari/" target="_blank"><i> </i></a></li>
						<li><a href="https://www.instagram.com/mvserviziimmobiliari/?hl=it" target="_blank"><i class="camera"> </i></a></li>
						<li><a href="#" target="_blank"><i class="twitter"> </i></a></li>
						<li><a href="#" target="_blank"><i class="gmail"> </i></a></li>
						
				</ul>
			</div>
			
			<div class="col-md-3 amet-sed ">
				<h4>LINK MV</h4>
				<ul class="nav-bottom">
					<li><a href="history.html">Storia</a></li>
					<li><a href="index.html#serv">Servizi</a></li>
					<li><a href="index.html#imm">Immobili e Locazioni</a></li>
					<li><a href="index.html#mutui">Mutui / Consulenza del Credito</a></li>
					<li><a href="index.html#aste">Aste Immobiliari</a></li>
					<li><a href="index.html#job">Lavora con Noi</a></li>
					<li><a href="index.html#test">Testimonial</a></li>
					<li><a href="contact.html">Contatti</a></li>
				</ul>	
			</div>
			
			<div class="col-md-3 amet-sed">
				<h4>SERVIZIO CLIENTI</h4>
				<ul class="nav-bottom">
					<li><p>Lun-Ven 8:00-19:00</p></li>
					<li><p>Sab 8:00-13:00</p></li>
					<li><p>VIA III NOVEMBRE, 99</p></li>
					<li><p>00013 Mentana (RM)</p></li>
					<li><p>Tel. +39 0687560995</p></li>
					<br/>
					<li><p><a href="mailto:serviziimmobiliari.mv@gmail.com">Scrivici</a></p></li>
				</p>
			</div>
			
			<div class="col-md-3 amet-sed ">
				<h4>MV IMMOBILIARE</h4>
					<ul class="nav-bottom">
						<li><a href="login.html">Login</a></li>
						<li><a href="privacy.html">Privacy Policy</a></li>
						<li><a href="sitemap.html">Sitemap</a></li>
					</ul>	
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	
	<div class="footer-bottom">
		<div class="container">
			<div class="col-md-8 footer-class">
				<p >© 2017 MV Servizi Immobiliari. PI 10926651000. All Rights Reserved</a> </p>
			</div>
		<div class="clearfix"> </div>
	 	</div>
	</div>	
</div>
<!--//footer-->

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src="js/smooth.js"></script>

<a href="/#" class="scrolltotop"><i class="fas fa-arrow-circle-up fa-3x"></i></a>

<script type="text/javascript">
$(document).ready(function(){ 

   $(window).scroll(function(){
       if ($(this).scrollTop() > 250) {
           $('.scrolltotop').fadeIn();
       } 
       else {
           $('.scrolltotop').fadeOut();
       }
}); 
$('.scrolltotop').click(function(){
       $("html, body").animate({ scrollTop: 0 }, 800);
       return false;
       });
});
</script>

<!-- Modal comunicazione -->
	<div class="modal fade" id="comunicazione" role="dialog">
		<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
					<div style="height:50px">
						<img align="left" class="img-responsive" src="images/logoModal.png" alt="mv servizimmobiliari"/>
						<p align="center" style="font-size: 20px; color:#27da93;">COMUNICAZIONE PERIODICA</p>
					</div>
				</div>
				<div class="modal-body">
					<p>testo testo testo</p>
					<p>testo testo testo</p>
					<p>testo testo testo</p>
					<p>testo testo testo</p>
				</div>
				<div class="modal-footer">
					<a href="contact.html" class="hvr-sweep-to-right more">Scrivici</a>
					<a href="#" class="hvr-sweep-to-right more" data-dismiss="modal">Chiudi</a>
				</div>
			  </div>
		  
		</div>
	</div>
<!-- Modal comunicazione end-->

<!-- Modal mutui -->
	<div class="modal fade" id="mutuocredito" role="dialog">
		<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
					<div style="height:50px">
						<img align="left" class="img-responsive" src="images/logoModal.png" alt="mv servizimmobiliari"/>
						<p align="center" style="font-size: 20px; color:#27da93;">MUTUI E CREDITO</p>
					</div>
				</div>
				<div class="modal-body">
					<p>testo testo testo</p>
					<p>testo testo testo</p>
					<p>testo testo testo</p>
					<p>testo testo testo</p>
				</div>
				<div class="modal-footer">
					<a href="contact.html" class="hvr-sweep-to-right more">Richiedi Appuntamento</a>
					<a href="#" class="hvr-sweep-to-right more" data-dismiss="modal">Chiudi</a>
				</div>
			  </div>
		  
		</div>
	</div>
<!-- Modal mutui end-->

<!-- Modal valutazioni -->
	<div class="modal fade" id="valutazioni" role="dialog">
		<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <div style="height:50px">
						<img align="left" class="img-responsive" src="images/logoModal.png" alt="mv servizimmobiliari"/>
						<p align="center" style="font-size: 20px; color:#27da93;">VALUTAZIONI E CONSULENZE</p>
					</div>
				</div>
				<div class="modal-body">
					<p>testo testo testo</p>
					<p>testo testo testo</p>
					<p>testo testo testo</p>
					<p>testo testo testo</p>
				</div>
				<div class="modal-footer">
					<a href="contact.html" class="hvr-sweep-to-right more">Richiedi Appuntamento</a>
					<a href="#" class="hvr-sweep-to-right more" data-dismiss="modal">Chiudi</a>
				</div>
			  </div>
		  
		</div>
	</div>
<!-- Modal valutazioni end-->

<!-- Modal servizi all -->
	<div class="modal fade" id="serviziall" role="dialog">
		<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div style="height:50px">
						<img align="left" class="img-responsive" src="images/logoModal.png" alt="mv servizimmobiliari"/>
						<p align="center" style="font-size: 20px; color:#27da93;">TUTTI I SERVIZI</p>
					</div>
				</div>
				<div class="modal-body">
					<p>testo testo testo</p>
					<p>testo testo testo</p>
					<p>testo testo testo</p>
					<p>testo testo testo</p>
				</div>
				<div class="modal-footer">
					<a href="contact.html" class="hvr-sweep-to-right more">Scrivici</a>
					<a href="#" class="hvr-sweep-to-right more" data-dismiss="modal">Chiudi</a>
				</div>
			  </div>
		  
		</div>
	</div>
<!-- Modal servizi all end-->

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>

</body>
</html>
