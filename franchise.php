<html>

<head>
    <title>سیستم مدیریت فاکتور فروشگاه نوید </title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>


    <!--js-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--js-->




    <meta charset="utf-8" >


</head>

<body>
<?php
require 'autoload.php';
require 'lib/jdf.php';

$branch = new branch();
$branch->GetBranchList();
$id = $_GET['id'];
?>

<div class="row">
    <div class="col-lg-12 text-center">
        <?php

        if(isset($_GET['branch_name']))
        {
            $branch_name = $_GET['branch_name'];
            $branch_per = $_GET['per'];

            echo "<br><h1>شعبه انتخاب شده : $branch_name &nbsp; &nbsp;  درصد تعیین شده: $branch_per</h1>";
        }
        ?>


    </div>


</div>



<div class="row">

    <div class="row col-md-6 col-lg-6 col-xs-6 col-sm-6 col-lg-offset-3 col-sm-offset-3 col-xs-offset-3 col-md-offset-3">



        <form method="post">

            <div class="col-md-9 col-lg-9 col-xs-9 col-sm-9">
                <label>کد کالا</label>
            <textarea name="productId"  class="input input-lg form-control"></textarea>
            </div>


            <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
                <label>مشاهده</label>
                <input type="submit" id="save" class="form-control input-lg btn btn-success btn-lg" value="ثبت">

            </div>

        </form>


</div>
</div>

<br>

<div class="row col-md-12 col-lg-12 col-xs-12 col-sm-12 ">
    <?php



    if(isset($_POST['productId']))
    {
        $branchs = new branch();
        set_time_limit(0);

        $text = $_POST['productId'];

        $data = preg_split("/[\r\n]+/", $text, -1, PREG_SPLIT_NO_EMPTY);

        $count  = count($data);

        for($i = '0' ; $i < $count ; $i++)
        {

            $data1 = substr( $data[$i] , 0 , 6 );

            $branchs->InsertIntoFranchiseProductList($id,$data1,$branch_per);


        }
    }

        $branch->GetAllFranchiseProductList($id);



    ?>
</div>



</body>

</html>


<a href="franchiseExcell.php?id=<?php echo $_GET['id']; ?>&per=<?php echo $_GET['per'];?>"><h1>خروجی اکسل</h1></a>