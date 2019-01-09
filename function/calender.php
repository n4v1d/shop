<?php

function calender()
{
    require 'lib/jdf.php';


    $time = jmktime("01","01","01",$month,$day,$year);

    $calender = new calender();

    ?>
    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
        <label>عنوان</label>
        <input class="form-control input-lg" id="message">
    </div>


    <div class="col-lg-6 ">
        <div class="form-group col-lg-4">
            <label>روز</label>
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


        <div class="form-group col-lg-4">
            <label>ماه</label>
            <select id="month" class="form-control input-lg">

                <option>8 / آبان</option>
                <option>9 / آذر</option>
                <option>10  /  دی</option>
                <option>11  /  بهمن</option>
                <option>12  /  اسفند</option>
            </select>


        </div>


        <div class="form-group col-lg-4">
            <label>سال</label>
            <select id="year" class="form-control input-lg">
                <option selected>1397</option>
                <option >1398</option>
            </select>

        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
        <label>ثبت</label>
        <button class="form-control input-lg btn btn-lg btn-success" id="save"> ثبت </button>
    </div>



    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <h1 class="text-center">لیست یاد اورهای امروز شما ( <?php echo jdate('d/F/Y',time(),'','','en'); ?> )</h1>
    </div>


    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
        <h4 class="text-center alert alert-warning">یاد اور انجام نشده روز های گذشته</h4>
        <br>
        <?php
        $calender->GetOldCalender(1);
        ?>
    </div>


    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
        <h4 class="text-center alert alert-danger">یاد آور های انجام نشده (امروز)</h4>
        <br>
        <?php
        $calender->GetTodayCalender(0);
        ?>
        <br>

    </div>


    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
        <h4 class="text-center alert alert-success">یاد آور های انجام شده (امروز)</h4>
        <br>
        <?php
        $calender->GetTodayCalender(1);
        ?>
    </div>





    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
        <h4 class="text-center alert alert-info">یاد اوری روز های آینده (3 روز آینده)</h4>
        <br>
        <?php
        $calender->GetNextDaysCalender(1);
        ?>
    </div>






    <script>
        $("#save").click(function() {
            var message = $("#message").val();
            var day = $("#day").val();
            var month = $("#month").val();
            var year = $("#year").val();
            var page = 'saveMessage';

            $.post('page.php' , {page:page,message:message , day : day , month : month , year : year } , function(data) {

                if(data == 1)
                {
                    swal("یاد آور!", "یک یاد آور جدید ثبت شد ، به موقع شما را خبردار خواهیم کرد", "success");

                }
                else
                {
                    swal("یاد آور!", "خطا ، ثبت نشد", "error");

                }
            });

        });

        $(".do").click(function() {
            var id = this.id;
            var page = 'UpdateCalenderMessage';
            var action = '1';
            $.post('page.php',{page:page,id:id,action:action},function(data) {
                if(data == 1)
                {
                    swal("یاد آور!", "وضعیت با موفقیت تغییر کرد", "success");

                }
                else
                {
                    swal("یاد آور!", "خطا", "error");

                }        });
        });



        $(".undo").click(function() {
            var id = this.id;
            var page = 'UpdateCalenderMessage';
            var action = '0';
            $.post('page.php',{page:page,id:id,action:action},function(data) {
                if(data == 1)
                {
                    swal("یاد آور!", "وضعیت با موفقیت تغییر کرد", "success");

                }
                else
                {
                    swal("یاد آور!", "خطا", "error");

                }
            });
        });
    </script>

    <?php

}

function saveMessage()
{
    require 'lib/jdf.php';
    $message = $_POST['message'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    $time = jmktime("01","01","01",$month,$day,$year);

    $calender = new calender();

    $userid = $_SESSION['UserId'];

    $calender->InserToCalender($time,$message,$userid);

}


function UpdateCalenderMessage()
{
    $id = $_POST['id'];
    $action = $_POST['action'];

    $calender = new calender();

    $calender->UpdateCalenderStatus($id,$action);
}




?>