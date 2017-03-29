<?php

session_start();

require_once dirname(__FILE__). '/vendor/autoload.php';
require_once dirname(__FILE__). '/classes/Task.class.php';

$loader = new Twig_Loader_Filesystem( dirname(__FILE__). '/templates' );
$twig = new Twig_Environment($loader, array(
    'debug' => true,
    // 'cache' => dirname(__FILE__). '/templates/cache',
));

$tasks = \App\Task::getObjects();
$statuses = \App\TaskStatus::getObjects();
$context = array(
    'tasks' => $tasks,
    'statuses' => $statuses
);

$template = $twig->load('tasks-list.html');

echo $template->render($context);