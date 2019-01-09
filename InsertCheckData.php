<?php
require 'autoload.php';
require 'lib/jdf.php';



$status = $_POST['status'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$price = $_POST['price'];
$title = $_POST['title'];
$company = $_POST['company'];


$time = jmktime("05","05","05",$month,$day,$year);



$check = new check();

$check->InsertCheck($status,$time,$title,$price,$company);

?>