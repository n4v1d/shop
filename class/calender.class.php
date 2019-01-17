<?php


class calender
{


    public $day_sum_pass;
    public $day_sum_dade;
    public $day_sum_nadade;


    public $day_month_sum_pass;
    public $day_month_sum_dade;
    public $day_month_sum_nadade;
    public $day_month_sum;
    public $day_sum_total;



    public function InserToCalender($time, $message, $userid)
    {
        $dbconnect = new db();
        $sql = "insert into calender (time,message,userid) values (:time,:message,:userid)";

        $result = $dbconnect->connect->prepare($sql);

        // Define Variable
        $result->bindParam("time", $time);
        $result->bindParam("message", $message);
        $result->bindParam("userid", $userid);

        $result->execute();


        if ($result->rowCount() > 0) {
            echo '1';
        } else {
            echo '0';
            var_dump($result->errorInfo());
        }
    }


    public function GetTodayCalender($status)
    {
        $userid = $_SESSION['UserId'];
        $day = jdate('d', time(), '', '', 'en');
        $month = jdate('m', time(), '', '', 'en');
        $year = jdate('Y', time(), '', '', 'en');
        $todayStart = jmktime('00', '00', '00', $month, $day, $year);
        $todayEnd = jmktime('23', '59', '58', $month, $day, $year);

        $dbconnect = new db();

        $sql = "select * from calender where time < $todayEnd and time > $todayStart and userid = $userid   and status = $status";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        ?>
        <table class="table table-responsive table-striped table-bordered table-hover">
            <thead class="text-center">
            <td>عنوان یاد آور</td>
            <td>وضعیت</td>
            <td>مدیریت</td>
            </thead>
            <tbody>
            <?php

            if ($result->rowCount() > 0) {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows) {
                    ?>
                    <tr class="text-center">
                        <td><?php echo $rows->message; ?></td>
                        <td width="20%">
                            <?php
                            if ($rows->status == 0) {
                                ?>
                                <span style="color: red">انجام نشده</span>
                                <?php
                            }

                            if ($rows->status == 1) {
                                ?>
                                <span style="color: red">انجام شده</span>
                                <?php
                            }

                            ?>
                        </td>


                        <td width="10%">
                            <?php
                            if ($rows->status == 0) {
                                ?>
                                <button id="<?php echo $rows->id; ?>" class=" do btn btn-success ">انجام شد</button>
                                <?php
                            }

                            if ($rows->status == 1) {
                                ?>
                                <button id="<?php echo $rows->id; ?>" class=" undo btn btn-danger ">انجام نشد</button>
                                <?php
                            }

                            ?>
                        </td>
                    </tr>
                    <?php

                }
            }
            ?>
            </thead>
        </table>
        <?php


    }


    public function UpdateCalenderCheckStatus($id, $action)
    {
        $dbconnect = new db();
        $sql = "update factor set check_confirm = $action where id = $id";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        if ($result->rowCount() > 0) {
            echo '1';
        } else {
            echo '0';
        }
    }


    public function GetOldCalender()
    {
        $userid = $_SESSION['UserId'];

        $day = jdate('d', time(), '', '', 'en');
        $month = jdate('m', time(), '', '', 'en');
        $year = jdate('Y', time(), '', '', 'en');
        $todayStart = jmktime('00', '00', '00', $month, $day, $year);
        $todayEnd = jmktime('23', '59', '58', $month, $day, $year);

        $dbconnect = new db();

        $sql = "select * from calender where time < $todayStart  and userid = $userid and status = 0";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        ?>
        <table class="table table-responsive table-striped table-bordered table-hover">
            <thead class="text-center">
            <td>عنوان یاد آور</td>
            <td>تاریخ</td>
            <td>وضعیت</td>
            <td>مدیریت</td>
            </thead>
            <tbody>
            <?php

            if ($result->rowCount() > 0) {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows) {
                    ?>
                    <tr class="text-center">
                        <td><?php echo $rows->message; ?></td>
                        <td><?php echo jdate('Y/m/d', $rows->time, '', '', 'en'); ?></td>
                        <td width="20%">
                            <?php
                            if ($rows->status == 0) {
                                ?>
                                <span style="color: red">انجام نشده</span>
                                <?php
                            }

                            if ($rows->status == 1) {
                                ?>
                                <span style="color: red">انجام شده</span>
                                <?php
                            }

                            ?>
                        </td>


                        <td width="10%">
                            <?php
                            if ($rows->status == 0) {
                                ?>
                                <button id="<?php echo $rows->id; ?>" class=" do btn btn-success ">انجام شد</button>
                                <?php
                            }

                            if ($rows->status == 1) {
                                ?>
                                <button id="<?php echo $rows->id; ?>" class=" undo btn btn-danger ">انجام نشد</button>
                                <?php
                            }

                            ?>
                        </td>
                    </tr>
                    <?php

                }
            }
            ?>
            </thead>
        </table>
        <?php


    }


    public function GetNextDaysCalender()
    {
        $userid = $_SESSION['UserId'];

        $day = jdate('d', time(), '', '', 'en');
        $month = jdate('m', time(), '', '', 'en');
        $year = jdate('Y', time(), '', '', 'en');
        $todayStart = jmktime('00', '00', '01', $month, $day, $year);
        $todayEnd = jmktime('23', '59', '58', $month, $day, $year);

        $threedayEnd = $todayEnd + 259200;

        $dbconnect = new db();

        $sql = "select * from calender where time > $todayEnd  and time < $threedayEnd and userid = $userid and status = 0";

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        ?>
        <table class="table table-responsive table-striped table-bordered table-hover">
            <thead class="text-center">
            <td>عنوان یاد آور</td>
            <td>تاریخ</td>
            <td width="20%">وضعیت</td>
            </thead>
            <tbody>
            <?php

            if ($result->rowCount() > 0) {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows) {
                    ?>
                    <tr class="text-center">
                        <td><?php echo $rows->message; ?></td>
                        <td><?php echo jdate('Y/m/d', $rows->time, '', '', 'en'); ?></td>
                        <td width="20%">
                            <?php
                            if ($rows->status == 0) {
                                ?>
                                <span style="color: red">انجام نشده</span>
                                <?php
                            }

                            if ($rows->status == 1) {
                                ?>
                                <span style="color: red">انجام شده</span>
                                <?php
                            }

                            ?>
                        </td>


                    </tr>
                    <?php

                }
            }
            ?>
            </thead>
        </table>
        <?php


    }


    // Check Page


    public function GetOldCheckCalender($status)
    {
        $compay = new company();


        $day = jdate('d', time(), '', '', 'en');
        $month = jdate('m', time(), '', '', 'en');
        $year = jdate('Y', time(), '', '', 'en');
        $todayStart = jmktime('00', '00', '00', $month, $day, $year);
        $todayEnd = jmktime('23', '59', '58', $month, $day, $year);

        $dbconnect = new db();

        if ($status == 0) // Get Unpassed Check
        {
            $sql = "select * from factor where check_date < $todaystart  and check_confirm  > 0";

        }

        if ($status == 1) // Get Unpassed Check
        {
            $sql = "select * from factor where check_date < $todayStart  and check_confirm  < 3 and check_confirm  > 1";

        }
        if ($status == 2) // Get back Check
        {
            $sql = "select * from factor where check_date < $todayStart  check_date check_confirm  = 4";

        }

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        ?>
        <table class="table table-responsive table-striped table-bordered table-hover">
            <thead class="text-center">
            <td>نام شرکت</td>
            <td>تاریخ</td>
            <td>شماره فاکتور</td>
            <td>مبلغ</td>
            <td>وضعیت</td>
            <td>مدیریت</td>
            </thead>
            <tbody>
            <?php

            if ($result->rowCount() > 0) {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows) {
                    $compay->getCompanyDetail($rows->company);

                    ?>
                    <tr class="text-center">
                        <td><?php echo $compay->name; ?></td>
                        <td><?php echo jdate('Y/m/d', $rows->check_date, '', '', 'en'); ?></td>

                        <td><?php echo $rows->factorid; ?></td>

                        <td><?php echo $rows->fullprice; ?></td>
                        <td width="20%">
                            <?php
                            if ($rows->check_confirm == 1) {
                                ?>
                                <span style="color: red">تحویل نشده</span>
                                <br>
                                <button id="<?php echo $rows->id; ?>" class="give btn btn-info ">تحویل</button>

                                <?php
                            }

                            if ($rows->check_confirm == 2) {
                                ?>
                                <span style="color: green">تحویل شده</span>
                                <?php
                            }


                            if ($rows->check_confirm == 4) {
                                ?>
                                <span style="color: red"> برگشت خورده</span>
                                <?php
                            }
                            if ($rows->check_confirm == 3) {
                                ?>
                                <span style="color: green">  پاس شده</span>
                                <?php
                            }
                            ?>
                        </td>


                        <td width="10%">
                            <?php
                            if ($rows->check_confirm == 2 || $rows->check_confirm == 4) {
                                ?>
                                <button id="<?php echo $rows->id; ?>" class=" pass btn btn-success ">پاس شده</button>
                                <?php
                            }
                            echo '<br><br>';
                            if ($rows->check_confirm == 2) {
                                ظ÷
                                ?>
                                <button id="<?php echo $rows->id; ?>" class=" unpass btn btn-danger ">برگشت خورده
                                </button>
                                <?php
                            }


                            ?>
                        </td>
                    </tr>
                    <?php

                }
            }
            ?>
            </thead>
        </table>
        <?php


    }


    public function GetTodayCheckCalender($status)
    {

        $day = jdate('d', time(), '', '', 'en');
        $month = jdate('m', time(), '', '', 'en');
        $year = jdate('Y', time(), '', '', 'en');
        $todayStart = jmktime('00', '00', '01', $month, $day, $year);
        $todayEnd = jmktime('23', '59', '58', $month, $day, $year);

        $dbconnect = new db();

        if ($status == 0) // Get Unpassed Check
        {
            $sql = "select * from factor where check_date < $todayEnd and check_date > $todayStart   and check_confirm  = 1 ";

        }


        if ($status == 1) // Get Unpassed Check
        {
            $sql = "select * from factor where check_date < $todayEnd and check_date > $todayStart   and check_confirm < 3 and check_confirm  > 1";

        }

        if ($status == 3) // passed
        {
            $sql = "select * from factor where check_date < $todayEnd and check_date > $todayStart   and check_confirm = 3";


        }
        if ($status == 4) // passed
        {
            $sql = "select * from factor where check_date < $todayEnd and check_date > $todayStart   and check_confirm = 4";


        }

        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        $compay = new company();


        ?>
        <table class="table table-responsive table-striped table-bordered table-hover">
            <thead class="text-center">
            <td>نام شرکت</td>
            <td>تاریخ</td>
            <td>شماره فاکتور</td>
            <td>مبلغ</td>

            <td>وضعیت</td>
            <td>مدیریت</td>
            </thead>
            <tbody>
            <?php

            if ($result->rowCount() > 0) {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows) {

                    $compay->getCompanyDetail($rows->company);

                    ?>
                    <tr class="text-center">
                        <td><?php echo $compay->name; ?></td>
                        <td><?php echo jdate('Y/m/d', $rows->check_date, '', '', 'en'); ?></td>
                        <td><?php echo $rows->factorid; ?></td>
                        <td width="20%">
                            <?php
                            echo $rows->fullprice;
                            ?>
                        </td>
                        <td width="20%">
                            <?php
                            if ($rows->check_confirm == 1) {
                                ?>
                                <span style="color: red">تحویل نشده</span>
                                <br>
                                <button id="<?php echo $rows->id; ?>" class="give btn btn-info ">تحویل</button>

                                <?php
                            }

                            if ($rows->check_confirm == 2) {
                                ?>
                                <span style="color: green">تحویل شده</span>
                                <?php
                            }


                            if ($rows->check_confirm == 4) {
                                ?>
                                <span style="color: red"> برگشت خورده</span>
                                <?php
                            }

                            if ($rows->check_confirm == 3) {
                                ?>
                                <span style="color: green">  پاس شده</span>
                                <?php
                            }

                            ?>
                        </td>


                        <td width="10%">
                            <?php
                            if ($rows->check_confirm == 2 || $rows->check_confirm == 4) {
                                ?>
                                <button id="<?php echo $rows->id; ?>" class=" pass btn btn-success ">پاس شده</button>
                                <?php
                            }
                            echo '<br><br>';
                            if ($rows->check_confirm == 2) {
                                ظ÷
                                ?>
                                <button id="<?php echo $rows->id; ?>" class=" unpass btn btn-danger ">برگشت خورده
                                </button>
                                <?php
                            }


                            ?>
                        </td>
                    </tr>
                    <?php

                }
            }
            ?>
            </thead>
        </table>
        <?php


    }


    public function getUngiveCheck()
    {
        $compay = new company();

        $day = jdate('d', time(), '', '', 'en');
        $month = jdate('m', time(), '', '', 'en');
        $year = jdate('Y', time(), '', '', 'en');
        $todayStart = jmktime('00', '00', '01', $month, $day, $year);
        $todayEnd = jmktime('23', '59', '58', $month, $day, $year);

        $dbconnect = new db();

        $sql = "select * from factor where  check_confirm  = 1";


        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        ?>
        <table class="table table-responsive table-striped table-bordered table-hover">
            <thead class="text-center">
            <td>نام شرکت</td>
            <td>تاریخ</td>
            <td>مبلغ</td>
            <td>شماره فاکتور</td>
            <td>وضعیت</td>
            <td>مدیریت</td>
            </thead>
            <tbody>
            <?php

            if ($result->rowCount() > 0) {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows) {
                    $compay->getCompanyDetail($rows->company);
                    ?>
                    <tr class="text-center">
                        <td><?php echo $compay->name; ?></td>
                        <td><?php echo jdate('Y/m/d', $rows->check_date, '', '', 'en'); ?></td>
                        <td><?php echo $rows->fullprice; ?></td>
                        <td><?php echo $rows->factorid; ?></td>
                        <td width="20%">
                            <?php
                            if ($rows->check_confirm == 1) {
                                ?>
                                <span style="color: red">تحویل نشده</span>
                                <br>
                                <button id="<?php echo $rows->id; ?>" class="give btn btn-info ">تحویل</button>

                                <?php
                            }

                            if ($rows->check_confirm == 2) {
                                ?>
                                <span style="color: green">تحویل شده</span>
                                <?php
                            }


                            if ($rows->check_confirm == 4) {
                                ?>
                                <span style="color: red"> برگشت خورده</span>
                                <?php
                            }

                            ?>
                        </td>


                        <td width="10%">
                            <?php
                            if ($rows->check_confirm == 2 || $rows->check_confirm == 4) {
                                ?>
                                <button id="<?php echo $rows->id; ?>" class=" pass btn btn-success ">پاس شده</button>
                                <?php
                            }
                            echo '<br><br>';
                            if ($rows->check_confirm == 2) {
                                ?>
                                <button id="<?php echo $rows->id; ?>" class=" unpass btn btn-danger ">برگشت خورده
                                </button>
                                <?php
                            }


                            ?>
                        </td>
                    </tr>
                    <?php

                }
            }
            ?>
            </thead>
        </table>
        <?php


    }


    public function GetFeatureCheckCalender($status)
    {

        $day = jdate('d', time(), '', '', 'en');
        $month = jdate('m', time(), '', '', 'en');
        $year = jdate('Y', time(), '', '', 'en');
        $TommarowStart = jmktime('23', '59', '59', $month, $day, $year) + 1;
        $TommarowEnd = $TommarowStart + 86400;

        $Tommarow1Start = $TommarowEnd;
        $Tommarow1End = $TommarowEnd + 86400;


        $Tommarow2Start = $Tommarow1End;
        $Tommarow2End = $Tommarow1End + 86400;


        $dbconnect = new db();

        if ($status == 1) // Get Unpassed Check
        {
            $sql = "select * from factor where check_date < $TommarowEnd and check_date > $TommarowStart   and check_confirm  > 0 ";

        }

        if ($status == 2) // Get Unpassed Check
        {
            $sql = "select * from factor where check_date < $Tommarow1End and check_date > $Tommarow1Start   and check_confirm  > 0 ";

        }


        if ($status == 3) // Get Unpassed Check
        {
            $sql = "select * from factor where check_date < $Tommarow2End and check_date > $Tommarow2Start   and check_confirm  > 0 ";

        }


        $result = $dbconnect->connect->prepare($sql);

        $result->execute();

        $compay = new company();


        ?>
        <table class="table table-responsive table-striped table-bordered table-hover">
            <thead class="text-center">
            <td>نام شرکت</td>
            <td>تاریخ</td>
            <td>مبلغ</td>
            <td>وضعیت</td>
            <td>مدیریت</td>
            </thead>
            <tbody>
            <?php

            if ($result->rowCount() > 0) {
                $data = $result->fetchAll(PDO::FETCH_OBJ);
                foreach ($data as $rows) {

                    $compay->getCompanyDetail($rows->company);

                    ?>
                    <tr class="text-center">
                        <td><?php echo $compay->name; ?></td>
                        <td><?php echo jdate('Y/m/d', $rows->check_date, '', '', 'en'); ?></td>
                        <td width="20%">
                            <?php
                            echo $rows->fullprice;
                            ?>
                        </td>
                        <td width="20%">
                            <?php
                            if ($rows->check_confirm == 1) {
                                ?>
                                <span style="color: red">تحویل نشده</span>
                                <br>
                                <button id="<?php echo $rows->id; ?>" class="give btn btn-info ">تحویل</button>

                                <?php
                            }

                            if ($rows->check_confirm == 2) {
                                ?>
                                <span style="color: green">تحویل شده</span>
                                <?php
                            }


                            if ($rows->check_confirm == 4) {
                                ?>
                                <span style="color: red"> برگشت خورده</span>
                                <?php
                            }

                            if ($rows->check_confirm == 3) {
                                ?>
                                <span style="color: green">  پاس شده</span>
                                <?php
                            }

                            ?>
                        </td>


                        <td width="10%">


                        </td>
                    </tr>
                    <?php

                }
            }
            ?>
            </thead>
        </table>
        <?php


    }


    /**
     * @param $day
     * @param $month
     * @param $year
     * @param $status
     */
    public function GetDayCheck($day, $month, $year, $status)
    {
        ?>
        <script>
            function myFunction(data) {
                window.open("CheckView.php?CheckId=" + data, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=800,left=800,width=800,height=800");
            }

            function myFunction2(data) {
                window.open("CheckViewWait.php?CheckId=" + data, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=800,left=800,width=800,height=800");
            }

        </script>
        <?php
        $company = new company();
        $day_start = jmktime('00', '00', '00', $month, $day, $year);
        $day_end = jmktime('23', '59', '59', $month, $day, $year);
        $dbconnect = new db();
        if($status == 1)
        {

            $sql = "select * from checks where time_check > $day_start and time_check < $day_end   and status IN(1,5)";

        }

        if($status == 2)
        {
            $sql = "select * from checks where time_check > $day_start and time_check < $day_end and status > 1 and status < 5   ";

        }

        $result = $dbconnect->connect->prepare($sql);
        $result->execute();



        if ($result->rowCount() > 0) {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $company->getCompanyDetail($rows->company);


                if($rows->status == 1 || $rows->status == 5) {
                    ?>

                    <span
                            <?php if($rows->check_type == 1)
                                {
                                    echo '  style="background-color: #bfffb2"';
                                }
                            ?>


                    ><input class="" type="checkbox" name="check_list[]" value="<?php echo $rows->factorid?>">
                    <span style="color: green;" onclick="myFunction(<?php echo $rows->id; ?>)"><?php echo $company->name ?></span>


                    | <span
                                onclick="myFunction(<?php echo $rows->id; ?>)"
                                style="color: red"><?php echo $rows->factorid; ?> </span> | <span
                                onclick="myFunction(<?php echo $rows->id; ?>)"
                                style="color:blue;"><?php echo number_format($rows->price) ?> </span><br></span>
                    <?php
                }


                if($rows->status  == 2) {
                    ?>
                        <span
                            <?php if($rows->check_type == 1)
                            {
                                echo '  style="background-color: #bfffb2"';
                            }
                            ?>


                        >
                    <span style="color: blue;" onclick="myFunction2(<?php echo $rows->id; ?>)"><?php echo $company->name ?></span>


                    | <span
                            onclick="myFunction2(<?php echo $rows->id; ?>)"
                            style="color: red"><?php echo $rows->factorid; ?> </span> | <span
                            onclick="myFunction2(<?php echo $rows->id; ?>)"
                            style="color:blue;"><?php echo number_format($rows->price) ?> </span></span><br>
                    <?php
                }


                if($rows->status  == 3) {
                    ?>
                        <span
                            <?php if($rows->check_type == 1)
                            {
                                echo '  style="background-color: #bfffb2"';
                            }
                            ?>


                        >
                    <span style="color: green;" onclick="myFunction2(<?php echo $rows->id; ?>)"><?php echo $company->name ?></span>


                    | <span
                            onclick="myFunction2(<?php echo $rows->id; ?>)"
                            style="color: red"><?php echo $rows->factorid; ?> </span> | <span
                            onclick="myFunction2(<?php echo $rows->id; ?>)"
                            style="color:blue;"><?php echo number_format($rows->price) ?> </span></span><br>
                    <?php
                }

                if($rows->status  == 4 ) {
                    ?>
                        <span
                            <?php if($rows->check_type == 1)
                            {
                                echo '  style="background-color: #bfffb2"';
                            }
                            ?>


                        >
                    <span style="color: red;" onclick="myFunction2(<?php echo $rows->id; ?>)"><?php echo $company->name ?></span>


                    | <span
                            onclick="myFunction2(<?php echo $rows->id; ?>)"
                            style="color: red"><?php echo $rows->factorid; ?> </span> | <span
                            onclick="myFunction2(<?php echo $rows->id; ?>)"
                            style="color:blue;"><?php echo number_format($rows->price) ?> </span>
                        </span><br>
                    <?php
                }




            }
        }
        else
        {
            echo 'هیج چکی در این روز ثبت نشده است ';
        }

    }


    public function GetDayCheckSum($day, $month, $year, $status)
    {
        $this->day_sum_dade = 0;
        $this->day_sum_nadade = 0;
        $this->day_sum_pass = 0;

        $day_start = jmktime('00', '00', '00', $month, $day, $year);
        $day_end = jmktime('23', '59', '59', $month, $day, $year);



        ?>
        <table class="table table-responsive table-hover table-bordered table-hover">

            <?php
            if($status == 1)
            {
                ?>
                <tr >
                    <td> چک</td>
                    <td><?php $this->GetDayCheckSumsungive($day_start,$day_end,0);?></td>
                </tr>

                <tr style="background-color: #e4ffde" >
                    <td> حواله</td>
                    <td><?php $this->GetDayCheckSumsungive($day_start,$day_end,1);?></td>
                </tr>


                <tr >
                    <td>جمع روز</td>
                    <td><?php $this->GetTodalDaySum($day_start,$day_end,'4');?></td>
                </tr>

                <?php
            }


                        if($status == 2)
            {
                ?>

                <tr style="color: blue;">
                    <td>تحویل شده</td>
                    <td><?php $this->GetDayCheckSumsgive($day_start,$day_end,'0');?></td>
                </tr>

                <tr style="color: green;">
                    <td>پاس شده</td>
                    <td><?php $this->GetDayCheckSumsPassed($day_start,$day_end,0);?></td>
                </tr>


                <tr >
                    <td>جمع کل</td>
                    <td><?php $this->GetTodalDaySum($day_start,$day_end,'0');?></td>
                </tr>





                <tr style=" color: blue;background-color: #e4ffde">
                    <td>تحویل شده</td>
                    <td><?php $this->GetDayCheckSumsgive($day_start,$day_end,1);?></td>
                </tr>

                <tr style="color: green;background-color: #e4ffde">
                    <td>پاس شده</td>
                    <td><?php $this->GetDayCheckSumsPassed($day_start,$day_end,1);?></td>
                </tr>


                <tr style="background-color: #e4ffde">
                    <td >جمع کل</td>
                    <td><?php $this->GetTodalDaySum($day_start,$day_end , 1);?></td>
                </tr>


                <tr >
                    <td>جمع روز</td>
                    <td><?php $this->GetTodalDaySum($day_start,$day_end,'');?></td>
                </tr>



                <?php
            }



?>

        </table>
        <?php

    }





    public function GetDayCheckSumsPassed($day_start,$day_end,$type)
    {
        $this->day_sum = 0;
        $this->day_sum_pass = 0;
        ?>

        <?php
        $dbconnect = new db();


            $sql = "select * from checks where time_check > $day_start and time_check < $day_end  and status = 3  and check_type = :type";



        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("type",$type);
        $result->execute();

        if ($result->rowCount() > 0) {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $this->day_sum_pass = $this->day_sum_pass + $rows->price;

            }
        }
        echo number_format($this->day_sum_pass);

    }





    public function GetTodalDaySum($day_start,$day_end,$type )
    {
        $this->day_sum_total = 0
        ?>

        <?php
        $dbconnect = new db();

        if($type == 0)
        {
            $sql = "select * from checks where time_check > $day_start and time_check < $day_end  and check_type = 0 and status in (2,3,4)";

        }

        if($type == 1)
        {
            $sql = "select * from checks where time_check > $day_start and time_check < $day_end  and check_type = 1 and status in (2,3,4)";

        }
        if($type == 2)
        {
            $sql = "select * from checks where time_check > $day_start and time_check < $day_end  and check_type = 0 and status in (1,5)";

        }


        if($type == 3)
        {
            $sql = "select * from checks where time_check > $day_start and time_check < $day_end  and check_type = 1 and status in (1,5)";

        }

        if($type == 4)
        {
            $sql = "select * from checks where time_check > $day_start and time_check < $day_end and status in (1,5)";

        }


        if($type == '')
        {
            $sql = "select * from checks where time_check > $day_start and time_check < $day_end and status in (2,3,4)";

        }






        $result = $dbconnect->connect->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $this->day_sum_total = $this->day_sum_total + $rows->price;

            }
        }
        echo number_format($this->day_sum_total);

    }



    public function GetDayCheckSumsgive($day_start,$day_end,$type)
    {
        $this->day_sum = 0;
        $this->day_sum_dade = 0;
        ?>

        <?php
        $dbconnect = new db();


            $sql = "select * from checks where time_check > $day_start and time_check < $day_end  and status = 2 and check_type = :type ";




        $result = $dbconnect->connect->prepare($sql);
        $result->bindParam("type",$type);
        $result->execute();

        if ($result->rowCount() > 0) {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $this->day_sum_dade = $this->day_sum_dade + $rows->price;

            }
        }
        echo number_format($this->day_sum_dade  );

    }





    public function GetDayCheckSumsungive($day_start,$day_end , $type)
    {
        ?>

        <?php
        $this->day_sum_nadade = 0;
        $dbconnect = new db();


            $sql = "select * from checks where time_check > $day_start and time_check < $day_end  and status  IN(1,5)  and check_type = $type ";



        $result = $dbconnect->connect->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $this->day_sum_nadade = $this->day_sum_nadade + $rows->price;

            }
        }
        echo number_format($this->day_sum_nadade);

    }






    public function GetNadadeMonth($year,$month)
    {
        $day_start = jmktime('00', '00', '00', $month, '01', $year);
        $day_end = jmktime('23', '59', '59', $month, '31', $year);


        ?>

        <?php
        $dbconnect = new db();


            $sql = "select * from checks where time_check > $day_start and time_check < $day_end  and status  IN(1,5) ";



        $result = $dbconnect->connect->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $this->day_month_sum_nadade = $this->day_month_sum_nadade + $rows->price;

            }
        }
        echo number_format($this->day_month_sum_nadade);

    }





    public function GetDadeMonth($year,$month)
    {
        $day_start = jmktime('00', '00', '00', $month, '01', $year);
        $day_end = jmktime('23', '59', '59', $month, '31', $year);


        ?>

        <?php
        $dbconnect = new db();


            $sql = "select * from checks where time_check > $day_start and time_check < $day_end  and status  = 2 ";



        $result = $dbconnect->connect->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $this->day_month_sum_dade = $this->day_month_sum_dade + $rows->price;

            }
        }
        echo number_format($this->day_month_sum_dade);

    }




    public function GetPassedMonth($year,$month)
    {
        $day_start = jmktime('00', '00', '00', $month, '01', $year);
        $day_end = jmktime('23', '59', '59', $month, '31', $year);


        ?>

        <?php
        $dbconnect = new db();


            $sql = "select * from checks where time_check > $day_start and time_check < $day_end  and status = 3 ";



        $result = $dbconnect->connect->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $this->day_month_sum_pass = $this->day_month_sum_pass + $rows->price;

            }
        }
        echo number_format($this->day_month_sum_pass);

    }


    public function GetMonthSum($year,$month)
    {
        $day_start = jmktime('00', '00', '00', $month, '01', $year);
        $day_end = jmktime('23', '59', '59', $month, '31', $year);


        ?>

        <?php
        $dbconnect = new db();


            $sql = "select * from checks where time_check > $day_start and time_check < $day_end   ";



        $result = $dbconnect->connect->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $rows) {
                $this->day_month_sum = $this->day_month_sum + $rows->price;

            }
        }
        echo number_format($this->day_month_sum);

    }





    public function updateStatus($id,$status)
        {
            $dbconnect = new db();
            $sql = "update checks set status = $status where id = $id";

            $result = $dbconnect->connect->prepare($sql);
            $result->execute();

            if($result->rowCount() > 0)
            {
                echo 'چک با موففیت تحویل شد';
            }
            else
            {
                echo 'خطا';
            }


        }
}
?>

