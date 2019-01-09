<?php

class factor
{
    public $id;
    public $name;
    public $company;
    public $time;
    public $creator;
    public $status;
    public $visitor;
    public $factorid;
    public $branch;
    public $gheymatmasraf;
    public $gheymatforoosh;
    public $lastProductPrice;
    public $lastProductForooshPrice;
    public $fullsaved;
    public $rank;
    public $count;
    public $message;
    public $fwaiter;
    public $Created_at;
    public $trash;
    public $check_date;
    public $check_len;
    public $check_confirm;
    public $fullprice;

    public function CreateFactor($factorid, $company, $time, $visitor,$branch)
    {
        session_start();
        $creator = $_SESSION['UserId'];
        $dbconnect = new db();
        $sql = "insert into factor (factorid,company,time,status,visitor,branch,creator) values (:factorid,:company,:time,'0',:visitor,:branch,:creator)";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("factorid", $factorid);
        $result->bindParam("company", $company);
        $result->bindParam("creator", $creator);
        $result->bindParam("time", $time);
        $result->bindParam("branch", $branch);
        $result->bindParam("visitor", $visitor);

        If ($result->execute()) {
            return '1';
        } else {
            return '0';
        }


    }








    public function factorlist($branch = null,$pageid = null,$company = null,$status = null)
    {
        session_start();
        $user = new user();
        $user->getUserData($_SESSION['UserName']);
        $userid = $_SESSION['UserId'];
        $userlevel =  $_SESSION['UserLevel'];


        $dbconnect = new db();
                if(strlen($pageid) > '0')
                    {
                        $start = $pageid * '20' ;
                    }
                    else
                        {
                            $start = '0';
                        }



                        if(strlen($status) == '0')
                            {
                                $status = '' ;
                            }


      if(strlen($branch) > '0')
            {


        $sql = "select * from factor where branch = :branch   order by id Desc limit $start,20 ";
        echo '<input type="hidden" id="branchid"  value="' . $branch .  '">';
        }
               else
         {
            $sql = "select * from factor order by id Desc limit $start,20 ";
                echo '<input type="hidden" id="branchid" value="">';

         }







         $branchClass = new branch();


        $result = $dbconnect->connect->prepare($sql);
           if(strlen($branch) > '0')
               {
                   $result->bindParam("branch",$branch);
               }

                if(strlen($company) > '0')
               {
                   $result->bindParam("company",$company);
               }
        $result->execute();
        if ($result->rowCount() > '0') {
            $member = new user();
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            ?>
            <script>

             $(".view").click(function () {
            var id = this.id;
            $.post("page.php", {page: 'viewFactor', id: id}, function (data) {
                $("#content").html(data);


            });
        });


            </script>
            <table class="table table-responsive  table-bordered text-center" > <tr><td>شماره فاکتور</td> <td>شعبه </td> <td>نام شرکت</td>  <td>تاریخ فاکتور</td>  <td> مبلغ </td>    <td>سازنده </td> <td> وضعیت</td> <td>مدیریت</td></tr>

<?php
require 'lib/jdf.php';
            foreach ($data as $rows) {
                {
                   ?>
                <tr <?php if($rows->status == "4")
                    {
                        ?> style="background-color:#fff444" <?php
                    }

               if($rows->status == "5")
                    {
                        ?> style="background-color:rgba(255,51,66,0.54)" <?php
                    }




                    ?>>
                <td width="10%"><?php echo $rows->factorid; ?> </td>

                <td width="10%"
                ><?php

                $branchClass->GetBranchNameById($rows->branch);

                echo $branchClass->name;

                ?>
                </td>


                <td>                <?php $company = new company(); $company->getCompanyDetail($rows->company); echo $company->name;?>                 </td>
                                              <td><?php echo jdate("d:F:Y",$rows->time,'','','en'); ?> </td>

                  <td class="text-center"><b><?php echo number_format($rows->fullprice); ?></b> </td>

                <td><?php  $member->getUserData($rows->creator); echo $member->name; ?> </td>
                <td><?php
                if($rows->status == '0')
                    {
                        echo '<b style="color:red">تایید نشده </b>';
                    }

                    if($rows->status == '1')

                    {
                         echo '<b style="color:blue"> تایید شده </b>';

                       }

                        if($rows->status == '2')
                    {
                         echo '<b style="color:orange">منتظر ثبت</b>';

                       }

                              if($rows->status == '3')
                    {
                         echo '<b style="color:green">ثبت شده </b>';

                       }

                        if($rows->status == '4')
              {
                  echo '<b style="color:#fd25cd">  تایید اولیه </b>';

              }
              if($rows->status == '5')
              {
                  echo '<b style="color:#ffffff">  مشکل دار  </b>';

              }
              if($rows->status == '6')
              {
                  echo '<b style="color:orange">  فاکتور باز  </b>';

              }



                       ?> </td>
                <td  width="15%"><button class="btn btn-info view" id="<?php echo $rows->id; ?>" >مشاهده</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="deletefactor.php?factorid=<?php echo $rows->id; ?>"> <button class="btn btn-danger" id="<?php echo $rows->id; ?>" >حذف</button></a></td>
                </tr>

                <?php
                }



            }
                echo '</table>';
                echo $this->pagination($branch,$pageid);

        } else {
            echo 'هنوز هیچ فاکتوری صادر نشده است';

        }
        ?>

        <?php

    }

                    public function pagination($branch = null,$pageid = null)
                    {
                        ?>
                        <script>

                            $(".navigation").click(function () {
                                var id = this.id;
                                var branch = $("#branchid").val();
                                $.post("page.php", {page: 'factorList', branch: branch,pageid: id}, function (data) {
                                    $("#content").html(data);
                                    $('html,body').animate({
                                            scrollTop: $("#content").offset().top
                                        },
                                        'slow')
                                });

                            });
                        </script>
                    <?php
                    $dbconnect = new db();



                    /* if(strlen($branch) > '0')
                        {
                              $sql = "select * from factor where branch = :branch ";
                        }
                    else
                        {
                            $sql = "select * from factor";
                        }
                    $result = $dbconnect->connect->prepare($sql);
                    if(strlen($branch) > '0')
                        {
                            $result->bindParam("branch",$branch);
                        }

            */
                    $user = new user();
                    $user->getUserData($_SESSION['UserName']);
                    $userid = $_SESSION['UserId'];
                    $userlevel =  $_SESSION['UserLevel'];


                    if(strlen($branch) > '0')
                    {


                        $sql = "select * from factor where branch = :branch ";
                    }
                    else
                    {
                        $sql = "select * from factor order by id Desc  ";

                    }

                    $result = $dbconnect->connect->prepare($sql);
                    if(strlen($branch) > '0')
                    {
                        $result->bindParam("branch",$branch);
                    }



                    $result->execute();
                    $data = $result->rowCount() / '20';
                    echo '<nav aria-label="صفحات"><ul class="pagination pagination-lg">';
                    for ($i = '0'; $i<$data ; $i++) {
                    ?>
                        <li><a class="navigation" href="#" id="<?php echo $i; ?>"><?php echo $i+1 ; ?> </a></li>
                        <?php
                    }
                        echo '</ul></nav>';
                    }






