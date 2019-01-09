<?php
session_start();
require 'autoload.php';

$userId =$_SESSION['UserId'];
$factorid = $_GET['factorid'];
$factor = new factor();
if($userId == '1' || $userId == '5')
{
$factor->UpdateZayeat($factorid,$userId);
}
else
{
    echo 'متاسفانه شما مجاز به ثبت ضایعات نیستید';
}



?>