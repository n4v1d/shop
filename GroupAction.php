<?php

$id = $_GET['Factorid'];
?>
<div class="container">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--css-->
<h2 class="text-center">تعیین حجمی کل فاکتور</h2>
<!--js-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--js-->
<script src="js/responsiveslides.min.js"></script>
<div class="row">
    <form action="updategroup.php" method="post">
        <div class="col-lg-4 col-md-6 col-xs-6 col-sm-6">
            <label>درصد حجمی</label>
            <input type="hidden" value="<?php echo $id; ?>" name="factorid" >
            <input type="hidden" value="1" name="type" >
            <input type="text" class="form-control input-lg" name="hajmi" placeholder="درصد حجمی جدید">
        </div>

        <div class="col-lg-4 col-md-6 col-xs-6 col-sm-6">
            <label>انجام عملیات </label>
            <input type="submit" value="ثبت درصد حجمی" class="btn btn-warning btn-lg input-lg form-control">
        </div>

    </form>

</div>

<br>
<br>
<br>
<h2 class="text-center">تعیین نقدی کل فاکتور</h2>





<div class="row">
    <form action="updategroup.php" method="post">
        <div class="col-lg-4 col-md-6 col-xs-6 col-sm-6">
            <label>درصد نقدی</label>
            <input type="hidden" value="<?php echo $id; ?>" name="factorid" >
            <input type="hidden" value="2" name="type" >
            <input type="text" class="form-control input-lg" name="naghdi" placeholder="درصد حجمی جدید">
        </div>

        <div class="col-lg-4 col-md-6 col-xs-6 col-sm-6">
            <label>انجام عملیات </label>
            <input type="submit" value="ثبت درصد نقدی" class="btn btn-primary btn-lg input-lg form-control">
        </div>

    </form>

</div>



    <br>
    <br>
    <br>


    <h2 class="text-center">تعیین مالیات کل فاکتور</h2>





    <div class="row">
        <form action="updategroup.php" method="post">
            <div class="col-lg-4 col-md-6 col-xs-6 col-sm-6">
                <label>درصد مالیات</label>
                <input type="hidden" value="<?php echo $id; ?>" name="factorid" >
                <input type="hidden" value="3" name="type" >
                <input type="text" class="form-control input-lg" name="tax" placeholder="درصد مالیات جدید">
            </div>

            <div class="col-lg-4 col-md-6 col-xs-6 col-sm-6">
                <label>انجام عملیات </label>
                <input type="submit" value="ثبت درصد مالیات" class="btn btn-success btn-lg input-lg form-control">
            </div>

        </form>

    </div>







    <br>
    <br>
    <br>


    <h2 class="text-center"> تخفیف تکفروشی</h2>





    <div class="row">
        <form action="updategroup.php" method="post">
            <div class="col-lg-4 col-md-6 col-xs-6 col-sm-6">
                <label>درصد تخفیف</label>
                <input type="hidden" value="<?php echo $id; ?>" name="factorid" >
                <input type="hidden" value="4" name="type" >
                <input type="text" class="form-control input-lg" name="tak" placeholder="درصد تخفیف جدید">
            </div>

            <div class="col-lg-4 col-md-6 col-xs-6 col-sm-6">
                <label>انجام عملیات </label>
                <input type="submit" value="ثبت  تخفیف تکفروشی" class="btn btn-danger btn-lg input-lg form-control">
            </div>

        </form>

    </div>






    <h2 class="text-center"> تخفیف اشانتیون</h2>




    <br>
    <br>
    <br>


    <div class="row">
        <form action="updategroup.php" method="post">
            <div class="col-lg-4 col-md-6 col-xs-6 col-sm-6">
                <label>تخفیف اشانتیون</label>
                <input type="hidden" value="<?php echo $id; ?>" name="factorid" >
                <input type="hidden" value="5" name="type" >
                <input type="text" class="form-control input-lg" name="tak" placeholder="درصد تخفیف اشانتیون جدید">
            </div>

            <div class="col-lg-4 col-md-6 col-xs-6 col-sm-6">
                <label>انجام عملیات </label>
                <input type="submit" value="ثبت  تخفیف تکفروشی" class="btn btn-primary btn-lg input-lg form-control">
            </div>

        </form>

    </div>

