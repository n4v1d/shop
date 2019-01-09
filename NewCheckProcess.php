<?php

require 'autoload.php';
require 'lib/jdf.php';


// Defin Parameters

$company = $_GET['company'];
$price= $_GET['price'];
$check_id = $_GET['check_id'];


$factorid  = $_GET['factor_id'];


$day  = $_GET['day'];
$month = $_GET['month'];
$year = $_GET['year'];
$time  = jmktime('00','00','01', $month , $day , $year);



$check = new chek();

$check->InsertNewCheck($company , 'ثبت دستی چک' , $price , $time , $time,'01','1','00',$factorid,$message = 'ثبت دستی چک',$check_id = null)


?>
<br>
<a href="NewCheck.php   ">بازگشت</a>
