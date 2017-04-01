<?php

include_once dirname(__FILE__). '/session.php';
require_once dirname(__FILE__). '/vendor/autoload.php';
require_once dirname(__FILE__). '/classes/User.class.php';
require_once dirname(__FILE__). '/classes/Role.class.php';

if ( !isset($_SESSION['login']) && !$_SESSION['login'] ) {
    header('Location: /');
}

$loader = new Twig_Loader_Filesystem( dirname(__FILE__). '/templates' );
$twig = new Twig_Environment($loader, array(
    'debug' => true,
    // 'cache' => dirname(__FILE__). '/templates/cache',
));

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$usersPerPage = 5;

$args = array(
	'page' => $page,
	'usersPerPage' => $usersPerPage,
	'isFirst' => \App\User::isFirstPage($page),
	'isLast' => \App\User::isLastPage($page, $usersPerPage),
	'pageAmount' => \App\User::getPageAmount($usersPerPage),
	'team_page' => "class=page-active"
);

$users = \App\User::getObjects($args);
$roles = \App\Role::getObjects();

$current_user = \App\User::getByName($_SESSION['login']);

$context = array(
    'users' => $users,
    'roles' => $roles,
    'current_user' => $current_user,
    'args' => $args
);

$template = $twig->load('team-list.html');

echo $template->render($context);