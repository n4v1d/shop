<?php


function report()
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





        $("#ShowFactorList").click(function () {
            var comp = $("#companyCreator").val();
            if(comp.length > 0 ) {
                var page = 'ShowFactorList';
                $.post("page.php", {page: page, code: comp}, function (data) {
                    $("#result").html(data);
                });
            }
            else
            {
                alert('لطفا مقداری از نام شرکت را وارد نمایید ');
            }
        });


        $("#factorid").keyup(function() {
            var factorid = $("#factorid").val();
            if(factorid.length > 0 ) {
                var page = 'ShowFactorListByFactorid';
                $.post("page.php", {page: page, factorid: factorid}, function (data) {
                    $("#result").html(data);
                });
            }
        });




        $("#ShowFactorListByfactorid").click(function () {

            var request;
            var factorid = $("#factorid").val();
            if(factorid.length > 0 ) {
                var page = 'ShowFactorListByFactorid';

                if(request && request.readyState != 4){
                    xhr.abort();
                }

                request = $.ajax({
                    url: "page.php",
                    type: "POST",
                    data: {page: page, factorid: factorid},
                    dataType: "html"
                });

                request.done(function(data) {
                    $("#result").html( data );
                });

                request.fail(function(jqXHR, textStatus) {
                    alert( "Request failed: " + textStatus );
                });


            }
            else
            {
                alert('لطفا مقداری از شماره فاکتور را وارد نمایید ');
            }
        });



    </script>





    <div class="modal fade" id="myModal1" role="dialog">

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


    <div class="row">
        <h1 class="text-center">  گزارش گیری فاکتور های یک شرکت  <small>(بر اساس نام شرکت) </small> </h1>
        <hr>
        <div class="form-group col-lg-8 col-lg-offset-2">
            <label for="#companyCreator">کد شرکت</label>
            <input type="text" name="companyCreator" data-toggle="modal" data-target="#myModal1"  id="companyCreator" class="input-lg form-control" placeholder="کد شرکت">
        </div>
        <div class="form-group col-lg-8 col-lg-offset-2">
            <button class="btn btn-info form-control" id="ShowFactorList">جستوجو</button>
        </div>
    </div>

    <div class="row">

        <h1 class="text-center">  گزارش گیری فاکتور های یک شرکت  <small>(بر اساس شماره فاکتور ) </small> </h1>
        <hr>
        <div class="form-group col-lg-8 col-lg-offset-2">
            <label for="#companyCreator">شماره فاکتور </label>
            <input type="text" name="factorid" id="factorid" class="input-lg form-control" placeholder="شماره فاکتور ">
        </div>
        <div class="form-group col-lg-8 col-lg-offset-2">
            <button class="btn btn-info form-control" id="ShowFactorListByfactorid">جستوجو</button>
        </div>

    </div>

    <div class="container-fluid" id="result">

    </div>







    <?php
}


?>