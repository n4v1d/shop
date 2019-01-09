<?php
require 'autoload.php';
$id = $_GET['RowId'];

$invent = new invent();
$invent->DeleteRelation($id);
