<?php
/**
 * Created by PhpStorm.
 * User: Navid Salehi Pour
 * Date: 10/18/2018
 * Time: 9:47 PM
 */

class loyalty
{

    public $price;
    public $masraf;
    public $forosh;
    public $hajmi;
    public $naghdi;
    public $tax;
    public $percent;
    public $finalPrice;
    public $companyId;
    public $BuyDate;
    public $status;
    public $loyalty;

    public function GetTotalProductForLoyalty($froms)
    {
        $dbconnect = new db();
        $sql = "select * from  product where loyaltyStatus = 0 order by id limit  $froms,25";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        $product = new product();


        if($result->rowCount() > 0)
        {
            ?>
            <table class="table table-bordered table-hover table-responsive table-striped text-center">
                <thead class="text-center">
                <th>کد کالا</th>
                <th> نام کالا</th>
                <th> قیمت واحد</th>
                <th>درصد نقدی</th>
                <th>درصد حجمی</th>
                <th>درصد مالیات</th>
                <th>تخفیفات شرکتی</th>
                <th>مبلغ نهایی</th>
                <th>قیمت فروش</th>
                <th>قیمت مصرف</th>
                <th>لویالتی</th>
                <th>ذخیره</th>
                </thead>
                <tbody>

<?php
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $product->GetProductData($rows->productid);
                $this->GetLastBuyData($rows->productid);

                ?>
                <form method="get" action="">
                <tr class="text-center">
                <th><?php echo  $rows->productid; ?></th>
                <th><?php echo $product->name; ?></th>
                <th><?php echo $this->price;?></th>
                <th><?php echo $this->naghdi;?></th>
                <th><?php echo $this->hajmi;?></th>
                <th><?php echo $this->tax;?></th>
                <th><?php echo $this->percent;?></th>
                <th><?php echo $this->finalPrice;?></th>
                <th><?php echo $this->forosh;?></th>
                <th><?php echo $this->masraf;?></th>
                <th style="width: 10%"><input type="text" name="percent" class="input-lg form-control text-center " value="<?php echo $product->loyalty; ?>" placeholder="درصد" ></th>
                <th><button class="btn-lg btn-lg form-control input-lg btn btn-success Save" name="id"
                            <?php
                            if($product->loyaltyStatus > 0)
                            {
                                echo 'disabled="disabled"';
                            }
                            ?>
                            value="<?php echo $rows->productid; ?>" >ثبت</button> </th>
                </tr>
                </form>
                <?php
            }
            ?>
                </tbody>
            </table>

            <?php
        }
    }




    public function GetLastBuyData($productid)
    {
        $dbconnect = new db();
        $sql = "select * from factorentity where productid = :productid order by id  Desc limit 0,1";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("productid",$productid);

        $result->execute();

        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            foreach ($data as $rows)
            {
                $this->price = $rows->price;
                $this->naghdi = $rows->discountnaghdi;
                $this->hajmi = $rows->discounthajmi;
                $this->tax = $rows->tax;
                $this->percent = $rows->eshantionpercent;
                $this->finalPrice = $rows->finalPrice;
                $this->forosh = $rows->currentgheymatforrosh;
                $this->masraf = $rows->currentgheymatmasraf;
            }

        }
    }


    public function UpdateProductLoyalty($productid , $percent)
    {
        $time = time();
        $dbconnect = new db();

        $sql = "update product set loyalty = :loyalty , loyaltyStatus = 1  , loyaltyUpdate = :loyaltyUpdate where productid = :productid";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("productid",$productid);
        $result->bindParam("loyalty",$percent);
        $result->bindParam("loyaltyUpdate",$time);

        $result->execute();

        if($result->rowCount() > 0)
        {
            echo 'ok';
        }
        else
        {
            echo 'fail';
            var_dump($result->errorInfo());

        }

    }


}