<?php

session_start();

require 'autoload.php';
$username = $_POST['user'];
$password = $_POST['pass'];
$user = new user();
$user->UserLogin($username,$password);

?>