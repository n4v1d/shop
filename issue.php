<?php
require 'lib/jdf.php';
require 'autoload.php';

$month = "07";
$year = "1397";


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
        <td> <?php $mktime = jmktime("01","01","01",$month,"01", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?></td>
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
        <td> اخوان حسینی | 6000| 640</td>
        <td> اخوان حسینی | 6000| 640</td>
        <td> اخوان حسینی | 6000| 640</td>
        <td> اخوان حسینی | 6000| 640</td>
        <td> اخوان حسینی | 6000| 640</td>
        <td> اخوان حسینی | 6000| 640</td>
        <td> اخوان حسینی | 6000| 640</td>

        <td>جمع کل </td>
    </tr>

    <tr class="text-center">
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>جمع کل</td>
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
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>جمع کل </td>
    </tr>

    <tr class="text-center">
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
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
        <td>جمع کل </td>
    </tr>
    </thead>
    <tr class="text-center">
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>جمع کل </td>
    </tr>

    <tr class="text-center">
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>جمع کل</td>
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
        <td>  <?php $mktime = jmktime("01","01","01",$month,"26", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"27", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>جمع کل </td>
    </tr>
    </thead>
    <tr class="text-center">
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>جمع کل </td>
    </tr>

    <tr class="text-center">
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>جمع کل</td>
    </tr>


</table>



<table class="table table-bordered table-responsive table-striped table-hover">
    <thead>
    <tr class="text-center">
        <td> <?php $mktime = jmktime("01","01","01",$month,"28", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?></td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"29", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"30", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>  <?php $mktime = jmktime("01","01","01",$month,"31", $year); echo jdate("l d",$mktime , "" ,"" , "en");    ?> </td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>جمع کل </td>
    </tr>
    </thead>
    <tr class="text-center">
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>جمع کل </td>
    </tr>

    <tr class="text-center">
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td>جمع کل</td>
    </tr>


</table>
</body>
</html>

