
<?php
// Turn off all error reporting
error_reporting(0);
session_start();
require 'autoload.php';

$uid = $_SESSION['UserId'];
$content = file_get_contents("php://input");
$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


$logreport = new logreport();
$logreport->NewLogReport($uid,$content,$link);



if(!isset($_SESSION['UserId']))
{
echo 'لطفا مجددا وارد شوید';
exit;
}



//require 'lib/jdf.php';

$manager = new manager();
$page = $_POST['page'];


switch ($page)
{
    case "newFactor":
        newfactor();
        break;
        case "PriceReport":
            PriceReport();
        break;
        case "ViewProductReport":
            ViewProductReport();
        break;

    case "newFactorForm":
        newfactorForm();
        break;
    case "createFactor":
        createFactor();
        break;
    case "factorList":
        factorlist();
        break;
        case "CompanyfactorList":
        Companyfactorlist();
        break;

    case "viewFactor":
        viewFactor();
        break;

    case "viewBranchFactor":
        viewBranchFactor();
        break;

    case "SearchProduct":
        SearchProduct();
        break;
    case "add2factor":
        add2factor();
        break;
    case "company":
        company();
        break;
    case "createCompany":
        Createcompany();
        break;
    case "Product":
        product();
        break;
    case "createProduct":
        CreateProduct();
        break;
    case "companySearch":
        companySearch();
        break;

    case "productSearch":
        productSearch();
        break;
    case "getFactorEntery":
    getFactorEntery();
        break;
 case "deleteEntity":
     deleteEntity();
        break;
    case "editEntity":
        editEntity();
        break;
    case "editEntitySave":
        editEntitySave();
        break;
        case "report":
        report();
        break;
        case "ShowFactorList":
            ShowFactorList();
        break;
         case "chart":
            chart();
        break;
     case "getProductGraph":
         getProductGraph();
        break;
    case "recipet":
        recipet();
        break;

  case "searchRecipet":
      searchRecipet();
        break;
        case "newRecipet":
            newRecipet();
        break;
        case "saveNewRecipet":
            saveNewRecipet();
        break;
        case "GetEshantionName":
            GetEshantionName();
        break;
        case "unaccept":
            unaccept();
        break;
        case "problem":
            problem();
        break;
       case "discount":
            discount();
        break;


    case "check":
        check();
        break;
    case "CalcCheck":
        CalcCheck();
        break;

  case "Detailed":
      Detailed();
        break;



  case "accepted":
      accepted();
        break;
  case "awaiting":
      awaiting();
        break;
  case "archive":
      archive();
        break;
  case "ShowFactorListByFactorid":
      ShowFactorListByFactorid();
        break;

  case "ShowFactorListByFactorid":
      ShowFactorListByFactorid();
        break;



  case "BuyReport":
      BuyReport();
        break;

  case "ShowBuyReport":
      ShowBuyReport();
        break;

  case "ByStatus":
      ByStatus();
        break;

 case "ShowByStatus":
     ShowByStatus();
        break;

 case "Message":
     Message();
        break;

 case "SaveFactorFinal":
     SaveFactorFinal();
        break;
        case "Manager":
            Manager();
        break;
        case "UserArchiveGet":
            UserArchiveGet();
        break;
     case "RankUpdate":
            RankUpdate();
        break;
     case "AdminPanel":
            AdminPanel();
        break;
     case "scoreCalc":
            scoreCalc();
        break;
        case "SeeReport":
            ShowReport();
        break;

  case "Discount":
      Discount();
        break;


  case "EditFactor":
      EditFactor();
        break;

  case "EdintEntitySave":
      EdintEntitySave();
        break;


  case "BuyCount":
      BuyCount();
        break;


  case "CalculateBuy":
      CalculateBuy();
        break;

  case "DetailedReport":
      DetailedReport();
        break;

  case "GetLastBuyData":
      GetLastBuyData();
        break;

  case "entity_company":
      entity_company();
        break;


  case "entity_company_product":
      entity_company_product();
        break;


  case "entity_company_addproduct":
      entity_company_addproduct();
        break;

  case "entity_product":
      entity_product();
        break;

  case "entity_product_relation":
      entity_product_relation();
        break;



  case "inventory":
      inventory();
        break;


}



