<?php

	require_once 'Pdo.php';

	$user_id = $_GET['id'];
	$token = $_GET['token'];

	$query = $bdd->prepare("SELECT confirmation_token,name,email FROM users WHERE id = ? ");
	$query->execute( array($user_id));

	$user = $query->fetch();
	session_start();

	if ($user && $user->confirmation_token == $token) {
		
		$bdd->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW()  WHERE id = ?')->execute([$user_id]);
		$_SESSION['flash']['success'] = 'Votre compte à bien été validé';
		$user->password = $user->id = $user->confirmed_at = 'fuck that in session, mate';
		$_SESSION['auth']  = $user;
		header("Location: Account.php");
	}else{
		$_SESSION["flash"]['danger'] = 'Ce token n\'est plus valide';
		header("Location: Login.php");
	}