<?php

require_once dirname(__FILE__) . '/classes/User.class.php';

$user = new \App\User(
	$_POST['login'],
	0,
	$_POST['login'],
	$_POST['password']
);

$result = $user->register();

header("Location: /tasks-list.php");
die();