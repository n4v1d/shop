<?php
error_reporting(0);
$id =  $_GET['Entityid'];
require 'autoload.php';
$entity = new entity();
$entity->GetEntityData($id);
$entity->getProductData($entity->productcode);
$entity->getEshantionData($entity->eshantionCode);
?>
<div class="container">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!--css-->

    <!--js-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--js-->
    <script src="js/responsiveslides.min.js"></script>
    <script src="js/switalert.js"></script>




    <h1 class="text-center" style="margin-top: 10px">قیمت گذاری یک کالا</h1>
    <br><br>

    <h2 class="text-center">کالای اصلی</h2>
    <div class="row">
        <div style="background-color: #53ffa1; height: 100px"  class="col-md-4  col-lg-4 col-xs-4 col-sm-4"><br>
            <h4 class="text-center">نام کالا</h4>
            <h3  class="text-center"><?php echo $entity->productname; ?></h3>
        </div>

        <div style="background-color: #2afff2; height: 100px" class="col-md-4  col-lg-4 col-xs-4 col-sm-4">
            <div class="row">
                <h4 class="text-center">تعداد کالا</h4>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                <label>کارتن</label>
                <h3><?php echo $entity->Box; ?> </h3>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                <label>تعداد در کارتن</label>
                <h3><?php echo $entity->InBox; ?> </h3>

            </div>

            <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                <label>جمع کل کالا</label>
                <h3><?php $productCount =  $entity->Box * $entity->InBox ;
                    echo $productCount; ?> </h3>

            </div>

        </div>



        <div style="background-color: #ffbd47; height: 100px" class="col-md-4  col-lg-4 col-xs-4 col-sm-4">
            <div class="row">
                <h4 class="text-center">قیمت کالا </h4>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                <label>قیمت واحد</label>
                <h3><?php echo $entity->Price; ?> </h3>
            </div>

            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                <label> جمع کل</label>
                <h3><?php echo $fullPrice  = $productCount * $entity->Price; ?> </h3>

            </div>

        </div>






        <?php
        ?> <!-- از  اینجا مخفی شود -->

        <br><br>
        <h2 class="text-center">کالای اشانتیون</h2>
        <div class="row">
            <div style="background-color: #53ffa1; height: 80px"  class="col-md-4  col-lg-4 col-xs-4 col-sm-4"><br>
                <h4 class="text-center">نام کالا</h4>
                <h3  class="text-center"><?php echo $entity->productname2; ?></h3>
            </div>

            <div style="background-color: #2afff2; height: 80px" class="col-md-4  col-lg-4 col-xs-4 col-sm-4">
                <div class="row">
                    <h4 class="text-center">تعداد کالا</h4>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                    <label>کارتن</label>
                    <h3><?php echo $entity->eshantionbox; ?> </h3>
                </div>

                <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                    <label>تعداد در کارتن</label>
                    <h3><?php echo $entity->eshantionInBox; ?> </h3>

                </div>

                <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                    <label>جمع کل کالا</label>
                    <h3><?php $eshantionCount =  $entity->eshantionInBox * $entity->eshantionbox ;
                        echo $eshantionCount; ?> </h3>

                </div>

            </div>



            <div style="background-color: #ffbd47; height: 80px" class="col-md-4  col-lg-4 col-xs-4 col-sm-4">
                <div class="row">
                    <h4 class="text-center">قیمت کالا </h4>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                    <label>قیمت واحد</label>
                    <h3><?php echo $entity->eshantionInPrice; ?> </h3>
                </div>

                <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                    <label> جمع کل</label>
                    <h3><?php echo $fullPriceeshantion  = $eshantionCount * $entity->eshantionInPrice; ?> </h3>

                </div>

            </div>


        </div>






        <?php $percent = ('100' / ($fullPrice + $fullPriceeshantion) * $fullPriceeshantion);
        echo '<b>'.'درصد اشانتیون کلی';

        ?>
        <input type="text" class="form-control input-lg text-center " value="<?php echo $percent ; ?>">




        <h2 class="text-center">درصد ها</h2>
        <div class="row">
            <div style="background-color: #53ffa1; height: 60px"  class="col-md-4  col-lg-4 col-xs-4 col-sm-4"><br>
                <h5 class="text-center">درصد حجمی</h5>
                <h4  class="text-center"><?php echo $entity->hajmi; ?></h4>
            </div>


            <div class="row">
                <div style="background-color: #53ffa1; height: 60px"  class="col-md-4  col-lg-4 col-xs-4 col-sm-4"><br>
                    <h5 class="text-center">درصد نقدی</h5>
                    <h4  class="text-center"><?php echo $entity->naghdi; ?></h4>
                </div>



                <div class="row">
                    <div style="background-color: #53ffa1; height: 60px"  class="col-md-4  col-lg-4 col-xs-4 col-sm-4"><br>
                        <h5 class="text-center">درصد مالیات</h5>
                        <h4  class="text-center"><?php echo $entity->tax; ?></h4>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <br><br>


    <!-- تا اینجا مخفی است -->


    <?php
    $gheymanbaeshantion = $entity->Price - (($entity->Price / '100') * $percent);
    $gheymanbanaghdi = $gheymanbaeshantion - (($gheymanbaeshantion / '100') * $entity->naghdi);
    $gheymanbamaliat = $gheymanbanaghdi + (($gheymanbanaghdi / '100') * $entity->tax);
    $gheymanbahajmi0 = $gheymanbamaliat - (($gheymanbamaliat / '100') * $entity->hajmi);
        $gheymanbahajmi0 = $gheymanbahajmi0 - (($gheymanbahajmi0 / '100') * $entity->eshantionpercent);

        $tax2 = (($gheymanbahajmi0) / 100) * $entity->tax2;

    $gheymanbahajmi = $gheymanbahajmi0 + $tax2;

    ?>
    <h2 class="text-center">قیمت نهایی  کالا   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php   echo round($gheymanbahajmi); ?>  </h2>
    <div class="row">



    </div>






    <br><br>

    <h2 class="text-center">قیمت فروش </h2>
    <div class="row">
        <div style="background-color: #53ffa1; height: 100px"  class="col-md-5  col-lg-5 col-xs-5 col-sm-5">
            <br>


            <div class="col-lg-4 col-md-4 col-xs-4  col-sm-4">
                <h4 class="text-center">تخفیف تک فروشی  </h4>
                <input type="text" id="takf" class="form-control" name="tak">
            </div>


            <div class="col-lg-4 col-md-4 col-xs-4  col-sm-4">
                <h4 class="text-center">قیمت فروش </h4>
                <input type="text" id="foroosh" class="form-control" value="<?php echo $entity->productforosh; ?>" name="gheymatforoosh">
            </div>


            <div class="col-lg-4 col-md-4 col-xs-4  col-sm-4">
                <h4 class="text-center">قیمت مصرف </h4>
                <input type="text" id="masraf" class="form-control" value="<?php echo $entity->productmasraf; ?>" name="gheymatforoosh">
            </div>


        </div>


        <div style="background-color: #53ffa1; height: 100px"  class="col-md-5  col-lg-5 col-xs-5 col-sm-5">
            <br>
            <div class="col-lg-4 col-md-6 col-xs-4  col-sm-4">
                <h4 class="text-center"> حاشیه سود   </h4>
                <input type="text" id="hashiye" disabled class="form-control" value="" name="gheymatforoosh">
            </div>

            <div class="col-lg-4 col-md-6 col-xs-4  col-sm-4">
                <h4 class="text-center"> تک فروشی  </h4>
                <input type="text" id="tak" disabled class="form-control" value="" name="gheymatforoosh">
            </div>

            <div class="col-lg-4 col-md-6 col-xs-4  col-sm-4">
                <h4 class="text-center"> سود ناخالص   </h4>
                <input type="text" id="nakhales" disabled class="form-control" value="" name="gheymatforoosh">
            </div>
        </div>




        <div style="background-color: ; height: 100px" class="col-md-2  col-lg-2 col-xs-2 col-sm-2">
            <div class="row">
                <h4 class="text-center">ثبت  </h4>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-122 col-sm-12">
                <button id="send" class="form-control input-lg btn btn-primary btn-lg btn-block form-control">ثبت</button>
            </div>

        </div>


    </div>