        public function UnAcceptfactorlist($branch = null,$pageid = null,$company = null,$status )
        {
        $branchClass = new branch();
        session_start();
        $user = new user();
        $user->getUserData($_SESSION['UserName']);
        $userid = $_SESSION['UserId'];
        $userlevel =  $_SESSION['UserLevel'];


        $dbconnect = new db();
        if(strlen($pageid) > '0')
        {
            $start = $pageid * '10' ;
        }
        else
        {
            $start = '0';
        }




        if(strlen($branch) > '0')
        {


            $sql = "select * from factor where branch = :branch and status = $status   order by id Desc limit $start,150 ";
            echo '<input type="hidden" id="branchid"  value="' . $branch .  '">';
        }
        else
        {
            $sql = "select * from factor  where status = $status order by id Desc limit $start,150 ";
            echo '<input type="hidden" id="branchid" value="">';

        }

        $result = $dbconnect->connect->prepare($sql);
        if(strlen($branch) > '0')
        {
            $result->bindParam("branch",$branch);
        }

        if(strlen($company) > '0')
        {
            $result->bindParam("company",$company);
        }
        $result->execute();
        if ($result->rowCount() > '0') {
        $member = new user();
        $data = $result->fetchAll(PDO::FETCH_OBJ);
        ?>
                <script>

                    $(".navigation").click(function () {
                        var id = this.id;
                        var branch = $("#branchid").val();
                        $.post("page.php", {page: 'factorList', branch: branch,pageid: id}, function (data) {
                            $("#content").html(data);
                            $('html,body').animate({
                                    scrollTop: $("#content").offset().top
                                },
                                'slow')
                        });

                    });
                </script>
                <table class="table table-responsive  table-bordered text-center" > <tr><td>شماره فاکتور</td> <td>شعبه </td> <td>نام شرکت</td> <td>تاریخ </td>  <td> مبلغ</td> <td>سازنده </td> <td> وضعیت</td> <td>مدیریت</td></tr>

                    <?php
                    require 'lib/jdf.php';
                    foreach ($data as $rows) {
                        {
                            ?>
                            <tr>
                                <td width="10%"><?php echo $rows->factorid; ?> </td>

                                <td width="10%"
                                ><?php
                                    $branchClass->GetBranchNameById($rows->branch);
                                    echo $branchClass->name;

                                    ?>
                                </td>


                                <td>                <?php $company = new company(); $company->getCompanyDetail($rows->company); echo $company->name;?>                 </td>
                                <td><?php echo jdate("d:F:Y",$rows->time,'','','en'); ?> </td>
                                <td class="text-center"><b><?php echo number_format($rows->fullprice); ?></b> </td>
                                <td><?php  $member->getUserData($rows->creator); echo $member->name; ?> </td>
                                <td><?php
                                    if($rows->status == '0')
                                    {
                                        echo '<b style="color:red">تایید نشده </b>';
                                    }

                                    if($rows->status == '1')

                                    {
                                        echo '<b style="color:blue"> تایید شده </b>';

                                    }

                                    if($rows->status == '2')
                                    {
                                        echo '<b style="color:orange">منتظر ثبت</b>';

                                    }

                                    if($rows->status == '3')
                                    {
                                        echo '<b style="color:green">ثبت شده </b>';

                                    }
                                    if($rows->status == '6')
                                    {
                                        echo '<b style="color:orange">  فاکتور باز  </b>';

                                    }


                                    ?> </td>
                                <td  width="15%"><button class="btn btn-info view" id="<?php echo $rows->id; ?>" >مشاهده</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="deletefactor.php?factorid=<?php echo $rows->id; ?>"> <button class="btn btn-danger" id="<?php echo $rows->id; ?>" >حذف</button></a></td>
                            </tr>

                            <?php
                        }



                    }
                    echo '</table>';

                    } else {
                        echo 'هنوز هیچ فاکتوری صادر نشده است';

                    }

                    }





                    public function OpenedFactorList($branch = null,$pageid = null,$company = null,$status )
                    {
                    $branchClass = new branch();
                    session_start();
                    $user = new user();
                    $user->getUserData($_SESSION['UserName']);
                    $userid = $_SESSION['UserId'];
                    $userlevel =  $_SESSION['UserLevel'];


                    $dbconnect = new db();
                    if(strlen($pageid) > '0')
                    {
                        $start = $pageid * '10' ;
                    }
                    else
                    {
                        $start = '0';
                    }




                    if(strlen($branch) > '0')
                    {


                        $sql = "select * from factor where branch = :branch and status = $status   order by id Desc limit $start,150 ";
                        echo '<input type="hidden" id="branchid"  value="' . $branch .  '">';
                    }
                    else
                    {
                        $sql = "select * from factor  where status = $status order by id Desc limit $start,150 ";
                        echo '<input type="hidden" id="branchid" value="">';

                    }










                    $result = $dbconnect->connect->prepare($sql);
                    if(strlen($branch) > '0')
                    {
                        $result->bindParam("branch",$branch);
                    }

                    if(strlen($company) > '0')
                    {
                        $result->bindParam("company",$company);
                    }
                    $result->execute();
                    if ($result->rowCount() > '0') {
                    $member = new user();
                    $data = $result->fetchAll(PDO::FETCH_OBJ);
                    ?>
                    <script>

                        $(".navigation").click(function () {
                            var id = this.id;
                            var branch = $("#branchid").val();
                            $.post("page.php", {page: 'factorList', branch: branch,pageid: id}, function (data) {
                                $("#content").html(data);
                                $('html,body').animate({
                                        scrollTop: $("#content").offset().top
                                    },
                                    'slow')
                            });

                        });
                    </script>
                    <table class="table table-responsive  table-bordered text-center" > <tr><td>شماره فاکتور</td> <td>شعبه </td> <td>نام شرکت</td> <td>تاریخ </td>  <td> مبلغ</td> <td>سازنده </td> <td> وضعیت</td> <td>مدیریت</td></tr>

                        <?php
                        require 'lib/jdf.php';
                        foreach ($data as $rows) {
                            {
                                ?>
                                <tr>
                                    <td width="10%"><?php echo $rows->factorid; ?> </td>

                                    <td width="10%"
                                    ><?php
                                        $branchClass->GetBranchNameById($rows->branch);
                                        echo $branchClass->name;

                                        ?>
                                    </td>


                                    <td>                <?php $company = new company(); $company->getCompanyDetail($rows->company); echo $company->name;?>                 </td>
                                    <td><?php echo jdate("d:F:Y",$rows->time,'','','en'); ?> </td>
                                    <td class="text-center"><b><?php echo number_format($rows->fullprice); ?></b> </td>
                                    <td><?php  $member->getUserData($rows->creator); echo $member->name; ?> </td>
                                    <td><?php
                                        if($rows->status == '0')
                                        {
                                            echo '<b style="color:red">تایید نشده </b>';
                                        }

                                        if($rows->status == '1')

                                        {
                                            echo '<b style="color:blue"> تایید شده </b>';

                                        }

                                        if($rows->status == '2')
                                        {
                                            echo '<b style="color:orange">منتظر ثبت</b>';

                                        }

                                        if($rows->status == '3')
                                        {
                                            echo '<b style="color:green">ثبت شده </b>';

                                        }
                                        if($rows->status == '6')
                                        {
                                            echo '<b style="color:orange">  فاکتور باز  </b>';

                                        }


                                        ?> </td>
                                    <td  width="15%"><button class="btn btn-info view" id="<?php echo $rows->id; ?>" >مشاهده</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="deletefactor.php?factorid=<?php echo $rows->id; ?>"> <button class="btn btn-danger" id="<?php echo $rows->id; ?>" >حذف</button></a></td>
                                </tr>

                                <?php
                            }



                        }
                        echo '</table>';

                        } else {
                            echo 'هنوز هیچ فاکتوری صادر نشده است';

                        }

                        }












