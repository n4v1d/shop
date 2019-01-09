<?php

class Api
{
    // All Js Api

    public function GetBranchListJson()
    {
        $dbconnect = new db();
        $sql = "select * from branch";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

           echo json_encode($data,true);
        }
    }
}


?>

