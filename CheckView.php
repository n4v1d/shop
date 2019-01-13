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

 $id = $_GET['CheckId'];
 require 'autoload.php';

 $check = new chek();

 $factor = new factor();
 $factor->getFactorDetail($id);
 require  'lib/jdf.php';
$check->GetCheckDetail($id);

 $company = new company();
 $company->getCompanyDetail($check->company);

?>
<h4 class="text-center">بخش مدیریت چک</h4>
<table class="table table-hover table-striped table-responsive table-striped table-bordered text-center">
    <tr>
        <td>نام شرکت</td>
        <td><?php echo $company->name ;?></td>
    </tr>
    <tr>
        <td> شماره فاکتور</td>
        <td><?php echo $check->factorNumber; ;?></td>
    </tr>
    <tr>
        <td>  تاریخ فاکتور</td>
        <td><?php echo jdate('Y/m/d' , $factor->time , '','','en') ;?></td>
    </tr>


    <tr>
        <td> <b>  مدت چک</b></td>
        <td><b><?php echo $check->len ;?></b></td>
    </tr>


    <tr>
        <td> <b>  مبلغ چک</b></td>
        <td><b><?php echo $check->price ;?></b></td>
    </tr>


    <tr>
        <td>  <b> تاریخ چک</b></td>
        <td><b><?php echo jdate('Y/m/d' , $check->time_check , '','','en') ;?></b></td>
    </tr>



    <tr>
        <td>  <b>  مدیریت </b></td>
        <td><a href="tahvil.php?id=<?php echo $id; ?>"><input type="submit" class="btn btn-success btn-lg " value="تحویل شده"> </td>
    </tr>
    <tr>
        <td>  <b>  تغییر تاریخ یا مبلغ </b></td>
        <td><a href="editCheck.php?id=<?php echo $id; ?>"><input type="submit" class="btn btn-danger btn-lg " value="تغییر اطلاعات "> </td>
    </tr>


    <form method="post" action="SetCheckType.php">
        <tr>
            <td>
                <b> حواله / چک</b></td>
            <td>
                <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                    <select name="type" class="form-control input-lg" >
                        <option value="0">چک</option>
                        <option value="1">حواله</option>
                    </select>

                    <input type="hidden" value="<?php echo $id; ?>" name="id">

                </div>


                <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                    <button class="form-control input-lg btn btn-lg btn-primary">ذخیره</button>
                </div>

            </td>
        </tr>


    </form>
    <tr>
        <td colspan="2"><h3>ریز تغییرات فاکتور</h3> </td>
    </tr>


</table>

<?php
$check->GetCheckDetailsData($id);
?>