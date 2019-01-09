<?php

class logreport
{
    public function NewLogReport($userid,$content , $url)
    {
$ip = $_SERVER['REMOTE_ADDR'];
        $dbconnect = new db2();

        $sql = "insert into loginfo (userid , content , url , ip) values (:userid , :content , :url , :ip)";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("userid",$userid);
        $result->bindParam("content",$content);
        $result->bindParam("url",$url);
$result->bindParam("ip",$ip);


        $result->execute();


    }
}

?>