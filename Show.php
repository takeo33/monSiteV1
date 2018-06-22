<?php 

	include_once 'Pdo.php';

	$data = $bdd->query("SELECT * FROM messages");
	$messages = $data->fetchAll();


	include 'views/show_messages.html';


  	