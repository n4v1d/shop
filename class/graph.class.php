<?php
class graph
{

    public $pname;

    public function getProductGraphData($pid)
    {


        $dbconnect = new db();
        $sql = "select * from factorentity where productid = :pid order by id Desc limit 0,8 ";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("pid", $pid);
        $result->execute();
        if ($result->rowCount() > '0') {
            $product = new entity();
            $product->getProductData($pid);
            $this->pname = $product->productname;
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                echo $rows->price . ',';
            }
        } else {
            echo 'Error';
        }
    }





    public function getProductForoshGraphData($pid)
    {


        $dbconnect = new db();
        $sql = "select * from factorentity where productid = :pid order by id Desc limit 0,8 ";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("pid", $pid);
        $result->execute();
        if ($result->rowCount() > '0') {
            $product = new entity();
            $product->getProductData($pid);
            $this->pname = $product->productname;
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                echo $rows->currentgheymatmasraf . ',';
            }
        } else {
            echo 'Error';
        }
    }






    public function getProductMasrafGraphData($pid)
    {


        $dbconnect = new db();
        $sql = "select * from factorentity where productid = :pid order by id Desc limit 0,8 ";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("pid", $pid);
        $result->execute();
        if ($result->rowCount() > '0') {
            $product = new entity();
            $product->getProductData($pid);
            $this->pname = $product->productname;
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                echo $rows->currentgheymatforrosh . ',';
            }
        } else {
            echo 'Error';
        }
    }




    public function getProductfactorId($pid)
    {


        $dbconnect = new db();
        $sql = "select * from factorentity where productid = :pid order by id Desc limit 0,8";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("pid", $pid);
        $result->execute();
        if ($result->rowCount() > '0') {

            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $this->getFactorDate($rows->factorid);

            }
        } else {
            echo 'Error';
        }
    }

    public function getFactorDate($id)
    {
        $dbconnect = new db();
        $sql = "select * from factor where id  = :factorid  ";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("factorid", $id);
        $result->execute();
        if ($result->rowCount() > '0') {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                echo "'" . jdate('Y/m/d', $rows->time, '', '', 'en') . "'" . ',';
            }
        }

    }
}
?>