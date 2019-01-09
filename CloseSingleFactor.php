<?php

$id = $_GET['id'];

require 'autoload.php';


$entity = new entity();

$factor = new factor();
$factor->GiveOneFactorRows($id);
$factor->SetClosedFactor($id);