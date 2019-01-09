<?php
require 'lib/jdf.php';
require 'autoload.php';
$factorid = $_POST['factorid'];
$len = $_POST['len'];

$check = new check();
$factor = new factor();

$factor->getFactorDetail($factorid);


$time  = $factor->time + ($len * 86400);


$check->UpdateCheckLenth($factorid,$len , $time)



?>