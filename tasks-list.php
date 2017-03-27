<?php

require_once dirname(__FILE__). '/vendor/autoload.php';

$loader = new Twig_Loader_Filesystem( dirname(__FILE__). '/templates' );
$twig = new Twig_Environment($loader, array(
    // 'cache' => dirname(__FILE__). '/templates/cache',
));

$template = $twig->load('tasks-list.html');

echo $template->render();