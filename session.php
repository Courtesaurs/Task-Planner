<?php

session_start();

// For debug purposes:
// echo var_dump($_SESSION);

if ( $_SERVER['REQUEST_URI'] != '/' && !$_SESSION['login'] ) {
	header("Location: /");
	die();
}
?>