<?php

class group
{

    public  $entityid;
    public $price;

    public function updateHajmi($factorid , $percent)
    {
        $dbconnect = new db();
        $sql = "update factorentity set discounthajmi = :discounthajmi where factorid = :factorid ";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam('factorid',$factorid);
        $result->bindParam("discounthajmi",$percent);

        $result->execute();

        if($result->rowCount() > '0')
        {
            echo 'درصد حجمی با موفقیت اعمال شد';
        }else
        {
            echo 'خطا در ثبت';
        }
    }






    public function updateNaghdi($factorid , $percent)
    {
        $dbconnect = new db();
        $sql = "update factorentity set discountnaghdi = :discountnaghdi where factorid = :factorid ";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam('factorid',$factorid);
        $result->bindParam("discountnaghdi",$percent);

        $result->execute();

        if($result->rowCount() > '0')
        {
            echo 'درصد نقدی با موفقیت اعمال شد';
        }else
        {
            echo 'خطا در ثبت نقدی';

        }
    }






    public function     updateTax($factorid , $tax)
    {
        $dbconnect = new db();
        $sql = "update factorentity set tax = :tax where factorid = :factorid ";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam('factorid',$factorid);
        $result->bindParam("tax",$tax);

        $result->execute();

        if($result->rowCount() > '0')
        {
            echo 'درصد مالیات با موفقیت اعمال شد';
        }else
        {
            echo 'خطا در ثبت نقدی';

        }
    }








    public function  UpdateTak($id, $newforosh)
    {
        $dbconnect = new db();
        $sql = "update factorentity set currentgheymatforrosh  = :currentgheymatforrosh where id = :id ";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam('id',$id);
        $result->bindParam("currentgheymatforrosh",$newforosh);

        $result->execute();

        if($result->rowCount() > '0')
        {
            echo 'درصد تخفیف گروهی با موفقیت اعمال شد' . '<br>';
        }else
        {
            echo 'خطا در ثبت درصد گروهی';

        }
    }




    public function GetAllFactorEntity($factorid , $percent)
    {

        $dbconnect = new db();
        $sql = "select * from factorentity where factorid = :factorid";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam('factorid',$factorid);

        $result->execute();

        if($result->rowCount() > '0')
        {
            $data = $result-> fetchAll(PDO::FETCH_OBJ);
            foreach($data as $rows) {

                $price =  $rows->currentgheymatmasraf - (($rows->currentgheymatmasraf / '100' )  * $percent);
                echo $price;

                $this->UpdateTak($rows->id ,$price);
            }
        }else
        {
            echo 'خطا در ثبت ';

        }
    }












    public function   UpdateEshantionPercent($factorid , $eshantionpercent)
    {
        $dbconnect = new db();
        $sql = "update factorentity set eshantionpercent = :eshantionpercent where factorid = :factorid ";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam('factorid',$factorid);
        $result->bindParam("eshantionpercent",$eshantionpercent);

        $result->execute();

        if($result->rowCount() > '0')
        {
            echo 'درصد تخفیف اشانتیون با موفقیت اعمال شد';
        }else
        {
            echo 'خطا در ثبت ';

        }
    }


}