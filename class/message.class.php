<?php

class message
{


    public function GetMessage()
    {
        require 'lib/jdf.php';
        $userid =$_SESSION['UserId'];
        $dbconnect = new db();
        $sql = "select * from message where user  = :user ORDER by id Desc Limit 0 , 50";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("user" , $userid);

        $result->execute();

        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
?>
            <table class="table table-responsive table-bordered table-strip">
                <thead>
                <td>تاریخ  </td>
                <td>عنوان  </td>
                <td>وضعیت  </td>
                </thead>
            <?php
            foreach ($data as $rows)
            {?>
                <tr class=" text-center ">
                <td><?php echo jdate('Y/m/d  H:i:s' , $rows->time , '' , '', 'en'); ?>  </td>
                <td><?php echo $rows->content; ?>  </td>
                <td><?php
                 if($rows->type == '1')
                     {
                         echo '<b style="color: red">عدم تایید</b>';
                     }?> </td>
</tr>
                <?php

            }
        }
        else
        {
            echo 'Not';
        }
    }


    public function MessageNew($userid , $message  , $type)
    {

        $time = time();

        $dbconnect = new db();
        $sql = "insert into message (user , time , type , content ) values (:user , :time , :type , :content )";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("user" , $userid);
        $result->bindParam("content" , $message);
        $result->bindParam("time" , $time);
        $result->bindParam("type" , $type);

        $result->execute();

        if($result->rowCount() > '0')
        {
            echo 'اطلاع رسانی با موفقیت انجام شد ';
        }
    }



}

?>