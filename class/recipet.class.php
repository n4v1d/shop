<?php
class recipet
{
    public function searchRecipet($factorid,$name,$type)
    {

        $dbconnect = new db();


        if ($type == '2')
        {
            $sql = "select * from recipet where factorid = :factorid order by id desc";

        }


        if ($type == '1')
        {
            $sql = "select * from recipet where cname = :name  order by id desc";

        }
        $result = $dbconnect->connect->prepare($sql);


        if ($type == '2')
        {
            $result->bindParam("factorid",$factorid);

        }


        if ($type == '1')
        {
            $result->bindParam("name",$name);

        }

        $result->execute();
        if($result->rowCount() > '0')
        {
             $company = new company();
            ?>
            <table class="table table-responsive table-bordered table-hovered   table-striped  table-hover table-condensed " >
            <tr >
            <td >نام شرکت</td>
            <td>شماره فاکتور</td>
            <td>مبلغ </td>
            <td>شماره پرداخت</td>
            <td>حساب دریافت کننده</td>
            <td>شماره کارت یا حساب</td>
            <td>بانک</td>
            <td>تاریخ پرداخت</td>
            <td>پرداخت کننده</td>
            <td>مدیریت</td>
            </tr>

            <?php
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                ?>
                <tr>
                <td><?php echo $company->getCompanyDetail($rows->cname); echo $company->name; ?></td>
                <td><?php echo $rows->factorid; ?></td>
                <td><?php echo $rows->price; ?></td>
                <td><?php echo $rows->payid; ?></td>
                <td><?php echo $rows->reciver; ?></td>
                <td><?php echo $rows->accountnumber; ?></td>
                <td><?php echo $rows->bank; ?></td>
                <td><?php echo jdate('Y/m/d',$rows->date); ?></td>
                <td><?php echo $rows->person; ?></td>
                <td width="10%"><span class="glyphicon glyphicon-edit"> <span  style="margin-right: 20px;" class="glyphicon glyphicon-trash "></span>   </span> </td>
                </tr>



                <?php

            }
        }

        else
        {
            echo '<h1 class="text-danger text-center">متاسفانه فاکتوری با این مشخصات یافت نشد</h1>';
        }

    }


    public function insertNewRecipet($name,$factorid ,$price,$time,$person , $bank,$payid , $type , $accountnumber ,$reciver)
    {
        $dbconnect = new db();
        $sql = "insert into recipet (cname,factorid,price,date,person,bank,payid,type,accountnumber,reciver) values (:cname,:factorid,:price,:date,:person,:bank,:payid,:type,:accountnumber,:reciver)";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("cname",$name);
        $result->bindParam("factorid",$factorid);
        $result->bindParam("price",$price);
        $result->bindParam("date",$time);
        $result->bindParam("person",$person);
        $result->bindParam("bank",$bank);
        $result->bindParam("payid",$payid);
        $result->bindParam("type",$type);
        $result->bindParam("accountnumber",$accountnumber);
        $result->bindParam("reciver",$reciver);

        $result->execute();

        if($result->rowCount() > '0')
            {
                echo 'واریزی شما با موفقیت ثبت شد';
            }
            else
                {
                    echo 'خطایی روی داده است';
                }

    }



    public function lastRecipet()
    {


        $dbconnect = new db();



            $sql = "select * from recipet order by id desc  limit 0,30";



        $result = $dbconnect->connect->prepare($sql);



        $result->execute();
        if($result->rowCount() > '0')
        {
            $company = new company();
            ?>
            <table class="table table-responsive table-bordered table-hovered   table-striped  table-hover table-condensed " >
            <tr >
            <td >نام شرکت</td>
            <td>شماره فاکتور</td>
            <td>مبلغ </td>
            <td>شماره پرداخت</td>
            <td>حساب دریافت کننده</td>
            <td>شماره کارت یا حساب</td>
            <td>بانک</td>
            <td>تاریخ پرداخت</td>
            <td>پرداخت کننده</td>
            <td>مدیریت</td>
            </tr>

            <?php
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                ?>
                <tr>
                <td><?php echo $company->getCompanyDetail($rows->cname); echo $company->name; ?></td>
                <td><?php echo $rows->factorid; ?></td>
                <td><?php echo $rows->price; ?></td>
                <td><?php echo $rows->payid; ?></td>
                <td><?php echo $rows->reciver; ?></td>
                <td><?php echo $rows->accountnumber; ?></td>
                <td><?php echo $rows->bank; ?></td>
                <td><?php echo jdate('Y/m/d',$rows->date); ?></td>
                <td><?php echo $rows->person; ?></td>
                <td width="10%"><span class="glyphicon glyphicon-edit"> <span  style="margin-right: 20px;" class="glyphicon glyphicon-trash "></span>   </span> </td>
                </tr>


                <?php

            }
        }

        else
        {
            echo '<h1 class="text-danger text-center">متاسفانه فاکتوری با این مشخصات یافت نشد</h1>';
        }

    }


}