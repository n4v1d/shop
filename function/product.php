<?php


function SearchProduct()
{
    $id = $_POST['id'];

    $entity = new entity();
    $entity->CheckForAlert($id);
    $factor = new factor();
    echo '<div class="col-lg-12">';
    $factor->getProductData($id);
    echo '</div>';
}


function product()
{
    ?>


    <script>
        $("#newCompany").click(function () {
            var page = 'createProduct';
            var name = $("#name").val();
            var code = $("#code").val();
            var inpack = $("#inpack").val();
            var companyC = $("#companyCreator").val();
            $.post("page.php", {page: page,name:name,code:code,inpack:inpack,companyC:companyC}, function (data) {
                $("#content").html(data);
                $('html,body').animate({
                        scrollTop: $("#content").offset().top},
                    'slow')
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










    <div class="container-fluid">
        <div class=" col-lg-4">
            <div class="form-group">
                <label>نام کالا</label>
                <input type="text" id="name" class="input-lg form-control" >
            </div>
        </div>

        <div class=" col-lg-3">
            <div class="form-group">
                <label>کد کالا</label>
                <input type="text" id="code" placeholder="کد تعریف شده در نرم افزار نیک حساب"  class="input-lg form-control" >
            </div>
        </div>

        <div class=" col-lg-3">
            <div class="form-group">
                <label> تولد کننده</label>
                <input type="text" data-toggle="modal" data-target="#myModal"   id="companyCreator" class="input-lg form-control" placeholder="کد تعریف شده در نرم افزار نیک حساب" >
            </div>
        </div>

        <div class=" col-lg-2">
            <div class="form-group">
                <label>تعداد در هر جعبه</label>
                <input type="text" id="inpack" class="input-lg form-control" placeholder="کد تعریف شده در نرم افزار نیک حساب" >
            </div>
        </div>



        <div class="form-group col-lg-6 col-lg-offset-3">
            <button id="newCompany" class="btn btn-success form-control">ثبت کالا</button>
        </div>
    </div>




    <form action="EditProduct.php">
        <div class="col-lg-6 col-md-6 col-xs-9 col-sm-6">
            <input type="text" name="code" class="input-lg form-control ">

        </div>




        <div class="col-lg-6 col-md-6 col-xs-9 col-sm-6">
            <input type="submit" value="ویرایش" class="btn btn-primary input-lg form-control">

        </div>

    </form>

    <?php
}

function  CreateProduct()
{
    $productid = $_POST['code'];
    $name = $_POST['name'];
    $companyC = $_POST['companyC'];
    $inpack = $_POST['inpack'];

    $company = new product();
    $company->addProduct($name,$productid,$companyC,$inpack);

}


function productSearch()
{
    $name = $_POST['name'];

    $company = new product();
    $company->searchName($name);
}


function add2factor()
{
    $factor = new factor();
    $facrorid = $_POST['factorid'];
    $epercent = $_POST['epercent'];
    $eshantionin = $_POST['eshantionin'];
    $eshantion = $_POST['eshantion'];
    if($_POST['feshantion'] == 'true')
    {
        $feshantion = '1';
    }
    else
    {
        $feshantion = '0';
    }
    $productid = $_POST['productid'];
    $count = $_POST['count'];
    $boxin = $_POST['boxin'];
    $oldprice = $_POST['oldprice'];
    $gheymatforooshghadi = $_POST['gheymatforooshghadi'];
    $gheymatmasrafghadim = $_POST['gheymatmasrafghadim'];
    $gheymatjadid = $_POST['gheymatjadid'];
    $gheymatmasrafjadid = $_POST['gheymatmasrafjadid'];
    $gheymatforoshjadid = $_POST['gheymatforooshjadid'];
    $takhfifnaghdi = $_POST['takhfifnaghdi'];
    $takhfifhajmi = $_POST['takhfifhajmi'];
    $tax = $_POST['tax'];
    $eshantionCode = $_POST['eshantionCode'];
    $eshantionPrice = $_POST['eshantionPrice'];
    $factor->addToFactor($facrorid,$productid,$gheymatjadid,$gheymatforoshjadid,$gheymatmasrafjadid,$count,$takhfifhajmi,$takhfifnaghdi,$tax,$oldprice,$gheymatforooshghadi,$gheymatmasrafghadim,$eshantion,$boxin,$eshantionin,$feshantion,$epercent,$eshantionCode,$eshantionPrice);
}


function GetEshantionName()
{
    $product_id = $_POST['eshantionCode'];
    $product = new product();
    $product->searchEshantionName($product_id);
}




function BuyReport()
{
    ?>
    <script>


        $("#ShowReport").click(function () {

            var productId = $("#productCode").val();
            $.post("page.php", {page:'ShowBuyReport',productId:productId}, function (data) {
                $("#AjxResult").html(data);
                $('html,body').animate({
                        scrollTop: $("#ajxresult").offset().top},
                    'slow')
            });
        });


        $("#productCode").keyup(function (e) {
            if (e.which == 13) {

                var productId = $("#productCode").val();
                $.post("page.php", {page:'ShowBuyReport',productId:productId}, function (data) {
                    $("#AjxResult").html(data);
                    $('html,body').animate({
                            scrollTop: $("#ajxresult").offset().top},
                        'slow')
                });

            }
        });

    </script>
    <div class="col-lg-6">
        <input  id="productCode" type="text" class="input-lg text-center form-control" placeholder="کد کالا">
    </div>

    <div class="col-lg-6">
        <button id="ShowReport" class="btn btn-success input-lg form-control"> مشاهده گزارش خرید</button>
    </div>


    <div id="AjxResult">

    </div>
    <?php
}



function ShowBuyReport()
{
    $productId = $_POST['productId'];
    $product = new product();
    $product->GiveLastBuyReportFranchise($productId,0);
}





function BuyCount()
{
    ?>
    <div class="container">         <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

            <input type="text" id="code" placeholder="کد کالا" class="form-control input-lg text-center">
            <br>
            <button id="view" class="form-control input-lg text-center btn btn-success btn-lg"> مشاهده گزارش</button>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div id="AjaxResponse" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

        </div>

    </div>

    <script>
        $("#view").click(function () {

            var code = $("#code").val();
            var page = 'CalculateBuy';

            $.post('page.php',{page:page,code:code} , function (data) {
                $("#AjaxResponse").html(data);
            });

        });
    </script>

    <?php
}


function CalculateBuy()
{
    $code = $_POST['code'];

    $product = new product();

    $TotalCount = $product->GetTotalBuyCount($code);
    $TotalEshantionCount = $product->GetTotalEshantionCount($code);
    $product->GetProductData($code);
    ?>

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 text-center">
        <h3>نام کالا </h3>
        <h1 class="alert alert-success text-center" ><?php echo $product->name;?></h1>
    </div>


    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 text-center">
        <h3>میزان خرید</h3>
        <h1 class="alert alert-info text-center" ><?php echo $product->TotalBuyCount;?></h1>
    </div>

    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 text-center">
        <h3>میزان اشانتیون</h3>

        <h1 class="alert alert-success text-center" ><?php echo $product->TotalEshantionConunt;?></h1>
    </div>

    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 text-center">
        <h3 class="text-center"> جمع کل</h3>

        <h1 class="alert alert-danger text-center" ><?php echo $product->TotalEshantionConunt + $product->TotalBuyCount ;?></h1>
    </div>

    <?php
}



function GetLastBuyData()
{
    ?>


    <?php
    $id = $_POST['id'];
    $factorid = $_POST['factorid'];


    $product = new product();

    $product->GetProductBuyData($id , $factorid);

}

function PriceReport()
{
    ?>
    <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
        <input class="form-control input-lg" placeholder="کد کالا" id="productid" >
    </div>


    <div class="col-lg-5 ">
        <div class="form-group col-lg-4">
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
                <option >1395</option>
                <option >1396</option>
                <option selected>1397</option>
            </select>

        </div>
    </div>



    <div class="col-lg-5 ">
        <div class="form-group col-lg-4">
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
                <option >1395</option>
                <option >1396</option>
                <option selected>1397</option>
            </select>

        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <button class="btn btn-lg input-lg form-control btn-success" id="viewReport">گزارش گیری</button>
    </div>

    <div class="container-fluid" id="ResultContent">
    </div>

    <script>
        $("#viewReport").click(function() {
            var productid = $("#productid").val();

            var day = $("#day").val();
            var month = $("#month").val();
            var year = $("#year").val();


            var tday = $("#tday").val();
            var tmonth = $("#tmonth").val();
            var tyear = $("#tyear").val();






            $.post('page.php',{page:'ViewProductReport' , productid:productid , day:day , month:month , year:year, tday:tday , tmonth:tmonth , tyear:tyear} , function(data) {
                $("#ResultContent").html(data);

            });
        });
    </script>

    <?php
}

function ViewProductReport()
{
    require 'lib/jdf.php';
    $productid = $_POST['productid'];

    $product = new product();


    $day  = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $from  = jmktime('00','00','01', $month , $day , $year);

    $tday  = $_POST['tday'];
    $tmonth = $_POST['tmonth'];
    $tyear = $_POST['tyear'];
    $to  = jmktime('23','59','59', $tmonth , $tday , $tyear);

    $factor = new factor();
    $factor->getAllFactorBetweenData($from,$to , $productid);




}



function ProductLIst()
{
    $product = new product();
    $product->GetLastProductList();
}


?>