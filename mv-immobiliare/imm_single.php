<!--
Author: MV Immobiliare
Author URL: MV Immobiliare
License: Creative Commons Attribution 3.0 Unported
License URL: http://mvimmobiliare.it/privacy.html
-->
<!DOCTYPE html>
<html>
<head>
<title>MV Immobile</title>
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
<!-- slide -->
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

<body >
<!--header-->
	<div class="navigation">
			<div class="container-fluid">
				<nav class="pull">
					<ul>
						<li><a  href="index.html">Home</a></li>
						<li><a  href="imm_loc_all.html">Immobili e Locazioni</a></li>
						<li><a  href="contact.html">Contatti</a></li>
					</ul>
				</nav>			
			</div>
		</div>

<div class="header">
	<div class="container">
		<!--logo-->
			<div class="logo">
					<a href="index.html"><img src="images/logo/logoTop.png" alt="mvImmobiliare " /></a>
			</div>
		<!--//logo-->
		<div class="top-nav">
			<ul class="right-icons">
				<li><span><a href="https://www.facebook.com/mvserviziimmobiliari/" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></span></li>
				<li><span><a href="https://www.instagram.com/mvserviziimmobiliari/?hl=it" target="_blank"><i class="fab fa-instagram fa-2x"></i></a></span></li>
				<li><span><a href="#"><i class="fab fa-twitter fa-2x"></i></a></span></li>
				<li><span><a href="#"><i class="fab fa-google-plus-g fa-2x"></i></a></span></li>
				<li><span><i class="glyphicon glyphicon-phone"> </i>+39 0687560995</span></li>				
			</ul>
			<div class="nav-icon">
				<div class="nav_slide_button" id="hero">
					<a href="#"><i class="glyphicon glyphicon-menu-hamburger"></i> </a>
				</div>	
			</div>
			<div class="clearfix"> </div>
		</div>
			
		</div>
		<div class="clearfix"> </div>
	</div>	
</div>
<!--//-->	

<!-- banner iniziale -->	
<div class=" banner-buying">
	<div class=" container">
		<h3>IMM<span>OBILI</span></h3> 
		<div class="clearfix"> </div>      		
	</div>
</div>
<!-- banner inizale end -->

<div class="container">
	
	<div class="buy-single-single">
	
			<div class="col-md-9 single-box">
				
       <div class=" buying-top">	
			<div class="flexslider">
  <ul class="slides">
  
  <?php 
  
  $idAnnuncio = $_GET['idAnnuncio'];
  
  $sqlAnnunciRecenti= "SELECT A.idAnnuncio, A.citta, A.indirizzo, A.prezzo, A.num_stanze, A.descrizione, C.nomeCategoria, I.path_immagine ".
                      " FROM annunci A ".
                      " LEFT JOIN immagini_annuncio I ".
                      "   ON A.idAnnuncio=I.idAnnuncio ".
                      " JOIN categorie C ".
                      "   ON A.idCategoria = C.idCategoria ".
                      " WHERE A.idAnnuncio = $idAnnuncio ".
                      " ORDER BY data_inserimento DESC ";
  try{
      if($resultAnnunciRecenti = $mysqli->query($sqlAnnunciRecenti)){
          while($rowAnnuncio = $resultAnnunciRecenti->fetch_array(MYSQLI_ASSOC)) {
              $pathImmagine = $rowAnnuncio['path_immagine'];
              echo '
	<li data-thumb="'.$pathImmagine.'">
      <img src="'.$pathImmagine.'" />
    </li>';
          }
      }
  } catch(Exception $e) {
      echo "<script type='text/javascript'>alert('ERRORE: Se il problema si presenta nuovamente, contattare l\'amministratore '".$e->getMessage().")</script>";
  }
  ?>
  
  </ul>
</div>
<!-- FlexSlider -->
  <script defer src="js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

