<?php

class sync
{
    public function GetProductInfo($from,$to)
    {
        $dbconnect = new db();

        $sql = "select * from product where productid >= :az and productid <= :ta order by id";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("az",$from);
        $result->bindParam("ta",$to);

        $result->execute();

        $dataArray = array();
        $i = 0;
        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            foreach ($data as $rows)
            {
                $dataArray[$i]['code'] = $rows->productid;
                $dataArray[$i]['name'] = $rows->name;
                $i = $i +1;
            }
        }

        $dc = json_encode($dataArray );

        echo $dc;

        $jd = json_decode($dc , true);

    }




    public function CheckProduct($productid,$name)
    {
        $dbconnect = new db();
        $company = new product();

        $sql = "select * from product where productid = :productid";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("productid",$productid);

        $result->execute();

        if($result->rowCount() == 0)
        {
            $company->addProduct($name,$productid,"0","0");

        }
    }

}

?>