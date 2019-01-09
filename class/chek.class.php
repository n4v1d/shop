<?php

class chek
{

    public $id;
    public $factorid;
    public $factorNumber;
    public $company;
    public $title;
    public $price;
    public $time;
    public $time_check;
    public $len;
    public $status;


    public $check_list_fullprice = 0;


    public function InsertNewCheck($company , $title , $price , $time , $time_check,$len,$status,$factorid,$factorNumber,$message = null,$check_id = null)
    {
        $dbconnect = new db();

        $sql = "insert into checks (factorid,factorNumber,company,title,price,time,time_check,len,status,check_id) values (:factorid,:factorNumber,:company,:title,:price,:time,:time_check,:len,:status,:check_id)";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("factorid",$factorid);
        $result->bindParam("factorNumber",$factorNumber);
        $result->bindParam("company",$company);
        $result->bindParam("title",$title);
        $result->bindParam("price",$price);
        $result->bindParam("time",$time);
        $result->bindParam("time_check",$time_check);
        $result->bindParam("len",$len);
        $result->bindParam("status",$status);
        $result->bindParam("check_id",$check_id);

        $result->execute();


        if($result->rowCount() > 0)
        {
            if(strlen($message) > 0)
                {
                                $this->InsertNewCheckDetalis($dbconnect->connect->lastInsertId(),$message,$price,$time_check);

                }
                else
                    {
                                    $this->InsertNewCheckDetalis($dbconnect->connect->lastInsertId(),"فاگتور سیستمی با مدت $len  روز ثبت  شد",$price,$time_check);

                    }
            echo '1';
        }
        else
        {
             echo 'InsertNewCheck -> ';
                    var_dump($result->errorInfo());
        }
    }











    public function InsertNewCheckDetalis($check_id,$message,$price,$time_check)
    {
        session_start();
        $user_id = $_SESSION['UserId'];
        $this->UpdateCheckDate($check_id,$time_check,$price);
        $change_time = time();
        $dbconnect = new db();

        $sql = "insert into checkdetail (check_id,message,price,time_check,change_time,user_id) values (:check_id,:message,:price,:time_check,:change_time,:user_id)";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("check_id",$check_id);
        $result->bindParam("message",$message);
        $result->bindParam("price",$price);
        $result->bindParam("time_check",$time_check);
        $result->bindParam("change_time",$change_time);
        $result->bindParam("user_id",$user_id);

        $result->execute();


        if($result->rowCount() > 0)
        {
            echo 'تغییرات با موفقیت ثبت شد';
        }
        else
        {
   echo 'InsertNewCheckDetalis -> ';
                    var_dump($result->errorInfo());        }
    }





    public function GetCheckDetail($id)
    {

        $dbconnect = new db();

        $sql = "select * from checks where id = :id";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$id);


        $result->execute();


