<?php

require 'autoload.php';

$branch = new branch();
$branch->DeleteAllFrinchiseProduct();

header('location:/shop/franchise.php');

?>