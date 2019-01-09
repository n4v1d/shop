<?php


function deleteEntity()
{

    $id = $_POST['id'];


    $entity = new entity();
    if($entity->entitydelete($id) == '1')
    {
        echo '<script>alert("با موفقیت از فاکتور حذف شد")</script>';
        header('location:index.php');
    }
    else
    {
        echo 'خطا';
    }
}

function editEntity()
{

    $id = $_POST['id'];
    $factorid = $_POST['factorid'];


    $entity = new factor();

    $entity->editProductData($id,$factorid);
}


function editEntitySave()
{
    $factor = new factor();
    $feshantion = $_POST['feshantion'];
    if($feshantion == 'true')
    {
        $feshantionstatus = '1';
    }
    else
    {
        $feshantionstatus = '0';
    }
    $facrorid = $_POST['factorid'];
    $eshantionin = $_POST['eshantionin'];
    $eshantion = $_POST['eshantion'];
    $productid = $_POST['productid'];
    $count = $_POST['count'];
    $boxin = $_POST['boxin'];
    $oldprice = $_POST['oldprice'];
    $gheymatforooshghadi = $_POST['gheymatforooshghadi'];
    $gheymatmasrafghadim = $_POST['gheymatmasrafghadim'];
    $gheymatjadid = $_POST['gheymatjadid'];
    $gheymatmasrafjadid = $_POST['gheymatmasrafjadid'];
    $gheymatforoshjadid = $_POST['gheymatforooshjadid'];
    $takhfifnaghdi = $_POST['takhfifnaghdi'];
    $entityid = $_POST['entityid'];
    $takhfifhajmi = $_POST['takhfifhajmi'];
    $tax = $_POST['tax'];
    $epercent = $_POST['epercent'];
    $eshantionCode = $_POST['eshantionCode'];
    $eshantionPrice = $_POST['eshantionPrice'];


    $factor->editEntitySave($gheymatjadid,$gheymatforoshjadid,$gheymatmasrafjadid,$count,$takhfifhajmi,$takhfifnaghdi,$tax,$eshantion,$boxin,$eshantionin,$feshantionstatus,$entityid,$facrorid,$epercent,$eshantionCode,$eshantionPrice,$oldprice,$gheymatmasrafghadim,$gheymatforooshghadi);
}



function getFactorEntery()
{
    $id = $_POST['id'];
    $entity = new entity();
    $entity->getFactorEntity($id);
}



function EdintEntitySave()
{
    $id = $_POST['id'];

    $factorid = $_POST['factorid'];
    $comoany = $_POST['company'];

    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    require 'lib/jdf.php';

    $time = jmktime('00','00' , '30' , $month , $day , $year);

    $factor = new factor();

    $factor->UpdateFactorData($id , $factorid , $comoany , $time);
}


?>