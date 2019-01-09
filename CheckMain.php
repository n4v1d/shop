<?php
if(isset($_GET['status']))
{
    $status  = $_GET['status'];

    $month = $_GET['month'];
    $year = $_GET['year'];


    if($status == 0)
    {
        header("location:unpassed.php?month=$month&year=$year");
    }
    else
    {
        header("location:passed.php?month=$month&year=$year");

    }
}

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
<form method="get" action="">
<body>
<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">

    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6" >
        <label>ماه</label>
        <select class="input-lg form-control " name="month">
            <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
            <option>08</option>
            <option>09</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
        </select>
    </div>



    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <label>ماه</label>
        <select class="input-lg form-control "  name="year">
            <option>1397</option>
            <option>1398</option>
            <option>1399</option>
        </select>
    </div>





</div>



<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">




    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <label>وضعیت</label>
        <select class="input-lg form-control "  name="status">
            <option value="0">تحویل نشده </option>
            <option value="1">تحویل شده</option>
        </select>
    </div>



    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <label>مشاهده</label>
        <input type="submit" class="form-control input-lg  btn btn-lg btn-success " value="مشاهده">
    </div>

</form>
</body>
</html>


