<?php

class archive
{
    public function newArchive($company , $address , $comment)
    {
        $dbconnect = new db();
        $sql= "insert into archive (company , file_address ,comment) values (:company , :file_address ,:comment)";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam('company' , $company);
        $result->bindParam('file_address' , $address);
        $result->bindParam('comment' , $comment);


        $result->execute();

        if($result->rowCount() > '0')
        {
            echo 'اطلاعات با موفقیت ذخیره شد';
        }
        else
        {
            echo 'خطا در ثبت اطلاعات';
        }


    }



    public function ShowArchive($companycode)
    {
        $company = new company();
        $dbconnect = new db();
        $sql= "select * from archive where company = :company ";
        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam('company' , $companycode);


        $result->execute();

        if($result->rowCount() > '0')
        ?>

            <table class="table table-responsive table-bordered table-hovered   table-striped  table-hover table-condensed " >
            <tr >
            <td >نام شرکت</td>
            <td>موضوع </td>
            <td>مبلغ </td>

            </tr>

            <?php
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                ?>
                <tr>
                <td><?php echo $company->getCompanyDetail($rows->company); echo $company->name; ?></td>
                <td><?php echo $rows->comment; ?></td>
                <td><a href="/shop/<?php echo $rows->file_address; ?>">مشاهده فایل</a> </td>

                </tr>


                <?php

            }
        }

}

?>