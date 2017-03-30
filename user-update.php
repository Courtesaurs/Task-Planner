<?php

include_once dirname(__FILE__). '/session.php';
require_once dirname(__FILE__). '/classes/Task.class.php';


\App\User::updateRole($_POST['user-id'], $_POST['select-role']);

header("Location: " . $_POST['page']);
die();