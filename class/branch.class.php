<?php

class branch
{
    public $id;
    public $name;

    public $branchPercent;

    public function GetBranchNameById($id)
    {
        $dbconnect = new db();
        $sql = "select * from branch where store_id = :id";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$id);


        $result->execute();


        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $this->id = $rows->id;
                $this->name = $rows->name;
            }
        }


    }

    public function GetBranchDropDown()
    {
        $dbconnect = new db();

        $sql = "select * from branch";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();
        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            foreach ($data as $rows)
            {
                ?>
                <option value="<?php echo $rows->store_id?>"><?php echo $rows->name; ?></option>
                <?php

            }
        }
    }




    public function GetBranchButton()
    {
        $dbconnect = new db();

        $sql = "select * from branch";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();
        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            foreach ($data as $rows)
            {
                ?>
                <div class="col-lg-1 form-group">
                    <button class="btn btn-primary form-control branch  "  id="<?php echo $rows->store_id?>"><?php echo $rows->name; ?></button>
                </div>
                <?php

            }
        }
    }


    // All Js Api

    public function GetBranchList()
    {
        $dbconnect = new db();
        $sql = "select * from branch";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            echo '<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3">';
            foreach ($data as $rows)
            {
                ?>

                <a href="?id=<?php echo $rows->id.'&branch_name'.'='.$rows->name . '&per=' . $rows->per; ?>"> <b class="text-center"  style="font-size: 30px;width: 100%"><?php echo  $rows->name ;?> &nbsp; |</b></a>


                <?php
            }
            ?>
            <a href="ClearFranchiseProduct.php"> <b class="text-center"  style="font-size: 30px;width: 100%">تخلیه &nbsp; </b></a>

<?php
            echo '</div>';

        }
    }





    // All Js Api

    public function GetBranchPercent($id)
    {
        $dbconnect = new db();
        $sql = "select * from branch where store_id = :id";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);

        $result->execute();

        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            foreach ($data as $rows)
            {
                $this->branchPercent = $rows->per;
            }

        }
    }






    public function InsertIntoFranchiseProductList($store_id,$productid,$per)
    {
        $dbconnect = new db();
        $sql = "insert into franchiseProductList (store_id,productid,per) values (:store_id,:productid,:per)";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("store_id",$store_id);
        $result->bindParam("productid",$productid);
        $result->bindParam("per",$per);


        $result->execute();


        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $this->id = $rows->id;
                $this->name = $rows->name;
            }
        }


    }



    public function DeleteAllFrinchiseProduct()
    {
        $dbconnect = new db();
        $sql = "delete  from franchiseProductList ";

        $result = $dbconnect->connect->prepare($sql);




        $result->execute();



    }


    public function GetAllFranchiseProductList($id)
    {
        $dbconnect = new db();
        $sql = "select * from franchiseProductList where store_id = :id";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$id);

        $result->execute();

        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            foreach ($data as $rows)
            {
                $this->GiveLastBuyReportFranchiseOneRow($rows->productid,$rows->per);

            }
        }


    }





    public function GetAllFranchiseProductListForExcell($id)
    {
        $dbconnect = new db();
        $sql = "select * from franchiseProductList where store_id = :id";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$id);

        $result->execute();

        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            foreach ($data as $rows)
            {
                $this->GiveLastBuyReportFranchiseOneRowForExcell($rows->productid,$rows->per);

            }
        }


    }















    public function GiveLastBuyReportFranchiseOneRow($productid,$percent)
    {
        $company = new company();
        $factor = new factor();
        $entity = new entity();

        $product =  new product();
        $product->GetProductData($productid);

        $dbconnect = new db();
        $sql = "select * from factorentity where productid = :productid and feshantion =  '0' order by id Desc limit 0,1  ";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("productid",$productid);

        $result->execute();
        ?>
        <table class="table table-responsive table-bordered text-center " >  <thead > <td>کد کالا   </td><td>نام کالا   </td> <td>شماره فاکتور  </td><td >تاریخ </td><td>نام شرکت </td>  <td>قیمت واحد </td> <td>قیمت فروش </td><td>قیمت مصرف </td><td>درصد حجمی  </td><td>درصد نقدی  </td><td>مالیات</td> <td> درصد<br> اشانتیون <br>شرکتی </td><td>درصد اشانتیون </td>  <td>قیمت نهایی</td>  <td > مالیات 2</td>  <td>قیمت نهایی فروشگاه</td>    <td> حاشیه سود</td>  <td>تخفیف تکفروشی </td>  <td>سود ناخالص</td>  </th>



        <?php

        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $factor->getFactorDetail($rows->factorid);
                $company->getCompanyDetail($factor->company);
                $entity->OneEntityRowPriceLive($rows->id);

                ?>

                <tr>
                    <td><b><?php echo $productid; ?></b></td>
                    <td><b><?php echo $product->name; ?></b></td>
                    <td><?php echo $factor->factorid; ?></td>

                    <td><?php echo jdate('Y/m/d',$factor->time,'','','en'); ?></td>
                    <td><?php echo $company->name; ?></td>
                    <td><?php echo $rows->price; ?></td>
                    <td><?php echo $rows->currentgheymatforrosh; ?></td>
                    <td><?php echo $rows->currentgheymatmasraf; ?></td>
                    <td><?php echo $rows->discounthajmi; ?></td>
                    <td><?php echo $rows->discountnaghdi; ?></td>
                    <td><?php echo $rows->tax; ?></td>
                    <td><?php echo $rows->eshantionpercent; ?></td>
                    <td><b><?php echo round($rows->perc,3); ?></b></td>
                    <td ><b><?php echo round($entity->FinalPriceLive); ?></b>
                    </td> <td style="background: aquamarine;"><?php $maliat2 = $rows->tax2; echo  round($maliat2); ?></td>
                    <td style="background: aquamarine"><?php  $store_price = $entity->FinalPriceLive + (($entity->FinalPriceLive / 100 )  * $percent) ; echo round($store_price); ?></td>
                    <td><b><?php echo $rows->hashiyesood; ?></b></td>
                    <td><b><?php echo $rows->takhfifTakForoshi; ?></b></td>
                    <td><b><?php echo $rows->soodNakhales; ?></b></td>
                </tr>
                <?php
            }
            echo '</table>';
        }

    }








    public function GiveLastBuyReportFranchiseOneRowForExcell($productid,$percent)
    {
        $company = new company();
        $factor = new factor();
        $entity = new entity();

        $product =  new product();
        $product->GetProductData($productid);

        $dbconnect = new db();
        $sql = "select * from factorentity where productid = :productid and feshantion =  '0' order by id Desc limit 0,1  ";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("productid",$productid);

        $result->execute();
        ?>
        <table class="table table-responsive table-bordered text-center " >  <thead >
        <td >کد کالا   </td>
        <td>نام کالا   </td>
        <td>قیمت مصرف </td>
        <td>مالیات</td>
        <td>قیمت نهایی</td>
        <td > مالیات 2</td>
        <td>قیمت نهایی فروشگاه</td>
        <td >تخفیف تکفروشی </td>



        <?php

        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $factor->getFactorDetail($rows->factorid);
                $company->getCompanyDetail($factor->company);
                $entity->OneEntityRowPriceLive($rows->id);

                ?>

                <tr>
                    <td><b><?php echo $productid; ?></b></td>
                    <td><b><?php echo $product->name; ?></b></td>

                    <td><?php echo $rows->currentgheymatmasraf; ?></td>

                    <td><?php echo $rows->tax; ?></td>

                    <td  ><b><?php echo round($entity->FinalPriceLive); ?></b>
                    </td> <td style="background: aquamarine;"><?php $maliat2 = $rows->tax2; echo  round($maliat2); ?></td>
                    <td style="background: aquamarine"><?php  $store_price = $entity->FinalPriceLive + (($entity->FinalPriceLive / 100 )  * $percent) ; echo round($store_price); ?></td>
                    <td><b><?php echo $rows->takhfifTakForoshi; ?></b></td>
                </tr>
                <?php
            }
            echo '</table>';
        }

    }


}

?>