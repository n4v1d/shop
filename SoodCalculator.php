<?php
set_time_limit(0);

?>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>


<form method="post" action="">
<!--js-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--js-->
<script src="js/responsiveslides.min.js"></script>
<div class="row">
    <div class="col-lg-4 col-md-4 col-xs-4">

        <div class="col-lg-4">
            <label class="text-center">روز</label>
            <select  name="fday"  class="input-lg form-control ">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
                <option>24</option>
                <option>25</option>
                <option>26</option>
                <option>27</option>
                <option>28</option>
                <option>29</option>
                <option>30</option>
                <option>31</option>
            </select>
        </div>







        <div class="col-lg-4">
            <label class="text-center">ماه</label>
            <select name="fmonth"  class="input-lg form-control ">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>

            </select>
        </div>





        <div class="col-lg-4">
            <label class="text-center">سال</label>
            <select name="fyear"  class="input-lg form-control ">
                <option>1396</option>
                <option>1397</option>
            </select>
        </div>


    </div>




    <div class="col-lg-4 col-md-4 col-xs-4">

        <div class="col-lg-4">
            <label class="text-center">روز</label>
            <select  name="tday"  class="input-lg form-control ">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
                <option>24</option>
                <option>25</option>
                <option>26</option>
                <option>27</option>
                <option>28</option>
                <option>29</option>
                <option>30</option>
                <option>31</option>
            </select>
        </div>







        <div class="col-lg-4">
            <label class="text-center">ماه</label>
            <select name="tmonth"  class="input-lg form-control ">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>

            </select>
        </div>





        <div class="col-lg-4">

            <label class="text-center">سال</label>
            <select name="tyear"  class="input-lg form-control ">
                <option>1396</option>
                <option>1397</option>


            </select>
        </div>


    </div>

    <div class="col-lg-4 col-md-4 col-xs-4">
        <label>نوع شرکت</label>
        <select name="CoType" class="input-lg form-control ">
            <option value="1">لبنیات</option>

            <option value="2">شرکتی</option>

            <option value="3">تجمیعی</option>
        </select>

    </div>
    </div>
    <div class="row" style="margin-top: 30px;">

        <div class="col-lg-6 col-md-6 col-xs-6 col-lg-offset-3  col-md-offset-3  col-xa-offset-3  ">
            <input type="submit" value="مشاهده گزارش" class="input-lg form-control btn btn-success">
        </div>
    </div>







</div>
<?php

error_reporting(0);
if(isset($_POST['fday']))
{
    $fday = $_POST['fday'];
    $tday = $_POST['tday'];

    $fmonth = $_POST['fmonth'];
    $tmonth = $_POST['tmonth'];

$fyear = $_POST['fyear'];
    $tyear = $_POST['tyear'];




$CoType = $_POST['CoType'];



require 'autoload.php';

    require 'lib/jdf.php';
    $from = jmktime('00', '00', '01', $fmonth, $fday, $fyear);
    $to = jmktime('23', '59', '59', $tmonth, $tday, $tyear);
    $factor = new factor();

    echo $factor->count;


?>
    <?php


    $factor->GetFactorSoodDetail($from, $to , $CoType);
}
?>