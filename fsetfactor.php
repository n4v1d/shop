<?php
session_start();
$userid = $_SESSION['UserId'];
if(isset($_GET['factorid'])) {
    $id = $_GET['factorid'];



    require 'autoload.php';
    $entity = new factor();
   if($entity->fsaveFactor($id,$userid) == '1')
   {

       header('location:index.php');
   }
   else
   {
       echo 'خطا';
   }
}