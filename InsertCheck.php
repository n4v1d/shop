

<?php
/* Check Status:


0 -> tahvil Nashode
1 -> Tahvil Shode
2 -> pass Shode -> green
3 -> Pass Nashode ->


*/
require 'lib/jdf.php';
require 'autoload.php';

?>
<!DOCTYPE html>
<html>
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

</head>
<body>






<!--                     فرم تغییرات   -->>

<form method="post" action="InsertCheckData.php">

<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
    <label>نام شرکت</label>
    <input type="text" class="form-control input-lg" data-toggle="modal" data-target="#myModal"  id="companyCreator" name="company">
</div>


<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
    <label> وضعیت</label>
    <select class="form-control input-lg form-group" name="status">
        <option  value="0">تحویل نشده</option>
        <option  value="1">تحویل شده</option>
        <option   value="2" style="background-color:#00dd28 ; color: #000000" >پاس شده </option>
        <option   value="3" style="background-color:#dd1600 ; color: #ffffff" >برگشت خورده</option>

        </optgroup>

    </select>
</div>




    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6  text-center " style="margin-top: 15px">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                <label> روز  </label>

                <select name="day" class="input-lg form-control">
                    <?php

                    for($i = 1 ; $i<32; $i++) {
                        {
                            ?>
                            <option><?php echo $i ?></option>

                            <?php

                        }
                    }
                    ?>
                </select>


            </div>


            <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                <label> ماه  </label>

                <select name="month" class="input-lg form-control">
                    <?php

                    for($i = 1 ; $i<13; $i++) {
                        {
                            ?>
                            <option><?php echo $i ?></option>

                            <?php
                        }

                    }
                    ?>


                </select>


            </div>



            <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                <label> سال  </label>

                <select name="year" class="input-lg form-control">
                    <?php

                    for($i = 1397 ; $i<1401; $i++) {
                        {
                            ?>
                            <option><?php echo $i ?></option>

                            <?php
                        }
                    }
                    ?>


                </select>


            </div>

        </div>


    </div>
</div>



</div>

<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
    <label>مبلغ </label>
    <input type="text"   class="form-control input-lg" name="price">
</div>

<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
<label>توضیجات </label>
<input type="text"   class="form-control input-lg" name="title">
</div>



</body>
</html>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
    <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6 col-xs-offset-3 col-sm-offset-3 col-lg-offset-3 col-md-offset-3 ">

        <input type="submit" class="form-control input-lg btn btn-success" style="margin-top: 20px" value="ثبت">

    </div>
</div>
</form>


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