<?php
require 'autoload.php';

$companyid = $_GET['CompanyId'];

$comany = new company();
$comany->IsCompany($companyid);
?>