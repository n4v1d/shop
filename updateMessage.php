<?php

$factorid = $_POST['factorid'];

echo $factorid;

$message = $_POST['message'];




require 'autoload.php';

$update = new update();

$update->message($factorid,$message);
?>