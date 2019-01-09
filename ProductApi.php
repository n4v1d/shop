<?php

require 'autoload.php';

$id = $_REQUEST['id'];

$api = new Api();

$api->GetProductData($id);

?>