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

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$tasksPerPage = 5;

$current_user = \App\User::getByName($_SESSION['login']);

$args = array(
	'page' => $page,
	'tasksPerPage' => $tasksPerPage,
	'isFirst' => \App\Task::isFirstPage($page),
	'isLast' => \App\Task::isLastPage($page, $tasksPerPage, $current_user->id),
	'pageAmount' => \App\Task::getPageAmount($tasksPerPage, $current_user->id),
	'tasks_page' => "class=page-active"
);

$users = \App\User::getObjects();
$tasks = \App\Task::getObjects($args);
$statuses = \App\TaskStatus::getObjects();

$context = array(
    'tasks' => $tasks,
    'statuses' => $statuses,
    'users' => $users,
    'current_user' => $current_user,
    'args' => $args,
);

$template = $twig->load('tasks-list.html');

echo $template->render($context);