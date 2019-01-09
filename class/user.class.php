<?php

class user
{
    public $user;
    public $userid;
    public $userLevel;
    public $userName;
    public $name;
    public $newbie;
    protected  $hash;
public function UserLogin($username,$password)
{

    $this->UserHashLogin($username);

    $db = new db();
    $sql = "select * from user where user = :user ";
    $result = $db->connect->prepare($sql);
    $result->bindParam("user",$username);
   // $result->bindParam("pass",$password);
    $result->execute();
    if($result->rowCount() == '1')
    {

        if (password_verify($password, $this->hash)) {
            $this->GetUserDataByUser($username);
            $_SESSION['UserId'] = $this->userid;
            $_SESSION['UserLevel'] = $this->userLevel;
            $_SESSION['UserName'] = $username;
            $_SESSION['name'] = $this->name;
            header("location:index.php");
        } else {
            echo 'نام کاربری یا رمز عبور اشتباه است.';
        }



    }

}



public function UserHashLogin($user)
{


    $db = new db();
    $sql = "select * from user where user = :user";
    $result = $db->connect->prepare($sql);
    $result->bindParam("user",$user);
    $result->execute();
    if($result->rowCount() == '1')
    {
        $data = $result->fetchAll(PDO::FETCH_OBJ);
        foreach ($data as $rows)
        {
            $this->hash = $rows->pass ;
        }
    }

}


public function GetUserData($id)
    {
        $db = new db();
        $sql = "select * from user where id = :id";
        $result = $db->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->execute();
        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $this->user = $rows->user;
                $this->userid = $rows->id;
                $this->name = $rows->name;
                $this->userLevel = $rows->level;
                $this->newbie = $rows->newbie;

            }
        }
        else
        {
            //var_dump($db->connect->errorInfo());
        }
    }






    public function GetUserDataByUser($user)
    {
        $db = new db();
        $sql = "select * from user where user = :user";
        $result = $db->connect->prepare($sql);
        $result->bindParam("user", $user);
        $result->execute();
        if ($result->rowCount() > '0') {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $this->user = $rows->user;
                $this->userid = $rows->id;
                $this->name = $rows->name;
                $this->userLevel = $rows->level;

            }
        } else {
            echo $db->connect->errorInfo();
        }
    }



        public function GetUserDropDownList()
    {
        $dbconnect = new db();
        $sql = "select * from  user ";
        {
            $result = $dbconnect->connect->prepare($sql);
            $result->execute();
            if ($result->rowCount() > '0') {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows) {
                  ?>
                    <option value="<?php echo $rows->id; ?>"> <?php echo $rows->name; ?></option>
<?php
                }
        }
    }

    }





    public function GetUserDataCount()
    {
        $dbconnect = new db();

        $sql = "select * from user";
        $result = $dbconnect->connect->prepare($sql);
        $result->execute();

        ?>
        <table class="table table-bordered table-responsive table-strip">
            <thead>
            <td>نام کاربر</td>
            <td> تعداد فاکتور زده شده</td>
            <td> مدیریت</td>
            </thead>
        <?php
        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
               ?>
               <tr>
                <td><?php  echo $rows->name; ?></td>
                <td><?php echo $this->GetUserDataCountNumber($rows->id)?></td>
                <td><span class="glyphicon-edit glyphicon"></span>  <span class="glyphicon-delete glyphicon"></span></td>
                </tr>
                <?php
            }
        }
        else
            {
                echo 'کارمندی یافت نشد';
            }

            echo '</table>';

    }






    public function GetUserDataCountNumber($id)
    {
        $dbconnect = new db();

        $sql = "select * from factor where creator = :creator";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("creator",$id);
        $result->execute();

        ?>

        <?php
        if($result->rowCount() > '0')
        {
            echo $result->rowCount();
        }
        else
        {
            echo 'بدون فاکتور ثبت شده ';
        }

    }




    public function GetPersonelScore($user , $from , $to)
    {
        $dbconnect = new db();
        $sql = " select * from factor where creator = :user  and time  > :from and time < :to   order by time Asc";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("user",$user);
        $result->bindParam("to",$to);
        $result->bindParam("from",$from);


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
                <td>امتیاز  </td>
                </thead>

            <?php

            $data = $result->fetchAll(PDO::FETCH_OBJ);

            $count = '0';
            $rank = '0';

            $company = new company();

            foreach ($data as $rows)
            {
                $company->getCompanyDetail($rows->company);
                ?>
                    <tbody>
                <td><?php
                 if(strlen($rows->rank > '0'))
                    {
                         $count = $count + '1';
                       echo $count;

                    }

                ?></td>
               <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6"></div> <td><?php echo $rows->factorid;?></td>
                <td><?php echo $company->name;?></td>
                <td><?php echo jdate('Y/m/d',$rows->time , '','','en');?>  </td>
                                <td><?php echo $rows->rank; if(strlen($rows->rank > '0'))
                                    {
                                        $rank = $rank + $rows->rank;
                                    };?>  </td>

                </tbody>
                <?php

            }


           ?>
            </table>
            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
            <h1>تعداد فاکتور : <?php echo $count; ?></h1>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
            <h1>امتیاز : <?php echo $rank / $count; ?></h1>
            </div>

            <?php
        }
        else
        {
            echo 'هیچ فاکتوری در این بازه زمانی از این کاربر وجود ندارد ';
        }


    }




    public function CheckUserPassword($user,$pass)
    {

        $db = new db();
        $sql = "select * from user where user = :user and pass = :pass";
        $result = $db->connect->prepare($sql);
        $result->bindParam("user",$user);
        $result->bindParam("pass",$pass);
        $result->execute();
        if($result->rowCount() == '1')
        {
            return '1';
        }
        else
        {
            return '0';
        }

    }




        public function UpdataPassWordData($pass,$id)
        {
            $dbconnect = new db();
            $sql = "update user set pass = :pass  where id = :id";
            $result = $dbconnect->connect->prepare($sql);
            $result->bindParam("id",$id);
            $result->bindParam("pass",$pass);
            $result->execute();

            if($result->rowCount() > '0')
            {
               return '1';
            }
            else
            {
                return '0';
            }
        }



        public function UserHashSetter()
        {


            $db = new db();
            $sql = "select * from user";
            $result = $db->connect->prepare($sql);

            $result->execute();
            if($result->rowCount()> 0)
            {
                $options = [
                    'cost' => 12,
                ];



                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows)
                {
                   echo $pass =   password_hash($rows->pass, PASSWORD_BCRYPT, $options);
                   $this->UpdataPassWordData($pass,$rows->id);
                }
            }

        }
}


?>


