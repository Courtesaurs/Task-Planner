<?php

require_once dirname(__FILE__) . '/classes/User.class.php';

$user = new \App\User(
	$_POST['login'],
	1,
	$_POST['login'],
	$_POST['password']
);

$result = $user->save();

header("Location: /tasks-list.php");
die();