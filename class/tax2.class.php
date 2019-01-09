<?php

class tax2
{

    public $factorid;
    public $company;
    public $time;
    public $fullPrice;

    public $FinalDiscount;
    public $Gross;
    public $amount ;


    public $tax;
    public $AllTaxSum;


    // New Design // ReCalculate

    public $hajmi;
    public $naghdi;
    public $maliat;
    public $id;
    public $eshantion;

    public $hajmi_final;
    public $naghdi_final;
    public $tax_final;
    public $eshantion_final;
    public $price_final;





    public function GetAllProductWithTax()
    {
        $id = '1';

        $dbconnect = new db();

        $sql = "select * from factorentity where tax > '0' GROUP by factorid order by id   ";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        $fullgross = '0';

        if($result->rowCount() > '0')
        {
            ?>
            <br>
            <br>
            <table class="table table-responsive table-bordered table-striped ">

                <thead class="text-center alert alert-info">
                <td>ردیف</td>
                <td>شماره فاکتور</td>
                <td>تاریخ فاکتور</td>
                <td > نام شرکت</td>
                <td> مبلغ ناخالص </td>
                <td> حجمی </td>
                <td> نقدی </td>
                <td>مبلغ تخفیفات </td>
                <td>مبلغ بعد تخفیفات </td>
                <td>  ارزش افزوده </td>
                <td>   خالص فاکتور </td>
                </thead>
                <tbody>
                <?php
                $data = $result->fetchAll(PDO::FETCH_OBJ);

                foreach ($data as $rows)
                {
                    $this->GetFactorDataWithFactorid($rows->factorid);
                    $company = new company();
                    $company->getCompanyDetail($this->company);
                    ?>
                    <tr class="text-center alert  alert-success ">
                        <td><?php echo $id; $id = $id + 1; ?></td>
                        <td><?php echo $this->factorid?></td>
                        <td><?php echo jdate('Y/m/d',$this->time , '','','en');?></td>
                        <td class="CompanyName"><?php echo $company->name?></td>
                        <td><?php $this->getFactorGrossAmount($rows->factorid);?></td>

                        <td><?php $this->getDiscountPrice($rows->factorid);?></td>
                        <td> <?php echo  $this->Gross - $this->FinalDiscount?></td>
                        <td><?php $this->GetTaxPrice($rows->factorid); ?></td>
                        <td><?php echo $this->amount ?></td>
                    </tr>
                    <?php


                }
                ?>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center"><?php  echo number_format(round($this->AllTaxSum)); ?></td>
                    <td class="text-center"> <?php echo number_format(round($fullgross));?></td>
                </tr>
                </tbody>

            </table>
            <?php
        }

    }



