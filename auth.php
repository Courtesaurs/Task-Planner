<?php

session_start();

require_once dirname(__FILE__) . '/classes/User.class.php';

$login = trim(htmlspecialchars(stripslashes($_POST['login'])));
$password = trim(htmlspecialchars(stripslashes($_POST['password'])));

if (isset($_POST['sign-up'])) {

	$user = new \App\User(
		$login,
		$login,
		1,
		$password
	);

	if( $user->save() ) {
		$_SESSION['login'] = $login;
	}

	header("Location: /");
	die();
} elseif (isset($_POST['sign-in'])) {

	$user = new \App\User(
		$login,
		$login,
		1,
		$password
	);

	if( $user->login() ) {
		$_SESSION['login'] = $login;
	}

	header("Location: /");
	die();
	
} else {
	exit('What are you even doing here?');
}