<?php


function Manager()
{
    ?>

    <script>
        $("#UserArchive").click(function() {
            $.post('page.php',{page:'UserArchiveGet'} , function(data) {
                $("#Result").html(data);
            })
        });
    </script>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
            <button class="input-lg form-control btn btn-success btn-lg " id="UserArchive">ارشیو اعضا</button>
        </div>
    </div>

    <br>
    <br>
    <div class="row ">
        <div class="container">
            <div id="Result">
            </div>
        </div>
    </div>

    <?php

}



function AdminPanel()
{
    ?>

    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <button class="btn btn-success btn-lg input-lg form-control" id="Score">مشاهده نمره بندی</button>
    </div>
    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <button class="btn btn-info btn-lg input-lg form-control" id="Discount">  آرشیو تحفیف ها</button>
    </div>


    <script>
        $("#Score").click(function() {
            var page = 'scoreCalc';
            $.post("page.php", {page: page},function (data) {
                $("#AjaxResult").html(data);
                $('html,body').animate({
                        scrollTop: $("#AjaxResult").offset().top},
                    'slow')
            });
        });





        $("#Discount").click(function() {
            var page = 'Discount';
            $.post("page.php", {page: page},function (data) {
                $("#AjaxResult").html(data);
                $('html,body').animate({
                        scrollTop: $("#AjaxResult").offset().top},
                    'slow')
            });
        });
    </script>
    <div id="AjaxResult">
    </div>
    <?php


}



function scoreCalc()
{
    ?>
    <div class="row" >
        <br>
        <br>
        <br>
        <br>
        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <select id="fd" class="form-control input-lg ">
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




            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <select id="fm" class="form-control input-lg ">
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






            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <select id="fy" class="form-control input-lg ">
                    <option>1396</option>
                    <option>1397</option>



                </select>
            </div>




        </div>











        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <select id="td" class="form-control input-lg ">
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




            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <select id="tm" class="form-control input-lg ">
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






            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <select id="ty" class="form-control input-lg ">
                    <option>1396</option>
                    <option>1397</option>



                </select>
            </div>




        </div>





        <br>
        <br>
        <br>
        <br>

        <div class="row">

            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                <select id="User" class="form-control input-lg">
                    <?php

                    $personel = new user();
                    $personel->GetUserDropDownList();
                    ?>
                </select>
            </div>



            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">

                <button id="SeeReport" class="form-control input-lg btn btn-lg btn-danger">مشاهده گزارش</button>
            </div>

        </div>

    </div>



    <div id="ShowReport">


    </div>

    </div>
    <script>
        $("#SeeReport").click(function () {

            var fd = $("#fd").val();
            var fm = $("#fm").val();
            var fy = $("#fy").val();



            var td = $("#td").val();
            var tm = $("#tm").val();
            var ty = $("#ty").val();


            var user = $("#User").val();

            var page = 'SeeReport';

            $.post("page.php" , {fd:fd , fm:fm , fy:fy , td:td , tm:tm , ty:ty , page:page , user:user} , function(data) {
                $("#ShowReport").html(data);
            });



        });
    </script>

    <?php
}


function ShowReport()
{

    require 'lib/jdf.php';


    $fd = $_POST['fd'];
    $fm = $_POST['fm'];
    $fy = $_POST['fy'];


    $td = $_POST['td'];
    $tm = $_POST['tm'];
    $ty = $_POST['ty'];

    $user = $_POST['user'];


    $personel = new user();

    $from =   jmktime('00','00','01' , $fm , $fd , $fy);
    $to =     jmktime('23','59','59' , $tm , $td , $ty);



    $personel->GetPersonelScore($user , $from , $to);

}



//  Open Close Factor ( Change Status)

function ChangeStatus()
{
    ?>
    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
        <label>شماره فاکتور (شماره سیستمی فاکتور)</label>
        <input type="text" id="FactorId" class="input-lg form-control ">
    </div>


    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
        <label>باز کردن فاکتور</label>
        <button type="text" id="opens" class="btn btn-lg  form-control input-lg  btn-success ">بار کردن فاکتور</button>
    </div>


    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
        <label>شماره فاکتور (شماره سیستمی فاکتور)</label>
        <button type="text" id="close" class="btn btn-lg  form-control input-lg  btn-danger "> بستن فاکتور</button>
    </div>


    <script>

        $("#opens").click(function() {
            var id = $("#FactorId").val();
            var page = "OpenFactor";

            $.post("page.php", {page: page, factorid: id}, function (data) {
                alert(data);
            });

        });


        $("#close").click(function() {
            var id = $("#FactorId").val();
            var page = "CloseFactore";

            $.post("page.php", {page: page, factorid: id}, function (data) {
                alert(data);
            });

        });
    </script>


    <?php
}




function OpenFactor()
{
    $factorid = $_POST['factorid'];

    $factor = new factor();

    $factor->OpenFactore($factorid);
}



function CloseFactore()
{
    $factorid = $_POST['factorid'];

    $factor = new factor();

    $factor->CloseFactore($factorid);
}




?>