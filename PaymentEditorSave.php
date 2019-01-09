<?php


require 'autoload.php';
$entity = new entity();
$id = $_POST['id'];
$price = $_POST['price'];
$masraf = $_POST['masraf'];

$entity->UpdateForooshPrice($id,$price,$masraf);


?>