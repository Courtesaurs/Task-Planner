<?php

require_once dirname(__FILE__). '/session.php';
require_once dirname(__FILE__). '/vendor/autoload.php';
require_once dirname(__FILE__). '/classes/Task.class.php';

// TODO: If not installed then installation wizard

// TODO: if not authorized then auth esle tasks list

$loader = new Twig_Loader_Filesystem( dirname(__FILE__). '/templates' );
$twig = new Twig_Environment($loader, array(
    'debug' => true,
    // 'cache' => dirname(__FILE__). '/templates/cache',
));

if ( !$_SESSION['login'] ) {

	$context = array();
	$template = $twig->load('auth.html');

} else {

	$tasks = \App\Task::getObjects();
	$statuses = \App\TaskStatus::getObjects();
	$context = array(
	    'tasks' => $tasks,
	    'statuses' => $statuses
	);

	$template = $twig->load('tasks-list.html');
}

echo $template->render($context);