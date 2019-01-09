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
<?php
 $id = $_GET['CheckId'];
 require 'autoload.php';
 $check = new chek();
$check->GetCheckDetail($id);
 require  'lib/jdf.php';

 $company = new company();
 $company->getCompanyDetail($check->company);

?>
<h4 class="text-center">بخش مدیریت چک</h4>
<table class="table table-hover table-striped table-responsive table-striped table-bordered text-center" style="width: 100%">
    <tr>
        <td>نام شرکت</td>
        <td><?php echo $company->name ;?></td>
    </tr>
    <tr>
        <td> شماره فاکتور</td>
        <td><?php echo $check->factorNumber ;?></td>
    </tr>
    <tr>
        <td>  تاریخ فاکتور</td>
        <td><?php echo jdate('Y/m/d' , $check->len , '','','en') ;?></td>
    </tr>


    <tr>
        <td> <b>  مدت چک</b></td>
        <td><b><?php echo $check->len ;?></b></td>
    </tr>


    <tr>
        <td>  <b> تاریخ چک</b></td>
        <td><b><?php echo jdate('Y/m/d' , $check->time_check , '','','en') ;?></b></td>
    </tr>

    <tr>
        <td>  <b>  مدیریت </b></td>
        <td><a href="pass.php?id=<?php echo $id; ?>"><input type="submit" class="btn btn-success btn-lg input-lg btn-success btn-lg form-control " value="پاس شد ">
        <br>
        <br>
        <a href="backed.php?id=<?php echo $id; ?>"><input type="submit" class="btn btn-danger btn-lg input-lg form-control " value="برگشت خورد "> </td>
    </tr>
    <tr>
        <td>  <b>  تغییر تاریخ یا مبلغ </b></td>
        <td><a href="editCheck.php?id=<?php echo $id; ?>"><input type="submit" class="btn btn-primary input-lg btn-lg form-control " value="تغییر اطلاعات "> </td>
    </tr>    <tr>
        <td colspan="2"><h3>ریز تغییرات فاکتور</h3> </td>
    </tr>
</table>

<?php
$check->GetCheckDetailsData($id);
?>

