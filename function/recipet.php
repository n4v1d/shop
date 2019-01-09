<?php


function recipet()
{
    ?>
    <script>
        $("#searchbtn").click(function () {
            var page = 'searchRecipet';
            var type = $("#type").val();
            var name= $("#companyCreator").val();
            var factor = $("#factor").val();
            $.post("page.php", {page: page,type:type,factor:factor,name:name}, function (data) {
                $("#Aresult").html(data);
            });
        });





        $("#newrecipet").click(function () {
            var page = 'newRecipet';

            $.post("page.php", {page: page}, function (data) {
                $("#content").html(data);
            });
        });



        $("#searchcompany").click(function () {
            var comp = $("#companyname").val();
            if(comp.length > 0 ) {
                var page = 'companySearch';
                var name = $("#companyname").val();
                $.post("page.php", {page: page, name: name}, function (data) {
                    $("#searchresult").html(data);
                });
            }
            else
            {
                alert('لطفا مقداری از نام شرکت را وارد نمایید ');
            }
        });




    </script>
    <div class="row">
        <div class="form-group col-lg-4 col-md-4 col-xs-4 col-sm-4 col-lg-offset-4 col-md-offset-4 col-xs-offset-4 col-sm-offset-4">
            <button class="btn btn-success btn-block  form-control" id="newrecipet">ثبت پرداختی جدید</button>
        </div>
    </div>

    <div class="form-group col-lg-4 col-md-4">
        <label>نام شرکت</label>
        <input type="text" placeholder="نام شرکت"  data-toggle="modal" data-target="#myModal" id="companyCreator" class="input-lg text-center form-control">
    </div>

    <div class="form-group col-lg-4 col-md-4">
        <label>شماره فاکتور</label>
        <input type="text" id="factor"  placeholder="شماره فاکتور"  class="input-lg text-center form-control">
    </div>

    <div class="form-group col-lg-2 col-md-2 col-lg-offset-1 col-md-offset-1">
        <label>جستوجو بر اساس</label>
        <select id="type" class="input-lg form-control">
            <option value="1">نام شرکت</option>
            <option value="2">شماره فاکتور</option>
        </select>
    </div>

    </div>


    </div>

    <div class="form-group col-lg-12 col-md-12 ">
        <button id="searchbtn" class="btn btn-info form-control input-lg">جستوجو</button>
    </div>

    <div id="Aresult" class="row col-md-12  col-lg-12"  >
        <?php
        require 'lib/jdf.php';
        $recipet = new recipet;
        $recipet->lastRecipet();
        ?>
    </div>







    <div class="modal fade" id="myModal" role="dialog">

        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">جستوجوی نام شرکت</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>نام شرکت</label>
                        <input type="text" class="form-control" id="companyname">

                    </div>

                    <div class="form-group">
                        <button class="btn btn-success" id="searchcompany">جستوجو</button>
                    </div>

                    <div id="searchresult">

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                </div>
            </div>

        </div>
    </div>








    <?php
}


function searchRecipet()
{
    require 'lib/jdf.php';
    $name = $_POST['name'];
    $factorid = $_POST['factor'];
    $type = $_POST['type'];
    $recipet = new recipet();
    $recipet->searchRecipet($factorid,$name,$type);

}



function newRecipet()
{
    ?>

    <script>

        $("#searchcompany").click(function () {
            var comp = $("#companyname").val();
            if(comp.length > 0 ) {
                var page = 'companySearch';
                var name = $("#companyname").val();
                $.post("page.php", {page: page, name: name}, function (data) {
                    $("#searchresult").html(data);
                });
            }
            else
            {
                alert('لطفا مقداری از نام شرکت را وارد نمایید ');
            }
        });

        $("#saveNewRecipet").click(function () {
            var comp = $("#companyCreator").val();
            var page = 'saveNewRecipet';
            var factorid = $("#factorid").val();
            var price = $("#price").val();
            var day = $("#day").val();
            var month = $("#month").val();
            var year = $("#year").val();
            var payer = $("#payer").val();
            var bank = $("#bank").val();
            var payid = $("#payid").val();
            var type = $("#vtype").val();
            var accountnumber = $("#accountnumber").val();
            var reciver = $("#reciver").val();


            $.post("page.php", {page: page, name: comp , factorid:factorid,price:price,day:day,month:month,year:year,payer:payer,bank:bank,payid:payid,type:type,accountnumber:accountnumber,reciver:accountnumber}, function (data) {
                $("#content ").html(data);
            });

        });



    </script>
    <div class="container">
        <div class="form-group  col-lg-4 col-md-4">
            <label>نام شرکت</label>
            <input type="text" data-toggle="modal" data-target="#myModal" id="companyCreator"  placeholder="نام شرکت" class="form-control input-lg">
        </div>

        <div class="form-group  form-group  col-lg-4 col-md-4">
            <label>شماره فاکتور</label>
            <input type="text" id="factorid"  class="form-control input-lg">
        </div>

        <div class="form-group  col-lg-4 col-md-4">
            <label>مبلغ</label>
            <input type="text" id="price"  class="form-control input-lg">
        </div>

        <div class="form-group  col-lg-6 col-md-6">
            <div class="form-group col-lg-4 col-md-4">

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
                    <option selected>1396</option>
                    <option>1397</option>
                    <option>1398</option>
                    <option>1399</option>
                    <option>1400</option>
                </select>

            </div>        </div>

        <div class="form-group  col-lg-6 col-md-6">
            <label>پرداخت کننده</label>
            <input type="text" id="payer"  class="form-control input-lg">
        </div>


        <div class="form-group  col-lg-4 col-md-4">
            <label>بانک مقصد</label>
            <input type="text" id="bank" class="form-control input-lg">
        </div>

        <div class=" form-group  col-lg-4 col-md-4">
            <label>شماره پرداخت</label>
            <input type="text" id="payid"  class="form-control input-lg">
        </div>
        <div class="form-group  col-lg-4 col-md-4">
            <label>نحوه  پرداخت</label>
            <input type="text" id="vtype" class="form-control input-lg">
        </div>


        <div class=" form-group  col-lg-6 col-md-6">
            <label> شماره چک / شماره حساب - کارت گیرنده</label>
            <input type="text" id="accountnumber" class="form-control input-lg">
        </div>
        <div class=" form-group col-lg-6 col-md-6">
            <label> نام صاحب حساب</label>
            <input type="text" id="reciver"  class="form-control input-lg">
        </div>
    </div>


    <div class="form-group col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
        <button class="btn btn-success form-control" id="saveNewRecipet">ثبت</button>
    </div>








    <div class="modal fade" id="myModal" role="dialog">

        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">جستوجوی نام شرکت</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>نام شرکت</label>
                        <input type="text" class="form-control" id="companyname">

                    </div>

                    <div class="form-group">
                        <button class="btn btn-success" id="searchcompany">جستوجو</button>
                    </div>

                    <div id="searchresult">

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                </div>
            </div>

        </div>
    </div>





    </div>
    <?php
}


function saveNewRecipet()
{
    require './lib/jdf.php';
    $recipet = new recipet();

    $name = $_POST['name'];
    $factorid = $_POST['factorid'];
    $price = $_POST['price'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $person = $_POST['payer'];
    $bank = $_POST['bank'];
    $payid = $_POST['payid'];
    $vtype = $_POST['type'];
    $accountnumber = $_POST['accountnumber'];
    $reciver = $_POST['reciver'];
    $time = jmktime("04","00","05",$month,$day,$year);
    $recipet->insertNewRecipet($name,$factorid ,$price,$time,$person , $bank,$payid , $vtype , $accountnumber ,$reciver);


}


?>