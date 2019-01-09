<?php

$id = $_GET['id'];

require 'autoload.php';
$factor = new factor();
$factor->SaveToArvhive($id);
