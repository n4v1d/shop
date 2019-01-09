<?php
session_start();

if(isset($_GET['factorid'])) {
    $id = $_GET['factorid'];


    $userid = $_SESSION['UserId'];

    require 'autoload.php';
    $entity = new factor();


$factor = new factor();
    $factor = new factor();
    $factor->GiveOneFactorRows($id);
    $factor->SetClosedFactor($id);


   if($entity->savenickHesab($id , $userid) == '1')
   {

      // header('location:index.php');
   }
   else
   {
       echo 'خطا';
   }
}