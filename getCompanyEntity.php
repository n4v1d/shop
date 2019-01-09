<?php
require 'autoload.php';

$companyId = $_GET['company'];

$invent =new invent();

$invent->UpdateCompanyEntity($companyId);
header("location:index.php");
?>