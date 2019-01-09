<?php

// فانکشن های مربوط به بخش شرکت ها


function Companyfactorlist()
{

    ?>



    </div>
    <?php
    $company = new company();
    if(isset($_POST['pageid'])) {
        $pageid = $_POST['pageid'];

    }
    else {
        $pageid = '0';
    }


    if(isset($_POST['company']))
    {


        $company->Companyfactorlist($pageid,$_POST['company']);
    }

}




function company()
{
    ?>


    <script>
        $("#newCompany").click(function () {
            var page = 'createCompany';
            var name = $("#name").val();
            var code = $("#code").val();
            var tele = $("#tel").val();
            var addresse = $("#address").val();
            var visitor = $("#visitor").val();
            $.post("page.php", {page: page,name:name,code:code,telC:tele,addressC:addresse}, function (data) {
                $("#content").html(data);
                $('html,body').animate({
                        scrollTop: $("#content").offset().top},
                    'slow')
            });
        });
    </script>



    <div class="container">
        <div class=" col-lg-12">
            <div class="form-group">
                <label>نام شرکت</label>
                <input type="text" id="name" class="input-lg form-control" >
            </div>
        </div>

        <div class=" col-lg-4">
            <div class="form-group">
                <label> کد شرکت</label>
                <input type="text" id="code" class="input-lg form-control" placeholder="کد تعریف شده در نرم افزار نیک حساب" >
            </div>
        </div>


        <div class=" col-lg-4">
            <div class="form-group">
                <label>آدرس شرکت</label>
                <input type="text" id="address" class="input-lg form-control" >
            </div>
        </div>



        <div class=" col-lg-4">
            <div class="form-group">
                <label>شماره تلفن</label>
                <input type="text" id="tel" class="input-lg form-control" >
            </div>
        </div>





        <div class="form-group col-lg-6 col-lg-offset-3">
            <button id="newCompany" class="btn btn-success form-control"> ثبت شرکت</button>
        </div>
    </div>


    <?php
}



function  Createcompany()
{
    $code = $_POST['code'];
    $name = $_POST['name'];
    $tel = $_POST['telC'];
    $address = $_POST['addressC'];

    $company = new company();
    $company->addCompany($code,$name,$address,$tel);

}




function companySearch()
{
    $name = $_POST['name'];

    $company = new company();
    $company->searchName($name);
}



function Detailed()
{
    $branchClass = new branch();
    ?>
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <h1 class="text-center">نام شرکت</h1>
            <input type="text" class="form-control input-lg" data-toggle="modal" data-target="#myModal"  id="companyCreator">
        </div>


        <div class="col-lg-4 col-md-4">
            <h1 class="text-center">شعبه مورد نظر </h1>

            <select id="branch" class="form-control input-lg">
                <?php
                $branchClass->GetBranchDropDown();
                ?>
                <option value="70">همه</option>
            </select>



        </div>

        <div class="col-lg-4 col-md-4">
            <h1>مشاهده گزارش</h1>
            <button id="ViewReport" class="btn btn-lg form-control input-lg btn-success">مشاهده</button>
        </div>

        <div class="form-group  col-lg-6 col-md-6">
            <div class="form-group col-lg-4 col-md-4">
                <h1 class="text-center">روز </h1>

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
                <h1 class="text-center">ماه   </h1>

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
                <h1 class="text-center"> سال  </h1>

                <select id="year" class="form-control input-lg">
                    <option selected>1396</option>
                    <option>1397</option>
                    <option>1398</option>
                    <option>1399</option>
                    <option>1400</option>
                </select>

            </div>        </div>







        <div class="form-group  col-lg-6 col-md-6">
            <div class="form-group col-lg-4 col-md-4">
                <h1 class="text-center">روز </h1>

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


            <div class="form-group col-lg-4">
                <h1 class="text-center">ماه   </h1>

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
                <h1 class="text-center"> سال  </h1>

                <select id="tyear" class="form-control input-lg">
                    <option selected>1396</option>
                    <option>1397</option>
                    <option>1398</option>
                    <option>1399</option>
                    <option>1400</option>
                </select>

            </div>        </div>






    </div>
    <br>
    <br>
    <br>


    <div id="AjxResult">

    </div>


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





        $("#ViewReport").click(function () {
            var comp = $("#companyCreator").val();

            var day = $("#day").val();
            var month = $("#month").val();
            var year = $("#year").val();

            var tday = $("#tday").val();
            var tmonth = $("#tmonth").val();
            var tyear = $("#tyear").val();

            var branch = $("#branch").val();
            if(comp.length > 0 ) {
                var page = 'DetailedReport';
                $.post("page.php", {page: page, company: comp , branch: branch , day:day , month:month , year:year,tday:tday , tmonth:tmonth , tyear:tyear}, function (data) {
                    $("#AjxResult").html(data);
                });
            }
            else
            {
                alert('لطفا مقداری از نام شرکت را وارد نمایید ');
            }
        });
    </script>

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



function DetailedReport()
{
    $branch = $_POST['branch'];
    $ReportCompany = $_POST['company'];

    $company = new company();

    require 'lib/jdf.php';

    $day= $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $from = jmktime("00","00","01",$month,$day,$year);

    $tday= $_POST['tday'];
    $tmonth = $_POST['tmonth'];
    $tyear = $_POST['tyear'];
    $to = jmktime("23","59","59",$tmonth,$tday,$tyear);


    $company->CompanyfactorlistbyBranch($ReportCompany , $branch , $from , $to );


}


function CompanyList()
{
    $company = new company();
    $company->GetLastCompanyList();
}



?>