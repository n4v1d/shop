<?php
class product
{
    public $name;
    public $company;
    public $TotalBuyCount;
    public $TotalEshantionConunt;

    public $loyalty;
    public $loyaltyStatus;

    public function addProduct($name,$productid,$company,$inpack)
    {
        $dbconnect = new db();
        $sql = "insert into product (name,productid,company,inpack) values (:name,:productid,:company,:inpack)";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("name",$name);
        $result->bindParam("productid",$productid);
        $result->bindParam("company",$company);
        $result->bindParam("inpack",$inpack);
        if($result->execute())
        {
            echo 'عملیات ثبت کالا با موفقیت انجام شد ';
        }
        else
        {
            echo 'خطا';
        }

    }



    public function searchName($name)
    {
        $dbconnect = new db();
        $query='SELECT * FROM product WHERE name LIKE ?';
        $stmt= $dbconnect->connect->prepare($query);
        $stmt->execute(array("%$name%"));

        if($stmt->rowCount() > '0')
        {
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            ?>
            <script>
                $(".productid").click(function () {
                    var id = this.id;
                    $("#id").val(id);

                });
            </script>
            <?php
            foreach ($data as $rows)
            {
                ?>
                <a href="#<?php echo $rows->productid; ?>" data-dismiss="modal" class="productid" id="<?php echo $rows->productid; ?>" ><?php echo $rows->name; ?></a><br><br>

                <?php
            }

        }
        else
        {
            echo 'هیچ محصولی با این نام پیدا نشد';
        }


    }


