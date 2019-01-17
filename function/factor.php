<?php

// فانکنشن های مربوط به بخش  فاکتور ها



function newFactor()
{

    $branchClass = new branch();


    $level = $_SESSION['UserLevel'];
    if($level == '1' || $level == '2' || $level == '3' || $level == '10'  )

    {
        ?>
        <script>
            $("#newFactorBtn").click(function () {
                var branch = $("#branch").val();
                if(branch == 0)
                {
                    alert("لطفا شعبه مورد نظر خورد را انتخاب نمایید");
                }
                else
                {
                    var page = 'createFactor';
                    var factorid = $("#factorid").val();
                    var companyCreator = $("#companyCreator").val();
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
                }

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
                    <option value="0">انتخاب شعبه</option>
                    <?php $branchClass->GetBranchDropDown(); ?>
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
        <?php
        $branchClass = new branch();
        $branchClass->GetBranchButton();
        ?>
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
        <?php
        $branchClass = new branch();
        $branchClass->GetBranchButton();
        ?>

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
        <?php
        $branchClass = new branch();
        $branchClass->GetBranchButton();
        ?>

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
        <?php
        $branchClass = new branch();
        $branchClass->GetBranchButton();
        ?>

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





function open()
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
        <?php
        $branchClass = new branch();
        $branchClass->GetBranchButton();
        ?>

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


        $factor->OpenedFactorList($_POST['branch'],$pageid,'','6');
    }
    else
    {
        $factor->OpenedFactorList(null,$pageid,'','6');
    }
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
    $branchClass = new branch();
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

            });
        });


        $("#SaveMessage").click(function () {
            var message = $("#FactorMessage").val();
            var factorid = <?php echo $id; ?>;
            var page = 'AddFactorMessage';

            $.post("page.php", {factorid: factorid,message:message,page:page}, function (data) {
                if(data == 1)
                {
                    alert('پیام با موفقیت ثبت شد');
                }
                else
                {
                    alert('خطا');
                }
            });
        });


    </script>
    <textarea disabled="disabled" id="message" class="form-control text-center  alert-danger" style="font-size:40px"><?php
        echo $factor->message;
        ?></textarea>
    <br>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9">
            <input type="text" class="input-lg form-control alert alert-info" id="FactorMessage">
        </div>

        <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
            <button id="SaveMessage" class="btn btn-lg form-control input-lg btn-success">ثبت پیام</button>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <?php
                $messages = new factormessages();
                $messages->GetFactorMessage($factor->id);
                ?>
            </div>
        </div>

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
                $branchClass->GetBranchNameById($factor->branch);
                echo $branchClass->name;

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

                if($factor->status == '6')
                {
                    echo '<b style="color:orange">  فاکتور باز  </b>';

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

                            </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="problem.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-danger" id="<?php echo $factor->id; ?>" >مشکل دار  </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                            <?php
                        }

                        if ($factor->status == '4') {

                            ?>

                            </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="problem.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-danger" id="<?php echo $factor->id; ?>" >مشکل دار  </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                            <?php
                        }


                    }
                }
                else
                {
                    if( $_SESSION['UserLevel'] == '1') {



                        ?>
                        <a href="acceptfactor.php?factorid=<?php echo $_POST['id']; ?>"
                        <button class=" btn btn-info">تایید</a> </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="problem.php?factorid=<?php echo $_POST['id']; ?>"> <button class="btn btn-danger" id="<?php echo $factor->id; ?>" >مشکل دار  </button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                        <?php

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
                    if($factor->status != 3)
                    {
                        ?>        <input type="text"  class="form-control" id="id"><?php
                    }        }

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
            $("#AjaxResult").loading();

            var id = <?php echo $id; ?>;
            $.post('page.php',{page:'getFactorEntery', id:id}, function (data) {

                $("#AjaxResult").html(data);

                $("#AjaxResult").loading('stop');
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
            <option value="6" style="color: orange;">فاکتور باز  </option>


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




function RankUpdate()
{
    $id = $_POST['id'];
    $rank = $_POST['rank'];

    $factor = new factor();
    $factor->UpdateFactorRank($id,$rank);
}


function Discount()
{

    $factor = new factor();
    $factor->getFactorDiscount();


}


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
        <?php
        $branchClass = new branch();
        $branchClass->GetBranchButton();
        ?>

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


function AddFactorMessage()
{
    $factorid = $_POST['factorid'];
    $message = $_POST['message'];
    $userid = $_SESSION['UserId'];

    $messages = new factormessages();
    $messages->InsertNewFactorMessage($userid,$factorid,$message);

}

?>