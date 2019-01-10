<?php
require 'lib/jdf.php';
require 'autoload.php';
$calender = new calender();

if(isset($_GET['month']))
{

    $month = $_GET['month'];
    $year = $_GET['year'];
}
else
{
    $month = jdate('m',time(),'','','en');
    $year = jdate('Y',time(),'','','en');
}
error_reporting(0)
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
    <script src="js/switalert.js"></script>


</head>
</html>
<br>
<div class="col-lg-12 ">
    <form method="get">

        <div class="form-group col-lg-4">
            <label>ماه</label>
            <select name="month" class="form-control input-lg">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
            </select>


        </div>


        <div class="form-group col-lg-4">
            <label>سال</label>
            <select name="year" class="form-control input-lg">
                <option selected>1397</option>
                <option >1398</option>
                <option >1399</option>
            </select>

        </div>


        <div class="form-group col-lg-4">
            <label>مشاهده</label>

            <input type="submit" value="مشاهده" class="form-control input-lg btn btn-lg btn-success">
        </div>



        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-offset-6 col-lg-offset-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3 ">

                <div class="form-group col-lg-3">
                    <a href="NewCheck.php"><input type="button" value="چک جدید" class="form-control input-lg btn btn-lg btn-success"> </a>
                </div>
                <div class="form-group col-lg-3">
                    <a href="CheckTable.php"><input type="button" value="تحویل نشده" class="form-control input-lg btn btn-lg btn-info"> </a>
                </div>
                <div class="form-group col-lg-3">
                    <a href="CheckTablewait.php"> <input type="button" value="تحویل شده" class="form-control input-lg btn btn-lg btn-warning"></a>
                </div>
                <div class="form-group col-lg-3">
                    <a href="index.php"> <input type="button" value="سیستم نوید" class="form-control input-lg btn btn-lg btn-success"></a>
                </div>



            </div>
    </form>
</div>
<!-- 1 - 7 -->
<table class="table table-bordered table-striped table-hover text-center">
    <thead>
    <td width="10%">تاریخ</td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '1' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '2' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '3' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '4' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '5' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '6' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '7' , $year) , '','','en')  ; ?> </td>

    </thead>
    <tbody>
    <tr>

        <td>لیست چک ها</td>
        <td> <?php $calender->GetDayCheck('1',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('2',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('3',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('4',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('5',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('6',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('7',$month,$year , 2) ?> </td>


    </tr>

    <tr>

        <td style="color red">جمع چک ها</td>

        <td> <?php $calender->GetDayCheckSum('1',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('2',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('3',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('4',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('5',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('6',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('7',$month,$year , 2) ?> </td>

    </tr>

    </tbody>
</table>











<br>
<br>



<!-- 8 - 14-->
<table class="table table-bordered table-striped table-hover text-center">
    <thead>
    <td width="10%">تاریخ</td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '8' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '9' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '10' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '11' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '12' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '13' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '14' , $year) , '','','en')  ; ?> </td>

    </thead>
    <tbody>
    <tr>

        <td>لیست چک ها</td>
        <td> <?php $calender->GetDayCheck('8',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('9',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('10',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('11',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('12',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('13',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('14',$month,$year , 2) ?> </td>
    </tr>

    <tr>

        <td style="color red">جمع تحویل نشده</td>

        <td> <?php $calender->GetDayCheckSum('8',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('9',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('10',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('11',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('12',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('13',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('14',$month,$year , 2) ?> </td>
    </tr>

    </tbody>
</table>








<br>
<br>



<!-- 15 - 21-->
<table class="table table-bordered table-striped table-hover text-center">
    <thead>
    <td width="10%">تاریخ</td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '15' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '16' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '17' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '18' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '19' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '20' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '21' , $year) , '','','en')  ; ?> </td>

    </thead>
    <tbody>
    <tr>

        <td>لیست چک ها</td>
        <td> <?php $calender->GetDayCheck('15',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('16',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('17',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('18',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('19',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('20',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('21',$month,$year , 2) ?> </td>
    </tr>

    <tr>

        <td style="color red">جمع تحویل نشده</td>

        <td> <?php $calender->GetDayCheckSum('15',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('16',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('17',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('18',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('19',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('20',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('21',$month,$year , 2) ?> </td>

    </tbody>
</table>








<br>
<br>



<!-- 22 - 28-->
<table class="table table-bordered table-striped table-hover text-center">
    <thead>
    <td width="10%">تاریخ</td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '22' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '23' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '24' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '25' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '26' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '27' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '28' , $year) , '','','en')  ; ?> </td>

    </thead>
    <tbody>
    <tr>

        <td>لیست چک ها</td>
        <td> <?php $calender->GetDayCheck('22',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('23',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('24',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('25',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('26',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('27',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('28',$month,$year , 2) ?> </td>
    </tr>

    <tr>

        <td style="color red">جمع تحویل نشده</td>
        <td> <?php $calender->GetDayCheckSum('22',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('23',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('24',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('25',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('26',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('27',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('28',$month,$year , 2) ?> </td>
    </tr>

    </tbody>
</table>









<br>
<br>



<!-- 22 - 28-->
<table class="table table-bordered table-striped table-hover text-center">
    <thead>
    <td width="10%">تاریخ</td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '29' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '30' , $year) , '','','en')  ; ?> </td>
    <td><?php echo jdate('m/d - l',jmktime('01','01','01',$month , '31' , $year) , '','','en')  ; ?> </td>


    </thead>
    <tbody>
    <tr>

        <td>لیست چک ها</td>

        <td> <?php $calender->GetDayCheck('29',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('30',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheck('31',$month,$year , 2) ?> </td>

    </tr>

    <tr>

        <td style="color red">جمع پاس نشده</td>

        <td> <?php $calender->GetDayCheckSum('29',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('30',$month,$year , 2) ?> </td>
        <td> <?php $calender->GetDayCheckSum('31',$month,$year , 2) ?> </td>

    </tr>

    </tbody>
</table>

</div>





<br>
<br>
<div class="row" style="margin-bottom: 20px">

    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
        <h4 class="text-center"> جمع تحویل نشده  : </h4>
        <h4 class="text-center"><?php $calender->GetNadadeMonth($year,$month); ?></h4>
    </div>

    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
        <h4 class="text-center"> جمع تحویل شده   : </h4>
        <h4 class="text-center"><?php $calender->GetDadeMonth($year,$month); ?></h4>

    </div>

    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
        <h4 class="text-center"> جمع پاس شده ماه : </h4>
        <h4 class="text-center"><?php $calender->GetPassedMonth($year,$month); ?></h4>


    </div>

    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
        <h4 class="text-center"> جمع کل : </h4>
        <h4 class="text-center"><?php $calender->GetMonthSum($year,$month); ?></h4>

    </div>

</div>