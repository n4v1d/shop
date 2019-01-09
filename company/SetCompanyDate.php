<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--css-->
<form method="post" action="">

    <!--js-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--js-->
    <script src="js/responsiveslides.min.js"></script>

<?php

require 'autoload.php';

$CompanyId = $_GET['CompanyId'];

$company = new company();

$company->getCompanyDetail($CompanyId);

if(isset($_POST['date']))
{
    $date = $_POST['date'];

    $company->UpdateCompanyDate($CompanyId , $date);

}
    ?>
    <div class="col-lg-6 col-md-6">
        <h1>نام شرکت : <?php echo $company->name; ?> </h1>

    </div>


    <div class="col-lg-6 col-md-6">
        <h1>مدت چک:<?php echo $company->date; ?> روز </h1>

    </div>
<br>
<br>
<br>
    <div class="row">
        <form method="post" action="">

            <div class="col-lg-6 col-md-6">
                <input type="text" name="date" class="input-lg form-control" placeholder="مدت چک">
            </div>


            <div class="col-lg-3 col-md-offset-2 col-lg-offset-2 col-md-3">
                <input type="submit" name="submit" value="ثبت" class="form-control input-lg btn btn-lg btn-success">
            </div>

    </div>

</form>

