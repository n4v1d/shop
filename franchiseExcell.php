
<?php
require 'autoload.php';
require 'lib/jdf.php';

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=FranchiseReport.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);


$branch = new branch();
$id = $_GET['id'];
$branch_name = $_GET['branch_name'];
$branch_per = $_GET['per'];
?>

    <?php


        $branch->GetAllFranchiseProductListForExcell($id);



?>



