<?php

class Api
{
    public  $name;
    public $code;
    public $barcode;


    public function InsertNewProduct($productid, $name , $company)
    {


        if (password_verify('rasmuslerdorf', $hash)) {
            echo 'Password is valid!';
        } else {
            echo 'Invalid password.';
        }

    }





    public function CheckProductExists($productid)
    {
        $dbconnect = new db();

        $sql = "select * from product where productid = :productid";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("productid",$productid);

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




    public function InsertBarcode($code , $barcode)
    {
        $dbconnnect = new db();

        $sql = "insert into barcode (code , barcode) values (:code , :barcode)";

        $result = $dbconnnect->connect->prepare($sql);
        $result->bindParam("code" , $code);
        $result->bindParam("barcode" , $barcode);

        $result->execute();

        if($result->rowCount() > '0')
        {
            return '3';
        }
        else
        {
            return '4';
        }
    }

    public function GetAllProductBarcode($code)
    {
        $dbconnect = new db();
        $sql = "select * from barcode where code = :code";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("code" , $code);

        $result->execute();

        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            $this->GetProductName($code);
            ?>
               <table class="table table-bordered  table-responsive table-striped table-hovered" >
                   <thead>
                   <td>کد </td>
                   <td>نام</td>
                   <td>بارکد</td>
                   </thead>
            <?php
            foreach ($data as $rows)
            {
                ?>
            <tr>
            <td><?php echo $code; ?></td>
            <td><?php echo $this->name ;?></td>
            <td><?php echo $rows->barcode; ?></td>
            </tr>
    <?php
            }
            echo '<table>';

        }
        else
        {
            echo 'هنوز هیچ بارکدی ثبت نشده است ';
        }
    }





    public function CheckBarcode($barcode)
    {
        $dbconnnect = new db();
        $sql = "select * from barcode where barcode = :barcode";

        $result = $dbconnnect->connect->prepare($sql);

        $result->bindParam("barcode" , $barcode);

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





            public function GetProductData($id)
            {
                $array = array();
                $product = new product();

                $dbconnect = new db();
                $sql = "select * from factorentity where productid = :id order by id Desc limit 0,1";

                $result = $dbconnect->connect->prepare($sql);

                $result->bindParam("id",$id);

                $result->execute();

                if($result->rowCount() > 0)
                {
                    $data = $result->fetchAll(PDO::FETCH_OBJ);
                    foreach ($data as $rows)
                    {
                        $product->GetProductData($id);
                        $array['name'] = $product->name;
                        $array['Price'] = $rows->currentgheymatforrosh;


                    }

                    echo json_encode($array,true);
                }
                else
                {
                    echo 'Error';
                    var_dump($result->errorInfo());
                }
            }



}


?>

