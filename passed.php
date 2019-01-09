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
        <td> <?php $check->GetCheckData("01",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("02",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("03",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("04",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("05",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("06",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("07",$month,$year);    ?></td>


        <td> </td>
    </tr>

    <tr class="text-center">
        <td><?php $check->GetCheckSumData("01",$month,$year);  ?> </td>
        <td><?php $check->GetCheckSumData("02",$month,$year);   ?> </td>
        <td><?php $check->GetCheckSumData("03",$month,$year);     ?> </td>
        <td><?php $check->GetCheckSumData("04",$month,$year);   ?> </td>
        <td><?php $check->GetCheckSumData("05",$month,$year);     ?> </td>
        <td><?php $check->GetCheckSumData("06",$month,$year);    ?> </td>
        <td><?php $check->GetCheckSumData("07",$month,$year);     ?> </td>

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
        <td> <?php $check->GetCheckData("08",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("09",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("10",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("11",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("12",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("13",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("14",$month,$year);    ?></td>


        <td> </td>
    </tr>

    <tr class="text-center">
        <td> <?php $check->GetCheckSumData("08",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("09",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("10",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("11",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("12",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("13",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("14",$month,$year);    ?></td>

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
        <td> <?php $check->GetCheckData("15",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("16",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("17",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("18",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("19",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("20",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("21",$month,$year);    ?></td>


        <td> </td>
    </tr>

    <tr class="text-center">
        <td> <?php $check->GetCheckSumData("15",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("16",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("17",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("18",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("19",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("20",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("21",$month,$year);    ?></td>

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
        <td> <?php $check->GetCheckData("22",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("23",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("24",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("25",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("26",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("27",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("28",$month,$year);    ?></td>


        <td> </td>
    </tr>

    <tr class="text-center">
        <td> <?php $check->GetCheckSumData("29",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("30",$month,$year);    ?></td>
        <td> <?php $check->GetCheckSumData("31",$month,$year);    ?></td>
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
        <td> <?php $check->GetCheckData("29",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("30",$month,$year);    ?></td>
        <td> <?php $check->GetCheckData("31",$month,$year);    ?></td>


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

