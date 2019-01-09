<!--css-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>


<!--js-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--js-->
<script src="js/responsiveslides.min.js"></script>

<link href="css/pure-min.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/editable.js"></script>



<?php
require 'lib/jdf.php';
require 'autoload.php';
 error_reporting(0);

set_time_limit(0);
$tax = new tax2();


    //$day = $_POST['day'];
    //$month = $_POST['month'];
    //$year = $_POST['year'];
    //$from = jmktime("00","00","01",$month , $day , $year);
    $from = jmktime("00","00","01",'08' , '01' , '1397');


    //$tday = $_POST['tday'];
    //$tmonth = $_POST['tmonth'];
    //$tyear = $_POST['tyear'];
    $to = jmktime("23","59","59",'08' , '31' , '1397');







//$tax->GetAllProductWithDiscount($from,$to);
$tax->GetAllFactorIdByTime($from,$to);



?>
