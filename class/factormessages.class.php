<?php

class factormessages
{

    public $id;
    public $userid;
    public $time;
    public $factorid;
    public $message;

    public function GetFactorMessage($factorid)
    {
        $dbconnect = new db();
        $sql = "select * from factormessages where factorid = :factorid";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("factorid",$factorid);

        $result->execute();

        if($result->rowCount() > 0)
        {
            ?>
            <br>
                <table class="table table-hover table-striped table-responsive text-center table-bordered">
                    <thead class=" alert alert-danger">
                    <td>شماره</td>
                    <td>کاربر</td>
                    <td>تاریخ</td>
                    <td>پیام</td>
                    </thead>

            <?php

            $data = $result->fetchAll(PDO::FETCH_OBJ);
                $user = new user();

            foreach ($data as $rows)
            {
                $user->GetUserData($rows->userid);
                ?>
                <tr class="alert alert-success">
                    <td><b><?php echo $rows->id; ?></b></td>
                    <td><b><?php echo $user->name; ?></b></td>
                    <td><b><?php echo jdate('h:i:s - Y/m/d' , $rows->time,'','','en');?></b></td>
                    <td><b><?php echo $rows->message?></b></td>
                </tr>
                    <?php

            }
            echo '</table>';
        }


    }


    public function InsertNewFactorMessage($userid,$factorid,$message)
    {
        $time = time();
        $dbconnect = new db();
       $sql = "insert into factormessages (factorid,userid,message,time) values (:factorid,:userid,:message,:time)";

       $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("userid",$userid);
        $result->bindParam("factorid",$factorid);
        $result->bindParam("message",$message);
        $result->bindParam("time",$time);

        $result->execute();

        if($result->rowCount() > 0)
            {
                echo '1';
            }
            else
                {
                    echo '0';
                    var_dump($result->errorInfo());
                }
    }
}

?>