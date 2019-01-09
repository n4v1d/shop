<?php




function check()
{
?>

    <div class="col-lg-12 col-x-12 col-md-12 col-xs-12">

      <div class="col-lg-6 col-md-6 col-xs-6  col-sm-6">
          <div class="form-group col-lg-3 col-md-3 col-xs-3">

              <select id="day" class="form-control input-lg">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>20</option>
                  <option>21</option>
                  <option>22</option>
                  <option>23</option>
                  <option>24</option>
                  <option>25</option>
                  <option>26</option>
                  <option>27</option>
                  <option>28</option>
                  <option>29</option>
                  <option>30</option>
                  <option>31</option>
              </select>
          </div>


          <div class="form-group col-lg-3 col-md-3 col-xs-3">

              <select id="month" class="form-control input-lg">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
              </select>


          </div>



    <div class="form-group col-lg-4">

        <select id="year" class="form-control input-lg">

            <option selected>1397</option>
            <option >1398</option>
        </select>

    </div>



</div>











      <div class="col-lg-6 col-md-6 col-xs-6  col-sm-6">
          <div class="form-group col-lg-3 col-md-3 col-xs-3">

              <select id="tday" class="form-control input-lg">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>20</option>
                  <option>21</option>
                  <option>22</option>
                  <option>23</option>
                  <option>24</option>
                  <option>25</option>
                  <option>26</option>
                  <option>27</option>
                  <option>28</option>
                  <option>29</option>
                  <option>30</option>
                  <option>31</option>
              </select>
          </div>


          <div class="form-group col-lg-3 col-md-3 col-xs-3">

              <select id="tmonth" class="form-control input-lg">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
              </select>


          </div>



    <div class="form-group col-lg-4">

        <select id="tyear" class="form-control input-lg">

            <option selected>1397</option>
            <option >1398</option>
        </select>

    </div>



</div>



    <div class="col-lg-6 col-x-6 col-md-6 col-xs-6">
        <input type="text" id="len" class="input-lg form-control" placeholder="مدت">
    </div>


    <div class="col-lg-6 col-x-6 col-md-6 col-xs-6">
        <input type="text" id="price" class="input-lg form-control" placeholder="مبلغ">
    </div>



    <div class="col-lg-12 col-x-12 col-md-12 col-xs-12" style="margin-top:  30px">
        <button class="btn btn-lg form-control input-lg btn-lg btn-success" id="calc">محاسبه</button>
    </div>


    <script>
        $("#calc").click(function () {
            var page = 'CalcCheck';

            var day = $("#day").val();
            var month = $("#month").val();
            var year= $("#year").val();


             var tday = $("#tday").val();
            var tmonth = $("#tmonth").val();
            var tyear= $("#tyear").val();


            var len = $("#len").val();
            var price = $("#price").val();
            $.post("page.php", {page: page,day:day,month:month,year:year,tday:tday,tmonth:tmonth,tyear:tyear,len:len,price:price}, function (data) {
                $("#content").html(data);
                $('html,body').animate({
                        scrollTop: $("#content").offset().top},
                    'slow')
            });
        });

        </script>

<?php
}




function CalcCheck()
{

    require 'lib/jdf.php';
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $from = jmktime("00","00","05",$month,$day,$year);



    $tday = $_POST['tday'];
    $tmonth = $_POST['tmonth'];
    $tyear = $_POST['tyear'];
    $tfrom = jmktime("00","00","05",$tmonth,$tday,$tyear);

    $dbt = ($from + $tfrom) / 2;

    $price = $_POST['price'];

    $len = $_POST['len']  * '86400';


    $final = $dbt + $len;


    $date =  jdate('Y/m/d   ',$final , '','','en');

    ?>

    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <h1>تاریخ چک: <?php echo $date; ?></h1>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <h1>مبلغ چک: <?php echo num2word($price); ?></h1>
    </div>
<?php

}





function num2word($num)
    {

        $one = array('','یک','دو','سه','چهار','پنج','شش','هفت','هشت','نه');
        $ten = array('','','بیست','سی','چهل','پنجاه','شصت','هفتاد','هشتاد','نود',);
        $hundred = array('','یکصد','دویست','سیصد','چهارصد','پانصد','ششصد','هفتصد','هشتصد','نهصد',);
        $categories = array('','هزار','میلیون','میلیارد','بیلیون','بیلیارد','تریلیون','تریلیارد','کوآدریلیون',);
        $exceptions = array('ده','یازده','دوازده','سیزده','چهارده','پانزده','شانزده','هفده','هجده','نوزده',);
        $out = '';
        $j   = 0;
        $cnt = strlen($num);
        for($i=--$cnt;$i>=0;$i-=3){
            $add = '';
            $i1 = $num[$i];
            $i2 = isset($num[$i-1]) ? $num[$i-1] : '';
            $i3 = isset($num[$i-2]) ? $num[$i-2] : '';
            if(!empty($i3))
                $add .= $hundred[$i3].' و ';
            if($i2>1)
                $add .= $ten[$i2].' و '.$one[$i1].' ';
            elseif($i2==1)
                $add .= $exceptions[$i1].' ';
            else
                $add .= $one[$i1].' ';
            if($add!=' ')
                $add .= $categories[$j++].' و ';
            else
                $j++;
            $out = $add.$out;
        }
        return mb_substr($out,0,-4);
    }





