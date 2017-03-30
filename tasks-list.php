<?php

include_once dirname(__FILE__). '/session.php';
require_once dirname(__FILE__). '/vendor/autoload.php';
require_once dirname(__FILE__). '/classes/Task.class.php';
require_once dirname(__FILE__). '/classes/User.class.php';

$loader = new Twig_Loader_Filesystem( dirname(__FILE__). '/templates' );
$twig = new Twig_Environment($loader, array(
    'debug' => true,
    // 'cache' => dirname(__FILE__). '/templates/cache',
));

$tasks = \App\Task::getObjects();
$statuses = \App\TaskStatus::getObjects();
$users = \App\User::getObjects();

$context = array(
    'tasks' => $tasks,
    'statuses' => $statuses,
    'users' => $users
);

$template = $twig->load('tasks-list.html');

echo $template->render($context);