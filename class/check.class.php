<?php

class check
{
    public $daySum;


    public $id;
    public $company;
    public $title;
    public $price;
    public $time;
    public $status;
    public $type;

    public function UpdateCheckLenth($factorid,$len , $time)
    {
        $dbconnect = new db();
        $sql = "update factor set check_len = :check_len , check_date = :check_date where id = :id";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$factorid);
        $result->bindParam("check_len",$len);
        $result->bindParam("check_date",$time);

        $result->execute();


        if($result->rowCount()>0)
        {
            echo 'چک برای تاریخ :' . jdate('Y/m/d',$time,'','','en') . ' ثبت شد ';
        }
        else
        {
            echo 'خطا در ثبت';
        }


    }








    // Check Page Data


    public function GetUnCheckData($day , $month , $year)
    {
        $company = new company();
        $dbconnect = new db();
        $from = jmktime("00","00","01",$month,$day,$year);
        $to = jmktime("23","59","59",$month,$day,$year);

        $sql = "select * from chek where time > $from and time < $to and status = '0' ";
        $result = $dbconnect->connect->prepare($sql);
        $result->execute();
        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {

                $company->getCompanyDetail($rows->company);
                ?><a target="_blank" href="EditCheck.php?id=<?php echo $rows->id; ?>"> <span> <?php echo $company->name ."  /  " .$rows->title."  /  " .number_format($rows->price) ; ?></span></a><br> <?php


            }
        }
        else
        {
            echo 'چکی ثبت نشده است';
        }

    }




    public function GetCheckData($day , $month , $year)
    {
        $company = new company();
        $dbconnect = new db();
        $from = jmktime("00","00","01",$month,$day,$year);
        $to = jmktime("23","59","59",$month,$day,$year);

        $sql = "select * from chek where time > $from and time < $to and status > '0' ";
        $result = $dbconnect->connect->prepare($sql);
        $result->execute();
        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {

                $company->getCompanyDetail($rows->company);
                ?><a target="_blank" href="EditCheck.php?id=<?php echo $rows->id; ?>"> <b

                    <?php
                    if($rows->status == "2")
                    {
                        ?>
                        style="background-color: #00dd28; color: #000000"
                        <?php
                    }


                    if($rows->status == "3")
                    {
                        ?>
                        style="background-color: #dd1214; color: #fff"
                        <?php
                    }

                    ?>
                > <?php echo $company->name ."  /  " .$rows->title."  /  " .number_format($rows->price) ; ?></b></a><br> <?php


            }
        }
        else
        {
            echo 'چکی ثبت نشده است';
        }

    }




    public function GetUnCheckSumData($day , $month , $year)
    {
        $fullyPrice = "0";
        $dbconnect = new db();
        $from = jmktime("00","00","01",$month,$day,$year);
        $to = jmktime("23","59","59",$month,$day,$year);

        $sql = "select * from chek where time > $from and time < $to  and status = '0' ";
        $result = $dbconnect->connect->prepare($sql);
        $result->execute();
        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $fullyPrice = $fullyPrice + $rows->price;

            }
            $this->daySum = $fullyPrice;
            echo number_format($this->daySum);
        }

    }



    public function GetCheckSumData($day , $month , $year)
    {
        $fullyPrice = "0";
        $dbconnect = new db();
        $from = jmktime("00","00","01",$month,$day,$year);
        $to = jmktime("23","59","59",$month,$day,$year);

        $sql = "select * from chek where time > $from and time < $to  and status > '0' ";
        $result = $dbconnect->connect->prepare($sql);
        $result->execute();
        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $fullyPrice = $fullyPrice + $rows->price;

            }
            $this->daySum = $fullyPrice;
            echo number_format($this->daySum);
        }

    }


    public function GetSingleCheckData($id)
    {
        $dbconnect = new db();
        $sql = "select * from chek where id = :id";

        $resiult = $dbconnect->connect->prepare($sql);

        $resiult->bindParam("id",$id);
        $resiult->execute();

        if($resiult->rowCount() > 0)
        {
            $data = $resiult->fetchAll(PDO::FETCH_OBJ);

            foreach ($data as $rows)
            {
                $this->status = $rows->status;
                $this->title = $rows->title;
                $this->company = $rows->company;
                $this->time = $rows->time;
                $this->price = $rows->price;
                $this->id = $rows->id;
            }
        }
    }


    public function UpdateCheck($id,$status,$time,$title,$price,$company)
    {
        $dbconnect = new db();
        $sql = "update chek set time = :time , title = :title , status = :status  , price = :price , company = :company  where id = :id";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$id);
        $result->bindParam("time",$time);
        $result->bindParam("title",$title);
        $result->bindParam("status",$status);
        $result->bindParam("price",$price);
        $result->bindParam("company",$company);

        $result->execute();


        if($result->rowCount() > 0)
        {
            echo 'با موفقیت ویرایش شد';
        }
        else
        {
            echo 'خطا';
            echo var_dump($result->errorInfo());
        }
    }





    public function InsertCheck($status,$time,$title,$price,$company)
    {
        $dbconnect = new db();
        $sql = "insert into chek (company,title,time,status,price) values (:company,:title,:time,:status,:price)";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("time",$time);
        $result->bindParam("title",$title);
        $result->bindParam("status",$status);
        $result->bindParam("price",$price);
        $result->bindParam("company",$company);

        $result->execute();


        if($result->rowCount() > 0)
        {
            echo 'با موفقیت ثبت شد';
        }
        else
        {
            echo 'خطا';
            echo var_dump($result->errorInfo());
        }
    }








    public function GetUnConfirmedCheck()
    {

        $branch = new branch();

        require 'lib/jdf.php';
        $dbconnect = new db();
        $company = new company();
        $sql = " select * from factor  where check_confirm = 0  and time > '1540243861' and branch = '6'";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        ?>
        <script>
            $(".view").click(function () {
                var id = this.id;
                $.post("page.php", {page: 'viewFactor', id: id}, function (data) {
                    $("#content").html(data);


                });
            });

        </script>
        <form method="get" action="Check_List.php">
            <input  class="btn btn-lg btn-success" type="submit" style="position: fixed;z-index: 1000" value="ثبت دسته ای">
            <table class="table table-hover table-bordered table-striped table-responsive">

                <thead class="text-center">
                <td>ردیف</td>
                <td>انتخاب</td>
                <td>شماره فاکتور</td>
                <td>تاریخ فاکتور</td>
                <td>نام شرکت</td>
                <td>نام شرکت</td>
                <td>مبلغ چک</td>
                <td>وضعیت</td>
                <td>مدت</td>
                <td>ثبت</td>
                </thead>
                <tbody class="text-center">

                <?php

                if($result->rowCount() > 0)
                {
                    $data = $result->fetchAll(PDO::FETCH_OBJ);
                    $id = 1;
                    foreach ($data as $rows)
                    {
                        $branch->GetBranchNameById($rows->branch);
                        $company->getCompanyDetail($rows->company);
                        ?><tr>

                        <td><?php echo $id ?></td>
                        <td><input class="input-lg form-control checkbox " type="checkbox" name="check_list[]" value="<?php echo $rows->id; ?>"></td>
                        <td><b class="view" id="<?php echo $rows->id; ?>"><?php echo $rows->factorid; ?></b></td>
                        <td><?php echo jdate('Y/m/d' , $rows->time , '','','en');?></td>
                        <td><?php echo $company->name;?></td>
                        <td><?php echo $branch->name; ?></td>
                        <td><?php if($rows->fullprice > 0 )
                            {
                                echo number_format($rows->fullprice);
                            }
                            ?></td>
                        <td><?php echo  $rows->status ?> </td>
                        <td style="width: 10%;">
                            <input type="text"  id="len<?php echo $rows->id; ?>" class="form-control input-lg">
                        </td>
                        <td style="width: 10%;"><input type="button" id="<?php echo $rows->id; ?>" class="input-lg form-control btn btn-lg btn-primary sve" value="ثبت"></td>
                        </tr>

                        <?php
                        $id = $id + 1;
                    }
                }
                ?>
        </form>
        <script>
            $(".sve").click(function () {
                $("#content").loading();

                var id =this.id;
                var Lenid = "len"+this.id;
                var len = $("#"+Lenid).val();
                $.post('page.php',{page:'SaveCheckLength',id:id,len:len},function (data) {
                    if(data == 1)
                    {
                        alert('با موفقیت ثبت شد');
                        refresh();



                    }
                    else
                    {
                        alert('خطا');
                        refresh();

                    }
                });

            });



            function refresh() {
                $.post('page.php',{page:'ConfirmCheck'}, function (data) {
                    $("#content").loading('stop');
                    $("#content").html(data);
                });
            }




        </script>
        <?php
    }







    public function GetWaitedCheck()
    {

        ?>
        <script>
            function myFunction(data) {
                window.open("CheckView.php?CheckId=" + data, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=800,left=800,width=800,height=800");
            }

        </script>
        <?php
        $branch = new branch();

        require 'lib/jdf.php';
        $dbconnect = new db();
        $company = new company();
        $sql = " select * from factor  where check_confirm = 5  and time > '1540243861' and branch = '6' order by time";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        ?>
        <form method="get" action="Check_List.php">
            <input  class="btn btn-lg btn-success" type="submit" style="position: fixed;z-index: 1000" value="ثبت دسته ای">
            <table class="table table-hover table-bordered table-striped table-responsive">

                <thead class="text-center">
                <td>ردیف</td>
                <td>انتخاب</td>
                <td>شماره فاکتور</td>
                <td>تاریخ فاکتور</td>
                <td>نام شرکت</td>
                <td>مدت</td>
                <td>تاریخ</td>
                <td>مبلغ چک</td>
                <td>وضعیت</td>
                <td>مدت</td>
                <td>تایید</td>
                </thead>
                <tbody class="text-center">

                <?php

                if($result->rowCount() > 0)
                {
                    $data = $result->fetchAll(PDO::FETCH_OBJ);
                    $id = 1;
                    foreach ($data as $rows)
                    {
                        $branch->GetBranchNameById($rows->branch);
                        $company->getCompanyDetail($rows->company);
                        ?><tr>

                        <td><?php echo $id ?></td>
                        <td><input class="input-lg form-control checkbox " type="checkbox" name="check_list[]" value="<?php echo $rows->id; ?>"></td>
                        <td><?php echo $rows->factorid; ?></td>
                        <td><?php echo jdate('Y/m/d' , $rows->time , '','','en');?></td>
                        <td><?php echo $company->name;?></td>
                        <td><?php echo $rows->check_len; ?></td>
                        <td><?php
                            $time = $rows->time + ($rows->check_len * 86400);
                            echo jdate('Y/m/d' , $time , '','','en');
                            ?></td>
                        <td><?php if($rows->fullprice > 0 )
                            {
                                echo number_format($rows->fullprice);
                            }
                            ?></td>
                        <td><?php echo  $rows->status ?> </td>
                        <td style="width: 10%;">
                            <input type="text"  id="len<?php echo $rows->id; ?>" class="form-control input-lg">
                        </td>
                        <td style="width: 10%;"><input type="button" id="<?php echo $rows->id; ?>"   class="input-lg form-control btn btn-lg btn-success sve " value="تایید نهایی"></td>
                        </tr>

                        <?php
                        $id = $id + 1;
                    }
                }
                ?>
        </form>
        <script>
            $(".sve").click(function () {
                var id =this.id;
                var Lenid = "len"+this.id;
                var len = $("#"+Lenid).val();

                $.post('page.php',{page:'SaveCheckLengthFinal',factorid:id,len:len},function (data) {
                    if(data == 1)
                    {
                        alert('با موفقیت ثبت شد');

                    }
                    else
                    {
                        alert('خطا');
                    }
                });

            });
        </script>
        <?php
    }






    public function InsertCheckData($id,$len)
    {
        $dbconnect = new db();

        $factor = new factor();

        $factor->getFactorDetail($id);

        $date = $factor->time + ('86400' * $len);


        $sql = "update factor set check_len = :len , check_date = :check_date , check_confirm = '1' where id = :id";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$id);
        $result->bindParam("check_date",$date);
        $result->bindParam("len",$len);

        $result->execute();

        if($result-> rowCount() > 0)
        {
            echo '1';

        }
        else
        {
            echo '0';
        }

    }




    public function ChangeCheckType($id,$type)
    {
        $dbconect = new db();
        $sql = "update checks set check_type = :type where id = :id";
        $result = $dbconect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("type",$type);

        $result->execute();

        if($result->rowCount() > 0)
        {
            echo 'با موفقت تغییر یافت';
        }
        else
        {
            echo 'خطا در تغییر اطلاعات';
        }
    }





}
?>