<script>
// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails"
  });
});
</script>
</div>
<div class="buy-sin-single">
			<div class="col-sm-5 middle-side immediate">
					     <p><span class="bath">PARAMETRO</span>: <span class="two">testo</span></p>
					     <p><span class="bath1">PARAMETRO</span>: <span class="two">testo</span></p>
					     <p><span class="bath2">PARAMETRO </span>: <span class="two">testo</span></p>
					     <p><span class="bath3">PARAMETRO </span>:<span class="two">testo</span></p>
						 <p><span class="bath4">PARAMETRO </span> : <span class="two">testo</span></p>
						 <p><span class="bath5">PARAMETRO </span>:<span class="two">testo</span></p>				 
						<div class="right-side">
							 <a href="contact.html" class="hvr-sweep-to-right more">richiedi informazioni</a>     
					 </div>
					</div>
					 <div class="col-sm-7 buy-sin">
					 	<h4>DESCRIZIONE</h4>
					 	<p>testo</p>
					 	<p>testo</p>
					 </div>
					 <div class="clearfix"> </div>
					</div>
					
					<!-- MAPPA
					<div class="map-buy-single">
					 	<h4>Neighborhood Info</h4>
						 	<div class="map-buy-single1">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d37494223.23909492!2d103!3d55!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x453c569a896724fb%3A0x1409fdf86611f613!2sRussia!5e0!3m2!1sen!2sin!4v1415776049771"></iframe>
							
						</div>
					</div> -->
					<!-- VIDEO
					<div class="video-pre">
						<h4>Video Presentation</h4>
						<iframe src="https://player.vimeo.com/video/63931426"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</div>-->
		</div>
	

			
		
		<div class="col-md-3">
			<div class="single-box-right right-immediate">
		     	<h4>Immobili Correlati</h4>
		     		
                      <?php 
                      
                      $dim_x_in_vendita = DIM_X_IN_VENDITA;
                      $dim_y_in_vendita = DIM_Y_IN_VENDITA;
                      
                      $sqlAnnunciCorrelati= "SELECT A.idAnnuncio, A.citta, A.indirizzo, A.prezzo, A.num_stanze, C.nomeCategoria, I.path_immagine ".
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
                                          " WHERE A.citta = (SELECT citta FROM annunci WHERE idAnnuncio=$idAnnuncio) ".
                                          " AND A.idAnnuncio!=$idAnnuncio ".
                                          "ORDER BY data_inserimento DESC ";
                      
                      try{
                          if($resultAnnunciCorrelati = $mysqli->query($sqlAnnunciCorrelati)){
                              while($rowAnnuncio = $resultAnnunciCorrelati->fetch_array(MYSQLI_ASSOC)) {
                                  $pathImmagine = $rowAnnuncio['path_immagine'];
                                  $pathImmagine = substr($pathImmagine,0,strrpos($pathImmagine,'/')).'/'.$dim_x_in_vendita.'x'.$dim_y_in_vendita.substr($pathImmagine,strrpos($pathImmagine,'/'));
                                  echo '
            	<div class="single-box-img ">
					<div class="box-img">
						<a href="imm_single.php?idAnnuncio='.$rowAnnuncio['idAnnuncio'].'"><img class="img-responsive" src="'.$pathImmagine.'" alt=""></a>
					</div>
					<div class="box-text">
						<p>testo</p>
						<p>testo</p>
					</div>
					<div class="clearfix"> </div>
				</div>';
                              }
                          }
                      } catch(Exception $e) {
                          echo "<script type='text/javascript'>alert('ERRORE: Se il problema si presenta nuovamente, contattare l\'amministratore '".$e->getMessage().")</script>";
                      }
                      ?>
							
<!-- 				<div class="single-box-img "> -->
<!-- 					<div class="box-img"> -->
<!-- 						<a href="single.html"><img class="img-responsive" src="images/sl.jpg" alt=""></a> -->
<!-- 					</div> -->
<!-- 					<div class="box-text"> -->
<!-- 						<p>testo</p> -->
<!-- 						<p>testo</p> -->
<!-- 					</div> -->
<!-- 					<div class="clearfix"> </div> -->
<!-- 				</div> -->
<!-- 				<div class="single-box-img"> -->
<!-- 					<div class="box-img"> -->
<!-- 						<a href="single.html"><img class="img-responsive" src="images/sl1.jpg" alt=""></a> -->
<!-- 					</div> -->
<!-- 					<div class="box-text"> -->
<!-- 						<p>testo</p> -->
<!-- 						<p>testo</p> -->
<!-- 					</div> -->
<!-- 					<div class="clearfix"> </div> -->
<!-- 				</div> -->
<!-- 				<div class="single-box-img"> -->
<!-- 					<div class="box-img"> -->
<!-- 						<a href="single.html"><img class="img-responsive" src="images/sl2.jpg" alt=""></a> -->
<!-- 					</div> -->
<!-- 					<div class="box-text"> -->
<!-- 						<p>testo</p> -->
<!-- 						<p>testo</p> -->
<!-- 					</div> -->
<!-- 					<div class="clearfix"> </div> -->
<!-- 				</div> -->
<!-- 				<div class="single-box-img"> -->
<!-- 					<div class="box-img"> -->
<!-- 						<a href="single.html"><img class="img-responsive" src="images/sl3.jpg" alt=""></a> -->
<!-- 					</div> -->
<!-- 					<div class="box-text"> -->
<!-- 						<p>testo</p> -->
<!-- 						<p>testo</p> -->
<!-- 					</div> -->
<!-- 					<div class="clearfix"> </div> -->
<!-- 				</div> -->
<!-- 				<div class="single-box-img"> -->
<!-- 					<div class="box-img"> -->
<!-- 						<a href="single.html"><img class="img-responsive" src="images/sl4.jpg" alt=""></a> -->
<!-- 					</div> -->
<!-- 					<div class="box-text"> -->
<!-- 						<p>testo</p> -->
<!-- 						<p>testo</p> -->
<!-- 					</div> -->
<!-- 					<div class="clearfix"> </div> -->
<!-- 				</div> -->
		 </div>
			
	  </div>
		<div class="clearfix"> </div>
		</div>
	</div>