                        public function getFactorDetail($id)
    {
        $dbconnect = new db();
        $sql = "select * from factor where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->execute();
        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $this->id = $rows->id;
                $this->company = $rows->company;
                $this->time = $rows->time;
                $this->creator = $rows->creator;
                $this->status = $rows->status;
                $this->visitor = $rows->visitor;
                $this->factorid = $rows->factorid;
                $this->branch = $rows->branch;
                $this->fwaiter = $rows->fwaiter;
                $this->waiter = $rows->waiter;
                $this->saver = $rows->saver;
                $this->company = $rows->company;
                $this->rank = $rows->rank;
                $this->message = $rows->message;
                $this->trash = $rows->trash;
                $this->check_len = $rows->check_len;
                $this->fullprice =  $rows->fullprice;


            }
        }
    }

    public function getProductData($id)
    {
        $dbconnect = new db();
        $sql = "select * from product where productid = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->execute();
        if($result->rowCount() > '0')
            {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows)
                    {
                        $this->getLastProductData($id);

                ?>
                <script>
                $("#inputPercentNaghdi").keyup(function()
                {
                   var percentnaghdi = $("#inputPercentNaghdi").val();
                    var newprice = $("#newprice").val();

                    var percent = newprice / 100 ;
                    var totalpercentnaghdi = percentnaghdi * percent;
                    $("#precentnaghdiresult").val(totalpercentnaghdi);
                });

  $("#eshantionCode").keyup(function()
                {
                   var eshantionCode = $("#eshantionCode").val();

                   if(eshantionCode.length > '5')
                       {
                     $.post("page.php",{page:'GetEshantionName',eshantionCode:eshantionCode},function (data) {
                        $("#eshantionName").val(data);

                    });
                     }
                });






 $('input:text').bind("keydown", function(e) {

    var n = $("input:text").length;

    if (e.which == 13)

    { //Enter key

      e.preventDefault(); //Skip default behavior of the enter key

      var nextIndex = $('input:text').index(this) + 1;

      if(nextIndex < n)

        $('input:text')[nextIndex].focus();

      else

      {

        $('input:text')[nextIndex-1].blur();

        $('#btnSubmit').click();

      }

    }

  });






                      $("#percenthajmi").keyup(function()
                {
                    var newprice = $("#newprice").val();
                    var percenthajmi = $("#percenthajmi").val();
                    var percent = newprice / 100 ;
                    var totalpercenthajmi = percenthajmi * percent;
                    $("#percenthajmiresult").val(totalpercenthajmi);
                });


                 $("#percentmailiat").keyup(function()
                {
                     var percentnaghdi = $("#inputPercentNaghdi").val();
                    var newprice = $("#newprice").val();

                    var percent = newprice / 100 ;
                    var totalpercentnaghdi = percentnaghdi * percent;



                    var percenthajmi = $("#percenthajmi").val();
                    var percent = newprice / 100 ;
                    var totalpercenthajmi = percenthajmi * percent;



                      var count = $("#count").val();
                      var inpack = $("#inpack").val();
                      var totalpack = count * inpack;




                    var percentmaliat  = $("#percentmailiat").val();
                    var totalmaliat = newprice / 100 * percentmaliat;
                    $("#percentmaliatresult") .val(totalmaliat);

                    var final1 = newprice - totalpercenthajmi ;
                    var final2 =final1 + (final1 /100 * percentmaliat) ;
                    var final3 = final2  - (final2 / 100 * percentnaghdi);


                    $("#finalprice").val(Math.round(final3));
                    $("#finaltotalprice").val(Math.round(final3 * totalpack));




                });

                 $("#epercent").keyup(function() {



                     var percentnaghdi = $("#inputPercentNaghdi").val();
                    var newprice = $("#newprice").val();

                    var percent = newprice / 100 ;
                    var totalpercentnaghdi = percentnaghdi * percent;



                    var percenthajmi = $("#percenthajmi").val();
                    var percent = newprice / 100 ;
                    var totalpercenthajmi = percenthajmi * percent;



                      var count = $("#count").val();
                      var inpack = $("#inpack").val();
                      var totalpack = count * inpack;




                    var percentmaliat  = $("#percentmailiat").val();
                    var totalmaliat = newprice / 100 * percentmaliat;
                    var final1 = newprice - totalpercenthajmi ;
                    var final2 =final1 + (final1 /100 * percentmaliat) ;
                    var final3 = final2  - (final2 / 100 * percentnaghdi);




                    var eshantion = Math.round((newprice * totalpack) / 100) * $("#epercent").val();
                   $("#eprice").val(eshantion);
                    $("#finaltotalprice").val((final3 * totalpack) - eshantion) ;

                 });


             $("#inpack").keyup(function()
                {
                    var tt  = parseInt($("#count").val());
                    var inpack = $("#inpack").val();
                    var final = tt * inpack;




                    $("#totalcount").val(final);
                });


               $("#eshantionin").keyup(function()
                {
                    var tt  = parseInt($("#eshantion").val());
                    var inpack = $("#eshantionin").val();
                    var final = tt * inpack;


                    var price = final * parseInt($("#eshantionPrice").val())

                    $("#eshantionCount").val(final);
                });


               $("#eshantionPrice").keyup(function()
                {
                    var tt  = parseInt($("#eshantion").val());
                    var inpack = $("#eshantionin").val();
                    var final = tt * inpack;


                    var price = final * parseInt($("#eshantionPrice").val())

                    $("#eshantionFullPrice").val(price);
                });




             
             







              $("#btnsubmit").click(function()
                {
                    var feshantionstatus = $('#feshantion').prop('checked');
                    var productid = $("#productid").val();
                    var count = $("#count").val();
                    var oldprice = $("#gheymatghadim").val();
                    var gheymatforoshghadim = $("#gheymatforoshghadim").val();
                    var gheymatmasrafghadim = $("#gheymatmasrafghadim").val();
                    var eshantion = $("#eshantion").val();
                    var gheymatjadid = $("#newprice").val();
                    var boxin = $("#inpack").val();
                    var eshantionin = $("#eshantionin").val();
                    var gheymatforooshjadid = $("#gheymatforroshjadid").val();
                    var gheymatmasrafjadid = $("#gheymatmasrafijadid").val();
                    var takhfifnaghdi = $("#inputPercentNaghdi").val();
                    var takhfifhajmi = $("#percenthajmi").val();
                    var factorid = $("#factorid").val();
                    var tax = $("#percentmailiat").val();
                    var epercent = $("#epercent").val();
                    var eshantionCode = $("#eshantionCode").val();
                    var eshantionPrice = $("#eshantionPrice").val();
                    $.post("page.php",{page:'add2factor',productid:productid,factorid:factorid,count:count,oldprice:oldprice,gheymatforooshghadi:gheymatforoshghadim,eshantion:eshantion,gheymatmasrafghadim:gheymatmasrafghadim,gheymatjadid:gheymatjadid,gheymatmasrafjadid:gheymatmasrafjadid,gheymatforooshjadid:gheymatforooshjadid,takhfifnaghdi:takhfifnaghdi,takhfifhajmi:takhfifhajmi,tax:tax,boxin:boxin,eshantionin:eshantionin,feshantion:feshantionstatus,epercent:epercent , eshantionCode:eshantionCode,eshantionPrice:eshantionPrice},function (data) {
                        $("#result").html(data);

                    });
                })




                </script>
                 <input type="hidden" id="factorid" value="<?php echo  $_POST['factorid']; ?>" name="factorid">


                <input type="hidden" id="productid" value="<?php echo $id; ?>">
                        <div class="col-lg-2 col-md-2 col-xs-2  col-sm-2  col-xs-2 form-group" >
                            <label>کد محصول</label>
                            <input type="text"   class="form-control input-lg" value="<?php echo $rows->productid; ?>">
                        </div>

                 <div class="col-lg-4 col-md-4  col-xs-4  col-sm-4  form-group" >

            <label>نام محصول</label>
            <input type="text"  class="form-control input-lg" value="<?php echo $rows->name; ?>">
        </div>

        <div class="col-lg-6  col-md-6  col-xs-6  col-sm-6 form-group" >
            <label>شرکت توزیع کننده </label>
            <input type="text"  class="form-control input-lg" value="<?php $company = new company(); $company->getCompanyDetail($rows->company); echo $company->name; ?>">
        </div>

        <div class="col-lg-4   col-md-4  col-sm-4  col-xs-4  form-group" >
            <label>تعداد بسته </label>
            <input type="text"  id="count" class="form-control input-lg" value="">
        </div>
          <div class="col-lg-4    col-md-4  col-sm-4  col-xs-4  form-group" >
            <label>تعداد در هر بسته </label>
            <input type="text" id="inpack" class="form-control input-lg" value="<?php echo $rows->inpack?>">
        </div>

  <div class="col-lg-4  col-md-4  col-sm-4  col-xs-4  form-group" >
            <label>تعداد کل </label>
            <input type="text"  id="totalcount" class="form-control input-lg" disabled  value="">
        </div>


        <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2 form-group" >
            <label>کد کالای اشانتیون</label>
            <input type="text"  id="eshantionCode" class="form-control input-lg" value="">
        </div>



        <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2 form-group" >
            <label>نام کالای اشانتیون</label>
            <input type="text "  disabled id="eshantionName" class="form-control input-lg" value="">
        </div>


        <div class="col-lg-1  col-md-1 col-xs-1 col-sm-1 form-group" >
            <label>تعداد بسته   </label>
            <input type="text"   id="eshantion" class="form-control input-lg" value="">
        </div>



            <div class="col-lg-1 col-xs-1 col-sm-1 col-md-1  form-group" >
            <label>تعداد در  بسته  </label>
            <input type="text"  id="eshantionin"  class="form-control input-lg" value="">
        </div>




           <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2 form-group" >
            <label>جمع کل اشانتیون</label>
            <input type="text" disabled id="eshantionCount" class="form-control input-lg" value="">
        </div>


 <div class="col-lg-2 col-md-2 col-xs-2  col-sm-2 form-group" >
            <label>قیمت کالای اشانتیون</label>
            <input type="text" id="eshantionPrice"  class="form-control input-lg" value="">
        </div>



  <div class="col-lg-2 col-md-2 col-xs-2  col-sm-2  form-group" >
            <label>جمع کل اشانتیون</label>
            <input type="text" disabled id="eshantionFullPrice" class="form-control input-lg" value="">
        </div>





        <div class="col-lg-4  col-md-4 col-xs-4 col-sm-4 form-group" >
            <label>قیمت  واحد قدیم</label>
            <input type="text" id="gheymatghadim" class="form-control input-lg" value="<?php echo $this->lastProductForooshPrice;?>">
        </div>

                <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 form-group" >
            <label>قیمت مصرف قدیم </label>
            <input type="text" id="gheymatmasrafghadim" class="form-control input-lg" value="<?php echo $this->gheymatmasraf;?>">
        </div>

        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 form-group" >
            <label>قیمت فروش قدیم </label>
            <input type="text" id="gheymatforoshghadim"  class="form-control input-lg"  value="<?php echo $this->gheymatforoosh;?>">
        </div>


        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 form-group" >
            <label>قیمت واحد جدید</label>
            <input type="text" id="newprice" class="form-control input-lg" value="">
        </div>

                <div class="col-lg-4 col-xs-4 col-sm-4 col-md-4 form-group" >
            <label>قیمت مصرف جدید </label>
            <input type="text" id="gheymatmasrafijadid" class="form-control input-lg" value="">
        </div>

        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 form-group" >
            <label>قیمت فروش جدید </label>
            <input type="text" id="gheymatforroshjadid" class="form-control input-lg"  value="">
        </div>



           <div class="col-lg-2 form-group" >
            <label>درصد فروش نقدی</label>
            <input type="text" id="inputPercentNaghdi" class="form-control input-lg"  value="">
        </div>


        <div class="col-lg-2 col-xs-2 col-sm-2 col-md-2 form-group" >
            <label>تخفیف  فروش نقدی</label>
            <input type="text" id="precentnaghdiresult" disabled id="count" class="form-control input-lg" value="">
        </div>

                <div class="col-lg-2 col-xs-2 col-sm-2 col-md-2 form-group" >
            <label>درصد فروش حجمی</label>
            <input type="text" id="percenthajmi" class="form-control input-lg" value="">
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2  col-xs-2 form-group" >
            <label>تخفیف فروش حجمی </label>
            <input type="text" id="percenthajmiresult" disabled class="form-control input-lg"  value="">
        </div>

                <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2 form-group" >
            <label>درصد  مالیات</label>
            <input type="text" id="percentmailiat" class="form-control input-lg" value="">
        </div>

        <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2 form-group" >
            <label>افزایش قیمت مالیت</label>
            <input type="text" id="percentmaliatresult" disabled class="form-control input-lg"  value="">
        </div>

                <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3 form-group" >
            <label> درصد تخفیف اشانتیون</label>
            <input type="text"  id="epercent" class="form-control input-lg">
        </div>

         <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3 form-group" >
            <label>  مبلغ تخفیف اشانتیون</label>
            <input type="text" disabled id="eprice" class="form-control input-lg">
        </div>

         <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3 form-group" >
            <label>  قیمت پایانی هر محصول</label>
            <input type="text" disabled id="finalprice" class="form-control input-lg">
        </div>


                <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3 form-group" >
            <label>  قیمت کل فاکتور</label>
            <input type="text" disabled id="finaltotalprice" class="form-control input-lg" >
        </div>
        <div class="form-group col-lg-3 col-xs-3 col-sm-3 col-md-3">
       <label for="feshantion" style="color: red; font-size: 20px">ضایعات ؟</label>
        &nbsp;&nbsp;&nbsp;<input type="checkbox" name="feshantion" id="feshantion" >

        </div>
        <div class="form-group col-lg-6 col-md-6 col-xs-6 col-sm-6 ">
            <button id="btnsubmit" class="btn btn-success form-control">افزودن به فاکتور</button>
            </div>



                <?php
            }
           }
            else
                {
                   echo '<script>alert("این محصول یافت نشد ");</script>';
                }
    }

    public function getLastProductData($id)
    {
        $dbconnect = new db();
        $sql = "select * from factorentity where productid = :id and feshantion = '0' order by id Desc limit 0,1";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->execute();
        if($result->rowCount() > '0')
            {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows)
                    {
                        $this->lastProductForooshPrice = $rows->price;
                        $this->gheymatmasraf = $rows->currentgheymatmasraf;
                        $this->gheymatforoosh = $rows->currentgheymatforrosh;
                    }

            }
            else
                {
                    return '0';
                }

    }

    public function addToFactor($factorid,$productid,$price,$currentgheymatforrosh,$currentgheymatmasraf,$box,$discounthajmi,$discountnaghdi,$tax,$gheymatghabli,$gheymatforoosh,$gheymatmasraf,$eshantion,$boxin,$eshantionin,$feshantion,$epercent,$eshantionCode,$eshantionPrice)
    {
        $dbconnect = new db();
        $sql = "insert into factorentity (factorid,productid,price,currentgheymatforrosh,currentgheymatmasraf,box,discounthajmi,discountnaghdi,tax,gheymatghabli,gheymatforoosh,gheymatmasraf,eshantion,eshantionin,boxin,feshantion,eshantionpercent,eshantionCode,eshantionPrice) values (:factorid,:productid,:price,:currentgheymatforrosh,:cuttentgheymatmasraf,:box,:discounthajmi,:discountnaghdi,:tax,:gheymatghabl,:gheymatforoosh,:gheymatmasraf,:eshantion,:eshantionin,:boxin,:feshantion,:eshantionpercent,:eshantionCode,:eshantionPrice)";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("factorid",$factorid);
        $result->bindParam("productid",$productid);
        $result->bindParam("eshantionpercent",$epercent);
        $result->bindParam("price",$price);
        $result->bindParam("currentgheymatforrosh",$currentgheymatforrosh);
        $result->bindParam("cuttentgheymatmasraf",$currentgheymatmasraf);
        $result->bindParam("box",$box);
        $result->bindParam("boxin",$boxin);
        $result->bindParam("discounthajmi",$discounthajmi);
        $result->bindParam("discountnaghdi",$discountnaghdi);
        $result->bindParam("eshantion",$eshantion);
        $result->bindParam("eshantionin",$eshantionin);
        $result->bindParam("tax",$tax);
        $result->bindParam("feshantion",$feshantion);
        $result->bindParam("gheymatghabl",$gheymatghabli);
        $result->bindParam("gheymatforoosh",$gheymatforoosh);
        $result->bindParam("gheymatmasraf",$gheymatmasraf);
        $result->bindParam("eshantionCode",$eshantionCode);
        $result->bindParam("eshantionPrice",$eshantionPrice);
        if($result->execute())
            {
                ?>
                <script>

                    refresh();

                </script>
<?php
            }
            else
                {
                    echo 'خطا';
                }

    }


      public function factordelete($id)
    {
        $dbconnect = new db();
        $sql = "delete from factor where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id", $id);
        if ($result->execute()) {
            header("location:index.php");
        } else {
            echo 'خطا';
        }
    }






    public function fsaveFactor($id , $userid)
    {
        $dbconnect = new db();
        $sql = "update factor set status = '1' , fwaiter = :userid  where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("userid",$userid );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }




    public function saveFactor($id , $userid)
    {
        $dbconnect = new db();
        $sql = "update factor set status = '2' , waiter = :userid  where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("userid",$userid );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }



    public function fwaiter($id , $userid)
    {
        $dbconnect = new db();
        $sql = "update factor set status = '2' , fwaiter = :userid  where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("userid",$userid );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }


    public function unsaveFactor($id)
    {
        $dbconnect = new db();
        $sql = "update factor set status = '1' where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id,PDO::PARAM_INT);

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }


    public function savenickHesab($id , $userid)
    {
        $dbconnect = new db();
        $sql = "update factor set status = '3' , saver = :userid where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id,PDO::PARAM_INT);
        $result->bindParam("userid",$userid );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }


    public function AcceptFactor($id)
    {
        $dbconnect = new db();
        $sql = "update factor set status = '1' where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id,PDO::PARAM_INT);

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }




    public function ProblemFactor($id)
    {
        $dbconnect = new db();
        $sql = "update factor set status = '5' where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id,PDO::PARAM_INT);

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }




    public function SolveProblemFactor($id , $userid)
    {
        $dbconnect = new db();
        $sql = "update factor set status = '2' , waiter = :waiter where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id,PDO::PARAM_INT);
        $result->bindParam("waiter",$userid);

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }



      public function fAcceptFactor($id)
    {
        $dbconnect = new db();
        $sql = "update factor set status = '4' where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id,PDO::PARAM_INT);

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }



         public function disapproval($id)
    {
        $dbconnect = new db();
        $sql = "update factor set status = '0' where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id,PDO::PARAM_INT);

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }

    }










      public function editProductData($id,$factorid)
    {
        $dbconnect = new db();
        $sql = "select * from factorentity where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->execute();
        if($result->rowCount() > '0')
            {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows)
                    {
                        $entity = new entity();
                        $entity->getProductData($rows->productid);

                ?>
                <script>
                $("#inputPercentNaghdi").keyup(function()
                {
                   var percentnaghdi = $("#inputPercentNaghdi").val();
                    var newprice = $("#newprice").val();

                    var percent = newprice / 100 ;
                    var totalpercentnaghdi = percentnaghdi * percent;
                    $("#precentnaghdiresult").val(totalpercentnaghdi);
                });



                      $("#percenthajmi").keyup(function()
                {
                    var newprice = $("#newprice").val();
                    var percenthajmi = $("#percenthajmi").val();
                    var percent = newprice / 100 ;
                    var totalpercenthajmi = percenthajmi * percent;
                    $("#percenthajmiresult").val(totalpercenthajmi);
                });


                 $("#percentmailiat").keyup(function()
                {
                     var percentnaghdi = $("#inputPercentNaghdi").val();
                    var newprice = $("#newprice").val();

                    var percent = newprice / 100 ;
                    var totalpercentnaghdi = percentnaghdi * percent;



                    var percenthajmi = $("#percenthajmi").val();
                    var percent = newprice / 100 ;
                    var totalpercenthajmi = percenthajmi * percent;



                      var count = $("#count").val();
                      var inpack = $("#inpack").val();
                      var totalpack = count * inpack;




                    var percentmaliat  = $("#percentmailiat").val();
                    var totalmaliat = newprice / 100 * percentmaliat;
                    $("#percentmaliatresult") .val(totalmaliat);

                    var final1 = newprice - totalpercenthajmi ;
                    var final2 =final1 + (final1 /100 * percentmaliat) ;
                    var final3 = final2  - (final2 / 100 * percentnaghdi);


                    $("#finalprice").val(Math.round(final3));
                    $("#finaltotalprice").val(Math.round(final3 * totalpack));



                });

             $("#inpack").keyup(function()
                {
                    var tt  = parseInt($("#count").val());
                    var inpack = $("#inpack").val();
                    var final = tt * inpack;


                    var ett  = parseInt($("#eshantion").val());
                    var einpack = $("#eshantionin").val();
                    var efinal = ett * einpack;
                    var show = final + efinal;

                    $("#totalcount").val(final);
                });






               $("#eshantionin").keyup(function()
                {


                    var ett  = parseInt($("#eshantion").val());
                    var einpack = $("#eshantionin").val();
                    var efinal = ett * einpack;


                    $("#eshantionCount").val(efinal);
                });









 $('input:text').bind("keydown", function(e) {

    var n = $("input:text").length;

    if (e.which == 13)

    { //Enter key

      e.preventDefault(); //Skip default behavior of the enter key

      var nextIndex = $('input:text').index(this) + 1;

      if(nextIndex < n)

        $('input:text')[nextIndex].focus();

      else

      {

        $('input:text')[nextIndex-1].blur();

        $('#btnSubmit').click();

      }

    }

  });



 




                 $("#epercent").keyup(function() {



                     var percentnaghdi = $("#inputPercentNaghdi").val();
                    var newprice = $("#newprice").val();

                    var percent = newprice / 100 ;
                    var totalpercentnaghdi = percentnaghdi * percent;



                    var percenthajmi = $("#percenthajmi").val();
                    var percent = newprice / 100 ;
                    var totalpercenthajmi = percenthajmi * percent;



                      var count = $("#count").val();
                      var inpack = $("#inpack").val();
                      var totalpack = count * inpack;




                    var percentmaliat  = $("#percentmailiat").val();
                    var totalmaliat = newprice / 100 * percentmaliat;
                    $("#percentmaliatresult") .val(totalmaliat);

                    var final1 = newprice - totalpercenthajmi ;
                    var final2 =final1 + (final1 /100 * percentmaliat) ;
                    var final3 = final2  - (final2 / 100 * percentnaghdi);




                     var eshantion = Math.round((newprice * totalpack) / 100) * $("#epercent").val();
                   $("#eprice").val(eshantion);
                    $("#finaltotalprice").val((final3 * totalpack) - eshantion) ;


                 });




               $("#eshantionPrice").keyup(function()
                {
                    var tt  = parseInt($("#eshantion").val());
                    var inpack = $("#eshantionin").val();
                    var final = tt * inpack;


                    var price = final * parseInt($("#eshantionPrice").val())

                    $("#eshantionFullPrice").val(price);
                });




  $("#eshantionCode").keyup(function()
                {
                   var eshantionCode = $("#eshantionCode").val();

                   if(eshantionCode.length > '5')
                       {
                     $.post("page.php",{page:'GetEshantionName',eshantionCode:eshantionCode},function (data) {
                        $("#eshantionName").val(data);

                    });
                     }
                });


              $("#btnsubmit").click(function()
                {
                    var entityid =<?php echo $id; ?>;
                    var feshantionstatus = $('#feshantion').prop('checked');
                    var productid = $("#productid").val();
                    var count = $("#count").val();
                    var oldprice = $("#gheymatghadim").val();
                    var gheymatforoshghadim = $("#gheymatforoshghadim").val();
                    var gheymatmasrafghadim = $("#gheymatmasrafghadim").val();
                    var eshantion = $("#eshantion").val();
                    var gheymatjadid = $("#newprice").val();
                    var boxin = $("#inpack").val();
                    var eshantionin = $("#eshantionin").val();
                    var gheymatforooshjadid = $("#gheymatforroshjadid").val();
                    var gheymatmasrafjadid = $("#gheymatmasrafijadid").val();
                    var takhfifnaghdi = $("#inputPercentNaghdi").val();
                    var takhfifhajmi = $("#percenthajmi").val();
                    var factorid = $("#factorid").val();
                    var tax = $("#percentmailiat").val();
                    var epercent = $("#epercent").val();
                    var eshantionCode = $("#eshantionCode").val();
                    var eshantionPrice = $("#eshantionPrice").val();
                    $.post("page.php",{page:'editEntitySave',productid:productid,factorid:factorid,count:count,oldprice:oldprice,gheymatforooshghadi:gheymatforoshghadim,eshantion:eshantion,gheymatmasrafghadim:gheymatmasrafghadim,gheymatjadid:gheymatjadid,gheymatmasrafjadid:gheymatmasrafjadid,gheymatforooshjadid:gheymatforooshjadid,takhfifnaghdi:takhfifnaghdi,takhfifhajmi:takhfifhajmi,tax:tax,boxin:boxin,eshantionin:eshantionin,feshantion:feshantionstatus,epercent:epercent , eshantionCode:eshantionCode,eshantionPrice:eshantionPrice,entityid:entityid},function (data) {

                         var id = <?php echo $factorid; ?>;
                            $.post('page.php',{page:'getFactorEntery', id:id}, function (data) {

                             $("#result").slideUp();
                              });
                            refresh();


                    });
                })







                </script>
                 <input type="hidden" id="factorid" value="<?php echo  $factorid  ?>" name="factorid">


                <input type="hidden" id="productid" value="<?php echo $id; ?>  ">

                        <div class="col-lg-2 col-md-2 col-xs-2  col-sm-2 form-group" >
                            <label>کد محصول تحت ویرایش</label>
                            <input type="text" class="form-control input-lg" value="<?php echo $rows->productid; ?> ">
                        </div>

                        <div class="col-lg-4 col-md-4 col-xs-4  col-sm-4 form-group" >
                            <label>نام محصول</label>
                            <input type="text" class="form-control input-lg" value="<?php echo $entity->productname; ?> ">
                        </div>



        <div class="col-lg-6 col-md-6 col-xs-6  col-sm-6  form-group" >
            <label>شرکت توزیع کننده </label>
            <input type="text" class="form-control input-lg" value="<?php $company = new company(); $company->getCompanyDetail($entity->productCompany); echo $company->name; ?>">
        </div>


        <div class="col-lg-4 col-sm-4 col-md-4 form-group" >
            <label>تعداد بسته </label>
            <input type="text" id="count" class="form-control input-lg" value="<?php echo $rows->box?>">
        </div>
          <div class="col-lg-4 col-sm-4 col-md-4  form-group" >
            <label>تعداد در هر بسته </label>
            <input type="text" id="inpack" class="form-control input-lg" value="<?php echo $rows->boxin?>">
        </div>

  <div class="col-lg-4 col-sm-4 col-md-4  form-group" >
            <label>تعداد کل </label>
            <input type="text" id="totalcount" class="form-control input-lg" disabled  value="">
        </div>


        <div class="col-lg-2  col-md-2  col-xs-2 form-group" >
            <label>کد کالای اشانتیون</label>
            <input type="text" id="eshantionCode" class="form-control input-lg" value="<?php echo $rows->eshantionCode; ?>">
        </div>



        <div class="col-lg-2 col-md-2 col-xs-2 form-group" >
            <label>نام کالای اشانتیون</label>
            <input type="text" disabled id="eshantionName" class="form-control input-lg" value="">
        </div>


        <div class="col-lg-1 col-xs-1 col-sm-1 form-group" >
            <label>تعداد بسته   </label>
            <input type="text" id="eshantion" class="form-control input-lg" value="<?php echo $rows->eshantion; ?>">
        </div>



            <div class="col-lg-1 col-xs-1 col-sm-1 form-group" >
            <label>تعداد در  بسته  </label>
            <input type="text" id="eshantionin" class="form-control input-lg" value="<?php echo $rows->eshantionin; ?>">
        </div>




           <div class="col-lg-2 col-md-2 col-xs-2 form-group" >
            <label>جمع کل اشانتیون</label>
            <input type="text" disabled id="eshantionCount" class="form-control input-lg" value="">
        </div>


 <div class="col-lg-2  col-md-2 col-xs-2 form-group" >
            <label>قیمت کالای اشانتیون</label>
            <input type="text" id="eshantionPrice" class="form-control input-lg" value="<?php echo $rows->eshantionPrice; ?>">
        </div>



  <div class="col-lg-2 col-md-2 col-xs-2 form-group" >
            <label>جمع کل اشانتیون</label>
            <input type="text" disabled id="eshantionFullPrice" class="form-control input-lg" value="">
        </div>





        <div class="col-lg-4 col-xs-4 col-sm-4 form-group" >
            <label>قیمت واحد قدیم</label>
            <input type="text" id="gheymatghadim"  class="form-control input-lg" value="<?php echo $rows->gheymatghabli; ?>">
        </div>

                <div class="col-lg-4  col-xs-4 col-sm-4 form-group" >
            <label>قیمت مصرف قدیم </label>
            <input type="text" id="gheymatmasrafghadim"  class="form-control input-lg" value="<?php echo $rows->gheymatmasraf;?>">
        </div>

        <div class="col-lg-4  col-xs-4 col-sm-4 form-group" >
            <label>قیمت فروش قدیم </label>
            <input type="text" id="gheymatforoshghadim"   class="form-control input-lg"  value="<?php echo $rows->gheymatforoosh; ?>">
        </div>


        <div class="col-lg-4  col-xs-4 col-sm-4 form-group" >
            <label>قیمت واحد جدید</label>
            <input type="text" id="newprice" class="form-control input-lg" value="<?php echo $rows->price; ?>">
        </div>

                <div class="col-lg-4  col-xs-4 col-sm-4 form-group" >
            <label>قیمت مصرف جدید </label>
            <input type="text" id="gheymatmasrafijadid" class="form-control input-lg" value="<?php echo $rows->currentgheymatmasraf; ?>">
        </div>

        <div class="col-lg-4  col-xs-4 col-sm-4 form-group" >
            <label>قیمت فروش جدید </label>
            <input type="text" id="gheymatforroshjadid" class="form-control input-lg"  value="<?php echo $rows->currentgheymatforrosh; ?>">
        </div>



           <div class="col-lg-2 col-md-2 col-sm-2 form-group" >
            <label>درصد فروش نقدی</label>
            <input type="text" id="inputPercentNaghdi" class="form-control input-lg"  value="<?php echo $rows->discountnaghdi; ?>">
        </div>


        <div class="col-lg-2  col-md-2 col-sm-2  form-group" >
            <label>تخفیف  فروش نقدی</label>
            <input type="text" id="precentnaghdiresult" disabled id="count" class="form-control input-lg" value="">
        </div>

                <div class="col-lg-2 form-group" >
            <label>درصد فروش حجمی</label>
            <input type="text" id="percenthajmi" class="form-control input-lg" value="<?php echo $rows->discounthajmi; ?>">
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2   form-group" >
            <label>تخفیف فروش حجمی </label>
            <input type="text" id="percenthajmiresult" disabled class="form-control input-lg"  value="">
        </div>

                <div class="col-lg-2 col-md-2 col-sm-2  form-group" >
            <label>درصد  مالیات</label>
            <input type="text" id="percentmailiat" class="form-control input-lg" value="<?php echo $rows->tax; ?>">
        </div>

        <div class="col-lg-2  col-md-2 col-sm-2  form-group" >
            <label>افزایش قیمت مالیت</label>
            <input type="text" id="percentmaliatresult" disabled class="form-control input-lg"  value="">
        </div>
            <div class="col-lg-3 col-xs-3 col-sm-3 form-group" >
            <label> درصد تخفیف اشانتیون</label>
            <input type="text"  id="epercent" class="form-control input-lg" value="<?php echo $rows->eshantionpercent; ?>">
        </div>

         <div class="col-lg-3 col-xs-3 col-sm-3 form-group" >
            <label>  مبلغ تخفیف اشانتیون</label>
            <input type="text" disabled id="eprice" class="form-control input-lg" >
        </div>


                <div class="col-lg-3 col-xs-3 col-sm-3  form-group" >
            <label>  قیمت پایانی هر محصول</label>
            <input type="text" disabled id="finalprice" class="form-control input-lg">
        </div>

                <div class="col-lg-3 col-xs-3 col-sm-3  form-group" >
            <label>  قیمت کل فاکتور</label>
            <input type="text" disabled id="finaltotalprice" class="form-control input-lg" >
        </div>
        <div class="form-group col-lg-3 col-md-3">
       <label for="feshantion" style="color: red; font-size: 20px">ضایعات    ؟</label>
        &nbsp;&nbsp;&nbsp;<input type="checkbox" name="feshantion" id="feshantion" >

        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6 ">
            <button id="btnsubmit" class="btn btn-success form-control">ثبت</button>
            </div>



                <?php
            }
           }
            else
                {
                   echo '<script>alert("این محصول یافت نشد ");</script>';
                }
    }




     public function editEntitySave($price,$currentgheymatforrosh,$currentgheymatmasraf,$box,$discounthajmi,$discountnaghdi,$tax,$eshantion,$boxin,$eshantionin,$feshantion,$entityid,$factorid,$epercent,$eshantionCode,$eshantionPrice,$oldprice,$gheymatmasrafghadim,$gheymatforooshghadi)
    {
        $dbconnect = new db();
        echo $entityid;
         $sql = "update factorentity set price = :price , currentgheymatforrosh = :currentgheymatforrosh , currentgheymatmasraf = :cuttentgheymatmasraf , box = :box , boxin = :boxin , eshantion = :eshantion , eshantionin = :eshantionin , discounthajmi = :discounthajmi , discountnaghdi = :discountnaghdi , tax = :tax , feshantion = :feshantion  , eshantionpercent = :eshantionpercent , eshantionCode = :eshantionCode , eshantionPrice = :eshantionPrice  ,gheymatghabli = :gheymatghabli ,gheymatmasraf = :gheymatmasraf ,gheymatforoosh = :gheymatforoosh where id = :entityid";
         $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("price",$price);
        $result->bindParam("entityid",$entityid);
        $result->bindParam("eshantionpercent",$epercent);
        $result->bindParam("currentgheymatforrosh",$currentgheymatforrosh);
        $result->bindParam("cuttentgheymatmasraf",$currentgheymatmasraf);
        $result->bindParam("box",$box);
        $result->bindParam("boxin",$boxin);
        $result->bindParam("discounthajmi",$discounthajmi);
        $result->bindParam("discountnaghdi",$discountnaghdi);
        $result->bindParam("eshantion",$eshantion);
        $result->bindParam("eshantionin",$eshantionin);
        $result->bindParam("tax",$tax);
        $result->bindParam("feshantion",$feshantion);
        $result->bindParam("eshantionCode",$eshantionCode);
        $result->bindParam("eshantionPrice",$eshantionPrice);
        $result->bindParam("gheymatghabli",$oldprice);
        $result->bindParam("gheymatmasraf",$gheymatmasrafghadim);
        $result->bindParam("gheymatforoosh",$gheymatforooshghadi);



        if( $result->execute())
            {
             ?> <script>
            var id = <?php echo $factorid; ?> ;
            $.post("page.php", {page: "viewFactor",id:id}, function (data) {
                $("#content").html(data);



            });

                </script>
                <?php
            }
            else
                {
                    echo ' <br>خطا <br>';
                }

    }




    public function GetFactorData($id)
    {
        $dbconnect = new db();
        $sql = "select * from factor where id = :id";

        $reslut = $dbconnect->connect->prepare($sql);
        $reslut->bindParam('id',$id);
        $reslut->execute();
        if($reslut->rowCount() > '0')
            {
                $data = $reslut->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows)
                    {
                        $this->creator =  $rows->creator;
                        $this->id =  $rows->id;
                        $this->factorid =  $rows->factorid;
                        $this->company =  $rows->company;
                        $this->fullsaved =  $rows->fullsaved;
                        $this->status =  $rows->status;
                    }
            }
    }



    public function CheckFactor($factorid,$company)
    {
       $dbconnect = new db();
       $sql = "select * from factor where factorid = :factorid and company = :company";

       $result = $dbconnect->connect->prepare($sql);
       $result->bindParam("factorid",$factorid);
       $result->bindParam("company",$company);
       $result->execute();

       if($result->rowCount() > '0')
           {
               return '0';
           }
           else
               {
                   return '1';
               }
    }


















    public function ShowFactorByBranchAndStatus($branch,$status)
    {


        $dbconnect = new db();





        $sql = "select * from factor where branch = :branch and status = :status   order by id Desc limit  1000 ";

        $result = $dbconnect->connect->prepare($sql);

                   $result->bindParam("branch",$branch);
                   $result->bindParam("status",$status);



        $result->execute();
        if ($result->rowCount() > '0') {
            $member = new user();
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            ?>
            <script>

             $(".navigation").click(function () {
                var id = this.id;
                var branch = $("#branchid").val();
                $.post("page.php", {page: 'factorList', branch: branch,pageid: id}, function (data) {
                    $("#content").html(data);
                    $('html,body').animate({
                            scrollTop: $("#content").offset().top
                        },
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
            <table class="table table-responsive  table-bordered text-center" > <tr><td>شماره فاکتور</td> <td>شعبه </td> <td>نام شرکت</td><td>تاریخ ایجاد</td> <td>مبلغ</td> <td>سازنده </td> <td> وضعیت</td> <td>مدیریت</td></tr>

<?php
require 'lib/jdf.php';
            foreach ($data as $rows) {
                {
                   ?>
                <tr>
                <td width="10%"><?php echo $rows->factorid; ?> </td>

                <td width="10%"
                ><?php
                 switch ($rows->branch)
                  {
                      case "1":
                          echo '<b style="font-size: 18px;"> زیتون </b>';
                          break;

                      case "2":
                          echo '<b  style="font-size: 18px;"  > باهنر </b>';
                          break;

                      case "3":
                          echo '<b  style="font-size: 18px;"> پاداد </b>';
                          break;

                      case "4":
                          echo '<b  style="font-size: 18px;">  نفت </b>';
                          break;

                      case "5":
                          echo '<b  style="font-size: 18px;"> فاطمی </b>';
                          break;

                            case "6":
                          echo '<b  style="font-size: 18px;">انبار </b>';
                          break;


                  }
                ?>
                </td>


                <td>                <?php $company = new company(); $company->getCompanyDetail($rows->company); echo $company->name;?>                 </td>
                <td><?php echo jdate("d:F:Y",$rows->time,'','','en'); ?> </td>
                  <td class="text-center"><b><?php echo number_format($rows->fullprice); ?></b> </td>

                <td><?php  $member->getUserData($rows->creator); echo $member->name; ?> </td>
                <td><?php
                if($rows->status == '0')
                    {
                        echo '<b style="color:red">تایید نشده </b>';
                    }

                    if($rows->status == '1')

                    {
                         echo '<b style="color:blue"> تایید شده </b>';

                       }

                        if($rows->status == '2')
                    {
                         echo '<b style="color:orange">منتظر ثبت</b>';

                       }

                              if($rows->status == '3')
                    {
                         echo '<b style="color:green">ثبت شده </b>';

                       }

                         if($rows->status == '6')
                    {
                         echo '<b style="color:green">فاکتور باز  </b>';

                       }



                       ?> </td>
                <td  width="15%"><button class="btn btn-info view" id="<?php echo $rows->id; ?>" >مشاهده</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="deletefactor.php?factorid=<?php echo $rows->id; ?>"> <button class="btn btn-danger" id="<?php echo $rows->id; ?>" >حذف</button></a></td>
                </tr>

                <?php
                }



            }
                echo '</table>';

        } else {
            echo 'هنوز هیچ فاکتوری صادر نشده است';

        }

    }








    public function UpdatePrice($factorid , $fullprice , $sood,$CoType)
    {
        $dbconnect = new db();

        $sql = "update factor set fullprice = :fullprice , fullsood = :fullsood  ,CoType = :CoType, fullsaved = '1' where id = :id";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$factorid);
        $result->bindParam("fullprice",$fullprice);
        $result->bindParam("fullsood",$sood);
        $result->bindParam("CoType",$CoType);


        $result->execute();

        if($result->rowCount() > '0')
            {
                echo 'دخیره اطلاعات با موفقیت به اتمام رسید';
            }
            else
                {
                    echo 'خطا در ثبت اطلاعات';
                }
    }





public function GetFactorSoodDetail($from , $to , $CoType  )
{
    $this->GetFactorSoodDetailCount($from,$to);

$number = '1';
$FullPrice = '0';
$FullSood  =  '0';
$dbconnect = new db;
if($CoType == "3")
{
    $sql = "select * from factor where time > :from and  time < :to  order by time";
}
else
{
    $sql = "select * from factor where time > :from and  time < :to and CoType = :CoType order by time";
}

$result = $dbconnect->connect->prepare($sql);

$result->bindParam("from" ,$from);
if($CoType != "3")
{
    $result->bindParam("CoType" ,$CoType);
}

$result->bindParam("to" ,$to);

$result->execute();
?>
                <table class="table table-responsive table-bordered table-responsive table-striped text-center">
                    <thead>
                    <td>ردیف </td>
                    <td>شماره فاکتور</td>
                    <td> نام شرکت</td>
                    <td>تاریخ </td>
                    <td> مبلغ فاکتور</td>
                    <td>درصد سود </td>
                    <td> مبلغ سود</td>
                    </thead>
                    <tbody>
                    <?php
                    if($result->rowCount() > '0')
                    {
                        $company = new company();
                        $data = $result->fetchAll(PDO::FETCH_OBJ);
                        foreach ($data as $rows)
                        {
                            $company->getCompanyDetail($rows->company);
                            ?>
                            <tr>
                                <td><?php echo $number; ?> </td>
                                <td><?php echo $rows->factorid; ?></td>
                                <td>  <?php echo $company->name; ?></td>
                                <td><?php echo jdate('Y:m:d',$rows->time , '','','en') ; ?> </td>
                                <td>  <?php echo $rows->fullprice; ?></td>
                                <td><?php echo $rows->fullsood; ?>  </td>
                                <td><?php $soodPrice = (($rows->fullprice / 100) * $rows->fullsood)  ; echo $soodPrice;  $FullSood =  $FullSood + $soodPrice;?></td>
                                <?php $FullPrice = $FullPrice + $rows->fullprice; ?>
                            </tr>
                            <?php
                            $number = $number + 1;
                        }

                    }
                    ?>
                    <thead>
                    <td><b>جمع کل خرید:</b></td>
                    <td> <?php echo number_format($FullPrice); ?> </td>
                    <td> <b>جمع کل سود:</b></td>
                    <td><?php echo number_format($FullSood); ?></td>
                    <td> <b>درصد دقیق سود:</b> </td>
                    <td><?php $soodPercent = ('100' / $FullPrice) * $FullSood ; echo number_format(round($soodPercent , 1));?> </td>
                    <td></td>
                    </thead>

    <?php
}






    public function GetFactorSoodDetailCount($from , $to )
    {
    $number = '1';
    $FullPrice = '0';
    $FullSood  =  '0';
    $dbconnect = new db;
    $sql = "select * from factor where time > :from and  time < :to ";

    $result = $dbconnect->connect->prepare($sql);

    $result->bindParam("from" ,$from);
    $result->bindParam("to" ,$to);

    $result->execute();
    ?>

                        <?php
                        if($result->rowCount() > '0')
                        {

                            $this->count = $result->rowCount();

                        }
                        ?>


    <?php
}





public  function  UpdateFactorRank($id,$rank)
{
    $dbconnect = new db();
    $sql = "update factor set rank = :rank where id = :id";

    $result = $dbconnect->connect->prepare($sql);

    $result->bindParam("id",$id);
    $result->bindParam("rank",$rank);
    $result->execute();

    if($result->rowCount() > '0')
    {
        echo 'نمره با موفقیت ثبت شد';
    }
}




public function SaveToArvhive($id)
{
    $dbconnect = new db();
    $sql = "update factor set takhfiflist = '1' where id = :id";

    $result = $dbconnect->connect->prepare($sql);

    $result->bindParam("id",$id);
    $result->execute();

    if($result->rowCount() > '0')
    {
        echo ' با موفقیت در آرشیو این ماه ذخیره شد';
    }
}



public  function getFactorDiscount()
{
    require 'lib/jdf.php';
    $dbconnect = new db();
    $sql = "select * from factor where takhfiflist = '1'";
    $result = $dbconnect->connect->prepare($sql);

    $result->execute();

    if($result->rowCount() > '0')
    {
        ?>
<script>
  $(".view").click(function () {
            var id = this.id;
            $.post("page.php", {page: 'viewFactor',id:id}, function (data) {
                $("#content").html(data);



            });
        });
</script>
          <br>
            <table class="table table-bordered table-responsive table-striped table-hovered text-center">
                <thead>
                <td>ردیف  </td>
                <td>شماره فاکتور </td>
                <td>نام شرکت</td>
                <td>تاریخ  </td>
                <td>مشاده  </td>
                <td>حذف از لیست  </td>
                </thead>

            <?php

            $data = $result->fetchAll(PDO::FETCH_OBJ);

            $count = '0';

            $company = new company();

            foreach ($data as $rows)
            {
                $company->getCompanyDetail($rows->company);
                ?>
                  <tbody>
                <td><?php $count = $count + 1; echo $count; ?> </td>
                <td> <?php echo $rows->factorid;?> </td>
                <td> <?php echo $company->name;?></td>
                <td><?php echo jdate('Y/m/d',$rows->time , '' , '','en'); ?> </td>
                <td><button class="btn btn-primary btn-lg input-lg form-control view"  id="<?php echo $rows->id; ?>">مشاهده</button>  </td>
                <td> <a href="RemoveFromTakhfif.php?id=<?php echo $rows->id; ?>" target="_blank" ><button class="btn btn-danger form-control btn-lg input-lg">حذف</button> </a>  </td>
                </tbody>
                <?php

                
            }


           ?>
            </table>
        
            <?php
        }
        else
        {
            echo 'هیچ فاکتوری در این بازه زمانی از این کاربر وجود ندارد ';
        }





    }


    public function RemoveFromTakhfif($id)
    {
        $dbconnect = new db();
        $sql = "update factor set takhfiflist = '0' where id = :id";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);

        $result->execute();

        if($result->rowCount() > '0')
            {
                ?>
                    <h1>فاکتور با موفقیت از لیست تخفیف ها حذف گردید</h1>
    <?php
            }
    }




   public function  UpdateFactorData($id , $factorid , $comoany , $time)
   {

       $dbconnect = new db();
       $sql = "update factor set factorid = :factorid , company = :company , time = :time where id = :id";

       $result = $dbconnect->connect->prepare($sql);
       $result->bindParam("id",$id);
       $result->bindParam("factorid",$factorid);
       $result->bindParam("company",$comoany);
       $result->bindParam("time",$time);


       $result->execute();

       if($result->rowCount() > '0')
           {
               echo 'با موفقیت ویرایش شد';
           }
           else
               {
                   echo 'خطا در ویرایش ';
               }
   }

   
   
    public function ViewOpenFactorList()
    {


         require 'lib/jdf.php';
    $dbconnect = new db();
    $sql = "select * from factor where close = '0' and status = '3'";
    $result = $dbconnect->connect->prepare($sql);

    $result->execute();

    if($result->rowCount() > '0')
    {
        ?>

          <br>
            <table class="table table-bordered table-responsive table-striped table-hovered text-center">
                <thead>
                <td>ردیف  </td>
                <td>شماره فاکتور </td>
                <td>نام شرکت</td>
                <td>تاریخ  </td>
                <td>بستن فاکتور  </td>
                </thead>

            <?php

            $data = $result->fetchAll(PDO::FETCH_OBJ);

            $count = '0';

            $company = new company();

            foreach ($data as $rows)
            {
                $company->getCompanyDetail($rows->company);
                ?>
                  <tbody>
                <td><?php $count = $count + 1; echo $count; ?> </td>
                <td> <?php echo $rows->factorid;?> </td>
                <td> <?php echo $company->name;?></td>
                <td><?php echo jdate('Y/m/d',$rows->time , '' , '','en'); ?> </td>
                <td><a target="_blank" href="CloseSingleFactor.php?id=<?php echo $rows->id;?>"> <button class="btn btn-warning btn-lg input-lg form-control "  id="<?php echo $rows->id; ?>">بستن فاکتور</button>  </td>
               </tbody>
                <?php


            }


           ?>
            </table>

            <?php
        }
        else
        {
            echo 'هیچ فاکتوری در این بازه زمانی از این کاربر وجود ندارد ';
        }





    }



    public function GiveOneFactorRows($id)
    {
        $entity  = new entity();

        $dbconnect = new db();
        $sql = "select * from factorentity  where factorid = :factorid";
        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("factorid",$id);

        $result->execute();

        if($result->rowCount() > '0')
            {
                $data = $result->fetchAll(PDO::FETCH_OBJ);

                foreach ($data as $rows)
                    {
                        $entity->OneEntityRowClose($rows->id);
                    }
            }

    }


    public  function SetClosedFactor($id)
    {
        $dbconnect = new db();
        $sql = "update factor set close = '1' where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->execute();
        if($result->rowCount() > '0')
            {
                echo 'فاکتو با موفقیت بسته شد';

            }
            else
                {
                    echo 'خطا در بستن فاکتور';
                }

    }





       public  function getAllFactorForUpdate()
    {
        $dbconnect = new db();
        $sql = "select * from factor";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->execute();
        if($result->rowCount() > '0')
            {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows)
                    {
                                  echo file_get_contents("http://192.168.1.3:1234/shop/UpdateFactorStatusAuto.php?id=$rows->id&Save=$rows->saver&status=$rows->status");
}
                    }

            else
                {
                    echo 'خطا در بستن فاکتور';
                }

    }



    public  function UpdateFactorAutomatic($id,$saver,$statuus)
    {
        $dbconnect = new db();
        $sql = "update factor set status = :status , saver = :saver where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("saver",$saver);
        $result->bindParam("status",$statuus);
        $result->execute();
        if($result->rowCount() > '0')
            {
                echo 'فاکتو با موفقیت بسته شد';

            }
            else
                {
                    echo 'خطا در بستن فاکتور';
                }

    }

    public function InsetNewZayeatRow($factorid,$productid , $Price , $count)
    {
        $dbconnect = new db();
        $yek = "1";
        $sql = "insert into factorentity (factorid,productid , price , feshantion , box , boxin) values (:factorid,:productid , :price , $yek , $yek , :boxin) ";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("factorid",$factorid);
        $result->bindParam("productid",$productid);
        $result->bindParam("price",$Price);
        $result->bindParam("boxin",$count);

        $result->execute();

        if($result->rowCount() > 0)
            {
                echo '1';
            }
            else
                {
                    echo '0';
                    var_dump($result->errorCode());
                }

    }


public function getAllFactorBetweenData($from,$to , $productid)
{
    $product = new product();
    $dconnect = new db();
    $sql = "select * from factor where time > :from and time  < :to";

    $result = $dconnect->connect->prepare($sql);

    $result->bindParam("from",$from);
    $result->bindParam("to",$to);

    $result->execute();

    $array = array();
    if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
                {
                    array_push($array , $rows->id);
                }


                    $product->getProductBuyReport($productid,$array);

        }



}



    public  function UpdateZayeat($id,$userid)
    {
        $dbconnect = new db();
        $sql = "update factor set trash =   :userid where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("userid",$userid);
        $result->execute();
        if($result->rowCount() > '0')
            {
                echo 'ضایعات با موفقیت ثبت شد';

            }
            else
                {
                    echo 'خطا در ثبت ضایعات';
                }

    }






    public function OpenFactore($factorid)
    {
    $dbconnect = new db();

    $sql = "update factor set status = 6 where id = :id";

    $result = $dbconnect->connect->prepare($sql);

    $result->bindParam("id",$factorid);

    $result->execute();

        if($result->rowCount() > 0)
        {
            ?>فاکور با موفقیت باز شد<?php
        }
        else
        {
            ?>خطا در باز باز کردن فاکتور<?php
        }
}








    public function CloseFactore($factorid)
    {
    $dbconnect = new db();

    $sql = "update factor set status = 3 where id = :id";

    $result = $dbconnect->connect->prepare($sql);

    $result->bindParam("id",$factorid);

    $result->execute();

    if($result->rowCount() > 0)
    {
        ?>فاکور با موفقیت بسته  شد<?php
    }
    else
    {
    ?>خطا در باز بستن فاکتور<?php
}
}


}


?>