</div>
</div>

<script>

    $("#foroosh").keyup(function () {

        var forosh = $("#foroosh").val();
        var masraf = $("#masraf").val();
        var nakhales = $("#nakhales").val();
        var tak = $("#tak").val();

        var nahaii = <?php echo $gheymanbahajmi; ?>



        var hashiye = ((masraf - nahaii) / nahaii) * 100;
        var darsadnakhales = ((forosh - nahaii) / nahaii) * 100;
        var darsadtak = ((masraf - forosh) / masraf) * 100;

        $("#nakhales").val(Math.round(darsadnakhales));
        $("#tak").val(Math.round(darsadtak));
        $("#hashiye").val(Math.round(hashiye));

    });

    $("#masraf").keyup(function () {

        var forosh = $("#foroosh").val();
        var masraf = $("#masraf").val();
        var nakhales = $("#nakhales").val();
        var tak = $("#tak").val();

        var nahaii = <?php echo $gheymanbahajmi; ?>



        var hashiye = ((masraf - nahaii) / nahaii) * 100;
        var darsadnakhales = ((forosh - nahaii) / nahaii) * 100;
        var darsadtak = ((masraf - forosh) / masraf) * 100;

        $("#nakhales").val(Math.round(darsadnakhales));
        $("#tak").val(Math.round(darsadtak));
        $("#hashiye").val(Math.round(hashiye));

    });






    $("#takf").keyup(function () {

        var masraf = $("#masraf").val();
        var tak = $("#takf").val();
        var takfinal = masraf - ((masraf / 100) * tak);
        $("#foroosh").val(Math.round(takfinal));

    });






    $("#send").click(function () {
        var id  =  <?php echo $_GET['Entityid']; ?>;
        var price = $("#foroosh").val();
        var masraf = $("#masraf").val();
        $.post("PaymentEditorSave.php",{id:id,price:price,masraf:masraf},function (data) {

            if(data == 1)
            {
                swal(
                    'ثبت شد',
                    ' ثبت قیمت با موفقیت انجام شد!',
                    'success'
                )

            }
        })
    })


</script>

<?php
$products = new product();
$products->GiveLastBuyReport($entity->productcode);
?>
