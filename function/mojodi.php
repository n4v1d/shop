<?php

function entity_company()
{
    ?>

    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <h3>نام شرکت</h3>
        <input type="text" class="form-control input-lg" data-toggle="modal" data-target="#myModal"  id="companyCreator">
    </div>

    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <h3>مشاهده </h3>
        <input type="submit" class="btn btn-lg form-control input-lg btn-success" id="view" value="مشاهده">
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

        $("#view").click(function() {
            var company = $("#companyCreator").val();
            var page = "entity_company_product"

            $.post('page.php' , {company:company , page:page} , function(data) {
                $("#content").html(data);
            });
        });


    </script>










    <div class="modal fade" id="myModal" role="dialog">

        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> نام شرکت</h4>
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





function entity_company_product()
{
    $company = $_POST['company'];
    $invent = new invent();

    ?>

    <script>
        function refreshCompanyEntity()
        {
            var company = <?php echo $company; ?>;
            var page = "entity_company_product";

            $.post('page.php' , {company:company , page:page} , function(data) {
                $("#content").html(data);
            });


        }
        $("#save").click(function() {
            var productid = $("#productid").val();
            var min = $("#min").val();
            var page = "entity_company_addproduct";
            var company = <?php echo $company; ?>;

            $.post('page.php' , {productid:productid , page:page ,company:company , min : min} , function(data) {
                if(data == 1)
                {
                    refreshCompanyEntity();
                }
                else
                {
                    alert("خطا");
                }
            });
        });

        $("#refreshEntity").click(function() {
            refreshCompanyEntity();
        });
    </script>
    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">

            <h3>کد کالا </h3>
            <input type="text" class="form-control input-lg"  id="productid">
        </div>

        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">

            <h3>حداقل موجودی  </h3>
            <input type="text" class="form-control input-lg"  id="min">
        </div>

    </div>

    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <h3>ثبت </h3>
        <div class="col-lg-6 col-md-6 col-xs-6 com-sm-6">

            <input type="submit" class="btn btn-lg form-control input-lg btn-success" id="save" value="ثبت">



        </div>
        <div class="col-lg-3 col-md-3 col-xs-6 com-sm-3">
            <input type="submit" class="btn btn-lg form-control input-lg btn-warning" id="refreshEntity" value="برزورسانی">

        </div> <div class="col-lg-3 col-md-3 col-xs-6 com-sm-3">
            <a href="readData.php?company=<?php echo $company; ?>"><input type="submit" class="btn btn-lg form-control input-lg btn-primary"  value="ثبت گروهی"></a>

        </div>
    </div>

    <div id="entity" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <?php
        $invent->GetCompanyProductLIst($company);
        ?>
    </div>
    <?php
}



function entity_company_addproduct()
{
    $productid = $_POST['productid'];
    $company = $_POST['company'];
    $min = $_POST['min'];

    $invent = new invent();
    $invent->AddRelation($productid,$company,$min);
}



function entity_product()
{

    ?>

    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <h3>کد کالا </h3>
        <input type="text" class="form-control input-lg"  id="product">
    </div>

    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <h3>مشاهده </h3>
        <input type="submit" class="btn btn-lg form-control input-lg btn-success" id="view" value="مشاهده">
    </div>




    <script>


        $("#view").click(function() {
            var product = $("#product").val();
            var page = "entity_product_relation";

            $.post('page.php' , {product:product , page:page} , function(data) {
                $("#content").html(data);
            });
        });


    </script>
    <?php
}



function entity_product_relation()
{
    $product = $_POST['product'];

    $invent= new invent();
    $invent->GetProductRelation($product);

}


function inventory()
{

    ?>
    </form>
    <form method="Get" action="getCompanyEntity.php">
        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
            <h3>نام شرکت</h3>
            <input type="text" name="company" class="form-control input-lg" data-toggle="modal" data-target="#myModal"  id="companyCreator">
        </div>

        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
            <h3>مشاهده </h3>
            <input type="submit" class="btn btn-lg form-control input-lg btn-success" id="view" value="مشاهده">
        </div>
    </form>




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



    </script>










    <div class="modal fade" id="myModal" role="dialog">

        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> نام شرکت</h4>
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


?>