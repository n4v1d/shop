<?php

require 'autoload.php';
require 'lib/jdf.php';

$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];

$time = jmktime('01','01','01',$month,$day,$year);

$message = $_POST['message'];
$price = $_POST['price'];

$id = $_GET['id'];

$check = new chek();
$check->InsertNewCheckDetalis($id,$message,$price,$time);
header("location:CheckViewWait.php?CheckId=$id")

?>