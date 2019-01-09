<?php

class company
{

    public $name;
    public $date;

    public function GetAllBranList()
    {
        $dbconnect = new db();
        $sql = "select * from company where iscompany = '0'";

        $result = $dbconnect->connect->prepare($sql);
        ?>
        <table class="table table-responsive table-bordered table-striped text-center">
        <thead>
        <td>نام شرکت</td>
        <td>ایا شرکت هست</td>
        </thead>
        <tbody>

        <?php
        $result->execute();
        if ($result->rowCount() > '0') {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                ?>
                <tr>
                <td><?php echo $rows->name; ?> </td>
                <td><a href="IsCompany.php?CompanyId=<?php echo $rows->id; ?>"><span
                                class="glyphicon glyphicon-check"></span></a></td>
                <?php
            }
            echo '</table>';
        }

    }


    public function IsCompany($companyid)
    {

        $dbconnect = new db();
        $sql = "update company set iscompany = '1' where id = :id";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id", $companyid);
        $result->execute();

        if ($result->rowCount() > '0') {
            echo 'با موفقیت ثبت شد';
        } else {
            echo 'خطا در ثبت اطلاعات ';
        }
    }


    public function GetAllCompanyList()
    {
        $dbconnect = new db();
        $sql = "select * from company where iscompany = '1'";

        $result = $dbconnect->connect->prepare($sql);
        ?>
        <table class="table table-responsive table-bordered table-striped text-center">
        <thead>
        <td>نام شرکت</td>
        <td>مدت تسویه</td>
        <td>ویرایش</td>
        </thead>
        <tbody>

        <?php
        $result->execute();
        if ($result->rowCount() > '0') {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                ?>
                <tr>
                <td><?php echo $rows->name; ?> </td>
                <td><?php echo $rows->date;?></td>
                <td><a href="SetCompanyDate.php?CompanyId=<?php echo $rows->id; ?>"><span class="glyphicon glyphicon-edit"></span></a> </td>
                <?php
            }
            echo '</table>';
        }

    }


    public function DeCompany($companyid)
    {

        $dbconnect = new db();
        $sql = "update company set iscompany = '0' where id = :id";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id", $companyid);
        $result->execute();

        if ($result->rowCount() > '0') {
            echo 'با موفقیت ثبت شد';
        } else {
            echo 'خطا در ثبت اطلاعات ';
        }
    }


    public function getCompanyDetail($CompanyId)
    {
        $dbconnect = new db();
        $sql = "select * from company where id = :id";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id",$CompanyId);

        $result->execute();

        if($result->rowCount() > '0')
        {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows)
            {
                $this->name = $rows->name;
                $this->date = $rows->date;
            }

        }


    }

    public function UpdateCompanyDate($CompanyId , $date)
    {
        $dbconnect = new db();
        $sql = "update company set date = :date where id = :id";

        $result = $dbconnect->connect->prepare($sql);

        $result->bindParam("id", $CompanyId);
        $result->bindParam("date", $date);
        $result->execute();

        if ($result->rowCount() > '0') {
            echo 'با موفقیت ثبت شد';
            header('location:CompanyList.php');
        } else {
            echo 'خطا در ثبت اطلاعات ';
        }
    }


}
?>