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

$users = \App\User::getObjects();
$roles = \App\Role::getObjects();

$current_user = null;
foreach ($users as $user) {
    if($user->username == $_SESSION['login'])
        $current_user = $user;
}

$context = array(
    'users' => $users,
    'roles' => $roles,
    'current_user' => $current_user
);

$template = $twig->load('team-list.html');

echo $template->render($context);