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
 $id = $_GET['id'];
 require 'autoload.php';
 require  'lib/jdf.php';
$check = new chek();
$check->GetCheckDetail($id);
 $company = new company();
 $company->getCompanyDetail($check->company);


  $year  = jdate('Y',$check->time_check,'','','en');
  $month = jdate('m',$check->time_check,'','','en');
  $day   = jdate('d',$check->time_check,'','','en');

?>
<h4 class="text-center">ویرایش اطلاعات  چک</h4>
<table class="table table-hover table-striped table-responsive table-striped table-bordered text-center">
    <tr>
        <td>نام شرکت</td>
        <td><?php echo $company->name ;?></td>
    </tr>
    <tr>
        <td> شماره فاکتور</td>
        <td><?php echo $check->factorNumber ;?></td>
    </tr>
    <tr>
        <td>  تاریخ فاکتور</td>
        <td><?php echo jdate('Y/m/d' , $check->time , '','','en') ;?></td>
    </tr>


    <tr>
        <td> <b>  مدت چک</b></td>
        <td><b><?php echo $check->len ;?></b></td>
    </tr>


    <tr>
        <td>  <b> تاریخ چک</b></td>
        <td><b><?php echo jdate('Y/m/d' , $check->time_check , '','','en') ;?></b></td>
    </tr>


    <tr>
        <td>  <b>  مبلغ</b></td>
        <td><b><?php echo number_format($check->price); ;?></b></td>
    </tr>
    <form method="post" action="SaveCheckData.php?id=<?php echo $id; ?>">

    <tr>
        <td> </td>
        <td>  <b> اطلاعات جدید </b> </td>
    </tr>

    <tr>
        <td>  <b>  مبلغ جدید</b></td>
        <td><input type="text" class="form-control input-lg text-center" name="price" value="<?php echo $check->price;?>"></td>
    </tr>
    <tr>
        <td>  <b> روز </b></td>
        <td>
            <select name="day" class="form-control input-lg">
                <option
                    <?php
                    if($day == '01')
                    {
                        echo 'selected';
                    }
                    ?>
                >1</option>
                <option
                    <?php
                    if($day == '02')
                    {
                        echo 'selected';
                    }
                    ?>
                >2</option>
                <option
                    <?php
                    if($day == '03')
                    {
                        echo 'selected';
                    }
                    ?>
                >3</option>
                <option
                    <?php
                    if($day == '04')
                    {
                        echo 'selected';
                    }
                    ?>
                >4</option>
                <option
                    <?php
                    if($day == '05')
                    {
                        echo 'selected';
                    }
                    ?>
                >5</option>
                <option
                    <?php
                    if($day == '06')
                    {
                        echo 'selected';
                    }
                    ?>
                >6</option>
                <option
                    <?php
                    if($day == '07')
                    {
                        echo 'selected';
                    }
                    ?>
                >7</option>
                <option
                    <?php
                    if($day == '08')
                    {
                        echo 'selected';
                    }
                    ?>
                >8</option>
                <option
                    <?php
                    if($day == '09')
                    {
                        echo 'selected';
                    }
                    ?>
                >9</option>
                <option
                    <?php
                    if($day == '10')
                    {
                        echo 'selected';
                    }
                    ?>
                >10</option>
                <option
                    <?php
                    if($day == '11')
                    {
                        echo 'selected';
                    }
                    ?>
                >11</option>
                <option
                    <?php
                    if($day == '12')
                    {
                        echo 'selected';
                    }
                    ?>
                >12</option>
                <option
                    <?php
                    if($day == '13')
                    {
                        echo 'selected';
                    }
                    ?>
                >13</option>
                <option
                    <?php
                    if($day == '14')
                    {
                        echo 'selected';
                    }
                    ?>
                >14</option>
                <option
                    <?php
                    if($day == '15')
                    {
                        echo 'selected';
                    }
                    ?>
                >15</option>
                <option
                    <?php
                    if($day == '16')
                    {
                        echo 'selected';
                    }
                    ?>
                >16</option>
                <option
                    <?php
                    if($day == '17')
                    {
                        echo 'selected';
                    }
                    ?>
                >17</option>
                <option
                    <?php
                    if($day == '18')
                    {
                        echo 'selected';
                    }
                    ?>
                >18</option>
                <option
                    <?php
                    if($day == '19')
                    {
                        echo 'selected';
                    }
                    ?>
                >19</option>
                <option

                <option
                    <?php
                    if($day == '20')
                    {
                        echo 'selected';
                    }
                    ?>
                >20</option>
                <option
                    <?php
                    if($day == '21')
                    {
                        echo 'selected';
                    }
                    ?>
                >21</option>
                <option
                    <?php
                    if($day == '22')
                    {
                        echo 'selected';
                    }
                    ?>
                >22</option>
                <option
                    <?php
                    if($day == '23')
                    {
                        echo 'selected';
                    }
                    ?>
                >23</option>
                <option
                    <?php
                    if($day == '24')
                    {
                        echo 'selected';
                    }
                    ?>
                >24</option>
                <option
                    <?php
                    if($day == '25')
                    {
                        echo 'selected';
                    }
                    ?>
                >25</option>
                <option
                    <?php
                    if($day == '26')
                    {
                        echo 'selected';
                    }
                    ?>
                >26</option>
                <option
                    <?php
                    if($day == '27')
                    {
                        echo 'selected';
                    }
                    ?>
                >27</option>
                <option
                    <?php
                    if($day == '28')
                    {
                        echo 'selected';
                    }
                    ?>
                >28</option>
                <option
                    <?php
                    if($day == '29')
                    {
                        echo 'selected';
                    }
                    ?>
                >29</option>
                <option
                    <?php
                    if($day == '30')
                    {
                        echo 'selected';
                    }
                    ?>
                >30</option>
                <option
                    <?php
                    if($day == '31')
                    {
                        echo 'selected';
                    }
                    ?>
                >31</option>
            </select>
        </td>
    </tr>

    <tr>
        <td>  <b> ماه </b></td>
        <td>
            <select name="month" class="form-control input-lg">
                <option
                    <?php
                    if($month == '01')
                    {
                        echo 'selected';
                    }
                    ?>
                >1</option>
                <option>
                    <?php
                    if($month == '02')
                    {
                        echo 'selected';
                    }
                    ?>
                    2</option>
                <option
                    <?php
                    if($month == '03')
                    {
                        echo 'selected';
                    }
                    ?>
                >3</option>
                <option
                    <?php
                    if($month == '04')
                    {
                        echo 'selected';
                    }
                    ?>
                >4</option>
                <option
                    <?php
                    if($month == '05')
                    {
                        echo 'selected';
                    }
                    ?>
                >5</option>
                <option
                    <?php
                    if($month == '06')
                    {
                        echo 'selected';
                    }
                    ?>
                >6</option>
                <option
                    <?php
                    if($month == '07')
                    {
                        echo 'selected';
                    }
                    ?>
                >7</option>
                <option
                    <?php
                    if($month == '08')
                    {
                        echo 'selected';
                    }
                    ?>
                >8</option>
                <option
                    <?php
                    if($month == '09')
                    {
                        echo 'selected';
                    }
                    ?>
                >9</option>
                <option
                    <?php
                    if($month == '10')
                    {
                        echo 'selected';
                    }
                    ?>
                >10</option>
                <option
                    <?php
                    if($month == '11')
                    {
                        echo 'selected';
                    }
                    ?>
                >11</option>
                <option
                    <?php
                    if($month == '12')
                    {
                        echo 'selected';
                    }
                    ?>
                >12</option>
            </select>
        </td>
    </tr>

    <tr>
        <td>  <b> سال </b></td>
        <td>

            <select name="year" class="form-control input-lg">
                   <option
                       <?php
                       if($year == 1397)
                       {
                           echo 'selected';
                       }
                       ?>
                   >1397</option>
                   <option        <?php
                   if($year == 1398)
                   {
                       echo 'selected';
                   }
                   ?> >1398</option>
                   <option        <?php
                   if($year == 1399)
                   {
                       echo 'selected';
                   }
                   ?> >1399</option>
            </select>
        </td>
    </tr>

        <tr>
            <td>  <b>  ثبت</b></td>
            <td><textarea name="message" rows="4" class="form-control input-lg"> </textarea></td>
        </tr>

   <tr>
            <td>  <b>  تغییر تاریخ یا مبلغ </b></td>
            <td><a href="editCheck.php?id=<?php echo $id; ?>"><input type="submit" class="btn btn-warning btn-lg " value=" ثبت اطلاعات جدید "> </td>
        </tr>


    </form>
</table>