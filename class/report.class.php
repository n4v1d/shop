<?php
class report
{

    public $masraf;
    public $forosh;

    public $ListArray = array();
    public function GetAllFactorWithNaghdiDiscountList()
    {
        $dbconnect = new db();
        $sql = "select * from factorentity where discountnaghdi > 8 and discountnaghdi < 9  group by factorid";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                 array_push($this->ListArray,$rows->factorid);
            }
        }
    }


    public function GetFactorDataForDiscountNaghdi($array)
    {
        $dbconnect = new db();
        $sql = "select * from factor where id  in ('" . implode("','", $array) . "')  order by company ";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();
        ?>
            <table class="table table-responsive table-bordered table-striped text-center">
                <thead>
                    <td> ردیف</td>
                    <td>نوید</td>
                    <td>شماره فاکتور</td>
                    <td>نام شرکت</td>
                    <td>تاریخ</td>
                    <td>بروزرسانی</td>
                </thead>
        <?php
        if($result->rowCount() > 0)
        {
            $company = new company();
            $i = 1;
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $company->getCompanyDetail($rows->company);
                ?>
                <thead>
                <td><?php echo $i; ?></td>
                <td><?php echo $rows->id; ?></td>
                <td><b><?php echo $rows->factorid;?></b></td>
                <td><?php echo $company->name; ?></td>
                <td><?php echo jdate('Y/m/d',$rows->time , '','','en') ?></td>
                <td><a href="ReCalc.php?id=<?php echo $rows->id?>"><button class="btn btn-success btn-lg">بروز رسانی</button></a></td>

                </thead>
                <?php
                $i++;
            }
        }
    }



    public function GetProductList()
    {
        $dbconnect = new db();
        $sql = "select * from product order by productid ";
        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        if($result->rowCount() > 0)
            {
                ?>
                    <table class="table table-striped table-bordered table-responsive table-hover">
                        <thead>
                            <td>کد کالا</td>
                            <td>نام محصول</td>
                            <td>قیمت فروش</td>
                            <td>قیمت مصرف</td>
                        </thead>
                <?php
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows)
                    {
                           $this->masraf = 0;
                           $this->forosh = 0;

                        $this->GetProductData($rows->productid);
                        ?>
                        <tr>
                        <td><?php  echo  $rows->productid; ?> </td>
                        <td><?php  echo  $rows->name; ?> </td>
                        <td><?php echo $this->forosh?></td>
                        <td><?php echo $this->masraf?></td>
                        </tr>
                        <?php

                    }
            }

    }



    public function GetProductData($id)
    {
        $this->masraf = 0;
        $this->forosh = 0;

        $dbconnect = new db();
        $sql = "select * from factorentity where productid = $id  and feshantion = 0 order by id desc limit 0,1";
        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        if($result->rowCount() > 0)
            {

                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows)
                    {

                        $this->forosh = $rows->currentgheymatforrosh;
                        $this->masraf = $rows->currentgheymatmasraf;

                    }
            }

    }

    public function GetDiscountRow($id)
    {
        $dbconnect = new db();
        $sql = "select * from factorentity where factorid = $id and discountnaghdi > 8 and discountnaghdi < 9 ";
        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        if($result->rowCount() > 0)
            {

                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows)
                    {

                       // echo $rows->discountnaghdi;
                        $price = ($rows->price / 100) * $rows->discountnaghdi;
                        $newPrice = $rows->price - $price;
                        $this->Update($rows->id , round($newPrice));

                    }
            }
    }

    public function Update($id , $price)
    {

        $dbconnect = new db();
        $sql = "update factorentity set price = :price , discountnaghdi = 0 where id = :id";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("price",$price);
        $result->execute();

        if($result->rowCount() > 0)
            {
                echo 'ok';
            }
        else
            {
                echo 'fail';
            }
    }
}



?>