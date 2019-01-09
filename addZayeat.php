<?php

$count = $_POST['count'];
$rowid = $_POST['rowid'];
$factorid = $_POST['factorid'];

require 'autoload.php';

$entity = new entity();
$entity->getRowEntitData($rowid);


$factor = new factor();
$factor->InsetNewZayeatRow($factorid,$entity->productcode , $entity->Price , $count);

?>