<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>سیستم مدیریت فاکتور فروشگاه نوید </title>
    <!--css-->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/jquery.loading.css" rel="stylesheet" type="text/css" media="all"/>


    <!--js-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--js-->
    <script src="js/responsiveslides.min.js"></script>

    <link href="css/pure-min.css" rel="stylesheet" type="text/css" media="all"/>
    <script src="js/editable.js"></script>
    <script src="js/switalert.js"></script>

    <script src="js/jquery.loading.js"></script>

    <script>
        $(document).ready(function(e) {
            $(".page").click(function () {
                var page = this.id;
                $.post("page.php", {page: page}, function (data) {
                    $("#content").html(data);
                    $('html,body').animate({
                            scrollTop: $("#content").offset().top},
                        'slow')
                });
            });

        });

    </script>
    <meta charset="utf-8" >


</head>
<body id="body">

<!--header-->
<div class="header" id="home">
    <div class="header-top">
        <div class="container-fluid">
            <div class="head-top">
                <div class="indicate">
                </div>
                <div class="deatils">
                    <ul>
                        <?php
                        if(isset($_SESSION['UserId']))   {
                            ?>
                            <li><i class="glyphicon glyphicon-log-out"></i><a href="logout.php" >خروج</a>
                            </li>
                            <?php
                        }
                        ?>

                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="logo">
                <h1><a href="#">سیستم مدیریت خرید  نوید</a></h1>
                <h2><a href="#">کاربر:
                        <?php
                        if(isset($_SESSION['UserId']))
                        {
                            echo $_SESSION['name'];
                        }
                        ?></a></h2>
            </div>
        </div>
    </div>

    <?php
    if(isset($_SESSION['UserId']))
    {
        ?>
        <div class="container-fluid">
            <div class="header-bottom">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            </button>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"
                             style="border-bottom: 2px solid red">
                            <nav class="menu menu--francisco">
                                <ul class="nav navbar-nav menu__list  ">
                                    <li class="dropdown">


                                    <li class="dropdown menu__item ">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu__link "><span
                                                    class="menu__helper"> فاکتور ها </span></a>
                                        <ul  class="dropdown-menu">

                                            <li style="height: 40px;"><a id="newFactor" class=" page"
                                                                         style="font-size: 20px" href="#">فاکتور
                                                    جدید</a></li>
                                            <li class="divider"></li>
                                            <li ><a href="#" id="factorList" class=" page"   style="font-size: 20px">لیست فاکتور ها</a></li><li class="divider"></li>
                                            <?php
                                            if($_SESSION['UserLevel'] == '1' ||$_SESSION['UserLevel'] == '3' ||$_SESSION['UserLevel'] == '2') {
                                                ?>
                                                <li ><a href="#" id="unaccept" class=" page"   style="font-size: 20px; color: red">تایید نشده  </a> </li>                                        <li class="divider"></li>
                                                <li ><a href="#" id="accepted" class=" page"   style="font-size: 20px; color: blue">تایید شده  </a></li>                                        <li class="divider"></li>
                                                <li ><a href="#" id="awaiting" class=" page"   style="font-size: 20px; color: orange">منتظر ثبت</a></li>                                        <li class="divider"></li>
                                                <li ><a href="#" id="problem" class=" page"   style="font-size: 20px; color: #ff000c"> مشکل دار</a></li>                                        <li class="divider"></li>
                                                <li ><a href="#" id="open" class=" page"   style="font-size: 20px; color: #c587ff"> فاکتور های باز شده</a></li>                                        <li class="divider"></li>
                                                <li ><a href="#" id="ByStatus" class=" page"   style="font-size: 20px; color: darkcyan">  نمایش بر اساس وضعیت</a></li>
                                                <li class="divider"></li>
                                                <?php
                                            }
                                            ?>

                                        </ul>
                                    </li>

                                    <li class="dropdown menu__item ">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu__link "><span
                                                    class="menu__helper"> کالاها </span></a>
                                        <ul  class="dropdown-menu">


                                            <li style="height: 40px;"><a id="Product" class=" page" style="font-size: 20px" href="#">ثبت و ویرایش کالا </a></li>
                                            <li class="divider"></li>

                                            <li ><a href="#" id="chart" class=" page"   style="font-size: 20px"> نمودار تغییر قیمت کالا  </a></li>                                        <li class="divider"></li>
                                            <?php
                                            if($_SESSION['UserLevel'] == '1' ||$_SESSION['UserLevel'] == '3' ||$_SESSION['UserLevel'] == '2'||$_SESSION['UserLevel'] == '10') {
                                                ?>
                                                <li ><a href="#" id="BuyReport" class=" page"   style="font-size: 20px">گزارش خرید  </a></li>
                                                <li class="divider"></li>

                                                <?php
                                            }
                                            if($_SESSION['UserLevel'] == '1' ||$_SESSION['UserLevel'] == '3' ||$_SESSION['UserLevel'] == '2') {
                                                ?>
                                                <li ><a href="#" id="PriceReport" class=" page"   style="font-size: 20px"> گزارش کالا </a></li>                                        <li class="divider"></li>
                                                <li ><a href="/shop/franchise.php" id="PriceReport" class=" page"   style="font-size: 20px"> گزارش کالا فرانچایز </a></li>                                        <li class="divider"></li>
                                                <li ><a href="#" id="ProductLIst" class=" page"   style="font-size: 20px"> لیست کالاها</a></li>
                                                <?php
                                            }
                                            ?>


                                        </ul>
                                    </li>






                                    <?php
                                    if($_SESSION['UserLevel'] == '1' ||$_SESSION['UserLevel'] == '3' ||$_SESSION['UserLevel'] == '2'   ||$_SESSION['UserLevel'] == '10') {
                                        ?>



                                        </li>


                                        <li class="dropdown menu__item ">
                                            <a href="#" data-toggle="dropdown" class="dropdown-toggle menu__link "><span
                                                        class="menu__helper"> شرکت ها </span></a>
                                            <ul  class="dropdown-menu">
                                                <li ><a href="#" id="company" class=" page"   style="font-size: 20px">ثبت شرکت</a></li>                                        <li class="divider"></li>
                                                <li ><a href="#" id="CompanyList" class=" page"   style="font-size: 20px">  لیست شرکت ها </a></li>                                        <li class="divider"></li>


                                            </ul>
                                        </li>




                                        <li class="menu__item"><a href="#report" id="report" class="menu__link page"><span
                                                        class="menu__helper"> گزارش گیری</span></a>
                                        </li>


                                        <li class="dropdown" role="menuitem"><a href="#archive" id="archive" class="menu__link page"><span
                                                        class="menu__helper"> بایگانی</span></a>

                                            <!-- <li class="menu__item"><a href="#recipet" id="recipet" class="menu__link page"><span
                                                            class="menu__helper">پرداختی ها</span></a>  -->

                                        </li>


                                        <li class="menu__item"><a href="#Message" id="Message" class="menu__link page"><span

                                                        class="menu__helper">   پیام ها </span></a>
                                        </li>


                                        <?php



                                        if($_SESSION['UserId'] == '1') {
                                            ?>

                                            <li class="menu__item"><a href="#Manager" id="Manager" class="menu__link page"><span

                                                            class="menu__helper">    مدیریت </span></a>
                                            </li>

                                            <?php
                                        }


                                        if($_SESSION['UserId'] == '1' || $_SESSION['UserId'] == '9') {
                                            ?>

                                            <li class="menu__item"><a href="#AdminPanel" id="AdminPanel" class="menu__link page"><span

                                                            class="menu__helper">    بخش مدیریت </span></a>
                                            </li>


                                            <li class="menu__item"><a href="#ChangeStatus" id="ChangeStatus" class="menu__link page"><span

                                                            class="menu__helper">     باز کردن فاکتور </span></a>
                                            </li>

                                            <?php
                                        }


                                        if($_SESSION['UserId'] == '1' || $_SESSION['UserId'] == '9'|| $_SESSION['UserId'] == '60') {
                                            ?>

                                            <li class="menu__item"><a href="SoodCalculator.php" id="Manager" class="menu__link page"><span

                                                            class="menu__helper">    محاسبه سود </span></a>
                                            </li>

                                            <?php
                                        }





                                        ?>


                                        <?php
                                    }
                                    ?>




                                    <li class="menu__item"><a href="#BuyCount" id="BuyCount" class="menu__link page"><span

                                                    class="menu__helper">    مجموع خرید  </span></a>
                                    </li>


                                    <li class="menu__item"><a href="#Detailed" id="Detailed" class="menu__link page"><span

                                                    class="menu__helper">   گزارش تفصیلی </span></a>
                                    </li>


                                    <li class="menu__item"><a href="#Detailed" id="check" class="menu__link page"><span

                                                    class="menu__helper">   چک  </span></a>
                                    </li>


                                    <li class="dropdown menu__item ">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu__link "><span
                                                    class="menu__helper"> پنل کاربری </span></a>
                                        <ul  class="dropdown-menu">

                                            <li ><a href="#calender" id="calender" class=" page"   style="font-size: 20px">سیستم   یاد آور </a></li>

                                            <?php
                                            if($_SESSION['UserId'] == '1' || $_SESSION['UserId'] == '9' || $_SESSION['UserId'] == '25' || $_SESSION['UserId'] == '5'|| $_SESSION['UserId'] == '48'|| $_SESSION['UserId'] == '61'|| $_SESSION['UserId'] == '62') {
                                                ?>
                                                <li class="divider"></li>
                                                <li ><a href="#ConfirmCheck" id="ConfirmCheck" class=" page"   style="font-size: 20px">تایید چک </a></li>
                                                <li class="divider"></li>
                                                <li ><a href="#awaitingCheck" id="awaitingCheck" class=" page"   style="font-size: 20px"> چک منتظر ثبت </a></li>
                                                <li class="divider"></li>
                                                <li ><a href="CheckTable.php" id="CalenderCheck" class=" page"   style="font-size: 20px">مدیریت چک  تحویل نشده</a></li>
                                                <li class="divider"></li>
                                                <li ><a href="CheckTableWait.php" id="CalenderCheck" class=" page"   style="font-size: 20px">مدیریت چک  تحویل شده</a></li>
                                                <?php
                                            }
                                            ?>

                                            <li class="divider"></li>
                                            <li style="height: 40px;"><a id="changePass" class=" page" style="font-size: 20px" href="#changePass">تعویض رمز عبور</a></li>

                                        </ul>
                                    </li>



                                    <?php
                                    /*
                                    if($_SESSION['UserLevel'] == '1' ||$_SESSION['UserLevel'] == '2' ||$_SESSION['UserLevel'] == '3') {
                                    ?>
                                    <li class="dropdown menu__item ">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu__link "><span
                                                    class="menu__helper"> کنترل موجودی </span></a>
                                        <ul  class="dropdown-menu">
                                            <li ><a href="#" id="inventory" class=" page"   style="font-size: 20px">بروز رسانی موجودی</a></li>                                          <li class="divider"></li>
                                            <li style="height: 40px;"><a id="entity_product" class=" page" style="font-size: 20px" href="#"> مدیریت کالا ها</a></li>                                        <li class="divider"></li>
                                            <li style="height: 40px;"><a id="entity_company" class=" page" style="font-size: 20px" href="#"> مدیریت شرکت ها</a></li>                                        <li class="divider"></li>


                                        </ul>
                                    </li>


                                        <?php
                                    }
                                    */
                                    ?>



                            </nav>
                </nav>

            </div>

            </nav>





        </div>

        <?php
    }
    else
    {
        ?>
        <form action="login.php" method="post"  autocomplete="off">
            <div class="col-lg-8 col-lg-offset-2 form-group">
                <h3 >نام کاربری </h3>
                <input type="text" name="user"  autocorrect="off"  class="form-control input-lg">

            </div>
            <div class="col-lg-8 col-lg-offset-2 form-group">
                <h3 >رمز عبور </h3>
                <input type="password" name="pass"  autocorrect="off" class="form-control input-lg">

            </div>
            <div class="col-lg-6 col-lg-offset-3 form-group">

                <button class="btn btn-primary form-control">ورود</button>

            </div>
        </form>
        <?php
    }
    ?>
    <div class="container-fluid">

        <div class="panel panel-success">

            <div class="panel-success panel-body  " dir="rtl">
                <div id="content">


                    <h2 class="text-center"><img class="imageRotate" src="img/logo.png"> </h2>

                </div>
            </div>


        </div>


    </div>

    <div class="copy-section">

        <div class="container-fluid">

            <h4><a href="#">طراحی و برنامه نویسی توسط نوید صالحی پور  ورژن 3.2 </a></h4>
        </div>
    </div>
    <!--copy-->
    <!--signin--></body>
</html>

