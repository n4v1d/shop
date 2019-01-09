<?php

require 'autoload.php';
$id = $_GET['id'];

$factor = new factor();


$factor->RemoveFromTakhfif($id);
?>