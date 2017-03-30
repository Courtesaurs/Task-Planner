<?php

include_once dirname(__FILE__). '/session.php';
require_once dirname(__FILE__). '/classes/Task.class.php';
require_once dirname(__FILE__). '/classes/User.class.php';

$user = \App\User::getByName($_SESSION['login']);
$user_id = $user->getID();

$task = new \App\Task(
	$_POST['title'],
	$_POST['description'],
	1,
	$user_id
);

$task->save();

header("Location: /tasks-list");
die();