<?php
error_reporting(0);
require 'autoload.php';
$factorid = $_POST['factorid'];

$type = $_POST['type'];

IF($type == '1')
{
    $hajmi = $_POST['hajmi'];

    $group = new group();

    $group->updateHajmi($factorid , $hajmi);
}





IF($type == '2')
{
    $naghdi = $_POST['naghdi'];

    $group = new group();

    $group->updateNaghdi($factorid , $naghdi);
}






IF($type == '3')
{
    $tax = $_POST['tax'];

    $group = new group();

    $group->updateTax($factorid , $tax);
}






IF($type == '4')
{
    $percent = $_POST['tak'];

    $group = new group();

    $group->GetAllFactorEntity($factorid , $percent);
}









IF($type == '5')
{
    $percent = $_POST['tak'];

    $group = new group();

    $group->UpdateEshantionPercent($factorid , $percent);
}



?>