function ConfirmCheck()
{
    ?>
    <h1>لیست چکهای تایید نشده:</h1>
    <?php
    $check = new check();
    $check->GetUnConfirmedCheck();
}






function SaveCheckLength()
{
    $id = $_POST['id'];
    $len = $_POST['len'];

    $check = new chek();
    $factor = new factor();
    $factor->getFactorDetail($id);

    $date = $factor->time + ('86400' * $len);
    $check->UpdateFactorStatusManual($id,5,$len);

    echo $check->InsertNewCheck($factor->company , "test" , $factor->fullprice , $factor->time , $date,$len,'5',$factor->id,$factor->factorid);
}




function SaveCheckLengthFinal()
{
    $check = new chek();

    $id = $_POST['factorid'];
    $check->UpdateFactorStatusManual($id,1);
}






function CalenderCheck()
{
require 'lib/jdf.php';


$time = jmktime("01","01","01",$month,$day,$year);

$calender = new calender();

?>

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <h1 class="text-center">لیست چک های امروز شما ( <?php echo jdate('d/F/Y',time(),'','','en'); ?> )</h1>
        </div>


        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">


            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <h4 class="text-center alert alert-danger">چک های تحویل نشده سررسید شده</h4>
                <?php
                $calender->GetOldCheckCalender(0);
                ?>
            </div>


            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <h4 class="text-center alert alert-danger">چک های پاس نشده روز های قبل</h4>
                <?php
                $calender->GetOldCheckCalender(1);
                ?>
            </div>


            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <h4 class="text-center alert alert-danger">چک های برگشت خورده روز های قبل</h4>
                <?php
                $calender->GetOldCheckCalender(2);
                ?>
            </div>
        </div>








        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">


            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <h4 class="text-center alert alert-danger">چک های تحویل (نشده) و سر رسید شده امروز</h4>
                <?php
                $calender->GetTodayCheckCalender(0);
                ?>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <h4 class="text-center alert alert-warning">چک های پاس نشده امروز</h4>
                <?php
                $calender->GetTodayCheckCalender(1);
                ?>
            </div>


            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <h4 class="text-center alert alert-success">چک های پاس شده امروز</h4>
                <?php
                $calender->GetTodayCheckCalender(3);
                ?>
            </div>




            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <h4 class="text-center alert alert-danger">چک های  برگشت خورده امروز</h4>
                <?php
                $calender->GetTodayCheckCalender(4);
                ?>
            </div>



        </div>








        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">


            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <h4 class="text-center alert alert-info">فردا</h4>
                <?php
                $calender->GetFeatureCheckCalender(1);
                ?>
            </div>


            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <h4 class="text-center alert alert-info">پس فردا</h4>
                <?php
                $calender->GetFeatureCheckCalender(2);
                ?>
            </div>




            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <h4 class="text-center alert alert-info">3 روز اینده</h4>
                <?php
                $calender->GetFeatureCheckCalender(3);
                ?>
            </div>



        </div>


        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <h4 class="text-center alert alert-info">چک های تحویل نشده</h4>
            <?php
            $calender->getUngiveCheck();
            ?>
        </div>
    </div>








    <script>
        $(".give").click(function() {
            var id = this.id;
            var page = 'UpdateCalenderCheckMessage';
            var action = '2';
            $.post('page.php',{page:page,id:id,action:action},function(data) {
                if(data == 1)
                {
                    swal("چک!", "وضعیت با موفقیت تغییر کرد", "success");

                }
                else
                {
                    swal("یاد آور!", "خطا", "error");

                }        });
        });





        $(".pass").click(function() {
            var id = this.id;
            var page = 'UpdateCalenderCheckMessage';
            var action = '3';
            $.post('page.php',{page:page,id:id,action:action},function(data) {
                if(data == 1)
                {
                    swal("چک!", "وضعیت با موفقیت تغییر کرد", "success");

                }
                else
                {
                    swal("یاد آور!", "خطا", "error");

                }        });
        });



        $(".unpass").click(function() {
            var id = this.id;
            var page = 'UpdateCalenderCheckMessage';
            var action = '4';
            $.post('page.php',{page:page,id:id,action:action},function(data) {
                if(data == 1)
                {
                    swal("چک!", "وضعیت با موفقیت تغییر کرد", "success");

                }
                else
                {
                    swal("یاد آور!", "خطا", "error");

                }        });
        });


    </script>

    <?php

}



function awaitingCheck()
{
    ?>
    <h1>لیست چکهای تایید نشده:</h1>
    <?php
    $check = new check();
    $check->GetWaitedCheck();
}

function UpdateCalenderCheckMessage()
{
    $id = $_POST['id'];
    $action = $_POST['action'];

    $calender = new calender();

    echo $calender->UpdateCalenderCheckStatus($id,$action);
}


?>