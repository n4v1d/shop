<?php
require 'autoload.php';
$id = $_GET['id'];
$report = new report();

$report->GetDiscountRow($id);

?>