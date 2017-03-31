<?php

session_start();

// For debug purposes:
// echo var_dump($_SESSION);

if ( $_SERVER['REQUEST_URI'] != '/' && $_SERVER['REQUEST_URI'] != '/auth.php' && !isset( $_SESSION['login'] )) {

	header("Location: /");
	die();
}
?>