<?php 

if (session_status() == PHP_SESSION_NONE) {
			session_start();
}

if (!empty($_POST)) {
	
	require_once 'Pdo.php';


	$errors = [];

	if ($_POST["slug"] === 'forget') {

		if (!empty($_POST['email']) && !empty($_POST)) {

			$email = htmlspecialchars($_POST["email"]);

			$query = $bdd->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');
			$query->execute([$email]);

			$user = $query->fetch();

			if ($user) {

				session_start();

				$reset_token = str_random(60);

				$bdd->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() 
					WHERE id = ?')->execute([$reset_token,$user->id]);
	
				$_SESSION['flash']["success"] =  "A mail have been send to your mail adress";

				mail($email,'Réinitialisation de votre mot de passe',
		    'Afin de Réinitialiser votre mot de passe, merci de cliquer sur ce lien:\n\n
		    http://localhost/mon%20site/Reset.php?id={$user_id}&token={$reset_token}',
			'FROM:boiteamat@gmail.com');
				header('Location: Login.php');
				exit(); 
			}
		}


		$_SESSION['flash']["danger"] =  "This mail is unknown ..";
		require_once 'Forget.php';
	}


	if ($_POST["slug"] === 'newname') {
		
		/**
		*
		*ICI TRAITEMENT DU FORMULAIRE DE CHANGEMENT DE PASSWORD UTILISATEUR
		*/

		if (empty($_POST['password']) || $_POST['password'] !=  $_POST['password_confirm']) {
				$_SESSION['flash']["danger"] =  "Please fill the passwords inputs correctly";
				require_once 'Account.php';
		}else {
		
			$user_id = $_SESSION['auth']->id;
			$password = password_hash($_POST['password'],PASSWORD_BCRYPT);

			$query = $bdd->prepare("UPDATE `users` SET `password` = ? WHERE `users`.`id` = ?  ");
			$query->execute( array($password,$user_id));

			$_SESSION['flash']["success"] = 'Le mot de passe à été mis à jour';
		}
			
		
	}



	if ($_POST['slug'] === 'imback') {
		
		/**
		*ICI TRAITEMENT DU FORMULAIRE DE LOGIN UTILISATEUR
		*
		*/
		if (!empty($_POST["name"]) && !empty($_POST["password"])) {
			$name = htmlspecialchars($_POST['name']);
			$password = htmlspecialchars($_POST['password']);

			$query = $bdd->prepare("SELECT * FROM users WHERE name = :name OR email = :email AND confirmed_at IS NOT NULL");
			$query->execute(["name" => $name,'email'=> $name]);
			$user = $query->fetch();


			if (password_verify($password,$user->password)) {
				$user->password = $user->id = $user->confirmed_at = 'fuck that in session, mate';
				$_SESSION['flash']['success'] = "You are now connected, Yeah!";
				$_SESSION['auth'] = $user;
				header('Location: Account.php');
				exit();
			}else{
				$_SESSION['flash']['danger'] = 'incorrect id or password';
				header('Location: Login.php');
				exit();
			}
		}
	}

	if ($_POST['slug'] === 'welcome') {
		
		/**
		* ICI TRAITEMENT DU FORMULAIRE DE CREATION DE COMPTE UTILISATEUR
		*
		*/

		if (empty($_POST['name']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['name'])) {
			$errors['name'] = "Please fill the name input correctly";
			require_once 'Register.php';
		}
		else {
		
			$query = $bdd->prepare("SELECT name FROM users WHERE name = ? ");
			$query->execute( array($_POST['name']));
			$user = $query->fetch();

			if ($user) {
				$errors['name'] = 'this pseudo is already taken';
				require_once 'Register.php';
			}

		}

		if (empty($_POST['email']) || !filter_var( $_POST['email'],FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = "Please fill the email input correctly";
				require_once 'Register.php';
		}else {
		
			$query = $bdd->prepare("SELECT `email` FROM `users` WHERE `email`= ? ");
			$query->execute( array($_POST['email']));
			$user = $query->fetch();

			if ($user) {
				$errors['email'] = 'this mail is already used';
				require_once 'Register.php';
			}

		}

		if (empty($_POST['password']) || $_POST['password'] !=  $_POST['password_confirm']) {
				$errors['password'] = "Please fill the passwords inputs correctly";
				require_once 'Register.php';
		}

		if (empty($errors)) {
			
			$name = htmlspecialchars($_POST['name']);
			$mail = htmlspecialchars($_POST['email']);
			$password = htmlspecialchars($_POST['password']);
			$password = password_hash($password,PASSWORD_BCRYPT);

			$query = $bdd->prepare("INSERT INTO `users` ( `name`, `email`,`password`,`confirmation_token`) VALUES (:name, :email, :password,:confirmation_token) ");

			$query->execute( array('name' => $name,'email'=> $mail, 'password' => $password, 'confirmation_token' => $token));
			$user_id = $bdd->lastInsertId();

		 	mail($_POST['email'],"Confirmation de votre Compte",
		    "Afin de valider votre compte, merci de cliquer sur ce lien:\n\n
		    http://localhost/mon%20site/Confirm.php?id=".$user_id."&token=".$token,
			'FROM:boiteamat@gmail.com');
		 	$_SESSION['flash']['success'] = 'Un email de confirmation à bien été envoyé';
		    header("location: Login.php");
		  	exit();	
		}
	}

	

	if ($_POST['slug'] === 'message') {
	
		/**
			* ICI TRAITEMENT DU FORMULAIRE DE CONTACT SUR PAGE ACCUEIL
			*
			*/

		if (empty($_POST['name']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['name'])) {
			$errors['name'] = "Please fill the name input correctly";
			require_once 'index.php';
		}
		 
	 	if (is_string($_POST['name']) && is_string($_POST['message'])) {
		
			$name = htmlspecialchars($_POST['name']);
			$message = htmlspecialchars($_POST['message']);

			$query = $bdd->prepare("INSERT INTO `messages` ( `pseudo`, `message`) VALUES (:pseudo, :message) ");

			$query->execute( array('pseudo' => $name,'message'=> $message));

			$_SESSION['flash']['success'] = 'Message send!';
		 	header('Location: index.php');
		  	exit();

 		}
		 
	}

	// PAR DEFAUT SI ON JOUE AVEC LE SLUG ON RETOURNE FAIRE UN TOUR EN PAGE D ACCUEIL
	require_once 'index.php';
}
