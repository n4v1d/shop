<?php
session_start();
require 'autoload.php';
$UserId = $_SESSION['UserId'];

$uid = $_SESSION['UserId'];

$content = file_get_contents("php://input");
$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


$logreport = new logreport();
$logreport->NewLogReport($uid,$content,$link);


$column = $_POST['column'];
$val = str_replace(',','',$_POST['editval']);
$val =  preg_replace('/\s+/', '', $val);
$val = strip_tags($val);
$id = $_POST['id'];
$entity = new entity();
$entity->getEntityFactorId($id);
$factor =  new factor();
$factor->getFactorDetail($entity->factorid);



if($factor->status == 3)
{
    ?>
    <script>
        alert("این فاکتور ثبت شده می باشد ، امکان ویرایش محتویات فاکتور نمی باشد");
    </script>
    <?php
    exit();
}






if( $uid != "9" )
{
if($factor->creator != $uid || $uid == "9" )
{
    ?>
    <script>
        alert("فقط سازنده این فاکتور مجاز به اعمال تغییرات می باشد");
    </script>
<?php
  exit();
}
}


echo $uid;

    $update = new update();
    switch ($column)
    {
        case "box":
            $update->UpdateBox($id,$val);
            break;



        case "boxin":
            $update->UpdateBoxIn($id,$val);
            break;



        case "price":
            $update->Price($id,$val);
            break;

        case "EshantionPrice":
            $update->EshantionPrice($id,$val);
            break;


        case "eshantion":
            $update->eshantion($id,$val);
            break;


        case "eshantionin":
            $update->eshantionin($id,$val);
            break;


        case "hajmi":
            $update->hajmi($id,$val);
            break;


        case "tax":
            $update->tax($id,$val);
            break;

        case "tax2":
            $update->tax2($id,$val);
            break;


        case "naghdi":
            $update->naghdi($id,$val);
            break;


        case "eshantionpercent":
            $update->eshantionpercent($id,$val);
            break;


        case "forosh":
            $update->forosh($id,$val);
            break;


        case "masraf":
            $update->masraf($id,$val);
            break;

    }



