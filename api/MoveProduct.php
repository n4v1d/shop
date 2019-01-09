<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="../css/pure-min.css" rel="stylesheet" type="text/css" media="all"/>
<script src="../js/editable.js"></script>
<?php

if(isset($_GET['code']))
{
require 'autoload.php';
$code = $_GET['code'];
set_time_limit(0);
$response['data'] = array();

$_pdo = new PDO('odbc:Driver={SQL Server};Server=127.0.0.1;Database=gNickHesab;Uid=sa2;Pwd=123456;charset=windows-1261');


$query = $_pdo->query("select * from dbo.tblbookinf where  s_code = $code ");
$row = $query->fetchAll();


//var_dump($row);

 $data['name'] =     iconv("windows-1256", "utf-8//TRANSLIT//IGNORE", $row[0]['bookname']);
 $data['productid'] = $row[0]['bookcode'];
  $data['barcode'] = $row[0]['barcode'];
  $data['company'] = iconv("windows-1256", "utf-8//TRANSLIT//IGNORE", $row[0]['publishercode']);


$api = new Api();

if($api->CheckProductExists($data['productid']) == '0')
{

   if($api->InsertNewProduct( $data['productid'], $data['name'] ,$data['company']) == '1')
   {
       ?>
       <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3">
           <h1 class="alert alert-success text-center">محصول با موفقیت ثبت شد</h1>

       </div>
       <?php
   }


   if($api->CheckBarcode($data['barcode']) == '0')
   {
       if($api->InsertBarcode($data['productid'] , $data['barcode']) == 3)
       {
           ?>
           <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3">
               <h1 class="alert alert-success text-center">بارکد با موفقیت ثبت شد</h1>

           </div>
           <?php

       }
       else
       {
           ?>
           <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3">
               <h1 class="alert alert-danger text-center">خطا در ثبت بارکد</h1>

           </div>
           <?php
       }

   }
   else
   {
       ?>
       <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3">
           <h1 class="alert alert-danger text-center">بارکد تکراری است </h1>

       </div>

       <?php

   }

}
else
{
   ?>
    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3">
        <h1 class="alert alert-danger text-center">محصول تکراری است</h1>

    </div>
    <?php
}
}
?>
<form method="get" action="">
<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3">

    <div class="row">
        <input type="text" name="code" placeholder="کد کالا" class="input-lg form-control " style="margin-top: 30px">

    </div>

    <div class="row">
        <input type="submit" value="انتقال" class="btn btn-lg btn-success input-lg form-control" style="margin-top: 30px">

    </div>

</div>