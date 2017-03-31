<?php

include_once dirname(__FILE__). '/session.php';
require_once dirname(__FILE__). '/vendor/autoload.php';
require_once dirname(__FILE__). '/classes/Role.class.php';
require_once dirname(__FILE__). '/classes/User.class.php';


$loader = new Twig_Loader_Filesystem( dirname(__FILE__). '/templates' );
$twig = new Twig_Environment($loader, array(
    // 'cache' => dirname(__FILE__). '/templates/cache',
));

$users = \App\User::getObjects();
$roles = \App\Role::getObjects();
$statuses = \App\TaskStatus::getObjects();

$current_user = null;
foreach ($users as $user) {
    if($user->username == $_SESSION['login']) {
        $current_user = $user;      
    }
}

$tasks = $current_user->getTasks();

$context = array(
    'users' => $users,
    'roles' => $roles,
    'current_user' => $current_user,
    'tasks' => $tasks,    
    'statuses' => $statuses,
);

$template = $twig->load('profile.html');

echo $template->render($context);