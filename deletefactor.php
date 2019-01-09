<?php 
session_start();
if(isset($_GET['RemoveConfirm']))
{
    if(isset($_GET['factorid'])) {
        $id = $_GET['factorid'];

        require 'autoload.php';


        $factor = new factor();
        $factor->getFactorDetail($id);
        if($_SESSION['UserId'] == $factor->creator) {
            if ($factor->factordelete($id) == '1') {
                echo '<script>alert("با موفقیت از فاکتور حذف شد")</script>';
                header('location:index.php');
            } else {
                echo 'خطا';
            }
        }
        else
        {
            echo '<h1>متاسفانه سازنده این فاکتور شما نیستید ،  به همین جهت امکان حذف آن را ندارید</h1>';
        }
    }
}
?>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>


<!--js-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--js-->
<br>
<br>
<br>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
  <a href="?factorid=<?php echo $_GET['factorid'] ?>&RemoveConfirm=yes"> <h1 class="alert alert-danger text-center">تایید حذف</h1></a>
</div>
