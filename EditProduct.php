<?php
$code = $_GET['code'];

require 'autoload.php';

$product = new product();

if(isset($_POST['name']))
{
    $name = $_POST['name'];
    $company = $_POST['company'];

    $product->UpdataData($code ,$name,$company);

}
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

<div class="container">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!--css-->

    <!--js-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--js-->
    <script src="js/responsiveslides.min.js"></script>
    <script src="js/switalert.js"></script>

<?php


$product->GetProductData($code);


?>
    <form method="post" action="">
    <br>
    <br>
    <div class="col-lg-6 col-md-6 col-xs-9 ccl-sm-6">
        <input type="text" value="<?php echo $product->name; ?>" name="name" class="input-lg form-control">
    </div>


    <div class="col-lg-6 col-md-6 col-xs-9 ccl-sm-6">
        <input type="text" value="<?php echo $product->company; ?>"  data-toggle="modal" data-target="#myModal"   id="companyCreator" name="company" class="input-lg form-control">
    </div>
<br>
<br>
<br>
<br>
    <button class="input-lg form-control btn btn-success">ثبت</button>

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
