<?php

require 'autoload.php';

$check = new check();

$id = $_POST['id'];
$type = $_POST['type'];


$check->ChangeCheckType($id,$type);


?>