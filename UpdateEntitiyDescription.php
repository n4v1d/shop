<?php


require 'autoload.php';
$id = $_POST['id'];

$description = $_POST['description'];


$entity = new entity();

$entity->UpdateEntityDescription($id,$description);

?>