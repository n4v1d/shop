<body dir="rtl">
<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Report.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
error_reporting(0);
require 'autoload.php';
$company= $_GET['Companyid'];
$invent = new invent();

$invent->GetCompanyProductLIst($company);

?>
</body>

