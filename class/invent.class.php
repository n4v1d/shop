<?php

class invent
{


    public $total;
    public $markazi;
    public $bahonar;
    public $fazel;
    public $naft;
    public $fatemi;
    public $padad;
    public $vahabi;

    public function GetCompanyProductLIst($company)
    {
        $dbconnect = new db();
        $sql = "select * from prco where companyid = :company order by id Desc";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("company",$company);

        $result->execute();

        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            ?>
            <table class="table table-hover table-responsive table-bordered table-hover text-center">
                <thead>
                <td>کد کالا</td><td>نام کالا</td> <td>نام شرکت</td> <td>حداقل موجودی</td>  <td> مجموع خرید</td>   <td>انبار مرکزی</td> <td>آخرین خرید</td> <td>باهنر</td> <td>فاضل</td>  <td>نفت</td> <td>پاداد</td> <td>فاطمی</td> <td>وهابی</td> <td>مدیریت</td>
                </thead>
            <?php

            $product = new product();
            $comp  = new company();

            foreach ($data as $rows)
            {
                $this->GetProductEntity($rows->productid);
                $product->GetProductData($rows->productid);
                $comp->getCompanyDetail($rows->companyid);
                ?>
              <tr>
                 <td><?php echo $rows->productid; ?></td>
                 <td><?php echo $product->name; ?></td>
                 <td><?php echo $comp->name; ?></td>
                 <td><?php echo $rows->min; ?></td>


                 <td ></td>
<td <?php if($this->markazi < $rows->min)
                     {
                         ?> style="background-color: #ff6161" <?php
                     }?>><?php echo $this->markazi; ?></td>
                                      <td>

</td>


                 <td  <?php if($this->bahonar < $rows->min)
                     {
                         ?> style="background-color: #ff6161" <?php
                     }?>>
                     <?php echo $this->bahonar; ?>
                     </td>
               <td  <?php if($this->fazel < $rows->min)
                     {
                         ?> style="background-color: #ff6161" <?php
                     }?>>
                     <?php echo $this->fazel; ?>

                      </td>
               <td  <?php if($this->naft < $rows->min)
                     {
                         ?> style="background-color: #ff6161" <?php
                     }?>>
                     <?php echo $this->naft; ?>

                     </td>
               <td  <?php if($this->padad < $rows->min)
                     {
                         ?> style="background-color: #ff6161" <?php
                     }?>>
                     <?php echo $this->padad; ?>
 </td>
                   <td  <?php if($this->fatemi < $rows->min)
                         {
                             ?> style="background-color: #ff6161" <?php
                         }?>>
                         <?php echo $this->fatemi; ?>

                          </td>
                       <td  <?php if($this->vahabi < $rows->min)
                         {
                             ?> style="background-color: #ff6161" <?php
                         }?>>
                         <?php echo $this->vahabi; ?>

                          </td>


                 <td><a href="deleteEntityRelation.php?RowId=<?php echo $rows->id;?>"><span  class="glyphicon glyphicon-trash"></span></a> </td>
</tr>
                <?php
            }
        }

        ?>
        <a href="getEntityExcell.php?Companyid=<?php echo $company?>"><h4>خروجی اکسل</h4></a>
        <?php
    }


    public function DeleteRelation($id)
    {
        $dbconnect= new db();
        $sql = "delete from prco where id = :id";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$id);

        $result->execute();

        if($result->rowCount() > 0)
            {
                Header("location:index.php");

            }
            else
                {
                    echo 'خطا در حذف ارتباط';
                }

    }




    public function AddRelation($productid,$company,$min)
    {
        $dbconnect = new db();
        $sql = "insert into prco (productid,companyid,min) values (:productid,:companyid,:min)";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("productid",$productid);
        $result->bindParam("companyid",$company);
        $result->bindParam("min",$min);

        $result->execute();

        if($result->rowCount() > 0)
            {
                echo '1';
            }
            else
                {
                    echo '0';
                }

    }


    public function GetProductRelation($productid)
    {
        $dbconnect = new db();
        $sql = "select * from prco where productid = :productid order by id Desc";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("productid",$productid);

        $result->execute();

        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            ?>
            <table class="table table-hover table-responsive table-bordered table-hover text-center">
                <thead>
                <td>کد کالا</td><td>نام کالا</td> <td>نام شرکت</td>  <td> حداقل موجودی</td> <td>مدیریت</td>
                </thead>
            <?php

            $product = new product();
            $comp  = new company();

            foreach ($data as $rows)
            {
                $product->GetProductData($rows->productid);
                $comp->getCompanyDetail($rows->companyid);
                ?>
              <tr>
                 <td><?php echo $rows->productid; ?></td>
                 <td><?php echo $product->name; ?></td>
                 <td><?php echo $comp->name; ?></td>
                 <td><?php echo $rows->min; ?></td>
                 <td><a href="deleteEntityRelation.php?RowId=<?php echo $rows->id;?>"><span  class="glyphicon glyphicon-trash"></span></a> </td>
</tr>
                <?php
            }
        }
    }




    public function CheckProductExists($product)
    {
        $dbconnect = new db();
        $sql = "select * from prentity where productid = :productid";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("productid",$product);

        $result->execute();

        if($result->rowCount() > 0)
            {
                return '1';
            }
            else
                {
                    return '0';
                }
    }




    public function UpdateCompanyEntity($companyId)
    {
        $dbconnect =  new db();
        $sql = "select * from prco where companyid = :companyid";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("companyid",$companyId);

        $result->execute();

        if($result->rowCount() >0)
            {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows)
                    {
                        $this->getEntity($rows->productid);
                    }

            }
    }


    public function getEntity($productid)
    {
        $url1 = "http://192.168.1.3:1234/shop/api/single.php?id=" . $productid;
        $anbar1 = file_get_contents($url1);




        if($this->CheckProductExists($productid)  == 1)
            {
                $this->UpdateEntity($productid,$anbar1);
            }
            else
                {
                    $this->InsertEntity($productid,$anbar1);
                }
    }




public function InsertEntity($productid,$anbar1 )
{
    $dbconnect = new db();
    $sql = "insert into prentity (productid , anbar1) values (:productid , :anbar1)";

    $result = $dbconnect->connect->prepare($sql);
    $result->bindParam("productid",$productid);
    $result->bindParam("anbar1",$anbar1);

    $result->execute();
}



public function UpdateEntity($productid,$anbar1)
{
    $dbconnect = new db();
    $sql = "update prentity set  anbar1 = :anbar1 where productid = :productid";

    $result = $dbconnect->connect->prepare($sql);
    $result->bindParam("productid",$productid);
    $result->bindParam("anbar1",$anbar1);

    $result->execute();
}


public function GetProductEntity($productId)
{
    $dbconnect = new db();
    $sql = "select * from prentity where productid = :productid";

    $result = $dbconnect->connect->prepare($sql);
    $result->bindParam("productid",$productId);

    $result->execute();

    if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);

            foreach ($data as $rows)
                {
                    $this->markazi = $rows->anbar1;
                    $this->bahonar = $rows->anbar2;
                    $this->fazel = $rows->anbar3;
                    $this->naft = $rows->anbar4;
                    $this->padad = $rows->anbar5;
                    $this->fatemi = $rows->anbar6;
                    $this->vahabi = $rows->anbar7;

                }
        }
}


}


?>