function newFactor()
{
    $level = $_SESSION['UserLevel'];
    if($level == '1' || $level == '2' || $level == '3'  )

       {
    ?>
    <script>
        $("#newFactorBtn").click(function () {
            var page = 'createFactor';
            var factorid = $("#factorid").val();
            var companyCreator = $("#companyCreator").val();
            var branch = $("#branch").val();
            var day = $("#day").val();
            var month = $("#month").val();
            var year= $("#year").val();
            var visitor = $("#visitor").val();
            $.post("page.php", {page: page,factorid:factorid,company:companyCreator,day:day,month:month,year:year,visitor:visitor,branch:branch}, function (data) {
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
    <div class="col-lg-4 ">
        <div class="form-group">
            <label>شماره فاکتور</label>
            <input type="text" class=" input-lg form-control" id="factorid">
        </div>
    </div>


    <div class="col-lg-4 ">
        <div class="form-group">
            <label>شرکت تامین کننده</label>
            <input type="text" class="form-control input-lg" data-toggle="modal" data-target="#myModal"  id="companyCreator">
        </div>
    </div>

    <div class="col-lg-4 ">
        <div class="form-group">
            <label>مربوط به شعبه</label>
            <select id="branch" class="form-control input-lg">
                <option value="1">زیتون</option>
                <option value="2">باهنر</option>
                <option value="4">نفت</option>
                <option value="3">پاداد</option>
                <option value="5">فاطمی</option>
                <option value="7">وهابی</option>
                <option value="8">اعتمادی</option>
                <option value="6">انبار</option>
            </select>

        </div>
    </div>


    <div class="col-lg-6 ">
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



    <div class="col-lg-6 ">
        <div class="form-group">
            <input type="text" placeholder="ویزیتور" class="form-control input-lg" id="visitor">
        </div>
    </div>



    <div class="col-lg-12 ">
        <div class="form-group">
            <button class="btn btn-danger   form-control" id="newFactorBtn">ایجاد</button>
        </div>
    </div>










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
else
    {
        echo 'شما توانایی ایجاد فاکتور را ندارید';
    }
 ?>



    <?php
}













function createFactor()
{
require_once 'lib/jdf.php';
    $factorid = $_POST['factorid'];
    $company = $_POST['company'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $branch = $_POST['branch'];

    $time = jmktime('12','00','00',$month,$day,$year);
    $visitor = $_POST['visitor'];
    $factor = new factor();

    if($factor->CheckFactor($factorid,$company) == "1")
    {
        if ($factor->CreateFactor($factorid, $company, $time, $visitor, $branch) == "1") {
            echo 'فاکتور مورد نظر با موفقیت ساخته شد ، لطفا آن را در لیست آن را میتوانید در لیست فاکتور ها مشاهده نمایید';
        }
        else
        {
            echo 'خطا در ثبت فیش';
        }
    }
    else
    {
        ?>
        <script>
            alert('فاکتور تکراری می باشد');
        </script><?php
    }
}





function factorlist()
{
    ?>
    <script>
        $(".view").click(function () {
            var id = this.id;
            $.post("page.php", {page: 'viewFactor',id:id}, function (data) {
                $("#content").html(data);



            });
        });


        $(".branch").click(function () {
            var branch = this.id;
            $.post("page.php", {page: 'factorList',branch:branch}, function (data) {
                $("#content").html(data);
                $('html,body').animate({
                        scrollTop: $("#content").offset().top},
                    'slow')
            });
        });
    </script>
    <div class="container-fluid" >
        <div class="col-lg-1 form-group">
            <button class="btn btn-danger form-control branch  " id="1">زیتون</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-warning form-control branch" id="2">باهنر</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-success form-control branch" id="3">پاداد</button>
        </div>


        <div class="col-lg-1 form-group">
            <button class="btn btn-primary form-control branch" id="4">نفت</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-info form-control branch" id="5">فاطمی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-success form-control branch" id="7">وهابی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-primary form-control branch" id="8">اعتمادی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-warning  form-control branch" id="6"> انبار</button>
        </div>





    </div>
    <?php
    $factor = new factor();
    if(isset($_POST['pageid'])) {
        $pageid = $_POST['pageid'];

    }
    else {
        $pageid = '0';
    }


    if(isset($_POST['branch']))
    {


        $factor->factorlist($_POST['branch'],$pageid);
    }
    else
    {
        $factor->factorlist(null,$pageid);
    }
}




function unaccept()
{
    ?>
    <script>
        $(".view").click(function () {
            var id = this.id;
            $.post("page.php", {page: 'viewFactor',id:id}, function (data) {
                $("#content").html(data);



            });
        });


        $(".branch").click(function () {
            var branch = this.id;
            $.post("page.php", {page: 'factorList',branch:branch}, function (data) {
                $("#content").html(data);
                $('html,body').animate({
                        scrollTop: $("#content").offset().top},
                    'slow')
            });
        });
    </script>
    <div class="container-fluid" >
        <div class="col-lg-1 form-group">
            <button class="btn btn-danger form-control branch  " id="1">زیتون</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-warning form-control branch" id="2">باهنر</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-success form-control branch" id="3">پاداد</button>
        </div>


        <div class="col-lg-1 form-group">
            <button class="btn btn-primary form-control branch" id="4">نفت</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-info form-control branch" id="5">فاطمی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-success form-control branch" id="7">وهابی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-primary form-control branch" id="8">اعتمادی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-warning  form-control branch" id="6"> انبار</button>
        </div>





    </div>
    <?php
    $factor = new factor();
    if(isset($_POST['pageid'])) {
        $pageid = $_POST['pageid'];

    }
    else {
        $pageid = '0';
    }


    if(isset($_POST['branch']))
    {


        $factor->UnAcceptfactorlist($_POST['branch'],$pageid,'','0');
    }
    else
    {
        $factor->UnAcceptfactorlist(null,$pageid,'','0');
    }
}












function accepted()
{
    ?>
    <script>
        $(".view").click(function () {
            var id = this.id;
            $.post("page.php", {page: 'viewFactor',id:id}, function (data) {
                $("#content").html(data);



            });
        });


        $(".branch").click(function () {
            var branch = this.id;
            $.post("page.php", {page: 'factorList',branch:branch}, function (data) {
                $("#content").html(data);
                $('html,body').animate({
                        scrollTop: $("#content").offset().top},
                    'slow')
            });
        });
    </script>
    <div class="container-fluid" >
        <div class="col-lg-1 form-group">
            <button class="btn btn-danger form-control branch  " id="1">زیتون</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-warning form-control branch" id="2">باهنر</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-success form-control branch" id="3">پاداد</button>
        </div>


        <div class="col-lg-1 form-group">
            <button class="btn btn-primary form-control branch" id="4">نفت</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-info form-control branch" id="5">فاطمی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-success form-control branch" id="7">وهابی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-primary form-control branch" id="8">اعتمادی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-warning  form-control branch" id="6"> انبار</button>
        </div>




    </div>
    <?php
    $factor = new factor();
    if(isset($_POST['pageid'])) {
        $pageid = $_POST['pageid'];

    }
    else {
        $pageid = '0';
    }


    if(isset($_POST['branch']))
    {


        $factor->UnAcceptfactorlist($_POST['branch'],$pageid,'','1');
    }
    else
    {
        $factor->UnAcceptfactorlist(null,$pageid,'','1');
    }
}


function awaiting()
{
    ?>
    <script>
        $(".view").click(function () {
            var id = this.id;
            $.post("page.php", {page: 'viewFactor',id:id}, function (data) {
                $("#content").html(data);



            });
        });


        $(".branch").click(function () {
            var branch = this.id;
            $.post("page.php", {page: 'factorList',branch:branch}, function (data) {
                $("#content").html(data);
                $('html,body').animate({
                        scrollTop: $("#content").offset().top},
                    'slow')
            });
        });
    </script>
    <div class="container-fluid" >
        <div class="col-lg-1 form-group">
            <button class="btn btn-danger form-control branch  " id="1">زیتون</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-warning form-control branch" id="2">باهنر</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-success form-control branch" id="3">پاداد</button>
        </div>


        <div class="col-lg-1 form-group">
            <button class="btn btn-primary form-control branch" id="4">نفت</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-info form-control branch" id="5">فاطمی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-success form-control branch" id="7">وهابی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-primary form-control branch" id="8">اعتمادی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-warning  form-control branch" id="6"> انبار</button>
        </div>
        </div>





    </div>
    <?php
    $factor = new factor();
    if(isset($_POST['pageid'])) {
        $pageid = $_POST['pageid'];

    }
    else {
        $pageid = '0';
    }


    if(isset($_POST['branch']))
    {


        $factor->UnAcceptfactorlist($_POST['branch'],$pageid,'','2');
    }
    else
    {
        $factor->UnAcceptfactorlist(null,$pageid,'','2');
    }
}
































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












function deleteEntity()
{

    $id = $_POST['id'];


    $entity = new entity();
    if($entity->entitydelete($id) == '1')
    {
        echo '<script>alert("با موفقیت از فاکتور حذف شد")</script>';
        header('location:index.php');
    }
    else
    {
        echo 'خطا';
    }
}




function editEntity()
{

    $id = $_POST['id'];
    $factorid = $_POST['factorid'];


    $entity = new factor();

    $entity->editProductData($id,$factorid);
}


















function viewFactor()
{
    session_start();
    require 'lib/jdf.php';
$id =  $_POST['id'];
$factor = new factor();
$factor->getFactorDetail($id);
$company = new company();
    $company->getCompanyDetail($factor->company);
    $member = new user();
    $member4 = new user();
    $member2 = new user();
    $member3 = new user();
    $member4 = new user();

    ?>
<script>

 $("#id").keypress(function (e) {
  if (e.which == 13) {
  var id = $("#id").val();
        var factorid = <?php echo $id; ?>;
        $.post("page.php", {page: 'SearchProduct',id:id,factorid:factorid}, function (data) {
            $("#result").html(data);
            $("#result").slideDown();
        });  }
});




     $("#message").keypress(function () {

            var message = $("#message").val();
            var factorid = <?php echo $id; ?>;

        $.post("updateMessage.php", {factorid: factorid,message:message}, function (data) {

        });  });





</script>
    <textarea id="message" class="form-control text-center  alert-danger" style="font-size:40px"><?php
       echo $factor->message;
        ?></textarea>

      <table class="table table-responsive table-hover table-striped table-bordered" > <tr><td>شماره فاکتور</td><td>نام شرکت</td><td>ویزیتور</td> <td>تاریخ فاکتور</td> <td>سازنده </td>  <td>انبار </td> <td> وضعیت</td> <td> تاریخ چک</td>



<?php
if($_SESSION['UserId'] == '1' || $_SESSION['UserId'] == '9')
{
?>
<td>نمره بندی</td>
    <?php
}
?>
                  <td> ویرایش</td>


 <td>ثبت</td></tr>
    <td width="10%"><h4><?php echo $factor->factorid; ?> </h4></td>
    <td>          <h4 class="Company" id="<?php echo $factor->company;?>">     <?php  echo $company->name; ?></h4> </td>
          <td><?php echo $factor->visitor; ?> </td>

          <td><h4><?php echo jdate("d:F:Y",$factor->time,'','','en'); ?></h4> </td>
          <td><b>سازنده:</b><?php  $member->getUserData($factor->creator); echo $member->name; ?><br>

              <b>تایید اولیه:</b><?php  $member4->getUserData($factor->fwaiter); echo $member4->name; ?><br>

          <b>تایید کننده:</b><?php  $member2->getUserData($factor->waiter); echo $member2->name; ?><br>

          <b>ثبت کننده:</b><?php   $member3->getUserData($factor->saver); echo $member3->name; ?>
          <br>
    <b> ضایعات:</b><?php  $member4->getUserData($factor->trash); echo $member4->name; ?><br>

          </td>
          <td width="10%"
          ><?php
              switch ($factor->branch)
              {
                  case "1":
                      echo '<b style="font-size: 18px;"> زیتون </b>';
                      break;

                  case "2":
                      echo '<b  style="font-size: 18px;"  > باهنر </b>';
                      break;

                  case "4":
                      echo '<b  style="font-size: 18px;"> نفت </b>';
                      break;

                  case "3":
                      echo '<b  style="font-size: 18px;">  پاداد </b>';
                      break;

                  case "5":
                      echo '<b  style="font-size: 18px;">  فاطمی </b>';
                      break;

                  case "6":
                      echo '<b  style="font-size: 18px;">انبار </b>';
                      break;


                  case "7":
                      echo '<b  style="font-size: 18px;">وهابی </b>';
                      break;

                  case "8":
                      echo '<b  style="font-size: 18px;">اعتمادی </b>';
                      break;



              }
              ?>
          </td>
          <td><?php  if($factor->status == '0')
            {
                echo '<b style="color:red">منتظر تایید </b>';
            }

                        if($factor->status == '1')

                        {
                            echo '<b style="color:blue">تایید شده </b>';

                        }

            if($factor->status == '2')
            {
                echo '<b style="color:orange"> منتظر ثبت</b>';

            }

              if($factor->status == '3')
              {
                  echo '<b style="color:green">  ثبت شده</b>';

              }



              if($factor->status == '4')
              {
                  echo '<b style="color:#fd25cd">  تایید اولیه </b>';

              }


            ?> </td>


  <td>
  <?php
  if($factor->check_len > 0)
      {
          ?>
          <b> تاریخ چک:</b> <?php echo jdate('Y/m/d' , $factor->check_date , '' , '', 'en'); ?><br>
          <b> مدت چک:</b> <?php echo $factor->check_len; ?><br>

          <?php
      }
 ?>

</td>



<?php
if($_SESSION['UserId'] == '1' || $_SESSION['UserId'] == '9') {
    ?>
    <td>
        <script>
            $("#sent").click(function () {
                var id = <?php echo $id; ?>;
                var rank = $("#rank").val();
                $.post('page.php', {page: 'RankUpdate', id: id, rank: rank}, function (data) {
                    alert(data);
                });
            });
        </script>
        <?php
        $factor->getFactorDetail($id);
        ?>
        <select id="rank" <?php if (strlen($factor->rank > '0')) {
            echo 'disabled';
        } ?> class="form-control input-lg">
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

        </select><br>
        <button class="form-control <?php if (strlen($factor->rank > '0')) {
            echo 'disabled';
        } ?>   btn btn-success" id="sent">ثبت نمره
        </button>
    </td>


    <?php

}

?>
        <td>

            <script>

                $(".FactorEdit").click(function () {
                   var id = this.id;

                   $.post('page.php' , {page:'EditFactor' , id : id} , function (data) {
                       $("#content").html(data);
                   });
                });
            </script>
            <button  id="<?php echo $id; ?>"  class="btn btn-info form-control input-lg btn-lg FactorEdit">ویرایش</button>

        </td>


          >
    <td width="15%">
        <?php
        $per = new user();
        $per->GetUserData($_SESSION['UserId']);

        if($per->newbie == 1)
        {
            if( $_SESSION['UserLevel'] == '1') {

                if ($factor->status == '0') {

                    ?>
                    <a href="facceptfactor.php?factorid=<?php echo $_POST['id']; ?>"
                    <button class=" btn btn-info">ارسال برای بررسی </a> </button></a>

                    <?php
                }
            }
        }
        else
        {
            if( $_SESSION['UserLevel'] == '1') {

                if ($factor->status == '0') {

                    ?>
                    <a href="acceptfactor.php?factorid=<?php echo $_POST['id']; ?>"
                    <button class=" btn btn-info">تایید</a> </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="problem.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-danger" id="<?php echo $factor->id; ?>" >مشکل دار  </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                    <?php
                }
            }

        }




        if( $_SESSION['UserLevel'] == '2') {

            if ($factor->status == '0') {

                ?>


                <a href="acceptfactor.php?factorid=<?php echo $_POST['id']; ?>">
                    <button class=" btn btn-info">تایید
                </button></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="problem.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-danger" id="<?php echo $factor->id; ?>" >مشکل دار  </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <?php

            }
            if ($factor->status == '1' ) {

                ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="setfactor.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-success" id="<?php echo $factor->id; ?>" >ارسال برای ثبت </button></a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="problem.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-danger" id="<?php echo $factor->id; ?>" >مشکل دار  </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="disapproval.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-danger" id="<?php echo $factor->id; ?>" >عدم تایید </button></a>

                <?php
            }


            if ($factor->status == '4' ) {

                ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="fsetfactor.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-success" id="<?php echo $factor->id; ?>" >تایید ثاتویه </button></a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="problem.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-danger" id="<?php echo $factor->id; ?>" >مشکل دار  </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="disapproval.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-danger" id="<?php echo $factor->id; ?>" >عدم تایید </button></a>



                <?php
            }


            if ($factor->status == '2') {

                ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="unsetfactor.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-primary" id="<?php echo $factor->id; ?>" >لغو تایید </button></a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="problem.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-danger" id="<?php echo $factor->id; ?>" >مشکل دار  </button></a>&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="zayeat.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-success" id="<?php echo $factor->id; ?>" > ثبت ضایعات  </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <?php
            }

        }


          if ($factor->status == '5') {

                ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="solveProblem.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-success" id="<?php echo $factor->id; ?>" >تایید رفع مشکل  </button></a>

                <?php
            }



        if( $_SESSION['UserLevel'] == '3') {
            if ($factor->status == '2') {

                ?>
<style type="text/css">
    .not-active {
        pointer-events: none;
        cursor: default;
    }
</style>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a  href="savefactor.php?factorid=<?php echo $_POST['id']; ?>"   > <button  class="btn btn-success " id="SaveFactorButton" > ثبت </button></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="problem.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-danger" id="<?php echo $factor->id; ?>" >مشکل دار  </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <?php
            } if ($factor->status == '0') {

                ?>
                <a href="acceptfactor.php?factorid=<?php echo $_POST['id']; ?>"
                    <button class=" btn btn-info">تایید</a> </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="problem.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-danger" id="<?php echo $factor->id; ?>" >مشکل دار  </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
            }
        }



        ?>

        <a href="deletefactor.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-warning" id="<?php echo $factor->id; ?>" >حذف</button></a></td>





    </tr>
      </table>

<script>

    $("#searchbtn").click(function () {
        var id = $("#id").val();
        var factorid = <?php echo $id; ?>;
        $.post("page.php", {page: 'SearchProduct',id:id,factorid:factorid}, function (data) {
            $("#result").html(data);
            $("#result").slideDown();
        });
    });






    $("#zayeat").click(function () {
     var id = $("#id").val();
     var factorid = <?php echo $id; ?>;
        $.post("page.php", {page: 'GetLastBuyData',id:id,factorid:factorid}, function (data) {
            $("#result").html(data);
            $("#result").slideDown();
        });
    });







</script>
    <img  width="80px" onclick="refresh()" height="60px" style="float: right;  bottom: 0px;
  position: fixed; z-index: 1000" src="img/refresh.png">
  <?php
    if($_SESSION['UserId'] == '9' || $_SESSION['UserId'] == '1' )
    {
        ?>
         <img  width="80px"  height="60px" style="float: right; right: 140px;  bottom: 0px;
  position: fixed; z-index: 1000" src="img/save.png"
   onclick="window.open('/shop/saveTakhfifFactor.php?id=<?php echo $id; ?>');"
   >
        <?php
    }
 ?>

    <div id="SearchForm">

    <div class="col-lg-4 form-group">
    <?php
    if($factor->creator == $_SESSION['UserId'] ||   $_SESSION['UserId'] == "9")
        {
            ?>        <input type="text"  class="form-control" id="id"><?php
        }

 ?>

    </div>

    <div class="col-lg-1  form-group">
        <button id="searchbtn" class="btn  btn-info form-control" >جستوجو</button>
    </div>
    <div class="col-lg-1  form-group">
        <button id="zayeat" class="btn  btn-danger form-control" >ضایعات</button>
    </div>

    <div class="col-lg-2  form-group">
        <button id="FindName"  data-toggle="modal" data-target="#myModal"  class="btn  btn-success form-control" >جستوجوی کد محصول</button>
    </div>
</div>
    <div class="col-lg-2   form-group">
        <button id="Refresh"   class="btn  btn-danger  form-control">بروز رسانی فاکتور</button>
    </div>  <div class="col-lg-2   form-group">
        <button id="franch"   class="btn  btn-primary  form-control">فرانچایز</button>
    </div>
<script>
    function openWindow() {
        window.open('/shop/GroupAction.php?Factorid=<?php echo $id; ?>', 'انجام عملیات گروهی', 'width=900, height=900%, resizable=1, left=0, top=0, location=1, menubar=1, scrollbars=1');
    }
</script>

 <?php
    if($factor->creator == $_SESSION['UserId'] ||   $_SESSION['UserId'] == "9")
        {
            ?><div class="col-lg-2   form-group">


        <button onclick="openWindow()"  class="btn  btn-warning  form-control" >عملیات گروهی</button>
    </div>

<?php
        }

 ?>

<script>

$(".Company").click(function() {
  var id = this.id;
  page = 'page.php';
   $.post("page.php", {page: 'ShowFactorList', code: id}, function (data) {
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
                    <h4 class="modal-title">جستوجوی محصول</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>نام محصول</label>
                        <input type="text" class="form-control" id="pname">

                    </div>

                    <div class="form-group">
                        <button class="btn btn-success" id="searchPname">جستوجو</button>
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


    $("#searchPname").click(function () {
        var comp = $("#pname").val();
        if(comp.length > 0 ) {
            var page = 'productSearch';
            var id = $("#pname").val;

            $.post("page.php", {page: page, code: id}, function (data) {
                $("#searchresult").html(data);
            });



        }
        else
        {
            alert('لطفا مقداری از نام شرکت را وارد نمایید ');
        }
    });




 $("#id").keyup(function (e) {
  if (e.which == 13) {
         var id = $("#id").val();
        var factorid = <?php echo $id; ?>;
        $.post("page.php", {page: 'SearchProduct',id:id,factorid:factorid}, function (data) {
            $("#result").html(data);
            $("#result").slideDown();
        });  }
});
</script>













    <div id="result">

</div>


</div>
    <br>

      <script>

        $("#Refresh").click(function () {
            refresh()

        });

          function refresh() {
              var id = <?php echo $id; ?>;
              $.post('page.php',{page:'getFactorEntery', id:id}, function (data) {

                  $("#AjaxResult").html(data);
                  $("body").off();
              });


          }
        refresh()



      </script>
    <div id="AjaxResult">

    </div>






    </table>
</div>
</div>
<?php

$userid = $_SESSION['UserId'];
if($userid == '1' || $userid == '9')
    {
       ?>
         <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
            <label>مدت چک</label>
            <select name="len"  class="form-control input-lg btn-lg" id="len">
            <option>10</option>
            <option>15</option>
            <option>20</option>
            <option>25</option>
            <option>30</option>
            <option>35</option>
            <option>40</option>
            <option>45</option>
            <option>50</option>
            <option>55</option>
            <option>60</option>
            <option>65</option>
            <option>70</option>
            <option>75</option>
            <option>80</option>
            <option>85</option>
            <option>90</option>
            <option>95</option>
            <option>100</option>
            <option>105</option>
            <option>110</option>
            <option>120</option>
            <option>125</option>
            <option>130</option>

</select>
</div>

   <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
            <label> ثبت</label>
            <button id="savelen" class="form-control input-lg btn-lg btn-success" >ثبت تاریخ</button>
</div>

<script>
$("#savelen").click(function() {
  var factorid = <?php echo $id; ?>;
  var len = $("#len").val();
  var page = "update_check.php";

   $.post("update_check.php", {page: page,factorid:factorid,len:len}, function (data) {
               alert(data)
            });

});
</script>

<?php
}
}


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



function editEntitySave()
{
    $factor = new factor();
    $feshantion = $_POST['feshantion'];
    if($feshantion == 'true')
    {
        $feshantionstatus = '1';
    }
    else
    {
        $feshantionstatus = '0';
    }
    $facrorid = $_POST['factorid'];
    $eshantionin = $_POST['eshantionin'];
    $eshantion = $_POST['eshantion'];
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
    $entityid = $_POST['entityid'];
    $takhfifhajmi = $_POST['takhfifhajmi'];
    $tax = $_POST['tax'];
    $epercent = $_POST['epercent'];
    $eshantionCode = $_POST['eshantionCode'];
    $eshantionPrice = $_POST['eshantionPrice'];


    $factor->editEntitySave($gheymatjadid,$gheymatforoshjadid,$gheymatmasrafjadid,$count,$takhfifhajmi,$takhfifnaghdi,$tax,$eshantion,$boxin,$eshantionin,$feshantionstatus,$entityid,$facrorid,$epercent,$eshantionCode,$eshantionPrice,$oldprice,$gheymatmasrafghadim,$gheymatforooshghadi);
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



function companySearch()
{
    $name = $_POST['name'];

    $company = new company();
    $company->searchName($name);
}






function productSearch()
{
    $name = $_POST['name'];

    $company = new product();
    $company->searchName($name);
}



function getFactorEntery()
{
    $id = $_POST['id'];
    $entity = new entity();
    $entity->getFactorEntity($id);
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



function ShowFactorList()
{
    $code = $_POST['code'];

    $factor = new company();
    $factor->Companyfactorlist('',$code);

}

function ShowFactorListByFactorid()
{
    $factorid = $_POST['factorid'];

    $factor = new company();
    $factor->CompanyfactorlistByFactorid($factorid);

}


function chart()
{
    ?>

    <script>

        $("#searchPname").click(function () {
            var comp = $("#pname").val();
            if(comp.length > 0 ) {
                var page = 'productSearch';
                var name = $("#pname").val();
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
                    <h4 class="modal-title">جستوجوی محصول</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>نام محصول</label>
                        <input type="text" class="form-control" id="pname">

                    </div>

                    <div class="form-group">
                        <button class="btn btn-success" id="searchPname">جستوجو</button>
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






    <form action="chart.php" method="post">

    <div class="container-fluid">
    <div class="form-group">
        <input type="text" class="input-lg form-control" id="id"  data-toggle="modal" data-target="#myModal"   name="id" placeholder="نام کالا">

    </div>
        <div class="form-group col-lg-6 col-lg-offset-3 ">
            <input type="submit" class="btn  btn-info   form-control" value="مشاهده گزارش" id="send"></input>
        </div>
        <div id="results">

        </div>

    </div>
</form>

<?php

}




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



function GetEshantionName()
{
    $product_id = $_POST['eshantionCode'];
    $product = new product();
    $product->searchEshantionName($product_id);
}

function archive()
{
?>
<form action="UploadFile.php"  method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                <input type="file" name="fileToUpload" id="fileToUpload"   class="form-control input-lg  ">
            </div>

            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                <input type="text" data-toggle="modal" data-target="#myModal"  id="companyCreator"   name="company" class="input-lg form-control" placeholder="نام شرکت">
            </div>
        </div>
<br>


        <div class="row">
          <textarea name="about" class="input-lg form-control">توضیحات فایل</textarea>
        </div>
<br>
<br>
<br>
        <input type="submit"  value="ارسال فایل" class="btn btn-success input-lg btn-block">
    </form></div>



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



    <br>
    <br>
    <br>


    <form action="ُCompanyArchive.php">
        <div class="col-lg-6 col-md-6 col-xs-9 col-sm-6">
            <input type="text" name="company" class="input-lg form-control ">

        </div>




        <div class="col-lg-6 col-md-6 col-xs-9 col-sm-6">
            <input type="submit" value="ویرایش" class="btn btn-primary input-lg form-control">

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
<?php
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
    $product->GiveLastBuyReport($productId);
}




function ByStatus()
{
    ?>
    <script>
        $("#show").click(function () {
            var branch = $("#branch").val();
            var status = $("#status").val();
            var page = 'ShowByStatus';

            $.post("page.php", {page: page,status:status,branch:branch,page:page}, function (data) {
                $("#AjaxResult").html(data);
                $('html,body').animate({
                        scrollTop: $("#content").offset().top},
                    'slow')
            });
        });



        $(".view").click(function () {
            var id = this.id;
            $.post("page.php", {page: 'viewFactor', id: id}, function (data) {
                $("#content").html(data);


            });
        });

    </script>
    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
        <label for="branch">نام فروشگاه</label>
        <select id="branch" name="branch" class="input-lg form-control">
            <option value="6">انبار</option>
            <option value="2">باهنر</option>
            <option value="1">فاضل</option>
            <option value="4">نفت</option>
            <option value="3">پاداد</option>
            <option value="5">فاطمی</option>
            <option value="7">وهابی</option>
            <option value="8">اعتمادی</option>

        </select>
    </div>
    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
        <label for="branch">نام فروشگاه</label>
        <select id="status" name="branch" class="input-lg form-control">
            <option value="1" style="color: blue;">تایید شده</option>
            <option value="0" style="color: red;">تایید نشده</option>
            <option value="2" style="color: orange;">منتظر ثبت </option>


        </select>

    </div>


    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
        <label>مشاهده</label>
        <button id="show" class="btn btn-primary btn-lg form-control input-lg">مشاهده</button>
        </select>

    </div>

    <br>
    <br>
    <div id="AjaxResult">

    </div>
    <?php
}


function ShowByStatus()
{
   ?>

    <br>
    <br>
    <br>


    <?php

    $branch = $_POST['branch'];
    $status = $_POST['status'];


    $factor = new factor();
    $factor->ShowFactorByBranchAndStatus($branch,$status);

}



function Message()
{ ?>
<div class="container">
    <?php
    $message = new message();
    $message->GetMessage();

}






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





function SaveFactorFinal()
{
    $factorid = $_POST['factorid'];
    $sood = $_POST['sood'];
    $price = $_POST['price'];
    $CoType = $_POST['CoType'];


    $factor = new factor();

    if($factor->UpdatePrice($factorid , $price , $sood,$CoType) == '102030')
    {
        return 'دخیره اطلاعات با موفقیت به اتمام رسید';
    }
    else
    {
        return 'خطا در ثبت اطلاعات ';
    }

}




function UserArchiveGet()
{
    $user = new user();

    $user->GetUserDataCount();
}


function RankUpdate()
{
    $id = $_POST['id'];
    $rank = $_POST['rank'];

    $factor = new factor();
    $factor->UpdateFactorRank($id,$rank);
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




function Discount()
{

    $factor = new factor();
    $factor->getFactorDiscount();


}


    /**
     *
     */
    function EditFactor()
{
    require 'lib/jdf.php';
$id = $_POST['id'];



$factor = new factor();

$factor->getFactorDetail($id);


$day  = jdate('d',$factor->time , '','','en');
$month  = jdate('m',$factor->time , '','','en');
$year  = jdate('Y',$factor->time , '','','en');


?>

    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
        <input type="text" id="Factorid"  value="<?php echo $factor->factorid; ?>"  class="form-control input-lg ">

    </div>
<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
            <select name="day" id="day" class="form-control input-lg ">
                <option <?php if($day == '1') { echo 'selected';} ?>>1</option>
                <option <?php if($day == '2') { echo 'selected';} ?>>2</option>
                <option <?php if($day == '3') { echo 'selected';} ?>>3</option>
                <option <?php if($day == '4') { echo 'selected';} ?>>4</option>
                <option <?php if($day == '5') { echo 'selected';} ?>>5</option>
                <option <?php if($day == '6') { echo 'selected';}?>>6</option>
                <option <?php if($day == '7') { echo 'selected';}?>>7</option>
                <option <?php if($day == '8') { echo 'selected';}?>>8</option>
                <option <?php if($day == '9') { echo 'selected';}?>>9</option>
                <option <?php if($day == '10') { echo 'selected';} ?>>10</option>
                <option <?php if($day == '11') { echo 'selected';} ?>>11</option>
                <option <?php if($day == '12') { echo 'selected';} ?>>12</option>
                <option <?php if($day == '13') { echo 'selected';} ?>>13</option>
                <option <?php if($day == '14') { echo 'selected';} ?>>14</option>
                <option <?php if($day == '15') { echo 'selected';} ?>>15</option>
                <option <?php if($day == '16') { echo 'selected';} ?>>16</option>
                <option <?php if($day == '17') { echo 'selected';} ?>>17</option>
                <option <?php if($day == '18') { echo 'selected';} ?>>18</option>
                <option <?php if($day == '19') { echo 'selected';} ?>>19</option>
                <option <?php if($day == '20') { echo 'selected';} ?>>20</option>
                <option <?php if($day == '21') { echo 'selected';} ?>>21</option>
                <option <?php if($day == '22') { echo 'selected';} ?>>22</option>
                <option <?php if($day == '23') { echo 'selected';} ?>>23</option>
                <option <?php if($day == '24') { echo 'selected';} ?>>24</option>
                <option <?php if($day == '25') { echo 'selected';} ?>>25</option>
                <option <?php if($day == '26') { echo 'selected';} ?>>26</option>
                <option <?php if($day == '27') { echo 'selected;';} ?>>27</option>
                <option <?php if($day == '28') { echo 'selected;';} ?>>28</option>
                <option <?php if($day == '29') { echo 'selected;';} ?>>29</option>
                <option <?php if($day == '30') { echo 'selected;';} ?>>30</option>
                <option <?php if($day == '31') { echo 'selected';} ?>>31</option>


            </select>
        </div>










        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
            <select name="month" id="month" class="form-control input-lg ">
                <option <?php if($month == '1') { echo 'selected';} ?>>1</option>
                <option <?php if($month == '2') { echo 'selected';} ?>>2</option>
                <option <?php if($month == '3') { echo 'selected';} ?>>3</option>
                <option <?php if($month == '4') { echo 'selected';} ?>>4</option>
                <option <?php if($month == '5') { echo 'selected';} ?>>5</option>
                <option <?php if($month == '6') { echo 'selected';}?>>6</option>
                <option <?php if($month == '7') { echo 'selected';}?>>7</option>
                <option <?php if($month == '8') { echo 'selected';}?>>8</option>
                <option <?php if($month == '9') { echo 'selected';}?>>9</option>
                <option <?php if($month == '10') { echo 'selected';} ?>>10</option>
                <option <?php if($month == '11') { echo 'selected';} ?>>11</option>
                <option <?php if($month == '12') { echo 'selected';} ?>>12</option>

            </select>
        </div>





        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
            <select name="month" id="year" class="form-control input-lg ">
                <option <?php if($year == '1395') { echo 'selected';} ?>>1395</option>
                <option <?php if($year == '1396') { echo 'selected';} ?>>1396</option>
                <option <?php if($year == '1397') { echo 'selected';} ?>>1397</option>


            </select>
        </div>


    </div>




    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">

        <input type="text" data-toggle="modal" value="<?php echo $factor->company; ?>" data-target="#myModal" id="companyCreator"   class="form-control input-lg ">

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


        $("#UpdateFactorSave").click(function () {

            var factorid = $("#Factorid").val();
            var company = $("#companyCreator").val();
            var day = $("#day").val();
            var month = $("#month").val();
            var year = $("#year").val();
            var id = <?php echo $id; ?>

            $.post('page.php' , {page : 'EdintEntitySave' , factorid : factorid , company : company , day : day ,  month : month , year : year , id : id} , function (data) {

                alert(data);
            });
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


    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <button class="form-control input-lg btn btn-warning" id="UpdateFactorSave"> ویرایش فاکتور</button>
    </div>

    <?php

}





function EdintEntitySave()
{
    $id = $_POST['id'];

    $factorid = $_POST['factorid'];
    $comoany = $_POST['company'];

    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    require 'lib/jdf.php';

$time = jmktime('00','00' , '30' , $month , $day , $year);

    $factor = new factor();

    $factor->UpdateFactorData($id , $factorid , $comoany , $time);
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





function Detailed()
{
    ?>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <h1 class="text-center">نام شرکت</h1>
                <input type="text" class="form-control input-lg" data-toggle="modal" data-target="#myModal"  id="companyCreator">
            </div>


            <div class="col-lg-4 col-md-4">
                <h1 class="text-center">شعبه مورد نظر </h1>

                <select id="branch" class="form-control input-lg">
                    <option value="1">زیتون</option>
                    <option value="2">باهنر</option>
                    <option value="4">نفت</option>
                    <option value="3">پاداد</option>
                    <option value="5">فاطمی</option>
                    <option value="7">وهابی</option>
                    <option value="8">اعتمادی</option>
                    <option value="6">انبار</option>
                    <option value="7">همه</option>
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








function check()
{
?>

    <div class="col-lg-12 col-x-12 col-md-12 col-xs-12">

      <div class="col-lg-6 col-md-6 col-xs-6  col-sm-6">
          <div class="form-group col-lg-3 col-md-3 col-xs-3">

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


          <div class="form-group col-lg-3 col-md-3 col-xs-3">

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

            <option selected>1397</option>
            <option >1398</option>
        </select>

    </div>



</div>











      <div class="col-lg-6 col-md-6 col-xs-6  col-sm-6">
          <div class="form-group col-lg-3 col-md-3 col-xs-3">

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


          <div class="form-group col-lg-3 col-md-3 col-xs-3">

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

            <option selected>1397</option>
            <option >1398</option>
        </select>

    </div>



</div>



    <div class="col-lg-6 col-x-6 col-md-6 col-xs-6">
        <input type="text" id="len" class="input-lg form-control" placeholder="مدت">
    </div>


    <div class="col-lg-6 col-x-6 col-md-6 col-xs-6">
        <input type="text" id="price" class="input-lg form-control" placeholder="مبلغ">
    </div>



    <div class="col-lg-12 col-x-12 col-md-12 col-xs-12" style="margin-top:  30px">
        <button class="btn btn-lg form-control input-lg btn-lg btn-success" id="calc">محاسبه</button>
    </div>


    <script>
        $("#calc").click(function () {
            var page = 'CalcCheck';

            var day = $("#day").val();
            var month = $("#month").val();
            var year= $("#year").val();


             var tday = $("#tday").val();
            var tmonth = $("#tmonth").val();
            var tyear= $("#tyear").val();


            var len = $("#len").val();
            var price = $("#price").val();
            $.post("page.php", {page: page,day:day,month:month,year:year,tday:tday,tmonth:tmonth,tyear:tyear,len:len,price:price}, function (data) {
                $("#content").html(data);
                $('html,body').animate({
                        scrollTop: $("#content").offset().top},
                    'slow')
            });
        });

        </script>

<?php
}




function CalcCheck()
{

    require 'lib/jdf.php';
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $from = jmktime("00","00","05",$month,$day,$year);



    $tday = $_POST['tday'];
    $tmonth = $_POST['tmonth'];
    $tyear = $_POST['tyear'];
    $tfrom = jmktime("00","00","05",$tmonth,$tday,$tyear);

    $dbt = ($from + $tfrom) / 2;

    $price = $_POST['price'];

    $len = $_POST['len']  * '86400';


    $final = $dbt + $len;


    $date =  jdate('Y/m/d   ',$final , '','','en');

    ?>

    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <h1>تاریخ چک: <?php echo $date; ?></h1>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
        <h1>مبلغ چک: <?php echo num2word($price); ?></h1>
    </div>
<?php

}





    function num2word($num)
    {

        $one = array('','یک','دو','سه','چهار','پنج','شش','هفت','هشت','نه');
        $ten = array('','','بیست','سی','چهل','پنجاه','شصت','هفتاد','هشتاد','نود',);
        $hundred = array('','یکصد','دویست','سیصد','چهارصد','پانصد','ششصد','هفتصد','هشتصد','نهصد',);
        $categories = array('','هزار','میلیون','میلیارد','بیلیون','بیلیارد','تریلیون','تریلیارد','کوآدریلیون',);
        $exceptions = array('ده','یازده','دوازده','سیزده','چهارده','پانزده','شانزده','هفده','هجده','نوزده',);
        $out = '';
        $j   = 0;
        $cnt = strlen($num);
        for($i=--$cnt;$i>=0;$i-=3){
            $add = '';
            $i1 = $num[$i];
            $i2 = isset($num[$i-1]) ? $num[$i-1] : '';
            $i3 = isset($num[$i-2]) ? $num[$i-2] : '';
            if(!empty($i3))
                $add .= $hundred[$i3].' و ';
            if($i2>1)
                $add .= $ten[$i2].' و '.$one[$i1].' ';
            elseif($i2==1)
                $add .= $exceptions[$i1].' ';
            else
                $add .= $one[$i1].' ';
            if($add!=' ')
                $add .= $categories[$j++].' و ';
            else
                $j++;
            $out = $add.$out;
        }
        return mb_substr($out,0,-4);
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






function problem()
{
    ?>
    <script>
        $(".view").click(function () {
            var id = this.id;
            $.post("page.php", {page: 'viewFactor',id:id}, function (data) {
                $("#content").html(data);



            });
        });


        $(".branch").click(function () {
            var branch = this.id;
            $.post("page.php", {page: 'factorList',branch:branch}, function (data) {
                $("#content").html(data);
                $('html,body').animate({
                        scrollTop: $("#content").offset().top},
                    'slow')
            });
        });
    </script>
    <div class="container-fluid" >
        <div class="col-lg-1 form-group">
            <button class="btn btn-danger form-control branch  " id="1">زیتون</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-warning form-control branch" id="2">باهنر</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-success form-control branch" id="3">پاداد</button>
        </div>


        <div class="col-lg-1 form-group">
            <button class="btn btn-primary form-control branch" id="4">نفت</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-info form-control branch" id="5">فاطمی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-success form-control branch" id="7">وهابی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-primary form-control branch" id="8">اعتمادی</button>
        </div>

        <div class="col-lg-1 form-group">
            <button class="btn btn-warning  form-control branch" id="6"> انبار</button>
        </div>





    </div>
    <?php
    $factor = new factor();
    if(isset($_POST['pageid'])) {
        $pageid = $_POST['pageid'];

    }
    else {
        $pageid = '0';
    }


    if(isset($_POST['branch']))
    {


        $factor->UnAcceptfactorlist($_POST['branch'],$pageid,'','5');
    }
    else
    {
        $factor->UnAcceptfactorlist(null,$pageid,'','5');
    }
}




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