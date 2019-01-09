<?php

$code = $_GET['id'];
require 'autoload.php';
$product = new product();
$TotalCount = $product->GetTotalBuyCount($code);
$TotalEshantionCount = $product->GetTotalEshantionCount($code);

$total = $product->TotalBuyCount + $product->TotalEshantionConunt;

echo $total;

?>