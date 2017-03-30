<?php

include_once dirname(__FILE__). '/session.php';
require_once dirname(__FILE__). '/classes/Task.class.php';

if(!isset($_POST['select-executor'])) {
	$_POST['select-executor'] = NULL;
}

// die(var_dump($_POST));

\App\Task::updateStatus($_POST['task-id'], $_POST['select-status'], $_POST['select-executor']);

header("Location: " . $_POST['page']);
die();