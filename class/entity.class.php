<?php
class entity
{
    public $productcode;
    public $productname;
    public $productname2;
    public $productprice;
    public $oldproductprice;
    public $productforosh;
    public $productmasraf;
    public $productCompany;
    public $inpack;
    public $name;
    public $id;
    public $Box;
    public $InBox;
    public $Price;

    public $tax;
    public $tax2;
    public $hajmi;
    public $naghdi;
    public $eshantionpercent;



    public $eshantionCode;
    public $eshantionbox;
    public $eshantionInBox;
    public $eshantionInPrice;
    public $FinalPriceLive;


    public $factorid;

    public function   getProductData($id)
    {
        $dbconnect = new db();
        $sql = "select * from product where productid = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->execute();
        if($result->rowCount() > '0') {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $this->productname = $rows->name;
                $this->productCompany = $rows->company;
                $this->inpack = $rows->inpack;

            }
        }
        else
        {
            echo 'اطلاعات این کالا ثبت نشده';
        }
    }




    public function   getEshantionData($id)
    {
        $dbconnect = new db();
        $sql = "select * from product where productid = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->execute();
        if($result->rowCount() > '0') {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $this->productname2 = $rows->name;
                $this->productname2 = $rows->name;

            }
        }
        else
        {
            echo 'اطلاعات این کالا ثبت نشده';
        }
    }


    /**
     * @param $id
     */



    public function getFactorEntity($id)
    {
        $branch = new branch();
        $factor = new factor();
        $factor->getFactorDetail($id);
        $branch->GetBranchPercent($factor->branch);

        $branch->



        $soodPrices;
        $jamegheymatekham = '0';
        $jamegheymatezayeat = '0';

        $shomare = '1' ; $GhabelPardakhtJadid = '0';

        $dbconnect = new db();
        $sql = "select * from factorentity where factorid = :id order by feshantion ASC , id ASC ";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id,PDO::PARAM_INT);
        $result->execute();
        if($result->rowCount() > '0') {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            $finalprice = '0';
            $fap = '0';
            $totalpers = '0';
            ?>
            <script xmlns:font-size="http://www.w3.org/1999/xhtml">


                $(".delete").click(function () {
                        var id = this.id;
                        var r = confirm("ایا میخواهید این ردیف را حذف نمایید!");
                        if (r == true) {
                            $.post("page.php", {page: 'deleteEntity', id: id}, function (data) {
                                refresh();
                            });
                        }
                    }
                );


                $(".editbtn").click(function () {
                    var id = this.id;
                    var factorid = <?php echo $id; ?> ;
                    $.post("page.php", {
                        page: 'editEn' +
                            'tity', id: id, factorid: factorid
                    }, function (data) {
                        $("#result").html(data);
                        $("#result").slideDown();
                        window.scrollTo(100, 100)

                    });
                });

                $(".payment").click(function () {
                    var id = this.id;

                    window.open('/shop/PaymentEditor.php?Entityid=' + id, 'انجام عملیات گروهی', 'width=900, height=900%, resizable=1, left=0, top=0, location=1, menubar=1, scrollbars=1');

                });
                function saveToDatabase(editableObj,column,id) {
                    $(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
                    $.ajax({
                        url: "saveedit.php",
                        type: "POST",
                        data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
                        success: function(data){
                            $(editableObj).css("background","yellow");
                            $("#stdResult").html(data);
                            refresh();
                        }
                    });
                }

                $(".hided").hide();

                $("#franch").click(function () {
                    $(".hided").toggle();
                });



                $(".description").keyup(function () {
                    var id = this.id;
                    var factorid = <?php echo $id; ?> ;
                    var description = $(this).val();
                    $.post("UpdateEntitiyDescription.php", {
                        id: id,
                        factorid: factorid,
                        description: description
                    }, function (data) {
                    });
                    });


            </script>

            <table width="100%" id=""
                   class="table table-responsive table-fixed table table-hover table-striped table-bordered text-center ">
                <tr style="">
                    <td  style="color:black; font-size: 15px; background-color: #12J875" class="uneditable">رد<br>یف</td>

                    <td style="color:black; font-size: 15px; background-color: #02B875"   >کد<br>کالا</td>

                    <td style="color:black; font-size: 17px; background-color: #02B875" >قیمت فروش قدیم</td>
                    <td style="color:black; font-size: 17px; background-color: #02B875">قیمت مصرف کننده قدیم</td>
                    <td style="color:black; font-size: 17px; background-color: #02B875">قیمت واحد قدیم</td>
                    <td style="color:black; font-size: 17px; background-color: #02B875">  قیمت <br> تمام شده <br> قدیم</td>

                    <td style="color:black; font-size: 17px; background-color: #02B875"><span></span>نام کالا</td>
                    <td style="color:black; font-size: 17px; background-color: #02B875">بسته</td>
                    <td style="color:black; font-size: 17px; background-color: #02B875">تعداد در بسته</td>
                    <td style="color:black; font-size: 17px; background-color: #02B875">تعداد کل</td>
                    <td style="color:black; font-size: 17px; background-color: #02B875">قیمت واحد</td>
                    <td style="color:black; font-size: 17px; background-color: #02B875">قیمت کل</td>
                    <td style="color:black; font-size: 17px; background-color: #c0a16b">کد اشانتیون</td>
                    <td style="color:black; font-size: 17px; background-color: #c0a16b">نام اشانتیون</td>
                    <td style="color:black; font-size: 17px; background-color: #c0a16b"> قیمت اشانتیون</td>

                    <td style="color:black; font-size: 17px; background-color: #c0a16b">تعداد بسته</td>
                    <td style="color:black; font-size: 17px; background-color: #c0a16b">تعداد در بسته اشانتیون</td>
                    <td style="color:black; font-size: 17px; background-color: #c0a16b">تعداد کل اشانتیون</td>
                    <td style="color:black; font-size: 17px; background-color: #ffb2cc">قیمت نهایی اشانتیون</td>
                    <td style="color:black; font-size: 17px; background-color: #c0a16b">قیمت قابل پرداخت</td>


                    <td style="color:black; font-size: 17px; background-color: #afd9ee">درصد تخفیف حجمی</td>
                    <td style="display: none">مبلغ تخفیف حجمی</td>
                    <td style="color:black; font-size: 17px; background-color: #afd9ee">درصد ارزش افزوده</td>
                    <td style="display: none">مبلغ ارزش افزوده</td>
                    <td  style="color:black; font-size: 17px; background-color: #f8ff6f">مالیات 2</td>

                    <td style="display: none">قیمت نهایی هر واحد</td>
                    <td style="color:black; font-size: 17px; background-color: #afd9ee"> درصد تخفیف نقدی</td>
                    <td style="color:black; font-size: 17px; background-color: #4cff5c"> د اِ  </td>
                    <td style="color:black; font-size: 17px; background-color: #c4e3f3"> قیمت نهایی هر واحد</td>
                    <td style="color:black; font-size: 17px; background-color: #c4e3f3"> قیمت قابل پرداخت فاکتور</td>
                    <td> درصد</td>
                    <td style="color:black; font-size: 17px; background-color: #ffb2cc"> قیمت کالا همراه اشانتیون</td>
                    <td style="color:black; font-size: 17px; background-color: #f8ff6f"> قیمت کالا همراه اشانتیون و مالیات2</td>

                    <td style="color:black; font-size: 17px; background-color: #f7ecb5">قابل پرداخت</td>
                    <td style="display: none">درصد اشانتیون</td>
                    <td style="color:black; font-size: 17px; background-color: #e4b9c0">جمع کل</td>
                    <td  style="color:black; font-size: 17px; background-color: #f8ff6f">جمع کل 2</td>
                    <td class="hided"  style="color:black; font-size: 17px; background-color: #72b1ff ; ">فروشگاه ها</td>
                    <td class="hided"  style="color:black; font-size: 17px; background-color: #72b1ff; ">جمع کل فروشگاه ها</td>
                    <td>قیمت فروش</td>
                    <td>قیمت مصرف کننده</td>
                    <td>حاشیه سود</td>

                    <td>تخفیف تکفروشی</td>
                    <td>درصد سود ناخالص</td>
                    <td>یادداشت</td>
                    <td>مدیریت</td>
                </tr>


                <?php
                $ttakhfif = 0;
                $tpers = 0;
                $counter = 0;
                $faptotal = '0';
                $eshanprice2total = '0';
                $fullyTax2 = 0;

                $fullHajmi = 0;




                ////////////////  Total Calculate ////////////////

                $calculate_Total_hajmi = 0;
                $calculate_Total_tax = 0;
                $calculate_Total_tax2 = 0;
                $calculate_Total_naghdi = 0;
                $calculate_Total_percent = 0;

                $calculate_Total_count = 0;
                $calculate_Total_eshantion = 0;


                foreach ($data as $rows) {


                    //////////////////// Calculating All Data

                    $calculate_Total_count = $calculate_Total_count + ($rows->box * $rows->boxin) ;
                    $calculate_Total_eshantion = $calculate_Total_eshantion  + ($rows->eshantionin * $rows->eshantion);

                    $calculate_price = $rows->price;

                    $calculate_count = $rows->box * $rows->boxin;

                    $calculate_Tatal_price = $calculate_count * $calculate_price;


                    $calculate_Hajmi = $calculate_Tatal_price - (($calculate_Tatal_price / 100) * $rows->discounthajmi);
                    $calculate_Hajmi_price =  (($calculate_Tatal_price / 100) * $rows->discounthajmi);
                    $calculate_Total_hajmi = $calculate_Total_hajmi + $calculate_Hajmi_price;


                    $calculate_Tax =  $calculate_Hajmi + (($calculate_Hajmi / 100) * $rows->tax);
                    $calculate_Tax_price =   (($calculate_Hajmi / 100) * $rows->tax);
                    $calculate_Total_tax =  $calculate_Total_tax + $calculate_Tax_price;

                    $calculate_Tax2 =  $calculate_Hajmi + (($calculate_Hajmi / 100) * $rows->tax2);
                    $calculate_Tax_price2 =   (($calculate_Hajmi / 100) * $rows->tax2);
                    $calculate_Total_tax2 =  $calculate_Total_tax2 + $calculate_Tax_price2;



                    $calculate_naghdi =  $calculate_Tax - (($calculate_Tax / 100) * $rows->discountnaghdi);
                    $calculate_naghdi_price =   (($calculate_Tax / 100) * $rows->discountnaghdi);
                    $calculate_Total_naghdi = $calculate_Total_naghdi + $calculate_naghdi_price;


                    $calculate_percent  =  $calculate_naghdi - (($calculate_naghdi / 100) * $rows->eshantionpercent);
                    $calculate_percent_price  =  (($calculate_naghdi / 100) * $rows->eshantionpercent);

                    $calculate_Total_percent = $calculate_Total_percent + $calculate_percent_price;











                    /////////////////////////////
                    $sood = '0';
                    $fap = '0';
                    $this->getProductData($rows->productid);


                    $product_count = $rows->box * $rows->boxin;
                    $product_total_price = $product_count * $rows->price;

                    $eshantion_count = $rows->eshantion * $rows->eshantionin;
                    $eshantion_total_price = $eshantion_count * $rows->eshantionPrice;

                    $total_buy_price = $product_total_price + $eshantion_total_price;

                    $darsad_sood = ('100' / $total_buy_price) * $eshantion_total_price;


                    ?>


                    <tr title="کد کالا :     <?php echo $rows->productid; ?>    &nbsp;&nbsp;&nbsp;  نام کالا : <?php echo $this->productname; ?> "           >
                        <td style="color:black; font-size: 17px; background-color: #12j875" <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?>  ><?php echo $shomare;
                            $shomare = $shomare + '1'; ?></td>

                        <td style="color:black; font-size: 17px; background-color: #02B875" <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?> ><?php echo $rows->productid; ?></td>


                        <td <?php if ($rows->currentgheymatforrosh > $rows->gheymatforoosh) {
                            echo '  style="background-color: #75D648"';
                        }


                        if ($rows->currentgheymatforrosh < $rows->gheymatforoosh) {
                            echo '  style="background-color: #EC6931"';
                        }


                        ?>><?php echo number_format($rows->gheymatforoosh); ?></td>
                        <td <?php if ($rows->currentgheymatmasraf > $rows->gheymatmasraf) {
                            echo '  style="background-color: #75D648"';
                        }

                        if ($rows->currentgheymatmasraf < $rows->gheymatmasraf) {
                            echo '  style="background-color: #EC6931"';
                        }

                        ?>><?php echo number_format($rows->gheymatmasraf); ?> </td>
                        <td <?php if ($rows->gheymatghabli > $rows->price) {
                            echo '  style="background-color: # 75D648"';
                        }

                        if ($rows->gheymatghabli < $rows->price) {
                            echo '  style="background-color: #EC6931"';
                        }

                        ?>>  <?php echo number_format($rows->gheymatghabli); ?> </td>
                        <td <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?>><?php echo $rows->finalPrice; ?></td>

                        <td <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?>><?php echo $this->productname; ?></td>

                        <td <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?>  contenteditable="true" onblur="saveToDatabase(this,'box','<?php echo $rows->id; ?>')" ondblclick="showEdit(this);"  ><?php echo $rows->box; ?></td>

                        <td <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?> contenteditable="true" onblur="saveToDatabase(this,'boxin','<?php echo $rows->id; ?>')" ondblclick="showEdit(this);"><?php echo $rows->boxin; ?></td>
                        <td style="color:red; font-size: 25px; <?php if ($rows->feshantion == '1') {
                            echo 'background-color: pink"';
                        } ?>"><?php
                            $count1 = $rows->boxin * $rows->box;
                            echo $count1;
                            $count = $rows->boxin * $rows->box;
                            ?>
                        </td>

                        <td <?php if ($rows->gheymatghabli > $rows->price) {
                            echo '  style="background-color: #75D648"';
                        }


                        if ($rows->gheymatghabli < $rows->price) {
                            echo '  style="background-color: #EC6931"';
                        }


                        ?> contenteditable="true" onblur="saveToDatabase(this,'price','<?php echo $rows->id; ?>')" ondblclick="showEdit(this);"> <?php echo number_format($rows->price); ?> </td>

                        <td <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?>><?php $ptotal = $rows->price * $count;
                            echo number_format($ptotal);
                            if ($rows->feshantion != '1') {
                                $jamegheymatekham = $jamegheymatekham + $ptotal;
                            } else {
                                $jamegheymatezayeat = $jamegheymatezayeat + $ptotal;

                            } ?></td>

                        <td style="color:black; font-size: 17px; background-color: #c0a16b">
                            <?php
                            echo $rows->eshantionCode;
                            ?>
                        </td>

                        <!-- مشخصات اشانتیون -->
                        <td>
                            <?php
                            $product = new product();
                            $product->searchEshantionName($rows->eshantionCode);
                            ?>
                        </td>

                        <td <?php if(strlen($rows->eshantionCode > '0'))
                        {
                            ?>
                            contenteditable="true" onblur="saveToDatabase(this,'EshantionPrice','<?php echo $rows->id; ?>')" ondblclick="showEdit(this);"
                            <?php
                        }
                        ?>><?php
                            echo $rows->eshantionPrice;

                            ?>
                        </td>


                        <td <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?>
                            <?php if(strlen($rows->eshantionCode > '0'))
                            {
                                ?>
                                contenteditable="true" onblur="saveToDatabase(this,'eshantion','<?php echo $rows->id; ?>')" ondblclick="showEdit(this);"
                                <?php
                            }
                            ?>><?php echo $rows->eshantion; ?></td>

                        <td <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?> <?php if(strlen($rows->eshantionCode > '0'))
                        {
                            ?>
                            contenteditable="true" onblur="saveToDatabase(this,'eshantionin','<?php echo $rows->id; ?>')" ondblclick="showEdit(this);"
                            <?php
                        }
                        ?>><?php echo $rows->eshantionin; ?></td>


                        <td style="color:blue; font-size: 25px; <?php if ($rows->feshantion == '1') {
                            echo 'background-color: pink"';
                        } ?>"><?php echo $rows->eshantion * $rows->eshantionin; ?></td>


                        <td style="background-color: #ffb2cc"
                        >
                        <?php

                        $eshantion_final = $rows->eshantionPrice - (($rows->eshantionPrice / '100') * $darsad_sood);

                        $eshantion_naghdi = ($eshantion_final / '100') * $rows->discounthajmi;

                        $eshantion_tax = ($eshantion_final - $eshantion_naghdi) / '100' * $rows->tax;
                        $eshantion_with_tax = ($eshantion_final - $eshantion_naghdi) + $eshantion_tax;

                        $final_eshantionProduct_price = $eshantion_with_tax - (($eshantion_with_tax / '100') * $rows->discountnaghdi);
                        $final_eshantionProduct_price =  $final_eshantionProduct_price   - (($final_eshantionProduct_price   / '100') * $rows->eshantionpercent);
                        echo round($final_eshantionProduct_price , 1);


                        ?>
                        </td>


                        <!-- قیمت قابل پرداخت کالای اشانتیون -->

                        <td style="color:red; font-size: 20px;">
                            <?php

                            $final_price_eshantion = $final_eshantionProduct_price * $eshantion_count;
                            echo number_format(round($final_price_eshantion, 1));
                            ?>
                        </td>


                        <td style="color:black; font-size: 17px; background-color: #afd9ee" <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?> contenteditable="true" onblur="saveToDatabase(this,'hajmi','<?php echo $rows->id; ?>')" ondblclick="showEdit(this);"><?php echo $rows->discounthajmi; ?>


                        </td>

                        <td style="display:none " <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?>   > <?php $percent = $rows->price / '100';
                            $dhajmi = $percent * $rows->discounthajmi;

                            $fullHajmi = $fullHajmi + ($dhajmi * $count);
                           ?> </td>

                        <td  <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?> contenteditable="true" onblur="saveToDatabase(this,'tax','<?php echo $rows->id; ?>')" ondblclick="showEdit(this);" ><?php echo $rows->tax;

                        ?> </td>


                        <td  style="color:black; font-size: 17px; background-color: #f8ff6f"   contenteditable="true" onblur="saveToDatabase(this,'tax2','<?php echo $rows->id; ?>')" ondblclick="showEdit(this);" ><?php echo $rows->tax2; ?> </td>



                        <td  style="display: none" <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?> ><?php $percent = ($rows->price - $dhajmi) / '100';
                            $tax = $percent * $rows->tax;
                            echo $tax; ?>  </td>

                        <td style="display: none" <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?>  ><?php $tp = $rows->price - $dhajmi + $tax;
                            echo $tp;
                            $finalprice = $finalprice + $tp; ?>  </td>





                        <td <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?> contenteditable="true" onblur="saveToDatabase(this,'naghdi','<?php echo $rows->id; ?>')" ondblclick="showEdit(this);"  > <?php echo $rows->discountnaghdi; ?> </td>

                        <td style="color:black; font-size: 17px; background-color: #4cff5c"; contenteditable="true" onblur="saveToDatabase(this,'eshantionpercent','<?php echo $rows->id; ?>')"
                        > <?php echo $rows->eshantionpercent; ?> </td>


                        <td style="color:black; font-size: 17px; background-color: #c4e3f3" <?php if ($rows->feshantion == '1') {
                                echo '  style="background-color: pink"';
                            } ?> ondblclick="showEdit(this); ><?php

                        $percent = $tp / '100';
                        $dnaghdi = $percent * $rows->discountnaghdi;

                        $df = $tp - $dnaghdi;
                        $df = $df - (($df / '100') * $rows->eshantionpercent);

                        if ($rows->feshantion == '1') {
                            echo '<b style="color:red; font-size: 20px" >' . round($df, 2) . '</b>';
                        } else {
                            echo '<b style="color:green; font-size: 20px" >' . round($df, 2) . '</b>';
                        }
                        ?>
                                </td>


                                <td style="color:black; font-size: 17px; background-color: #c4e3f3">
                        <?php
                        $factor_price = $df * $count;
                        echo round($factor_price, 3);
                        ?>
                        </td>
                        <!-- درصد اشانتیون -->
                        <td>

                            <?php

                            echo round($darsad_sood, 3);

                            ?>

                        </td>


                        <td style="color:black; font-size: 17px; background-color: #ffb2cc" <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?> ><?php

                            $percent = $tp / '100';
                            $dnaghdi = $percent * $rows->discountnaghdi;
                            $dcf = $tp - $dnaghdi;

                            $df = $dcf - (($dcf / '100') * $darsad_sood);
                            $df = $df - ((  $df / '100' ) * $rows->eshantionpercent);
                            if ($rows->feshantion == '1') {
                                echo '<b style="color:red; font-size: 20px" >' . number_format(round($df, 2)) . '</b>';
                            } else {
                                echo '<b style="color:green; font-size: 20px" >' . number_format(round($df, 2)) . '</b>';
                            }
                            ?>
                        </td>
                        <td style="color:black; font-size: 17px; background-color: #f8ff6f" <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?> ><?php

                            $percent = $tp / '100';
                            $dnaghdi = $percent * $rows->discountnaghdi;
                            $dcf = $tp - $dnaghdi;

                            $df = $dcf - (($dcf / '100') * $darsad_sood);
                            $df0 = $df - ((  $df / '100' ) * $rows->eshantionpercent);
                            $df2 = $df0 + ((  $df0 / '100' ) * $rows->tax2);
                            if ($rows->feshantion == '1') {
                                echo '<b style="color:red; font-size: 20px" >' . number_format(round($df2, 2)) . '</b>';
                            } else {
                                echo '<b style="color:green; font-size: 20px" >' . number_format(round($df2, 2)) . '</b>';
                            }
                            ?>
                        </td>


                        <td style="color:black; font-size: 17px; background-color: #f7ecb5" <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?> ><?php
                            if ($rows->feshantion == '1') {

                                ;
                                echo '<strong style="color:red; font-size: 20px" >0</strong>';
                            } else {
                                $fp0 = $count * $df ;
                                $fp = $fp0 - (($fp0 / 100) * $rows->eshantionpercent);
                                $fap = round($fap + $fp);
                                echo '<strong style="color:green; font-size: 20px" > ' . number_format(round($fp)) . '</strong>';
                                $faptotal = $faptotal + $fap;
                            }

                            ?>   </td>

                        <td style="display: none" <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?> ></td>
                        <td style="display:none;" <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?> >
                            <?php


                            if ($rows->feshantion == '1') {
                                echo '<strong style="color:red; font-size: 20px">' . $rows->price . '</strong>';
                            } else {
                                ///////////////////////////////////////////////////////
                                ///
                                $tedadkol = $rows->box * $rows->boxin;
                                $tedadeshantion = $rows->eshantion * $rows->eshantionin;

                                $tedadfinal = $tedadkol + $tedadeshantion;

                                $gheymattamamshode0 = ($rows->price * $tedadkol) / ($tedadkol + $tedadeshantion);
                                $gheymattamamshode1 = $gheymattamamshode0 - ($gheymattamamshode0 / '100' * $rows->discounthajmi);
                                $gheymattamamshode2 = $gheymattamamshode1 + ($gheymattamamshode1 / '100' * $rows->tax);
                                $gheymattamamshode3 = $gheymattamamshode2 - ($gheymattamamshode2 / '100' * $rows->discountnaghdi);
                                $gheymattamamshode = $gheymattamamshode3 - ($gheymattamamshode3 / '100' * $rows->eshantionpercent);
                                //$gheymattamamshode = $df - ($df / 100 * $takhfifeshantion) - ($eshanprice2 / $count) ;
                                echo '<b style="color:green; font-size: 20px">' . round($gheymattamamshode) . '</b>';
                                $GhabelPardakhtJadid = $GhabelPardakhtJadid + ($tedadfinal * $gheymattamamshode);

                            }


                            ?>
                        </td>
                        <td style="color:black; font-size: 17px; background-color: #e4b9c0" <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?> >

                            <!--  جمع کل ستون-->

                            <?php

                            $eper = $rows->eshantionpercent;

                            $total = $final_price_eshantion + $faptotal ;

                            echo number_format(round($total));



                            ///   کم کردن مبلغ مالیات
                            ///


                            $tts =  $tcs = $final_price_eshantion + $faptotal;
                            $total_show = $total_show + $total_fianl;

                            $final_price_eshantion = '0';
                            $faptotal = '0';


                            ?>
                        </td>  <td  style="color:black; font-size: 17px; background-color: #f8ff6f">
                            <!-- Tax 2  -->
                            <?php

                            if($rows->tax2 > 0)
                            {
                                $tts0 = $tts + (($tts / 100) * $rows->tax2);
                                echo  $tts2 = number_format($tts0 - (($tts0 / 100) * $rows->eshantionpercent));
                                $tts3 = $tts + (($tts / 100) * $rows->tax2);
                                $fullyTax2 = $fullyTax2 + $tts3;

                            }
                            ?>


                        </td>

                        <td class="hided"  style="color:black; font-size: 17px; background-color: #72b1ff; ">
                            <?php $df3 = round($df2 + (($df2/100) * $branch->branchPercent)); echo  number_format($df3); ?></td>
                        <td class="hided"   style="color:black; font-size: 17px; background-color: #72b1ff; "><?php if($rows->feshantion != 1)
                            {
                                echo  number_format(round($df4 =  $df3 *  ($rows->box * $rows->boxin))) ;$store_sum = $store_sum + $df4;
                            }?></td>

                        <td <?php if ($rows->currentgheymatforrosh > $rows->gheymatforoosh) {
                            echo '  style="background-color:  #75D648"';
                        }

                        if ($rows->currentgheymatforrosh < $rows->gheymatforoosh) {
                            echo '  style="background-color:  #EC6931"';
                        }

                        ?>  contenteditable="true" onblur="saveToDatabase(this,'forosh','<?php echo $rows->id; ?>')">

                            <?php

                            echo $rows->currentgheymatforrosh ?></td>
                        <td style="color:green; <?php if ($rows->currentgheymatmasraf > $rows->gheymatmasraf) {
                            echo 'background-color: #75D648 "';
                        }

                        if ($rows->currentgheymatmasraf < $rows->gheymatmasraf) {
                            echo 'background-color: #EC6931 "';
                        }

                        ?>"  contenteditable="true" onblur="saveToDatabase(this,'masraf','<?php echo $rows->id; ?>')"><?php echo $rows->currentgheymatmasraf; ?> </td>
                        <td style="color: blue;  <?php if ($rows->feshantion == '1') {
                            echo 'background-color: pink"';
                        } ?>
                                "><b>
                                <?php
                                if ($rows->feshantion == '1') {
                                    $pers = '100';
                                    echo $pers;
                                } else {
                                    $pers = (($rows->currentgheymatmasraf - $df2) / $df2) * '100';

                                    echo round($pers, 1);
                                }
                                $totalpers = $totalpers + $pers;
                                ?>

                            </b>
                        </td>
                        <td style="color: red;  <?php if ($rows->feshantion == '1') {
                            echo 'background-color: pink"';
                        } ?>
                                "><b> <?php


                                if ($rows->feshantion == '1') {
                                    $sood = '100';
                                    echo $sood;
                                } else {
                                    $totalp = ($df2 * ($rows->box * $rows->boxin)) + (($rows->eshantion * $rows->eshantionin) * $rows->price);


                                    $sood = abs(round((($rows->currentgheymatforrosh / $rows->currentgheymatmasraf) * 100) - 100, 2));
                                    echo '<b style="color:green">' . $sood . '</b>';

                                    $totalsood = $totalp - $fap;


                                }
                                if ($rows->feshantion == '0') {
                                    $counter = $counter + 1;
                                    $ttakhfif = ($ttakhfif + $sood);
                                }


                                ?></b>
                        </td>
                        <!--  محاسبه سود  -->


                        <td <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?>

                        ><b><?php
                                if ($rows->feshantion == '1') {
                                    $pers = '100';
                                    echo $pers;
                                    $tpers = $tpers + $pers;
                                } else {

                                    if(strlen($rows->currentgheymatforrosh))
                                    {
                                        $pers = (($rows->currentgheymatforrosh - $df2) / $df2) * 100;
                                        echo round($pers, 1);
                                        $tpers = $tpers + $pers;
                                    }else
                                    {
                                        $pers = (($rows->currentgheymatmasraf - $df2) / $df2) * 100;
                                        echo round($pers, 1);
                                        $tpers = $tpers + $pers;
                                    }

                                }
                                ?></b></td>


                        <td><textarea class="description"
                                <?php

                                if($_SESSION['UserLevel'] == '1' || $_SESSION['UserLevel'] == '2' || $_SESSION['UserLevel'] == '3')
                                {
                                    echo 'placeholder="یادداشت"';
                                }
                                else
                                {
                                    echo 'disabled';
                                }
                                ?>
                                      id="<?php echo $rows->id; ?>"><?php echo $rows->description; ?></textarea>
                            <?php
                            if ($rows->feshantion != '1') {
                                ?>
                                <br>مبلغ سود این سطر :
                                <?php
                                $prices = $tcs;

                                $SoodDaghigh = (($prices / '100') * $pers);
                                $tcs = '0';
                                echo round($SoodDaghigh);
                                $SoodDaghighTotal = $SoodDaghighTotal + $SoodDaghigh;

                            }
                            ?>
                        </td>


                        <td <?php if ($rows->feshantion == '1') {
                            echo '  style="background-color: pink"';
                        } ?>>
                            <?php
                            if($_SESSION['UserLevel'] == '1' || $_SESSION['UserLevel'] == '2' || $_SESSION['UserLevel'] == '3'  ) {

                                if ($_SESSION['UserId'] == $factor->creator && $factor->status != '3') {
                                    ?>

                                    <button class="editbtn btn btn-primary" id="<?php

                                    echo $rows->id;


                                    ?>">ویرایش
                                    </button>
                                    <br><br><br>
                                    <button class="delete btn btn-danger" style="margin-top: 5px;" id="<?php

                                    echo $rows->id;


                                    ?>">حذف<br>
                                    </button>

                                    <?php
                                }
                                ?>


                                <?php
                                if ($_SESSION['UserId'] == "1" || $_SESSION['UserId'] == "9" || $_SESSION['UserId'] == "13" || $_SESSION['UserId'] == "55" || $_SESSION['UserId'] == "57" || $_SESSION['UserId'] == "61"|| $_SESSION['UserId'] == "63   ") {
                                    if ($factor->status != '3') {
                                        ?>
                                        <br><br><br>
                                        <button class="payment btn btn-success" style="margin-top: 5px;" id="<?php

                                        echo $rows->id;


                                        ?>">قیمت گذاری
                                        </button>
                                        <?php
                                    }
                                }
                            }
                            ?>

                    </tr>

                    <?php
                }
                ?>
                <td></td>
                <td style="color:black; font-size: 17px; background-color: #02B875"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td><h4 style="color: red;"><?php echo number_format($calculate_Total_count);?></h4></td>
                <td style="color:black; font-size: 20px; background-color: red"><?php echo number_format($jamegheymatezayeat); ?> </td>
                <td style="color:black; font-size: 20px; background-color: #02B875"><?php echo number_format($jamegheymatekham); ?> </td>

                <td style="color:black; font-size: 20px; background-color: #c0a16b"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td><h4 style="color: blue"><?php echo  number_format($calculate_Total_eshantion); ?></h4></td>
                <td style="background-color: #ffb2cc"></td>
                <td></td>
                <td style="color:black; font-size: 17px; background-color: #afd9ee"><h4><?php echo number_format(round($calculate_Total_hajmi)); ?></h4></td>
                <td><h4><?php echo number_format(round($calculate_Total_tax)); ?></h4></td>
                <td  style="color:black; font-size: 17px; background-color: #f8ff6f"><h4><?php echo number_format(round($calculate_Total_tax2)); ?></h4></td>
                <td ><h4><?php echo number_format(round($calculate_Total_naghdi)); ?></h4></td>

                <td><h4><?php echo number_format(round($calculate_Total_percent)); ?></h4></td>
                <td style="color:green; font-size: 17px;background-color: #c4e3f3"></td>
                <td style="color:green; font-size: 20px;background-color: #c4e3f3"></td>
                <td></td>
                <td style="background-color: #ffb2cc;font-size: 17px; background-color: #f7ecb5" ></td>




                <td style="color:black; font-size: 17px; background-color: #f8ff6f"><?php  ?></td>
                <td style="color:black; font-size: 17px; background-color: #f7ecb5"><?php echo $faptotal; ?></td>


                <td style="color:black; font-size: 22px; background-color: #e4b9c0 ; color: red;"><?php echo number_format(round($GhabelPardakhtJadid)); ?> </td>


                <td  style="color:black; font-size: 17px; background-color: #f8ff6f"><?php echo $fullyTax2;?> </td>

                <td> </td>
                <td style="color:black; font-size: 17px; background-color: #72b1ff" class="hided"><?php echo number_format(round($store_sum)); ?> </td>

                <td></td>
                <td><?php echo round($totalpers / $counter, 1); ?></td>
                <td style="color: green; font-size: 20px"><?php echo round($ttakhfif / $counter, 1); ?></td>

                <td style="color: red; ?>"><?php echo round($tpers / $counter, 1); ?></td>
                <b>
                    <td>جمع کل سود این فاکتور :
                        <b> <?php echo round($SoodDaghighTotal); ?></b>
                        <br>


                        درصد دقیق سود فاکتور:

                        <?php $darsSood = ('100' / $GhabelPardakhtJadid * $SoodDaghighTotal);
                        echo '<br><b>' . round($darsSood, 1) . '</b>';
                        ?>
                    </td>

                </b>

                <td></td>
                <td></td>
            </table>

            <script>


                $("#sender").click(function () {
                    var price = $("#fullprice").val();
                    var sood = $("#sood").val();
                    var CoType = $("#CoType").val();
                    var factorid = <?php echo $id; ?>;
                    $.post("page.php", {
                        page: 'SaveFactorFinal',
                        price: price,
                        sood: sood,
                        CoType: CoType,
                        factorid: factorid
                    }, function (data) {


                        alert(data);

                        refresh();

                    });
                });
            </script>

            <?php

            $factor = new factor();
            $factor->GetFactorData($id);

        if ($factor->status == '3')
        {
            ?>

            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2 ">
                    <input type="text" id="fullprice" class="form-control input-lg text-center" disabled value="<?php echo round($GhabelPardakhtJadid);?>" placeholder="مبلغ کل فاکتور">
                </div>

                <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2 ">
                    <input type="text" id="sood" class="form-control input-lg text-center " disabled value="<?php echo round($darsSood , 1); ?>">
                </div>


                <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2 ">
                    <select id="CoType" class="form-control input-lg ">
                        <option value="1">لبنیات</option>
                        <option value="2">شرکتی</option>
                    </select>

                </div>


                <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 ">
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                        <input type="submit" id="sender"
                            <?php if($factor->fullsaved == '1')
                            {
                                echo 'disabled';
                            }?>
                               class="form-control btn btn-lg btn-success input-lg text-center " value="ثبت مبلغ " ?>
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6" >
                        <input type="submit" id="EnableButton" class="form-control btn btn-lg btn-danger input-lg text-center " value="بازکردن فاکتور" ?>
                    </div>


                    <script>
                        $("#EnableButton").click(function () {
                            $( "#sender" ).prop( "disabled", false );
                        });
                    </script>
                </div>

                <?php
                }
                ?>

            </div>

            <?php


        }
        else
        {
            echo 'هنوز هیچ محصولی در این فاکتور ثبت نشده';
        }
    }





    public function entitydelete($id)
    {
        $dbconnect = new db();
        $sql = "delete from factorentity where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id", $id);
        if ($result->execute()) {
            header("location:index.php");
        } else {
            echo 'خطا';
        }
    }






    public function UpdateEntityDescription($id,$description)
    {
        $dbconnect =new db();
        $sql = "update factorentity set description = :description where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("description",$description);
        $result->execute();

        if($result->rowCount() > '0')
        {
            echo 'ok';
        }
        else
        {
            echo 'false';
        }
    }



    public function GetEntityData($id)
    {
        $dbconnect =new db();
        $sql = "select * from factorentity where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->execute();

        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $this->id = $rows->id;
                $this->Box = $rows->box;
                $this->InBox = $rows->boxin;
                $this->Price = $rows->price;
                $this->productcode = $rows->productid;

                $this->tax = $rows->tax;
                $this->hajmi = $rows->discounthajmi;
                $this->naghdi = $rows->discountnaghdi;

                $this->eshantionCode = $rows->eshantionCode;
                $this->eshantionInPrice = $rows->eshantionPrice;
                $this->eshantionbox = $rows->eshantion;
                $this->eshantionInBox = $rows->eshantionin;
                $this->productforosh = $rows->currentgheymatforrosh;
                $this->productmasraf = $rows->currentgheymatmasraf;
                $this->eshantionpercent = $rows->eshantionpercent;
                $this->tax2 = $rows->tax2;
            }



        }
        else
        {
            echo 'false';
        }

    }



    public function UpdateForooshPrice($id,$price,$masraf)
    {
        $dbconnect =new db();
        $sql = "update factorentity set currentgheymatforrosh = :currentgheymatforrosh , currentgheymatmasraf = :currentgheymatmasraf where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("currentgheymatforrosh",$price);
        $result->bindParam("currentgheymatmasraf",$masraf);
        $result->execute();

        if($result->rowCount() > '0')
        {
            echo '1';
        }
        else
        {
            echo '0';
        }
    }



    public function CheckForAlert($id)
    {
        $dbconnect =new db();
        $sql = "select * from danger where productid = :productid";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("productid",$id);
        $result->execute();

        if($result->rowCount() > '0')
        {
            ?>
            <script>
                alert('این کالا جزو کالاهایی است که باید به انبار ارسال شود ');
            </script>
            <?php
        }
        else
        {
            return '0';
        }
    }




    public function OneEntityRowClose($id)
    {
        error_reporting(0);
        $entity = new entity();
        $entity->GetEntityData($id);
        $entity->getProductData($entity->productcode);
        $entity->getEshantionData($entity->eshantionCode);
        ?>

        <?php  $entity->productname; ?></h3>

        <h3><?php  $entity->InBox; ?> </h3>


        <h3><?php $productCount =  $entity->Box * $entity->InBox ;
            ?> </h3>



        <?php  $fullPrice  = $productCount * $entity->Price; ?> </h3>










        <?php $eshantionCount =  $entity->eshantionInBox * $entity->eshantionbox ;
        ?>


        <?php  $fullPriceeshantion  = $eshantionCount * $entity->eshantionInPrice; ?>


        <?php $percent = ('100' / ($fullPrice + $fullPriceeshantion) * $fullPriceeshantion);


        $gheymanbaeshantion = $entity->Price - (($entity->Price / '100') * $percent);
        $gheymanbanaghdi = $gheymanbaeshantion - (($gheymanbaeshantion / '100') * $entity->naghdi);
        $gheymanbamaliat = $gheymanbanaghdi + (($gheymanbanaghdi / '100') * $entity->tax);
        $gheymanbahajmi0 = $gheymanbamaliat - (($gheymanbamaliat / '100') * $entity->hajmi);
        $finalPrice0 = $gheymanbahajmi0 - (($gheymanbahajmi0 / '100') * $entity->eshantionpercent);


        $tax2 = (($finalPrice0 /100) * $entity->tax2);
        $finalPrice = $finalPrice0 + $tax2;

        $HashiyeSood = (($entity->productforosh - $finalPrice) / $finalPrice) * 100;
        echo $HashiyeSood . '<br>';
        $takhfifTakForosh = (($entity->productforosh / $entity->productmasraf) * 100 ) - 100;
        echo $takhfifTakForosh . '<br>';
        $nakhales = (($entity->productmasraf - $finalPrice) / $finalPrice) * 100;
        echo $nakhales . '<br>';

        $this->UpdateOneEntityRow($id , $finalPrice , $percent , $HashiyeSood , $takhfifTakForosh , $nakhales);
        echo $percent;

        echo $id;
    }








    public function OneEntityRowPriceLive($id)
    {
        error_reporting(0);
        $entity = new entity();
        $entity->GetEntityData($id);
        $entity->getProductData($entity->productcode);
        $entity->getEshantionData($entity->eshantionCode);
        ?>

        <?php  $entity->productname; ?></h3>

        <h3><?php  $entity->InBox; ?> </h3>


        <h3><?php $productCount =  $entity->Box * $entity->InBox ;
            ?> </h3>



        <?php  $fullPrice  = $productCount * $entity->Price; ?> </h3>




        <?php $eshantionCount =  $entity->eshantionInBox * $entity->eshantionbox ;
        ?>


        <?php  $fullPriceeshantion  = $eshantionCount * $entity->eshantionInPrice; ?>


        <?php $percent = ('100' / ($fullPrice + $fullPriceeshantion) * $fullPriceeshantion);


        $gheymanbaeshantion = $entity->Price - (($entity->Price / '100') * $percent);
        $gheymanbanaghdi = $gheymanbaeshantion - (($gheymanbaeshantion / '100') * $entity->naghdi);
        $gheymanbamaliat = $gheymanbanaghdi + (($gheymanbanaghdi / '100') * $entity->tax);
        $gheymanbahajmi0 = $gheymanbamaliat - (($gheymanbamaliat / '100') * $entity->hajmi);
        $finalPrice0 = $gheymanbahajmi0 - (($gheymanbahajmi0 / '100') * $entity->eshantionpercent);


        $tax2 = (($finalPrice0 /100) * $entity->tax2);
        $finalPrice = $finalPrice0 + $tax2;

        $HashiyeSood = (($entity->productforosh - $finalPrice) / $finalPrice) * 100;
        $takhfifTakForosh = (($entity->productforosh / $entity->productmasraf) * 100 ) - 100;
        $nakhales = (($entity->productmasraf - $finalPrice) / $finalPrice) * 100;

        $this->FinalPriceLive =  $finalPrice;


    }





    public function UpdateOneEntityRow($id , $finalPrice , $percent , $HashiyeSood , $takhfifTakForosh , $nakhales)
    {
        $dbconnect =new db();
        $sql = "update factorentity set finalPrice = :finalPrice , perc = :per  , hashiyesood = :hashiyesood ,takhfifTakForoshi = :takhfifTakForoshi , soodNakhales = :soodNakhales where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->bindParam("finalPrice",$finalPrice);
        $result->bindParam("per",$percent);
        $result->bindParam("hashiyesood",$HashiyeSood);
        $result->bindParam("takhfifTakForoshi",$takhfifTakForosh);
        $result->bindParam("soodNakhales",$nakhales);

        $result->execute();

        if($result->rowCount() > '0')
        {
            echo 'RowUpdated->';
        }
        else
        {
            echo '0';
            var_dump($result->errorInfo());
        }
    }




    public function getEntityFactorId($id)
    {
        $dbconnect =new db();
        $sql = "select * from factorentity where id = :id";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$id);
        $result->execute();

        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {

                $this->factorid = $rows->factorid;
            }
        }
        else
        {
            return '0';
        }
    }


    public function getRowEntitData($row)
    {
        $dbconnect = new db();
        $sql = "select * from factorentity where id = :id";

        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("id",$row);

        $result->execute();

        if($result->rowCount() > 0)
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $this->Price = $rows->finalPrice;
                $this->productcode = $rows->productid;
            }
        }

    }




}