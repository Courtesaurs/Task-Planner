<?php

include_once dirname(__FILE__). '/session.php';
require_once dirname(__FILE__). '/vendor/autoload.php';
require_once dirname(__FILE__). '/classes/Role.class.php';
require_once dirname(__FILE__). '/classes/User.class.php';


$loader = new Twig_Loader_Filesystem( dirname(__FILE__). '/templates' );
$twig = new Twig_Environment($loader, array(
    // 'cache' => dirname(__FILE__). '/templates/cache',
));


$user = \App\User::getByName($_SESSION['login']);
$roles = \App\Role::getObjects();

$context = array(
    'roles' => $roles,
    'user' => $user
);

$template = $twig->load('profile.html');

echo $template->render($context);