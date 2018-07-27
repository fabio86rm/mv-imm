<!--
Author: MV Immobiliare
Author URL: MV Immobiliare
License: Creative Commons Attribution 3.0 Unported
License URL: http://mvimmobiliare.it/privacy.html
-->
<!DOCTYPE html>
<html>
<head>
<title>MV Immobili Locazioni</title>
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
						<li><a  href="immobili_loc_all.html">Immobili e Locazioni</a></li>
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

<div class=" banner-buying">
	<div class=" container">
	<h3><span>IMMOBILI E LOCAZIONI</span></h3> 
</div>
	
	<div class="clearfix"> </div>
		<!--initiate accordion-->
		<script type="text/javascript">
			$(function() {
			    var menu_ul = $('.menu > li > ul'),
			           menu_a  = $('.menu > li > a');
			    menu_ul.hide();
			    menu_a.click(function(e) {
			        e.preventDefault();
			        if(!$(this).hasClass('active')) {
			            menu_a.removeClass('active');
			            menu_ul.filter(':visible').slideUp('normal');
			            $(this).addClass('active').next().stop(true,true).slideDown('normal');
			        } else {
			            $(this).removeClass('active');
			            $(this).next().stop(true,true).slideUp('normal');
			        }
			    });
			
			});
		</script>
      		
	</div>
</div>
<!--//header-->
<div class="container">

	
	<!-- box ricerca
	<div class="price">
		<div class="price-grid">
			<div class="col-sm-4 price-top">
				<h4>City</h4>
				<select class="in-drop">
					<option>Select City</option>
					<option>Bangkok</option>
					<option>Tokyo</option>
					<option>London</option>
					<option>Paris</option>
					<option>Dhubai</option>
					<option>New Jerrsey</option>
					<option>Hongkong</option>
					<option>New York</option>
					<option>Rome</option>
					<option>Sydney</option>
					<option>Florence</option>
					<option>Istanbul</option>
					<option>Brezil</option>
					<option>Canda</option>
					<option>Malaysia</option>
					<option>Singapore</option>
					<option>Taiwan</option>
					<option>Spain</option>
					<option>More</option>
				</select>
			</div>
			<div class="col-sm-4 price-top">
				<h4>Category</h4>
				<select class="in-drop">
					<option>Select Category</option>
					<option>Apartment</option>
					<option>Independent House</option>
					<option>Row House</option>
					<option>Villa</option>
					<option>Builder Floor</option>
					<option>Farm House</option>
					<option>Penthouse</option>
				</select>
			</div>
			<div class="col-sm-4 price-top">
				<h4>Rooms</h4>
				<select class="in-drop">
					<option>No. of Bedrooms</option>
					<option>1 BHK</option>
					<option>2 BHK</option>
					<option>3 BHK</option>
					<option>4 BHK</option>
					<option>4+ BHK</option>
				</select>
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="price-grid">
			<div class="col-sm-6 price-top1">
				<h4>Price Range</h4>
				<ul>
					<li>
						<select class="in-drop">
							<option>Price From</option>
							<option>0</option>
							<option>5 Lacs </option>
							<option>10 Lacs</option>
							<option>15 Lacs</option>
							<option>20 Lacs</option>
							<option>25 Lacs</option>
							<option>30 Lacs</option>
							<option>35 Lacs</option>
							<option>40 Lacs</option>
							<option>45 Lacs</option>
							<option>50 Lacs</option>
							<option>55 Lacs</option>
							<option>60 Lacs</option>
							<option>65 Lacs</option>
							<option>70 Lacs</option>
							<option>75 Lacs</option>
							<option>80 Lacs</option>
							<option>85 Lacs</option>
							<option>90 Lacs</option>
							<option>95 Lacs</option>
						</select>
					</li>
					<span>-</span>
					<li>
						<select class="in-drop">
							<option>Price To</option>
							<option>5 Lacs</option>
							<option>10 Lacs</option>
							<option>15 Lacs</option>
							<option>20 Lacs</option>
							<option>25 Lacs</option>
							<option>30 Lacs</option>
							<option>35 Lacs</option>
							<option>40 Lacs</option>
							<option>45 Lacs</option>
							<option>50 Lacs</option>
							<option>55 Lacs</option>
							<option>60 Lacs</option>
							<option>65 Lacs</option>
							<option>70 Lacs</option>
							<option>75 Lacs</option>
							<option>80 Lacs</option>
							<option>85 Lacs</option>
							<option>90 Lacs</option>
							<option>95 Lacs</option>
							<option>100 Cr</option>
						</select>
					</li>
				</ul>
			</div>
			<div class="col-sm-6 price-top1">
				<h4>Area</h4>
				<ul>
					<li>
						<select class="in-drop">
							<option>Sqmt From</option>
							<option>0</option>
							<option>500 Sq Ft</option>
							<option>1000 Sq Ft</option>
							<option>1500 Sq Ft</option>
							<option>2000 Sq Ft</option>
							<option>2500 Sq Ft</option>
							<option>3000 Sq Ft</option>
							<option>3500 Sq Ft</option>
							<option>4000 Sq Ft</option>
							<option>4500 Sq Ft</option>
						</select>
					</li>
					<span>-</span>
					<li>
						<select class="in-drop">
							<option>Sqmt To</option>
							<option>500 Sq Ft</option>
							<option>1000 Sq Ft</option>
							<option>1500 Sq Ft</option>
							<option>2000 Sq Ft</option>
							<option>2500 Sq Ft</option>
							<option>3000 Sq Ft</option>
							<option>3500 Sq Ft</option>
							<option>4000 Sq Ft</option>
							<option>4500 Sq Ft</option>
							<option>5000+ Sq Ft</option>
						</select>
					</li>
				</ul>
			</div>
			
		</div>
	</div>
	box ricerca end -->
	
	<div class="clearfix"> </div>
	<br/><br/>
	
	<div class="top-grid">
		<h3>IMMOBILI E LOCAZIONI</h3>
		
		<div class="grid-at">
			
			<?php 
			
			$sqlCategorie= "SELECT * FROM categorie ";
			try{
			    if($resultCategorie = $mysqli->query($sqlCategorie)){
			        while($rowCategoria = $resultCategorie->fetch_array(MYSQLI_ASSOC)) {
			            echo '
	       <div class="col-md-3 grid-city">
				<div class="grid-lo">
					<a href="'.$rowCategoria['linkCategoria'].'">
						<figure class="effect-layla">
							<img class="img-responsive" src="'.$rowCategoria['immagineCategoria'].'" alt="residenziali">
							<figcaption>
								<h4>'.strtoupper($rowCategoria['nomeCategoria']).'</h4>
							</figcaption>			
						</figure>
					</a>
				 </div>
			</div>';
			        }
			    }
			} catch(Exception $e) {
			    echo "<script type='text/javascript'>alert('ERRORE: Se il problema si presenta nuovamente, contattare l\'amministratore '".$e->getMessage().")</script>";
			}
			?>
			
			<div class="clearfix"> </div>
		</div>

	</div>