    public function GetFactorDataWithFactorid($factorid)
    {

        $dbconnect = new db();
        $sql = " select * from factor where id = :factorid";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("factorid",$factorid);

        $result->execute();

        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $this->company = $rows->company;
                $this->time = $rows->time;
                $this->factorid = $rows->factorid;
            }

        }
    }



    public function getFactorGrossAmount($factorid)
    {
        $this->amount = 0;
        $price = '0';

        $dbconnect = new db();
        $sql = "select * from factorentity where factorid = :factorid and feshantion = 0";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("factorid",$factorid);

        $result->execute();


        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            foreach ($data as $rows)
            {

                $EntityPrice =( $rows->price  * ($rows->box * $rows->boxin) );
                ;
                $price = $price + $EntityPrice;
                $p = '0';

            }
            echo number_format($this->Gross =  $price);
            $this->amount = $price;

        }
        else
        {
            echo "error";
        }
    }




    public function getDiscountPrice($factorid)
    {
        $this->FinalDiscount = 0;
        $dbconnect = new db();

        $sql = "select * from factorentity where factorid = :factorid and feshantion = '0'";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("factorid",$factorid);

        $result->execute();
        $FinalDiscount = '0';
        if($result->rowCount() > '0')

        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $price = ($rows->price * ($rows->box * $rows->boxin));




                if ($rows->discounthajmi > 0)
                {
                    $hajmi = $price - ($price / 100 * $rows->discounthajmi);
                }
                else
                {
                    $hajmi = $price;

                }


                $naghdi =$hajmi - ( $hajmi / 100 * $rows->discountnaghdi);

                $discount = $price  - $naghdi ;


                $fp =$discount - $price   ;

                $FinalDiscount0 =   $FinalDiscount0  + ($price - abs($fp- ((($fp) / 100 ) * $rows->eshantionpercent)));





            }
            echo  round($this->FinalDiscount =  $FinalDiscount0);
            $this->FinalDiscount =  abs($FinalDiscount0);


        }
        else
        {
            echo 'error';
        }
    }













    public function GetTaxPrice($factorid)
    {
        $dbconnect = new db();

        $sql = "select * from factorentity where factorid = :factorid and feshantion = '0' ";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("factorid",$factorid);

        $result->execute();
        $FinalDiscount = '0';
        if($result->rowCount() > '0')

        {
            $finalTax = '0';
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {

                $price = $rows->price * ($rows->box * $rows->boxin) . '<br>';



                if ($rows->discounthajmi > 0)
                {
                    $hajmi = $price - ($price / 100 * $rows->discounthajmi);
                }
                else
                {
                    $hajmi = $price;

                }



                if ($rows->discounthajmi > 0)
                {
                    $hajmi = $price - ($price / 100 * $rows->discounthajmi);
                }
                else
                {
                    $hajmi = $price;

                }


                $naghdi =$hajmi - ( $hajmi / 100 * $rows->discountnaghdi);

                $discount = $price  - $naghdi ;



                $fp =$discount - $price   ;

                $FinalDiscount =($price - abs($fp- ((($fp) / 100 ) * $rows->eshantionpercent)));



                $tax = ($price - $FinalDiscount) / 100  * $rows->tax;


                $finalTax = $finalTax + $tax ;





            }
            echo  $this->tax =  round($finalTax);
            $this->AllTaxSum = round($this->AllTaxSum + $finalTax);


        }
        else
        {
            echo 'error';
        }
    }








    public function GetAllProductWithDiscount($array)
    {
        $id = '1';

        $dbconnect = new db();



        $sql = "select * from factorentity  where factorid in ('" . implode("','", $array) . "') group by factorid ";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        $fullgross = '0';

        if($result->rowCount() > '0')
        {
            ?>
            <br>
            <br>
            <table class="table table-responsive table-bordered table-striped ">

                <thead class="text-center alert alert-info">
                <td>ردیف</td>
                <td>شماره فاکتور</td>
                <td>تاریخ فاکتور</td>
                <td > نام شرکت</td>
                <td> مبلغ ناخالص </td>
                <td>حجمی</td>
                <td>مالیات</td>
                <td>نقدی</td>
                <td>درصد شرکتی</td>
                <td>مبلغ تخفیفات</td>
                <td>   خالص فاکتور </td>
                </thead>
                <tbody>
                <?php
                $data = $result->fetchAll(PDO::FETCH_OBJ);

                foreach ($data as $rows)
                {
                    $this->GetFactorDataWithFactorid($rows->factorid);
                    $company = new company();
                    $company->getCompanyDetail($this->company);
                    ?>
                    <tr class="text-center alert  alert-success ">
                        <td><?php echo $id; $id = $id + 1; ?></td>
                        <td><?php echo $this->factorid; ?></td>
                        <td><?php echo jdate('Y/m/d',$this->time , '','','en');?></td>
                        <td class="CompanyName"><?php echo $company->name?></td>
                        <td><?php round($this->getFactorGrossAmount($rows->factorid));?></td>

                        <!--  Discount Place  -->
                        <td><?php
                            $this->GetDiscountHajmi($rows->factorid);
                            ;?>
                        </td>
                        <td><?php
                            $this->GetTax($rows->factorid);
                            ;?>
                        </td>      <td><?php
                            $this->GetNaghdi($rows->factorid);
                            ;?>
                        </td>

                        </td>
                        <td><?php
                            $this->GetSherkati($rows->factorid);
                            ;?>
                        </td>

                        <td><?php

                            echo  $disc = round($this->hajmi_final + $this->naghdi_final + $this->eshantion_final);

                            ;?>
                            </td>
                        <td><?php

                            echo number_format(round($this->Gross - $disc + $this->tax_final));

                            ;?>
                            </td>


                    </tr>
                    <?php


                }
                ?>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center"><?php  echo number_format(round($this->AllTaxSum)); ?></td>
                    <td class="text-center"> <?php echo number_format(round($fullgross));?></td>
                </tr>
                </tbody>

            </table>
            <?php
        }

    }


    public function GetAllFactorIdByTime($from , $to)
    {
        $dbconnect = new db();
        $sql = "select * from factor  where  time > :from and time < :to order by time ASC";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("to",$to);
        $result->bindParam("from",$from);

        $result->execute();

        //echo $result->rowCount();

        $array = array();
        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $array[]= $rows->id;
            }
        }


        $this->GetAllProductWithDiscount($array);


    }


    public function GetDiscountHajmi($id)
    {
        $this->hajmi = 0;
        $dbconnect = new db();
        $sql = "select * from factorentity where factorid = :id";
        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$id);

        $result->execute();


        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $price = $rows->price;
                $hajmiPrice =  (($price / 100) * $rows->discounthajmi) * ($rows->box * $rows->boxin);

                $this->hajmi = $this->hajmi + $hajmiPrice;

            }

            $this->hajmi_final = $this->hajmi;
            echo round($this->hajmi_final);

        }
    }











    public function GetTax($id)
    {
        $this->tax = 0;
        $dbconnect = new db();
        $sql = "select * from factorentity where factorid = :id";
        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$id);

        $result->execute();


        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $price = $rows->price;
                $hajmiPrice =  (($price / 100) * $rows->discounthajmi)  ;
                $taxPrice =  ((($price - $hajmiPrice) / 100) * $rows->tax) * ($rows->box * $rows->boxin) ;

                $this->tax = $this->tax + $taxPrice;

            }

            $this->tax_final = $this->tax;
            echo round($this->tax_final);

        }
    }








    public function GetNaghdi($id)
    {
        $this->naghdi = 0;
        $dbconnect = new db();
        $sql = "select * from factorentity where factorid = :id";
        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$id);

        $result->execute();


        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $price = $rows->price;
                $hajmiPrice =  (($price / 100) * $rows->discounthajmi)  ;
                $taxPrice =  ((($price - $hajmiPrice) / 100) * $rows->tax) ;
                $NaghdiPrice =  (((($price - $hajmiPrice) + $taxPrice) / 100) * $rows->discountnaghdi) * ($rows->box * $rows->boxin) ;

                $this->naghdi = $this->naghdi + $NaghdiPrice;

            }

            $this->naghdi_final = $this->naghdi;
            echo round($this->naghdi);

        }
    }






    public function GetSherkati($id)
    {
        $this->eshantion = 0;
        $dbconnect = new db();
        $sql = "select * from factorentity where factorid = :id";
        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$id);

        $result->execute();


        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $price = $rows->price;
                $hajmiPrice =  (($price / 100) * $rows->discounthajmi)  ;
                $taxPrice =  ((($price - $hajmiPrice) / 100) * $rows->tax) ;
                $NaghdiPrice =  (((($price - $hajmiPrice) + $taxPrice) / 100) * $rows->discountnaghdi) ;
                $eshantionPrice =  ((((($price - $hajmiPrice) + $taxPrice) - $NaghdiPrice) / 100) * $rows->eshantionpercent) * ($rows->box * $rows->boxin) ;

                $this->eshantion = $this->eshantion + $eshantionPrice;

            }

            $this->eshantion_final = $this->eshantion;
            echo round($this->eshantion_final);

        }
    }

}

?>