        if($result->rowCount() > 0)
        {
            $data   = $result->fetchAll(PDO::FETCH_OBJ);

            foreach ($data as $rows)
            {
                $this->id = $rows->id;
                $this->factorid = $rows->factorid;
                $this->factorNumber = $rows->factorNumber;
                $this->company = $rows->company;
                $this->title = $rows->title;
                $this->price = $rows->price;
                $this->time = $rows->time;
                $this->time_check = $rows->time_check;
                $this->len = $rows->len;
                $this->status = $rows->status;
            }
        }
        else
        {
        }
    }




    public function GetCheckDetailsData($id)
    {

        $dbconnect = new db();

        $sql = "select * from checkdetail where check_id = :id order by id desc";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$id);


        $result->execute();


        if($result->rowCount() > 0)
        {
            $data   = $result->fetchAll(PDO::FETCH_OBJ);
            ?>
            <table class="table table-bordered table-striped table-hover table-responsive text-center">
                <thead>

                <td>مبلغ</td>
                <td>تاریخ</td>
                <td>پیام</td>
                <td>تاریخ تغییر</td>
                <td> کاربر</td>

                </thead>
            <?php
            foreach ($data as $rows)
            {            $user = new user();

                $user->GetUserData($rows->user_id);
                ?>
                <tr>

                <td><?php echo number_format($rows->price);?> </td>
                <td><?php echo jdate('Y/m/d',$rows->time_check  ,'','','en');?> </td>
                <td><?php echo $rows->message;?> </td>
                <td><?php echo jdate('h:i:s - Y/m/d',$rows->change_time,'','','en');?> </td>
                <td> <?php echo $user->name;?> </td>

                </tr>

                <?php
            }


        }
        else
        {
        }
    }



        public function UpdateCheckDate($id,$time,$price)
        {
            $dbconnect = new db();
            $sql = "update checks set time_check = :time_check , price = :price where id = :id";

            $result = $dbconnect->connect->prepare($sql);

            $result->bindParam("time_check",$time);
            $result->bindParam("id",$id);
            $result->bindParam("price",$price);
            $result->execute();

            if($result->rowCount() > 0)
                {
                    echo '1';
                }
            else
                {
                    echo '0';
                }
        }


        public function UpdateCheckView($id)
        {
            $dbconnect = new db();
            $sql = "update checks set view = 1  where factorid = :id";

            $result = $dbconnect->connect->prepare($sql);

            $result->bindParam("id",$id);
            $result->execute();

            if($result->rowCount() > 0)
                {
                    echo '1';
                }
            else
                {
                    echo '0';
                }
        }



        public function UpdateFactorStatus($factorid)
        {
            $dbconnect = new db();
            $sql = "update factor set check_confirm = '1' where id = :id";

            $result = $dbconnect->connect->prepare($sql);

            $result->bindParam("id",$factorid);
            $result->execute();

            if($result->rowCount() > 0)
                {
                    echo '1';
                }
            else
                {
                    echo '0';
                }
        }


        public function UpdateFactorStatusManual($factorid,$status,$len)
        {
            $dbconnect = new db();
            $sql = "update factor set check_confirm = $status  , check_len = $len where id = :id";

            $result = $dbconnect->connect->prepare($sql);

            $result->bindParam("id",$factorid);
            $result->execute();

            if($result->rowCount() > 0)
                {
                    echo '1';
                }
            else
                {
                    echo 'UpdateFactorStatusManual -> ';
                    var_dump($result->errorInfo());
                }
        }




    public function GetSelectedCheckArray($check_list)
    {

$branch = new branch();

        require 'lib/jdf.php';
        $dbconnect = new db();
        $company = new company();
    $sql = 'SELECT * 
              FROM factor 
             WHERE `id` IN (' . implode(',', array_map('intval', $check_list)) . ')  ';


        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        ?>
            <table class="table table-hover table-bordered table-striped table-responsive">

            <thead class="text-center">
            <td>ردیف</td>
            <td>شماره فاکتور</td>
            <td>تاریخ فاکتور</td>
            <td>نام شرکت</td>
            <td>مبلغ فاکتور</td>
            </thead>
            <tbody class="text-center">

    <?php

        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
$id = 1;
            foreach ($data as $rows)
            {

                if($rows->fullprice > 0 )
                {
                   $this->check_list_fullprice = $this->check_list_fullprice + $rows->fullprice;
                }


              $branch->GetBranchNameById($rows->branch);
                $company->getCompanyDetail($rows->company);
                ?><tr>

                <td><?php echo $id ?></td>
  <td><?php echo $rows->factorid; ?></td>
                <td><?php echo jdate('Y/m/d' , $rows->time , '','','en');?></td>
                <td><?php echo $company->name;?></td>
                <td><?php if($rows->fullprice > 0 )
{
echo number_format($rows->fullprice);
}
?></td>
                </tr>

                <?php
$id = $id + 1;
            }
        }
        else
            {
                var_dump($result->errorInfo());
            }
        ?>
        </tbody>
        </form>
            </table>
    <script>
        $(".sve").click(function () {
            var id =this.id;
            var Lenid = "len"+this.id;
            var len = $("#"+Lenid).val();

            $.post('page.php',{page:'SaveCheckLength',id:id,len:len},function (data) {
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






    public function UpdateCheckToHidden($factorid)
    {
        $dbconnect = new db();

        $sql = "update checks set status = 200  where  factorid = :factorid";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("factorid",$factorid);

        $result->execute();


    }

}
?>