</div>

<!--premium-project
<div class="premium">
	<div class="pre-top">
		<h5>Lorem Ipsum is simply dummy</h5>
		<p>$7.24 Lacs-4.36 Lacs 2-3 BHK, Lorem Ipsum</p>
	</div>
</div>
premium-project-->


<div class="container">
	<div class="future">
		<h3>I PIU' RECENTI</h3>
			<div class="content-bottom-in">
					<ul id="flexiselDemo1">	
					
						<?php
			    $dim_x_vetrina = DIM_X_VETRINA;
			    $dim_y_vetrina = DIM_Y_VETRINA;
			
				$sqlAnnunciRecenti= "SELECT A.citta, A.indirizzo, A.prezzo, A.num_stanze, C.nomeCategoria, I.path_immagine ".
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
								    <a href="imm_single.php" ><img class="img-responsive" src="'.$pathImmagine.'" alt="" />	</a>
									<div class="fur">
										<div class="fur1">
		                                    <span class="fur-money">&#8364; '.number_format($rowAnnuncio['prezzo'],2,",",".").'</span>
		                                    <span class="fur-money"><i class="fa fa-home"></i> '.$rowAnnuncio['num_stanze'].' stanze</span>
		                                    <h6 class="fur-name"><a href="single.html">'.$rowAnnuncio['nomeCategoria'].'</a></h6>
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


