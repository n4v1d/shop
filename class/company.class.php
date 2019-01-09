<?php
class company
{
    public $name;
    public function getCompanyDetail($id)
    {
        $dbconnect = new db();
        $sql = "select * from company where code = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->execute();
        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $this->name = $rows->name;

            }
        }
    }


    public function addCompany($code,$name,$address,$tel)
    {
        $dbconnect = new db();
        $sql = "insert into company (code,name,address,tel) values (:code,:name,:address,:tel)";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("code",$code);
        $result->bindParam("name",$name);
        $result->bindParam("address",$address);
        $result->bindParam("tel",$tel);
        if($result->execute())
        {
            echo 'عملیات ثبت شرکت با موفقیت انجام شد ';
        }
        else
        {
            echo 'خطا';
        }

    }


    public function searchName($name)
    {
        $dbconnect = new db();
        $query='SELECT * FROM company WHERE name LIKE :search';
        $stmt= $dbconnect->connect->prepare($query);
        $stmt->execute(array(':search' => '%'.$name.'%'));

        if($stmt->rowCount() > '0')
        {
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            ?>
            <script>
                $(".companylink").click(function () {
                    var id = this.id;
                    $("#companyCreator").val(id);

                });


            </script>
            <?php
            foreach ($data as $rows)
            {
                ?>
                <a href="#<?php echo $rows->code; ?>" data-dismiss="modal" class="companylink" id="<?php echo $rows->code; ?>" ><?php echo $rows->name; ?></a><br><br>

<?php
            }

        }
        else
        {
            echo 'هیچ توزیع کننده ای با این نام پیدا نشد';
        }


    }







    public function Companyfactorlist($pageid = null,$companycode = null)
    {
        $branchClass = new branch();


                if(strlen($pageid) > '0')
                    {
                        $start = $pageid * '10' ;
                    }
                    else
                        {
                            $start = '0';
                        }

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


     if(strlen($companycode) > '0')
            {


        $sql = "select * from factor where company = :company order by id Desc limit $start,20 ";
        }
               else
         {
            $sql = "select * from factor where company = :company order by id Desc limit $start,20 ";

         }



$member = new user();


        $result = $dbconnect->connect->prepare($sql);
                          if(strlen($companycode) > '0')
               {
                   $result->bindParam("company",$companycode);
               }
        $result->execute();
        if ($result->rowCount() > '0') {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            ?>


            <script>

                $(".navigations").click(function () {
                var id = this.id;
                var company = <?php echo $companycode; ?>;
                $.post("page.php", {page: 'CompanyfactorList', company: company,pageid: id}, function (data) {
                    $("#content").html(data);
                    $('html,body').animate({
                            scrollTop: $("#content").offset().top
                        },
                        'slow')
                        });

                    });

                        $(".view").click(function () {
                    var id = this.id;
                    $.post("page.php", {page: 'viewFactor',id:id}, function (data) {
                        $("#content").html(data);
                        });
                    });



    </script>

            <table class="table table-responsive  table-bordered text-center" > <tr><td>شماره فاکتور</td> <td>شعبه </td> <td>نام شرکت</td><td>تاریخ ایجاد</td><td>مبلغ</td>  <td>سازنده </td><td> وضعیت</td> <td>مدیریت</td></tr>

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

                <td><?php  $member->getUserData($rows->creator); echo $member->name; ?> </td>                <td><?php

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

                       ?> </td>
                <td  width="15%"><button class="btn btn-info view" id="<?php echo $rows->id; ?>" >مشاهده</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="deletefactor.php?factorid=<?php echo $rows->id; ?>"> <button class="btn btn-danger" id="<?php echo $rows->id; ?>" >حذف</button></a></td>
                </tr>

                <?php
                }



            }

                echo '</table>';
                echo $this->pagination($companycode);

        } else {
            echo 'هنوز هیچ فاکتوری صادر نشده است';

        }

    }



















    public function CompanyfactorlistbyBranch($companycode , $branch  , $form , $to)
    {

        $branchClass = new branch();


          $dbconnect = new db();

          if($branch == "70")
              {
                   if($companycode == "-")
              {
                          $sql = "select * from factor where time < :to  and  time > :from order by id Desc limit 0,500 ";

              }
              else
                  {
                                                $sql = "select * from factor where company = :company and time < :to  and  time > :from order by id Desc limit 0,500 ";

                  }


              }
              else
                  {
                                  if($companycode == "-")
              {
        $sql = "select * from factor where  branch = :branch and time < :to  and  time > :from order by id Desc limit 0,500 ";

              }
              else
                  {
        $sql = "select * from factor where company = :company and branch = :branch and time < :to  and  time > :from order by id Desc limit 0,500 ";

                  }



                  }



$member = new user();


        $result = $dbconnect->connect->prepare($sql);

                           if($companycode != "-")
                       {
                   $result->bindParam("company",$companycode);

                       }

                   if($branch != "70")
                       {
                                              $result->bindParam("branch",$branch);

                       }
                   $result->bindParam("from",$form,PDO::PARAM_INT);
                   $result->bindParam("to",$to,PDO::PARAM_INT);

        $result->execute();
        if ($result->rowCount() > '0') {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            ?>


            <script>

                $(".navigations").click(function () {
                var id = this.id;
                var company = <?php echo $companycode; ?>;
                $.post("page.php", {page: 'CompanyfactorList', company: company,pageid: id}, function (data) {
                    $("#result").html(data);
                    $('html,body').animate({
                            scrollTop: $("#result").offset().top
                        },
                        'slow')
                        });

                    });

                        $(".view").click(function () {
                    var id = this.id;
                    $.post("page.php", {page: 'viewFactor',id:id}, function (data) {
                        $("#content").html(data);
                        });
                    });



    </script>

            <table class="table table-responsive  table-bordered text-center" > <tr><td>شماره فاکتور</td> <td>شعبه </td> <td>نام شرکت</td><td>تاریخ ایجاد</td><td>مبلغ</td> <td style="background:cadetblue;">فرانچایز</td>  <td>سازنده </td><td> وضعیت</td> <td>مدیریت</td></tr>

<?php
//require 'lib/jdf.php';
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




                   <td class="text-center"><h4><?php echo number_format($rows->fullprice); ?></h4> </td>
                   <td style="background:cadetblue;" class="text-center"><h4><?php $fc = $rows->fullprice + (($rows->fullprice / 100) * 5); echo number_format($fc); ?></h4> </td>





                <td><?php  $member->getUserData($rows->creator); echo $member->name; ?> </td>                <td><?php


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



                       ?> </td>
                <td  width="15%"><button class="btn btn-info view" id="<?php echo $rows->id; ?>" >مشاهده</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="deletefactor.php?factorid=<?php echo $rows->id; ?>"> <button class="btn btn-danger" id="<?php echo $rows->id; ?>" >حذف</button></a></td>
                </tr>

                <?php
                }



            }

                echo '</table>';

        } else {
            echo 'هنوز هیچ فاکتوری صادر نشده است';
            echo '<br>' . $result->errorCode();
            ;

        }

    }

































    public function CompanyfactorlistByFactorid($factorid)
    {
        $branchClass = new branch();
 ?>
         <script>



                   $(".view").click(function () {
                                    var id = this.id;
                                    $.post("page.php", {page: 'viewFactor',id:id}, function (data) {
                                        $("#content").html(data);
                                        });
                                    });



    </script>
    <?php

        $member = new user();



        $dbconnect = new db();




        $sql = "select * from factor where factorid   LIKE ? order by id Desc limit 50 ";

        $result = $dbconnect->connect->prepare($sql);

                $result->execute(array("%$factorid%"));


                   //$result->bindParam("factorid",$factorid);

        $result->execute();

        if ($result->rowCount() > '0') {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            ?>




            <table class="table table-responsive  table-bordered" > <tr><td>شماره فاکتور</td> <td>شعبه </td> <td>نام شرکت</td><td>تاریخ ایجاد</td><td>مبلغ</td>  <td>سازنده </td> <td> وضعیت</td> <td>مدیریت</td></tr>

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

                <td><?php  $member->getUserData($rows->creator); echo $member->name; ?> </td><td>
                <?php

                        if($rows->status == '0')

                        {
                            echo '<b style="color:red">تایید نشده </b>';

                        }

                            if($rows->status == '1')
                            {
                                echo '<b style="color:blue">تایید شده </b>';

                            }

                             if($rows->status == '2')
                            {
                                echo '<b style="color:orange"> منتظر ثبت </b>';

                            }

                              if($rows->status == '3')
                            {
                                echo '<b style="color:green"> ثبت شده  </b>';

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




    public function pagination($companycode)
    {

            $dbconnect = new db();


        $user = new user();
        $user->getUserData($_SESSION['UserName']);
        $userid = $_SESSION['UserId'];
        $userlevel =  $_SESSION['UserLevel'];


   if(strlen($companycode) > '0')
            {


        $sql = "select * from factor where company = :company ";
        }
               else
         {
            $sql = "select * from factor order by id Desc  ";

         }

$result = $dbconnect->connect->prepare($sql);
              $result->bindParam("company",$companycode);



        $result->execute();
        $data = $result->rowCount() / '10';
        echo '<nav aria-label="صفحات"><ul class="pagination pagination-lg">';
        for ($i = '0'; $i<$data ; $i++) {
            ?>
            <input type="hidden" id="companycode" value="<?php echo $companycode; ?>">
            <li><a class="navigations" href="#" id="<?php echo $i; ?>"><?php echo $i+1 ; ?> </a></li>
            <?php
        }
        echo '</ul></nav>';
    }






public function GetLastCompanyList()
{
$dbconnect = new db();
$sql = "select * from company order by id Desc limit 0,50";

$result = $dbconnect->connect->prepare($sql);

$result->execute();
?>
                <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 col-lg-offset-4 col-md-offset-4 col-xs-offset-4 col-sm-offset-4 text-center">
                    <table class="table table-bordered table-hover table-striped table-responsive">
                        <thead>
                        <td>کد شرکت</td>
                        <td>نام شرکت</td>
                        </thead>
                        <tbody>
                        <?php
                        if($result->rowCount() > 0)
                        {
                        $data = $result->fetchAll(PDO::FETCH_OBJ);

                        foreach ($data as $rows)
                        {
                        ?>
                        <tr>
                            <td><?php echo $rows->code; ?></td>
                            <td><?php  echo $rows->name;?></td>
                        </tr>
    <?php
}
}
    echo '</div>';

}


}