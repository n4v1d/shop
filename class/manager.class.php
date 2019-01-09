<?php

class manager
{

    public function RecoreAction($userid,$action)
    {
        $time = time();

        $dbconnect = new db();

        $sql = "insert into action (userid , action , time) values (:userid ,:action ,   :time)";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("userid",$userid);
        $result->bindParam("action",$action);
        $result->bindParam("time",$time);
        $result->execute();
        if($result->rowCount() == '0')
        {
            echo 'خطا در ثبت رکورد';
            exit;
        }
    }
}

?>