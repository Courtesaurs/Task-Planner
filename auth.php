<?php

include_once dirname(__FILE__). '/session.php';
require_once dirname(__FILE__) . '/classes/User.class.php';

$name = trim(htmlspecialchars(stripslashes($_POST['name'])));
$login = trim(htmlspecialchars(stripslashes($_POST['login'])));
$password = trim(htmlspecialchars(stripslashes($_POST['password'])));

if (isset($_POST['sign-up'])) {

	$user = new \App\User(
		0,
		$name,
		$login,
		$password,
		1
	);

	if( $user->save() ) {
		$_SESSION['login'] = $login;
	}

	header("Location: /");
	die();
} elseif (isset($_POST['sign-in'])) {

	$user = new \App\User(
		0,
		$name,
		$login,
		$password,
		1
	);

	if( $user->login() ) {
		$_SESSION['login'] = $login;
	}

	header("Location: /");
	die();
	
} else {
	exit('What are you even doing here?');
}