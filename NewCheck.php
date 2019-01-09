<?php
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
    <script src="js/switalert.js"></script>


</head>
<body>
<h1 class="text-center">ثبت چک جدید</h1>
<div class="col-lg-6 col-md-6 col-xs-6 col-sm-offset-6 col-lg-offset-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3 ">

<form method="get" action="NewCheckProcess.php">
    <table class="table table-responsive table-bordered  text-center">
        <tbody><tr>
            <td style="width: 20%"><b>نام شرکت</b></td>
            <td>            <input name="company" type="text" class="form-control input-lg" data-toggle="modal" data-target="#myModal" id="companyCreator">
            </td>
        </tr>

        <tr>
            <td><b>مبلغ</b></td>
            <td><input class="form-control input-lg" value="" name="price" type="text"></td>
        </tr>

        <tr>
            <td><b>شماره چک</b></td>
            <td><input class="form-control input-lg" value="" name="check_id" type="text"></td>
        </tr>

        <tr>
            <td><b>شماره فاکتور</b></td>
            <td><input class="form-control input-lg" value="" name="factor_id" type="text"></td>
        </tr>



        <tr>
            <td><b>روز</b></td>
            <td>
                <select name="day" class="form-control input-lg">
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
                </select></td>
        </tr>

        <tr>
            <td><b>ماه</b></td>
            <td>
                <select name="month" class="form-control input-lg">
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
                </select></b></td>
        </tr>

        <tr>
            <td><b></b></td>
            <td>
                <select name="year" class="form-control input-lg">
                    <option selected>1397</option>
                    <option>1398</option>
                    <option></option>
                </select></td>
        </tr>
        <tr>
            <td><b>توضیحات </b></td>
            <td><textarea class="form-control input-lg" rows="7" name="message"></textarea></td>
        </tr>

        <tr>
            <td><b></b></td>
            <td><b><input type="submit" value="ثبت" class="btn btn-success form-control btn-lg input-lg"></b></td>
        </tr>
        <tr>
            <td><b></b></td>
            <td><a href="CheckTable.php"><input type="button" value="بازگشت" class="btn btn-danger form-control btn-lg input-lg"></a></td>
        </tr>

        </tbody></table>
</form>
</div>
</body>

</html>





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





</script>





