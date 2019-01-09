<?php
error_reporting(0);
  $company = $_GET['company'];
  $productid = $_GET['productid'];
  $count = $_GET['count'];

  require 'autoload.php';

  $mojodi = new mojodi();

    $mojodi->GetCompanyFactorListForMojodi($company,$productid,$count);


?>