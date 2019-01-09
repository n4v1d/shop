<?php
class update
{
    public function UpdateBox($id,$val)
    {
        $dbconnect = new db();
        $sql = "update factorentity set box = :box   where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("box",$val );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }



    public function UpdateBoxIn($id,$val)
    {
        $dbconnect = new db();
        $sql = "update factorentity set boxin = :boxin   where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("boxin",$val );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }






    public function Price($id,$val)
    {
        $dbconnect = new db();
        $sql = "update factorentity set price = :price   where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("price",$val );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }




    public function EshantionPrice($id,$val)
    {
        $dbconnect = new db();
        $sql = "update factorentity set eshantionPrice = :eshantionPrice   where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("eshantionPrice",$val );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }


    public function eshantion($id,$val)
    {
        $dbconnect = new db();
        $sql = "update factorentity set eshantion = :eshantion   where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("eshantion",$val );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }

    public function eshantionin($id,$val)
    {
        $dbconnect = new db();
        $sql = "update factorentity set eshantionin = :eshantion   where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("eshantion",$val );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }


    public function hajmi($id,$val)
    {
        $dbconnect = new db();
        $sql = "update factorentity set discounthajmi = :discounthajmi   where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("discounthajmi",$val );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }

    public function tax($id,$val)
    {
        $dbconnect = new db();
        $sql = "update factorentity set tax = :tax   where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("tax",$val );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }




    public function tax2($id,$val)
    {
        $dbconnect = new db();
        $sql = "update factorentity set tax2 = :tax   where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("tax",$val );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }







    public function naghdi($id,$val)
    {
        $dbconnect = new db();
        $sql = "update factorentity set discountnaghdi = :naghdi  where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("naghdi",$val );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }


    public function eshantionpercent($id,$val)
    {
        $dbconnect = new db();
        $sql = "update factorentity set eshantionpercent = :eshantionpercent  where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("eshantionpercent",$val );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }

 public function forosh($id,$val)
    {
        $dbconnect = new db();
        $sql = "update factorentity set currentgheymatforrosh = :forosh  where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("forosh",$val );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }


 public function masraf($id,$val)
    {
        $dbconnect = new db();
        $sql = "update factorentity set currentgheymatmasraf = :masraf  where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("masraf",$val );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }





    public function message($factorid,$message)
    {
        $dbconnect = new db();
        $sql = "update factor set message = :message   where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$factorid);
        $result->bindParam("message",$message );

        if($result->execute())
        {
            return '1';
        }
        else
        {
            return '0';
        }
    }





}
?>