    public function searchEshantionName($product_id)
    {
        $dbconnect = new db();
        $sql = "select * from product where productid = :productid ";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("productid" , $product_id);
        $result->execute();

        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                echo $rows->name;
            }
        }
        else
        {
            echo 'کالا یافت نشد';
        }
    }


    public function GetProductData($id)
    {
        $dbconnect = new db();
        $sql = "select * from product where productid = :productid ";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("productid", $id);
        $result->execute();

        if ($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $this->name  = $rows->name;
                $this->company  = $rows->company;
                $this->loyalty  = $rows->loyalty;
                $this->loyaltyStatus  = $rows->loyaltyStatus;
            }
        }

    }


    public function UpdataData($id,$name,$company)
    {
        $dbconnect = new db();
        $sql = "update product set name = :name , company = :company where productid = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("name",$name);
        $result->bindParam("company",$company);
        $result->execute();

        if($result->rowCount() > '0')
        {
            ?>
            <script>
                alert('کالا با موفقت بروز رسانی شد');
            </script>
            <?php
        }
        else
        {
            ?>
            <script>
                alert(خطا در بروزسانی ');
            </script>
        <?php        }
    }




public function GiveLastBuyReport($productid)
{
    require 'lib/jdf.php';
    $company = new company();
    $factor = new factor();

    $product =  new product();
    $product->GetProductData($productid);

    $dbconnect = new db();
    $sql = "select * from factorentity where productid = :productid and feshantion =  '0' order by id Desc limit 0,10  ";

    $result = $dbconnect->connect->prepare($sql);
    $result->bindParam("productid",$productid);

    $result->execute();
    ?>
    <table class="table table-responsive table-bordered text-center " >  <thead > <td>نام کالا   </td> <td>شماره فاکتور  </td><td >تاریخ </td><td>نام شرکت </td>  <td>قیمت واحد </td> <td>قیمت فروش </td><td>قیمت مصرف </td><td>درصد حجمی  </td><td>درصد نقدی  </td><td>مالیات</td> <td> درصد<br> اشانتیون <br>شرکتی </td><td>درصد اشانتیون </td>  <td>قیمت نهایی</td>  <td > مالیات 2</td>  <td>قیمت نهایی فروشگاه</td>    <td> حاشیه سود</td>  <td>تخفیف تکفروشی </td>  <td>سود ناخالص</td>  </th>



        <?php

        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $factor->getFactorDetail($rows->factorid);
                $company->getCompanyDetail($factor->company);

                ?>

                <tr>
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
                    <td ><b><?php echo $rows->finalPrice; ?></b>
                    </td> <td style="background: aquamarine;"><?php $maliat2 = $rows->tax2; echo  round($maliat2); ?></td>
                    <td style="background: aquamarine"><?php  $store_price = $rows->finalPrice + (($rows->finalPrice / 100 )  * 5) ; echo round($store_price); ?></td>
                    <td><b><?php echo $rows->hashiyesood; ?></b></td>
                    <td><b><?php echo $rows->takhfifTakForoshi; ?></b></td>
                    <td><b><?php echo $rows->soodNakhales; ?></b></td>
                </tr>
                <?php
            }
        }
        else
        {
            echo 'قبلا خریدی نداشتیم';
        }

        }





        public function GiveLastBuyReportFranchise($productid,$percent = 0)
        {
        require 'lib/jdf.php';
        $company = new company();
        $factor = new factor();
        $entity = new entity();

        $product =  new product();
        $product->GetProductData($productid);

        $dbconnect = new db();
        $sql = "select * from factorentity where productid = :productid and feshantion =  '0' order by id Desc limit 0,10  ";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("productid",$productid);

        $result->execute();
        ?>
        <table class="table table-responsive table-bordered text-center " >  <thead > <td>نام کالا   </td> <td>شماره فاکتور  </td><td >تاریخ </td><td>نام شرکت </td>  <td>قیمت واحد </td> <td>قیمت فروش </td><td>قیمت مصرف </td><td>درصد حجمی  </td><td>درصد نقدی  </td><td>مالیات</td> <td> درصد<br> اشانتیون <br>شرکتی </td><td>درصد اشانتیون </td>  <td>قیمت نهایی</td>  <td > مالیات 2</td>  <td>قیمت نهایی فروشگاه</td>    <td> حاشیه سود</td>  <td>تخفیف تکفروشی </td>  <td>سود ناخالص</td>  </th>



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
            }
            else
            {
                echo 'قبلا خریدی نداشتیم';
            }

            }




            public function GetTotalBuyCount($productid)
            {
                $dbconnect  = new db();

                $sql =  "select * from factorentity where productid = :productid";

                $result = $dbconnect->connect->prepare($sql);

                $result->bindParam("productid",$productid);


                $result->execute();



                $totalCount = '0';
                $totalEshantionCount = '0';


                if($result->rowCount() > '0')
                {
                    $data = $result->fetchAll(PDO::FETCH_OBJ);

                    foreach ($data as $rows)
                    {
                        $totalCount = $totalCount + ($rows->box * $rows->boxin);
                    }
                    $this->TotalBuyCount = $totalCount;
                    ?>
                    <?php
                }

            }


                public function GetTotalEshantionCount($productid)
                {
            $dbconnect  = new db();

            $sql =  "select * from factorentity where eshantionCode = :productid";

            $result = $dbconnect->connect->prepare($sql);

            $result->bindParam("productid",$productid);


            $result->execute();



            $totalCount = '0';
            $totalEshantionCount = '0';


            if($result->rowCount() > '0')
            {
                $data = $result->fetchAll(PDO::FETCH_OBJ);

                foreach ($data as $rows)
                {
                    $totalCount = $totalCount + ($rows->eshantion * $rows->eshantionin);
                }
                $this->TotalEshantionConunt = $totalCount;
                ?>
                <?php
            }








        }







        public  function getAllFactorForUpdate()
        {
            $dbconnect = new db();
            $sql = "select * from factor";
            $result = $dbconnect->connect->prepare($sql);
            $result->bindParam("id",$id);
            $result->execute();
            if($result->rowCount() > '0')
            {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows)
                {
                    echo file_get_contents("'http://192.168.1.3/shop/UpdateFactorStatusAuto.php?id=$rows->id&Save=$rows->saver&status=$rows->status");
                }
            }

            else
            {
                echo 'خطا در بستن فاکتور';
            }

        }



        public  function UpdateFactorAutomatic($id,$saver,$statuus)
        {
            $dbconnect = new db();
            $sql = "update factor set status = :status , saver = :saver and where id = :id";
            $result = $dbconnect->connect->prepare($sql);
            $result->bindParam("id",$id);
            $result->bindParam("saver",$saver);
            $result->bindParam("status",$statuus);
            $result->execute();
            if($result->rowCount() > '0')
            {
                echo 'فاکتو با موفقیت بسته شد';

            }
            else
            {
                echo 'خطا در بستن فاکتور';
            }

        }











        public function GetProductBuyData($productid , $factorid)
        {
        ?>
        <script>

            $(".waste").click(function() {
                var id = this.id;
                $('#myModal2').modal('show');
                $("#codeid").val(id);

            });

        </script>
        <?php
        require 'lib/jdf.php';
        $company = new company();
        $factor = new factor();
        $product = new product();
        $product->GetProductData($productid);


        $dbconnect = new db();
        $sql = "select * from factorentity where productid = :productid and feshantion =  '0' order by id Desc limit 0,10  ";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("productid",$productid);

        $result->execute();
        ?>
        <div id="this-content" class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <h1 class="text-center alert alert-danger"> <?php echo $product->name ?></h1>
            </div>
            <table class="table table-responsive table-bordered table-hover table-bordered table-striped text-center " >  <thead ><td >تاریخ </td> <td>شماره فاکتور  </td><td>نام شرکت </td>  <td>قیمت واحد </td> <td>قیمت مصرف </td><td>قیمت نهایی</td> <td> مالیات 1</td> <td>مالیات2</td> <td> انتخاب</td>     </thead>



                <?php

                if($result->rowCount() > '0')
                {
                    $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows)
                {
                    $factor->getFactorDetail($rows->factorid);
                    $company->getCompanyDetail($factor->company);

                    ?>

                    <tr>
                        <td><?php echo jdate('Y/m/d',$factor->time,'','','en'); ?></td>
                        <td ><?php echo $factor->factorid; ?></td>
                        <td ><?php echo $company->name; ?></td>
                        <td><?php echo $rows->price; ?></td>
                        <td><?php echo $rows->currentgheymatmasraf; ?></td>
                        <td><b><?php echo $rows->finalPrice; ?></b></td>
                        <td><b><?php echo $rows->tax; ?></b></td>
                        <td><b><?php echo $rows->tax2; ?></b></td>
                        <td><b><button id="<?php echo $rows->id; ?>" class="btn btn-lg input-lg form-control btn-success waste">انتخاب</button></td>
                    </tr>
                <?php
                }
                echo '</table>
</div>
';
                ?>




                    <div class="modal fade" id="myModal2" role="dialog">

                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">جستوجوی نام شرکت</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>تعداد </label>
                                        <input type="text" class="form-control" id="count">
                                        <input type="text" class="form-control" hidden id="codeid" >

                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-success" id="addZayeat">ثبت</button>
                                    </div>

                                    <div id="searchresult">

                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <script>
                        $("#addZayeat").click(function () {
                            var count = $("#count").val();
                            var rowid = $("#codeid").val();
                            var factorid = '<?php echo $factorid; ?>';


                            $.post("addZayeat.php", {factorid: factorid,rowid: rowid , count :count}, function (data) {

                                if(data == 1)
                                {
                                    refresh();
                                    $('#myModal2').modal('hide');
                                    $(window).load(function() {
                                        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
                                    });

                                }
                                else
                                {
                                    alert('خطا در ثبت اطلاعات');
                                }

                            });
                        });
                    </script>

                    <?php
                }
                else
                {
                    echo 'قبلا خریدی نداشتیم';
                }

                ?>
                <?php

                }


                public function getProductBuyReport($productid , $array )
                {




                $dbconnect = new db();
                $sql2 = "select * from factorentity  where factorid in ('" . implode("','", $array) . "') and productid = $productid";


                $result2 = $dbconnect->connect->prepare($sql2);
                $join = join(",", $array);
                // $result2->bindParam(1,$join);
                //    $result2->bindParam(2,$productid);

                $radif = 1;
                $result2->execute();

                $factor = new factor();
                $company = new company();
                $fprice = 0;
                if($result2->rowCount() > 0)
                {
                $data = $result2->fetchAll(PDO::FETCH_OBJ);
                ?>
                <table class="table table-responsive table-hover table-bordered table-striped text-center">

                    <thead>
                    <td>ردیف</td>
                    <td>نام شرکت</td>
                    <td>تاریخ</td>
                    <td> تعداد</td>
                    <td>قیمت واحد</td>
                    <td>درصد حجمی</td>
                    <td>مالیات</td>
                    <td>درصد نقدی</td>
                    <td>جمع کل</td>

                    </thead>
                    <tbody>
                    <?php
                    foreach ($data as $rows)
                    {
                        $factor->getFactorDetail($rows->factorid);
                        $company->getCompanyDetail($factor->company);
                        ?>
                        <tr>
                            <td><?php echo  $rows->id; $radif = $radif + 1; ?></td>
                            <td><?php echo $company->name; ?></td>
                            <td><?php echo jdate('Y/m/d',$factor->time,'','','en'); ?></td>
                            <td> <?php echo $rows->box * $rows->boxin; ?></td>
                            <td> <?php echo $rows->price; ?></td>
                            <td><?php echo $rows->discounthajmi?></td>
                            <td><?php echo $rows->tax?></td>
                            <td><?php echo $rows->discountnaghdi?></td>
                            <td>
                                <?php

                                $count   =  ($rows->box * $rows->boxin);


                                $hajmi = $rows->price - (($rows->price / 100 )  * $rows->discounthajmi);
                                $maliat = $hajmi +  (($hajmi / 100 )  * $rows->tax);

                                $naghdi =  $maliat  - (($maliat / 100 )  * $rows->discountnaghdi);
                                echo round($naghdi * $count);

                                $fprice = $fprice + ($naghdi * $count);
                                ?>

                            </td>
                        </tr>
                        <?php


                    }
                    ?>
                    <tr>
                        <td>جمع کل</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h3><?php echo  number_format(round($fprice)); ?></h3></td>
                    </tr>
    <?php
}
    echo '</table>';


}




public function GetLastProductList()
{
    $dbconnect = new db();
    $sql = "select * from product order by id Desc limit 0,100";

    $result = $dbconnect->connect->prepare($sql);

    $result->execute();
    ?>
                    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 col-lg-offset-4 col-md-offset-4 col-xs-offset-4 col-sm-offset-4 text-center">
        <table class="table table-bordered table-hover table-striped table-responsive">
            <thead>
            <td>کد کالا</td>
            <td>نام کالا</td>
            </thead>
            <tbody>
    <?php
    if($result->rowCount() > 0)
    {
        $data = $result->fetchAll(PDO::FETCH_OBJ);

        foreach ($data as $rows)
        {
            ?>
                <tr>
                    <td><?php echo $rows->productid; ?></td>
                    <td><?php  echo $rows->name;?></td>
                </tr>
    <?php
        }
    }
    echo '</div>';

}




}