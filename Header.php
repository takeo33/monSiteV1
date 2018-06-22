<?php
		
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

 	echo '<!DOCTYPE html>
<html>	
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Mathias Tardiff</title>
       <link href="https://fonts.googleapis.com/css?family=Cabin|Tajawal" rel="stylesheet">

		<link rel="stylesheet" href="css/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css"  crossorigin="anonymous">
		
		<script src="js/jquery-3.3.1.min.js"  crossorigin="anonymous"></script>
		<script src="js/tether-master/dist/js/tether.min.js"  crossorigin="anonymous"></script>


		<script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.css" crossorigin="anonymous">

   </head>

    <body>
		<header>
	
			<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
	  			
	  			<div class="collapse navbar-collapse" id="navbarNav">
	    			<ul class="navbar-nav">
	      				<li class="nav-item active">
	        				<a class="nav-link" href="index.php">Home</a>
	      				</li>
	      				<li class="nav-item">
	        				<a class="nav-link" href="index.php#about">About</a>
	      				</li>
	      				<li class="nav-item">
	        				<a class="nav-link" href="index.php#portfolio">Portfolio</a>
	      				</li>
	      				<li class="nav-item">
	        				<a class="nav-link" href="index.php#contact">Contact</a>
	      				</li>';

if (!isset($_SESSION['auth'])) {
	
	echo '


	      				<li class="nav-item">
	      					<a class="nav-link" href="Register.php">Register</a>
	      				</li
	      				<li class="nav-item">
	      					<a class="nav-link" href="Login.php">Login</a>
	      				</li>';
}else{
	echo ' 
						<li class="nav-item">
	      					<a class="nav-link" href="Logout.php">Logout</a>
	      				</li>
	      				<li class="nav-item">
	      					<a class="nav-link" href="Show.php">Messages</a>
	      				</li>';

}
echo '	    			</ul>
	  			</div>

	  			
  				<a href="Account.php"><i style="color:white" class="fas fa-cogs"></i></a>
	  			
			</nav>
		
        </header>';



if (isset($_SESSION['flash'])) {
	
	foreach ($_SESSION['flash'] as $type => $message) {
		
		echo '<div class="alert alert-'.$type.'" style="margin-bottom: 0px"><ul><li>'.$message.'</li></ul></div>';
	}

	unset($_SESSION["flash"]);
}