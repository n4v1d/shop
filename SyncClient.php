
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>


<!--js-->
<form method="post" action="">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--js-->
    <script src="js/responsiveslides.min.js"></script>

    <link href="css/pure-min.css" rel="stylesheet" type="text/css" media="all"/>
    <script src="js/editable.js"></script>


    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <label>بروز رسانی از</label>
        <input type="text" class="input-lg form-control alert alert-success" name="from">
    </div>


    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <label>بروز رسانی تا</label>
        <input type="text" class="input-lg form-control alert alert-info" name="to">
    </div>

    <br>
    <br>
    <br>
    <br>
    <input type="submit" class="form-control input-lg btn btn-success">

    <?php
require 'autoload.php';


$sync = new sync();
set_time_limit(0);
ini_set('max_execution_time', 0);


if(isset($_POST['from']))
{
    echo '<h1>لطفا صبر کنید</h1>';
    $from = $_POST['from'];
    $to = $_POST['to'];

    $data = file_get_contents("http://94.183.198.35:1234/shop/SyncProduct.php?from=$from&to=$to");

    $decode = json_decode($data,true);


    $count = count($decode);

    for($i=0;$i<$count;$i++)
    {
        echo $decode[$i]['code'];
        $sync->CheckProduct($decode[$i]['code'],$decode[$i]['name']);
        echo '<br>';

    }


}

?>