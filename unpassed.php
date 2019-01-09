<?php
require 'lib/jdf.php';
require 'autoload.php';

$month =$_GET['month'];
$year = $_GET['year'];


$check = new check();



?>
<!DOCTYPE html>
<html>
<head>
    <title>سیستم مدیریت فاکتور فروشگاه نوید </title>
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

</head>
<body>
<table class="table table-bordered table-responsive table-striped table-hover">
    <thead>
    <tr class="text-center">
        <td>  <?php $mktime = jmktime("01","01","01",$month,"01", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"02", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"03", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"04", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"05", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"06", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"07", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>جمع کل </td>
    </tr>
    </thead>
    <tr class="text-center">
        <td> <?php $check->GetUnCheckData("01",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("02",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("03",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("04",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("05",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("06",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("07",$month,$year);    ?></td>


        <td> </td>
    </tr>

    <tr class="text-center">
        <td><?php $check->GetUnCheckSumData("01",$month,$year);  ?> </td>
        <td><?php $check->GetUnCheckSumData("02",$month,$year);   ?> </td>
        <td><?php $check->GetUnCheckSumData("03",$month,$year);     ?> </td>
        <td><?php $check->GetUnCheckSumData("04",$month,$year);   ?> </td>
        <td><?php $check->GetUnCheckSumData("05",$month,$year);     ?> </td>
        <td><?php $check->GetUnCheckSumData("06",$month,$year);    ?> </td>
        <td><?php $check->GetUnCheckSumData("07",$month,$year);     ?> </td>

        <td> </td>
    </tr>


</table>




<table class="table table-bordered table-responsive table-striped table-hover">
    <thead>
    <tr class="text-center">
        <td> <?php $mktime = jmktime("01","01","01",$month,"08", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?></td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"09", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"10", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"11", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"12", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"13", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"14", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>جمع کل </td>
    </tr>
    </thead>

    <tr class="text-center">
        <td> <?php $check->GetUnCheckData("08",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("09",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("10",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("11",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("12",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("13",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("14",$month,$year);    ?></td>


        <td> </td>
    </tr>

    <tr class="text-center">
        <td> <?php $check->GetUnCheckSumData("08",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("09",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("10",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("11",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("12",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("13",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("14",$month,$year);    ?></td>

        <td>جمع کل</td>
    </tr>

</table>



<table class="table table-bordered table-responsive table-striped table-hover">
    <thead>
    <tr class="text-center">
        <td> <?php $mktime = jmktime("01","01","01",$month,"15", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?></td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"16", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"17", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"18", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"19", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"20", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"21", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>جمع کل</td>
    </tr>

    <tr class="text-center">
        <td> <?php $check->GetUnCheckData("15",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("16",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("17",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("18",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("19",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("20",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("21",$month,$year);    ?></td>


        <td> </td>
    </tr>

    <tr class="text-center">
        <td> <?php $check->GetUnCheckSumData("15",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("16",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("17",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("18",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("19",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("20",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("21",$month,$year);    ?></td>

        <td> </td>
    </tr>

</table>




<table class="table table-bordered table-responsive table-striped table-hover">
    <thead>
    <tr class="text-center">
        <td> <?php $mktime = jmktime("01","01","01",$month,"22", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?></td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"23", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"24", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"25", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"26", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"27", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"28", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>جمع کل </td>
    </tr>
    </thead>

    <tr class="text-center">
        <td> <?php $check->GetUnCheckData("22",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("23",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("24",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("25",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("26",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("27",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("28",$month,$year);    ?></td>


        <td> </td>
    </tr>

    <tr class="text-center">
        <td> <?php $check->GetUnCheckSumData("29",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("30",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckSumData("31",$month,$year);    ?></td>
        <td> </td>
        <td> </td>
        <td></td>
        <td> </td>

        <td> </td>
    </tr>

</table>



<table class="table table-bordered table-responsive table-striped table-hover">
    <thead>
    <tr class="text-center">
        <td>  <?php $mktime = jmktime("01","01","01",$month,"29", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"30", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"31", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>جمع کل </td>
    </tr>
    </thead>

    <tr class="text-center">
        <td> <?php $check->GetUnCheckData("29",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("30",$month,$year);    ?></td>
        <td> <?php $check->GetUnCheckData("31",$month,$year);    ?></td>


        <td> </td>
    </tr>

    <tr class="text-center">
        <td><?php $check->GetUnCheckSumData("29",$month,$year);  ?> </td>
        <td><?php $check->GetUnCheckSumData("30",$month,$year);   ?> </td>
        <td><?php $check->GetUnCheckSumData("31",$month,$year);     ?> </td>

        <td> </td>
    </tr>

</table>
</body>
</html>

