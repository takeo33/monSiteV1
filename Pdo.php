<?php

try {
	
		$bdd = new PDO('mysql:host=localhost;dbname=monsite;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ));

		
		function str_random($length){

			$alpha = "abcdefghijklmnopqrstuvwxyz1234567890QBCDEFGHIJKLMNOPQRSTUVWXYZ";

			return substr(str_shuffle(str_repeat($alpha, $length)),0,$length);

		}
		$token = str_random(60); 
	
	} 
	catch(Exeption $e)
	{
		die('Erreur : ' . $e->getMessage());
	}	


