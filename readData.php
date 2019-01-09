
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--css-->

    <!--js-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <form method="post">
        <br>
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
<textarea name="text" class="input input-lg form-control">


</textarea>
            <br>
            <br>
            <br>
            <br>
            <input class="btn btn-success btn-lg input-lg form-control" type="submit" value="ثبت">

        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
</form>

<?php

if(isset($_POST['text']))
{
    set_time_limit(0);

    $text = $_POST['text'];

$data = preg_split("/[\r\n]+/", $text, -1, PREG_SPLIT_NO_EMPTY);

$count  = count($data);

$ListId = $_GET['company'];


require 'autoload.php';

$invent = new invent();
for($i = '0' ; $i < $count ; $i++)
{

     $data1 = substr( $data[$i] , 0 , 6 );
     $data2 = substr( $data[$i] , 7 , 100 );
    $invent->AddRelation($data1 , $ListId,$data2);

}
header("index.php");
}
else
{
    ?>
<div class="row">
<br>
<br>
<br>
<br>
<br>
<br>
    <h1 class="text-center">لطفا اطلاعات خود را وارد نمایید</h1>
</div>
<?php

}