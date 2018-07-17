<html>
<head>
  <title>Login Amministrazione</title>
  <link rel="icon" href="../images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  
  <style>
	  .form-signin
	{
		max-width: 330px;
		padding: 15px;
		margin: 0 auto;
	}
	.form-signin .form-signin-heading, .form-signin .checkbox
	{
		margin-bottom: 10px;
	}
	.form-signin .checkbox
	{
		font-weight: normal;
	}
	.form-signin .form-control
	{
		position: relative;
		font-size: 16px;
		height: auto;
		padding: 10px;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
	.form-signin .form-control:focus
	{
		z-index: 2;
	}
	.form-signin input[type="text"]
	{
		margin-bottom: -1px;
		border-bottom-left-radius: 0;
		border-bottom-right-radius: 0;
	}
	.form-signin input[type="password"]
	{
		margin-bottom: 10px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
	}
	.account-wall
	{
		margin-top: 20px;
		padding: 40px 0px 20px 0px;
		background-color: #f7f7f7;
		-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	}
	.login-title
	{
		color: #555;
		font-size: 18px;
		font-weight: 400;
		display: block;
	}
	.profile-img
	{
		width: 96px;
		height: 96px;
		margin: 0 auto 10px;
		display: block;
		-moz-border-radius: 50%;
		-webkit-border-radius: 50%;
		border-radius: 50%;
	}
  </style>
  
</head>

<?php
// Version
define('VERSION', '1.0');

// Configuration
//require_once('php/connDB.php');
try {
	include 'php/utility.php';
	include("php/connDB.php");
	sec_session_start();
	
}catch(Exception $e) {
	echo "<script type='text/javascript'>alert('ERROR: Input data is fail: '".$e->getMessage().")</script>";
}

?>

<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<h1 class="text-center login-title">Login Amministrazione</h1>
				<div class="account-wall">
					<img class="profile-img" src="../images/user-login-image.png"
						alt=""/>
	<?php
		if (isset($_SESSION['esito']) and $_SESSION['esito']=='WARN'){
	?>
		<div class="alert alert-warning">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Attenzione!</strong> <?php echo "$_SESSION[messaggioLogin]";?>
		</div>
	<?php
			unset($_SESSION['esito']);
			unset($_SESSION['messaggioLogin']);
		}else if (isset($_SESSION['esito']) and $_SESSION['esito']=='NOK'){
	?>
		<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Errore!</strong> <?php echo "$_SESSION[messaggioLogin]";?>
		</div>
	<?php
			unset($_SESSION['esito']);
			unset($_SESSION['messaggioLogin']);
		}
	?>
					<form name="login_form" action="php/login.php" method="post" class="form-signin">
						<input name="username" type="text" class="form-control" placeholder="Username" required autofocus>
						<input name="password" type="password" class="form-control" placeholder="Password" required>
						<button class="btn btn-lg btn-primary btn-block" type="submit">
							Sign in</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>