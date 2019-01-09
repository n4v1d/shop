<?php

$status = $_GET['status'];
$id = $_GET['id'];
$save= $_GET['Save'];

require 'autoload.php';
$factor = new factor();
$factor->UpdateFactorAutomatic($id,$save,$status);

