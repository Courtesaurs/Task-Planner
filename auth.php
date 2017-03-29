<?php

session_start();

require_once dirname(__FILE__) . '/classes/User.class.php';

$login = trim(htmlspecialchars(stripslashes($_POST['login'])));
$password = trim(htmlspecialchars(stripslashes($_POST['password'])));

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