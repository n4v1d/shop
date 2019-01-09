<?php
class mojodi
{


    public $FactorListArray = array();

    public $productCount = 0;
    public $eshantionCount = 0;


    public function GetCompanyFactorListForMojodi($company,$productid , $count)
    {  $this->FactorListArray[] = null;
        $dbconnect = new db();
        $sql = "select * from factor where company = :company order by id Desc Limit 0,$count";

        // Get Database Data
        $result = $dbconnect->connect->prepare($sql);

        //Defin Params
        $result->bindParam("company",$company);

        //execute
        $result->execute();

        if($result->rowCount() > 0)
        {
           $data = $result->fetchAll(PDO::FETCH_OBJ);

                foreach ($data as $rows)
                {
                    $this->FactorListArray[] =  $rows->id;
                }
                $this->GetFactorBuyDataByProductId($this->FactorListArray,$productid);
        }
        else
        {
            echo  '0';
        }
    }




    public function GetFactorBuyDataByProductId($factorid,$productid)
    {
        $dbconnect= new db();
        $sql = "select * from factorentity where factorid in ('" . implode("','", $factorid) . "') and( productid = :productid or  eshantionCode = :productid)";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("productid",$productid);

        $result->execute();

        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            foreach ($data as $rows)
            {

                if($rows->productid == $productid )
                {
                    $this->productCount = $this->productCount + ($rows->boxin * $rows->box);

                }

                if($rows->eshantionCode == $productid )
                {
                    $this->eshantionCount = $this->eshantionCount + ($rows->eshantion * $rows->eshantionin);

                }

            }
            echo '<b>' .$this->productCount .'</b>&nbsp;&nbsp;&nbsp;' .  $this->eshantionCount;
        //    echo json_encode($res,true);
        }
        else
        {
            echo  '0';
        }
    }
}

?>