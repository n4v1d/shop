<?php
if(isset($_GET['factorid'])) {
    $id = $_GET['factorid'];

    require 'autoload.php';
    $entity = new factor();
   if($entity->unsaveFactor($id) == '1')
   {

       header('location:index.php');
   }
   else
   {
       echo 'خطا';
   }
}