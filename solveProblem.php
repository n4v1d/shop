<?php
session_start();
$UserId = $_SESSION['UserId'];
require 'autoload.php';
$id = $_GET['factorid'];

$factor = new factor();
$factor->getFactorDetail($id);


if($factor->creator == $UserId || $UserId == 9 || $UserId == 1)
{

if(isset($_GET['factorid'])) {

    $entity = new factor();
   if($entity->SolveProblemFactor($id ,  $UserId) == '1')
   {

       header('location:index.php');
   }
   else
   {
       echo 'خطا';
   }
}

}
