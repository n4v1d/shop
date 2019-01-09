<h1 class="text-center">لیست فاکتور های انتخابی</h1>

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

<?php

$check_list = array();

        foreach($_GET['check_list'] as $selected)
        {
            $check_list[] = $selected;
        }

        require 'autoload.php';


    $check = new chek();

    $check->GetSelectedCheckArray($check_list);



?>

<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
<h1 class="text-center">مبلغ کل:</h1>
</div>

<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
    <h1 class="text-center" id="total" ><?php echo number_format($check->check_list_fullprice); ?> </h1>
</div>

<h3 class="text-center">ثبت چند گانه چک</h3>

<br>
<div class="row">

    <div class="col-lg-6 ">
        <div class="form-group col-lg-4">
            <label>روز</label>
            <select id="day" class="form-control input-lg">
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
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
            <label>ماه</label>
            <select id="month" class="form-control input-lg">
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
            </select>


        </div>


        <div class="form-group col-lg-4">
            <label>سال</label>
            <select id="year" class="form-control input-lg">
                <option  selected>1397</option>
                <option >1398</option>
                <option>1399</option>
            </select>

        </div>
    </div>






    <div class="col-lg-3 ">
        <label>مبلغ</label>
        <input type="text" class="form-control input-lg" id="price">
    </div>


    <div class="col-lg-3 ">
        <label>ثبت</label>
        <input type="submit" id="save" class="form-control input-lg btn btn-success btn-lg" value="ثبت"></div>
    </div>
</div>

<br>

<div class="row col-md-6 col-lg-6 col-xs-6 col-sm-6 col-lg-offset-3 col-sm-offset-3 col-xs-offset-3 col-md-offset-3">
    <table  id="tbl" class="table table-responsive table-striped table-hover table-bordered text-center" onclick="return confirm('آیا از ثبت چک ها مطمعن هستید');">

        <thead>
        <td>تاریخ</td>
        <td>مبلغ چک</td>
        </thead>

    </table>
</div>



<div class="row">
    <br>
    <br>
    <br>
    <br>
    <button class="form-control input-lg btn btn-lg btn-info" id="add">نهایی سازی</button>

</div>


<script>
    var Check_Date = [];
    var Check_Price = [];

    var Total_price = <?php echo $check->check_list_fullprice; ?>;


    $("#save").click(function () {

        var day = $("#day").val();
        var month = $("#month").val();
        var year = $("#year").val();

        var price = $("#price").val();
        var date = year + '/' + month + '/' +day;

        Total_price = Total_price - price;

        $("#total").html(numberWithCommas(Total_price));

        // Push Data
        Check_Date.push(date);
        Check_Price.push(price);

        $('#tbl').append("<tr><td>"+  date + "</td><td>"+ numberWithCommas(price) +"</td></tr>");


    });


    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $("#add").click(function () {

        var r = confirm("ایا از ثبت چکها مطمعن هستید؟!");
        if (r == true) {

            window.location.href = 'Check_list_process.php?date='+Check_Date + '&price='+Check_Price+"&Check_List_array="+<?php echo json_encode($check_list);?>;


        }


    });
</script>