<?php


if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

unset($_SESSION["auth"]);
$_SESSION['flash']['success'] = 'Vous êtes maintenant déconnecté(e)';
header('Location: Login.php');
exit();