<!---->
<div class="container">
	<div class="future">
		<h3>I PIU' RECENTI</h3>
			<div class="content-bottom-in">
					<ul id="flexiselDemo1">	
					
						<?php
			    $dim_x_vetrina = DIM_X_VETRINA;
			    $dim_y_vetrina = DIM_Y_VETRINA;
			
				$sqlAnnunciRecenti= "SELECT A.idAnnuncio, A.citta, A.indirizzo, A.prezzo, A.num_stanze, C.nomeCategoria, I.path_immagine ".
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
						while($rowAnnuncio = $resultAnnunciRecenti->fetch_array(MYSQLI_ASSOC)) {
						    $pathImmagine = $rowAnnuncio['path_immagine'];
						    $pathImmagine = substr($pathImmagine,0,strrpos($pathImmagine,'/')).'/'.$dim_x_vetrina.'x'.$dim_y_vetrina.substr($pathImmagine,strrpos($pathImmagine,'/'));
						    $i++;
							echo '
				            <li>
                                <div class="project-fur">
								    <a href="imm_single.php?idAnnuncio='.$rowAnnuncio['idAnnuncio'].'" ><img class="img-responsive" src="'.$pathImmagine.'" alt="" />	</a>
									<div class="fur">
										<div class="fur1">
		                                    <span class="fur-money">&#8364; '.number_format($rowAnnuncio['prezzo'],2,",",".").'</span>
		                                    <span class="fur-money"><i class="fa fa-home"></i> '.$rowAnnuncio['num_stanze'].' stanze</span>
		                                    <h6 class="fur-name"><a href="imm_single.php?idAnnuncio='.$rowAnnuncio['idAnnuncio'].'">'.$rowAnnuncio['nomeCategoria'].'</a></h6>
		                                   	<span>'.$rowAnnuncio['indirizzo'].'</span>
                               			</div>
			                            <div class="fur2">
			                               	<span>'.$rowAnnuncio['citta'].'</span>
			                             </div>
									</div>					
							    </div>
                            </li>';
							if($i>8){
							    break;
							}
						}
					}
				} catch(Exception $e) {
					echo "<script type='text/javascript'>alert('ERRORE: Se il problema si presenta nuovamente, contattare l\'amministratore '".$e->getMessage().")</script>";
				}
			?>
							
					</ul>
					<script type="text/javascript">
						$(window).load(function() {
							$("#flexiselDemo1").flexisel({
								visibleItems: 4,
								animationSpeed: 1000,
								autoPlay: true,
								autoPlaySpeed: 3000,    		
								pauseOnHover: true,
								enableResponsiveBreakpoints: true,
						    	responsiveBreakpoints: { 
						    		portrait: { 
						    			changePoint:480,
						    			visibleItems: 1
						    		}, 
						    		landscape: { 
						    			changePoint:640,
						    			visibleItems: 2
						    		},
						    		tablet: { 
						    			changePoint:768,
						    			visibleItems: 3
						    		}
						    	}
						    });
						    
						});
			</script>
			<script type="text/javascript" src="js/jquery.flexisel.js"></script>
		</div>
	</div>
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
					<li><a href="imm_loc_all.html">Immobili e Locazioni</a></li>
					<li><a href="mutuo_cred.html">Mutui / Consulenza del Credito</a></li>
					<li><a href="aste.html">Aste Immobiliari</a></li>
					<li><a href="work_with_us.html">Lavora con Noi</a></li>
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

<a href="/#" class="scrolltotop"><i class="fa fa-arrow-circle-up fa-3x" aria-hidden="true"></i></a>

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

</body>
</html>