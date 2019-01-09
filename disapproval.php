<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>


<!--js-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--js-->
<script src="js/responsiveslides.min.js"></script>
<?php
require 'autoload.php';
if(isset($_GET['factorid'])) {
    $id = $_GET['factorid'];

    $factor = new factor();
    $factor->getFactorDetail($id);
    $message = new message();
    $company = new company();
    $company->getCompanyDetail($factor->company);

    $type = '1';

    if(isset($_POST['AdminMessage']))
    {
        $adminMessage = $_POST['AdminMessage'];
        $messages = " فاکتور شماره : <b>$factor->factorid</b> از شرکت <b> $company->name</b> توسط مدیریت تایید نشد ، لطفا پیگیری نمایید " . '<br> <b> دلیل عدم تایید: </b> '  . $adminMessage ;

        $message->MessageNew($factor->creator, $messages, $type);
        $entity = new factor();

        if($entity->disapproval($id) == '1')
        {

            header('location:index.php');
        }
        else
        {
            echo 'خطا';
        }
    }else
    {
        ?>

        <br>
       <div class=" col-lg-6 col-md-9 col-xs-6 col-sm-6  col-lg-offset-3 col-md-offset-3 col-xs-offset-3col-sm-offset-3">
           <form method="post" action="">
               <textarea name="AdminMessage" class="form-control input-lg" placeholder="دلیل عدم تایید"></textarea><br>
               <input type="submit" value="ثبت" class="form-control btn btn-lg input-lg btn-danger">
           </form>
       </div>
        <?php
    }

}